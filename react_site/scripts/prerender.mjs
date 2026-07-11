/**
 * prerender.mjs — SSG snapshot + critical-CSS inline pipeline.
 *
 * Usage: node scripts/prerender.mjs [buildDir]   (default: dist)
 *
 * 1. Serves the built dir on a local port with SPA fallback (sirv single mode).
 * 2. Boots each route in real headless Chrome (puppeteer-core) so browser-only
 *    code renders, then captures the fully-rendered HTML.
 * 3. At snapshot time there is no scroll, so lazy three.js/WebGL chunks never
 *    load — snapshots stay light.
 * 4. Inlines above-the-fold critical CSS with beasties and async-loads the rest.
 */

import http from 'node:http';
import path from 'node:path';
import fs from 'node:fs/promises';
import { fileURLToPath } from 'node:url';
import sirv from 'sirv';
import puppeteer from 'puppeteer-core';
import Beasties from 'beasties';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const projectRoot = path.resolve(__dirname, '..');

const BUILD_DIR = path.resolve(projectRoot, process.argv[2] || 'dist');
const CHROME_PATH =
  process.env.CHROME_PATH ||
  '/snap/chromium/current/usr/lib/chromium-browser/chrome';

const PORT = 5188;
const HOST = '127.0.0.1';

// Routes to snapshot. /labs/scan-resolve is intentionally excluded (noindex,
// heavy WebGL) so it keeps the plain SPA shell.
const ROUTES = [
  '/',
  '/about',
  '/pricing',
  '/contact',
  '/blog',
  '/terms',
  '/privacy-policy',
  '/cookies-policy',
  '/services/virtual-tours-education',
  '/services/digital-twins-solar-energy',
  '/services/virtual-tours-commercial',
  '/services/virtual-tours-hospitality',
  '/services/virtual-tours-tourism',
  '/services/digital-twins-industries',
  '/services/virtual-tours-real-estate',
  '/services/virtual-tours-construction',
  '/services/digital-twins-manufacturing',
  '/blog/3d-virtual-tour-cost-uk',
  '/blog/matterport-vs-local-provider',
  '/case-studies/ai-video-ship-maintenance',
  '/resources/digital-twins-manufacturing',
];

const NETWORK_IDLE_TIMEOUT = 30000;
const H1_TIMEOUT = 15000;
const HELMET_FLUSH_MS = 300;

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function startServer(dir) {
  const serve = sirv(dir, { single: true, dev: false, etag: false });
  const server = http.createServer((req, res) => serve(req, res));
  await new Promise((resolve, reject) => {
    server.once('error', reject);
    server.listen(PORT, HOST, resolve);
  });
  return server;
}

async function inlineCriticalCss(html, dir) {
  // beasties needs the built stylesheet reachable from the served root. It
  // resolves <link href="/assets/*.css"> against `path`, and rewrites the
  // remaining full stylesheet to load async (preload + onload swap).
  const beasties = new Beasties({
    path: dir,
    publicPath: '/',
    preload: 'swap',
    pruneSource: false, // keep the source stylesheet intact
    inlineFonts: false,
    logLevel: 'silent',
  });
  return beasties.process(html);
}

async function main() {
  // Verify prerequisites.
  await fs.access(CHROME_PATH).catch(() => {
    throw new Error(`Chrome binary not found at ${CHROME_PATH}`);
  });
  await fs.access(BUILD_DIR).catch(() => {
    throw new Error(`Build dir not found: ${BUILD_DIR}. Run vite build first.`);
  });

  console.log(`[prerender] build dir : ${BUILD_DIR}`);
  console.log(`[prerender] chrome    : ${CHROME_PATH}`);
  console.log(`[prerender] routes    : ${ROUTES.length}`);

  let server;
  let browser;
  const summary = [];
  let hadError = false;

  try {
    server = await startServer(BUILD_DIR);
    console.log(`[prerender] serving on http://${HOST}:${PORT} (SPA fallback)\n`);

    browser = await puppeteer.launch({
      executablePath: CHROME_PATH,
      headless: 'new',
      args: [
        '--no-sandbox',
        '--disable-gpu',
        '--disable-dev-shm-usage',
      ],
    });

    // PHASE 1 — snapshot every route into memory while the served SPA shell
    // (dist/index.html) is still pristine. We must NOT write any file yet:
    // sirv's single-mode fallback serves index.html for deep routes, so
    // overwriting it mid-run would poison later routes' SPA bootstrap.
    const snapshots = [];
    for (const route of ROUTES) {
      const url = `http://${HOST}:${PORT}${route}`;
      const page = await browser.newPage();
      const consoleWarnings = [];

      page.on('console', (msg) => {
        const type = msg.type();
        if (type === 'error' || type === 'warning') {
          consoleWarnings.push(`[${type}] ${msg.text()}`);
        }
      });
      page.on('pageerror', (err) => {
        consoleWarnings.push(`[pageerror] ${err.message}`);
      });

      try {
        await page.goto(url, {
          waitUntil: 'networkidle2',
          timeout: NETWORK_IDLE_TIMEOUT,
        });
        await page.waitForSelector('h1', { timeout: H1_TIMEOUT });
        // Let react-helmet-async flush title/meta into <head>.
        await sleep(HELMET_FLUSH_MS);

        const html = await page.content();
        snapshots.push({ route, html, warnings: consoleWarnings });
        console.log(
          `[prerender] snapshot ✓ ${route.padEnd(42)} warn=${consoleWarnings.length}`
        );
        if (consoleWarnings.length) {
          for (const w of consoleWarnings.slice(0, 5)) {
            console.log(`             ↳ ${w}`);
          }
        }
      } catch (routeErr) {
        hadError = true;
        console.error(`[prerender] snapshot ✗ ${route} FAILED: ${routeErr.message}`);
      } finally {
        await page.close();
      }
    }

    // Browser + server no longer needed for writing; close early so the
    // static dir is only mutated after all snapshots are captured.
    await browser.close().catch(() => {});
    browser = null;
    await new Promise((r) => server.close(r));
    server = null;

    // PHASE 2 — write each snapshot, then inline critical CSS.
    console.log('');
    for (const snap of snapshots) {
      const { route } = snap;
      let html = snap.html;
      let cssInlined = false;
      try {
        const processed = await inlineCriticalCss(html, BUILD_DIR);
        if (processed) {
          html = processed;
          cssInlined = processed.includes('<style');
        }
      } catch (cssErr) {
        console.warn(
          `[prerender] critical-CSS failed for ${route}: ${cssErr.message}`
        );
      }

      // Write <dir>/index.html for '/', <dir><route>/index.html otherwise.
      const outDir = route === '/' ? BUILD_DIR : path.join(BUILD_DIR, route);
      await fs.mkdir(outDir, { recursive: true });
      const outFile = path.join(outDir, 'index.html');
      await fs.writeFile(outFile, html, 'utf8');

      const bytes = Buffer.byteLength(html, 'utf8');
      summary.push({
        route,
        kb: (bytes / 1024).toFixed(1),
        cssInlined,
        warnings: snap.warnings.length,
      });
      console.log(
        `[prerender] wrote ✓ ${route.padEnd(42)} ${(bytes / 1024)
          .toFixed(1)
          .padStart(7)} KB  css=${cssInlined ? 'yes' : 'no '}`
      );
    }

    // Summary block.
    console.log('\n[prerender] ===== summary =====');
    console.log(`[prerender] routes done : ${summary.length}/${ROUTES.length}`);
    const inlinedCount = summary.filter((s) => s.cssInlined).length;
    console.log(`[prerender] css inlined : ${inlinedCount}/${summary.length}`);
    for (const s of summary) {
      console.log(
        `[prerender]   ${s.route.padEnd(42)} ${s.kb.padStart(7)} KB  css=${s.cssInlined ? 'yes' : 'no'}`
      );
    }
  } catch (err) {
    hadError = true;
    console.error(`[prerender] FATAL: ${err.stack || err.message}`);
  } finally {
    if (browser) await browser.close().catch(() => {});
    if (server) await new Promise((r) => server.close(r));
    console.log('[prerender] cleaned up browser + server');
  }

  process.exit(hadError ? 1 : 0);
}

main();

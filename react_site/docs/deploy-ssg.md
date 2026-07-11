# Deploy — prerendered (SSG) build

The site is a Vite React SPA that is **prerendered to static per-route HTML** at build
time for LCP + SEO (crawlers get fully-baked `<title>`/meta/content and pages paint
before JS hydrates). Critical CSS is inlined per page (beasties); the full stylesheet
loads async.

## Deploy command — use `build:ssg`, NOT plain `build`

```bash
cd ~/beyex/react_site
npm install            # if deps changed (beasties, sirv)
npm run build:ssg      # vite build + scripts/prerender.mjs — writes dist/ with prerendered routes
```

- `npm run build` (plain `vite build`) produces an **un-prerendered SPA shell** — do not use it for prod deploys, or you lose prerendering.
- `build:ssg` builds to `dist/` and prerenders in place. For zero-downtime you can instead
  build to a staging dir and swap: `npx vite build --outDir dist-staging && node scripts/prerender.mjs dist-staging && mv dist dist-old && mv dist-staging dist`.
- Prerender uses headless Chrome at `CHROME_PATH` (snap chromium on this box:
  `/snap/chromium/current/usr/lib/chromium-browser/chrome`). puppeteer-core picks it up.
- `/labs/scan-resolve` is intentionally NOT prerendered (noindex, heavy WebGL) — it serves
  the SPA shell via fallback.

## nginx (server-side, not in this repo)

nginx serves `dist/` and resolves prerendered routes with:

```
location / { try_files $uri $uri/index.html /index.html; }
```

The `$uri/index.html` (not `$uri/`) is required so `/services/x` serves
`dist/services/x/index.html` **directly at the canonical no-slash URL** — `$uri/` would
301-redirect to a trailing slash and mismatch the canonical tags. Config backup:
`/etc/nginx/sites-available/beyex.com.bak-ssg`.

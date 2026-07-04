# Site Revamp — Handoff Brief

Context for continuing the beyex.com revamp from any machine. Written 2026-07-04
on the dev box; the full audit report artifact is at
https://claude.ai/code/artifact/a5c36bde-09a0-4165-88c2-9918bc8f5bf0

## Where this came from

A 19-agent audit (3 perf domains, 5 UX scopes, 3 research tracks, 3 design
concepts scored by 3 judges) diagnosed:

1. **Perf root cause:** every scroll event fired React setState, re-rendering
   the entire ~500-mesh WebGL London scene per scroll tick, which also rebuilt
   randomised geometry. Plus ~900–1,100 un-instanced draw calls, 8 lights,
   always-on render loop.
2. **Blandness:** the site said "which industries" four times with duplicated
   Matterport tours; zero tours on the 8 content pages; no proof (metrics,
   quotes, logos); price calculator buried behind a six-field form; no mobile
   nav; hero only clickable on its right third.
3. **Winning direction:** "Proof and Portfolio" — every section anchored to a
   named client, a walkable tour, and a verified number; cityscape replaced by
   ONE WebGL set-piece ("Scan Resolve": a real client scan knitting from point
   cloud into a walkable twin).

## What's done (all pushed to main)

- Tag `before-site-revamp` = pre-revamp checkpoint.
- **Lane 1** (commit "Lane 1 revamp"): transient scroll store (Scene renders
  once, never on scroll), frameloop visibility gating, lights 8→2, dpr 1.5 /
  antialias off, roofline memoized, dead code + 3 unused deps removed, tours
  manifest `src/data/tours.js` (one Matterport ID per homepage section),
  full-card clickable hero + proof strip, mobile hamburger nav, poster-first
  `LazyTourEmbed` on all 8 content pages, calculator honesty (native GBP,
  £10 rounding, email-only required), floating CTA timing, banned-phrase pass.
- **Lane 2** (commit "Lane 2 revamp"): homepage 10 sections → 6.
  `EvidenceWall` (lead tour embedded live + filterable capture grid with data
  plates, owns #experiences). `ProofBySector` (3 case-anchored rows + dark
  Industries band + links strip, owns #sectors). Calculator-first GetStarted +
  single contact dock. ProcessFlow spec table. Footer restructure + CTA band.
  117 materials → Lambert. Viewport-aware fov (70° landscape → 95° portrait).
  Sector-specific closing CTAs on all content pages.
- **Scan Resolve prototype** (commit "Add Scan Resolve prototype"):
  `/labs/scan-resolve` (noindex, unlinked). ~19k procedural points knit into a
  taproom on a pinned scroll, ends "This is Brewhouse — walk it" → GPU handoff
  to the live Matterport iframe. 2 draw calls, scrub via refs (no React
  renders), reduced-motion static frame. The real capture replaces
  `generateRoomPoints()` in `src/components/labs/ScanResolve.jsx` — a data
  swap, not a rebuild. Also fixed sitewide: `overflow-x: hidden` on html/body
  broke `position: sticky` everywhere → now `overflow-x: clip`.

## Deploy on this (prod) machine

```bash
cd ~/beyex && git pull origin main
cd react_site && npm install && npx vite build
```

nginx serves `react_site/dist/` statically — no restart. PM2 `beyex-api`
(server/index.js, port 3002) untouched. Verify: the `assets/index-*.js` hash
in https://www.beyex.com/ should match `react_site/dist/index.html`.

## Decision gates (owner)

1. **View `/labs/scan-resolve`** → approve/reject replacing the London
   cityscape. The skyline stays until approved. If approved, the parked
   instancing workstream (audit fixes G1–G4, G7) is permanently cancelled.
2. **MatterPak export rights** for the Brewhouse capture (Matterport account)
   → unlocks the real point cloud for Scan Resolve.
3. **Client outreach** — `docs/client-outreach.md` has the per-client ask list
   and email template. Metrics/quotes/logo permissions are the critical path;
   every published number must be client-approved or self-owned.
4. **Verify two self-owned claims** in ProcessFlow: "typically 2–4 hours on
   site" and "delivered within days" — tighten to real operations numbers.

## Lane 3 remaining (after gate 1 approves)

- Remove cityscape (`webgl/Buildings.jsx`, `Scene.jsx`, `WebGLBackground.jsx`);
  static blueprint-texture background; KEEP the lazy-load/capability-gate rig.
- Wire Scan Resolve into the homepage (likely between EvidenceWall and
  ProofBySector); pre-rendered frame-sequence variant for mobile/reduced-motion.
- **Flagship Case Hero:** eager poster as the LCP element (never lazy-load it),
  dollhouse-orbit WebM loop, whole-surface tap swaps in place to the live tour,
  dual-intent CTAs.
- Case-study archetype `/work/:slug` (snapshot box, headline metric, inline
  tour, quote) once outreach yields real numbers.
- Hardening: reduced-motion QA, Save-Data enforcement, LCP/CWV on 4G +
  mid-range Android.

## Verification cheatsheet

- Scroll perf: React DevTools Profiler → zero `Scene` renders while scrolling.
- Draw calls: `renderer.info.render.calls` in console.
- Camera: landmarks should stay in frame on portrait phones (fov widens).
- WebGL cannot render in headless browsers with `failIfMajorPerformanceCaveat`
  — the labs Canvas omits that flag deliberately so it CAN be screenshot-tested.

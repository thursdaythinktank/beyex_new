/**
 * HeroGutterField - Drifting point-cloud field confined to viewport gutters
 * Activates once each gutter is >= ~88px wide (viewport >= ~1180px)
 * Plain canvas + rAF — no dependencies, no per-frame React state
 */
import { useEffect, useRef } from 'react';

// --- Activation ---
const MIN_ACTIVE_WIDTH = 1180;   // below this viewport width → render nothing
const CONTENT_WIDTH = 1000;      // central protected column (clears hero text ~896px with margin)
const MIN_GUTTER_WIDTH = 88;     // single gutter narrower than this → render nothing

// --- Point population ---
const POINTS_PER_GUTTER = 200;  // 200 per side (400 total)

// --- Motion ---
const DRIFT_SPEED = 8;           // px/second upward baseline drift
const DRIFT_JITTER = 0.4;        // per-point speed multiplier variance (±)

// --- Appearance ---
const RADIUS_MIN = 0.9;          // px (CSS; multiplied by dpr at paint)
const RADIUS_MAX = 2.6;          // px
const ALPHA_MIN = 0.16;          // far points — still clearly visible
const ALPHA_MAX = 0.42;          // near points
const BLUE = '#007AFF';          // brand accent (brief specifies #007AFF; tailwind token is #0066CC)
const GRAY = '#8A8A8F';          // apple-gray mid tint
const BLUE_RATIO = 0.55;         // ~55% of points blue, rest gray

const DPR_CAP = 2;               // clamp devicePixelRatio to avoid huge canvases on 3x displays

export function HeroGutterField() {
  const canvasRef = useRef(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let points = [];
    let rafId = null;
    let lastTime = 0;
    let active = false;
    let dpr = 1;
    let vh = 0;

    const reduceMotion =
      window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function buildAndSize() {
      dpr = Math.min(window.devicePixelRatio || 1, DPR_CAP);
      const vw = window.innerWidth;
      vh = window.innerHeight;

      canvas.width = Math.floor(vw * dpr);
      canvas.height = Math.floor(vh * dpr);
      canvas.style.width = vw + 'px';
      canvas.style.height = vh + 'px';

      const gutterWidth = (vw - CONTENT_WIDTH) / 2;

      if (vw < MIN_ACTIVE_WIDTH || gutterWidth < MIN_GUTTER_WIDTH) {
        points = [];
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        active = false;
        return;
      }

      const contentStart = gutterWidth;
      const contentEnd = contentStart + CONTENT_WIDTH;

      points = [];
      for (let side = 0; side < 2; side++) {
        for (let i = 0; i < POINTS_PER_GUTTER; i++) {
          const depth = Math.random();
          const radius = RADIUS_MIN + depth * (RADIUS_MAX - RADIUS_MIN);
          const alpha = ALPHA_MIN + depth * (ALPHA_MAX - ALPHA_MIN);
          const speed =
            DRIFT_SPEED *
            (1 - DRIFT_JITTER + Math.random() * DRIFT_JITTER * 2) *
            (0.4 + depth * 0.6);
          const color = Math.random() < BLUE_RATIO ? BLUE : GRAY;
          const x =
            side === 0
              ? Math.random() * gutterWidth
              : contentEnd + Math.random() * gutterWidth;
          const y = Math.random() * vh;
          points.push({ x, y, speed, depth, radius, alpha, color });
        }
      }

      active = true;
    }

    function paint() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      for (const p of points) {
        ctx.globalAlpha = p.alpha;
        ctx.fillStyle = p.color;
        ctx.beginPath();
        ctx.arc(p.x * dpr, p.y * dpr, p.radius * dpr, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.globalAlpha = 1;
    }

    function tick(now) {
      if (!lastTime) lastTime = now;
      const dt = Math.min((now - lastTime) / 1000, 0.05);
      lastTime = now;
      for (const p of points) {
        p.y -= p.speed * dt;
        if (p.y < -RADIUS_MAX) p.y = vh + RADIUS_MAX;
      }
      paint();
      rafId = requestAnimationFrame(tick);
    }

    function startLoop() {
      if (reduceMotion || !active) return;
      if (rafId != null) return;
      lastTime = 0;
      rafId = requestAnimationFrame(tick);
    }

    function stopLoop() {
      if (rafId != null) {
        cancelAnimationFrame(rafId);
        rafId = null;
      }
    }

    let resizeTimer = null;

    function onResize() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        buildAndSize();
        if (!active) { stopLoop(); return; }
        if (reduceMotion) { paint(); return; }
        stopLoop();
        startLoop();
      }, 150);
    }

    function onVisibility() {
      if (document.hidden) {
        stopLoop();
      } else {
        startLoop();
      }
    }

    buildAndSize();
    if (active) {
      if (reduceMotion) {
        paint();
      } else {
        startLoop();
      }
    }

    window.addEventListener('resize', onResize);
    document.addEventListener('visibilitychange', onVisibility);

    return () => {
      stopLoop();
      clearTimeout(resizeTimer);
      window.removeEventListener('resize', onResize);
      document.removeEventListener('visibilitychange', onVisibility);
    };
  }, []);

  return (
    <canvas
      ref={canvasRef}
      aria-hidden="true"
      className="fixed inset-0 z-0 pointer-events-none"
    />
  );
}

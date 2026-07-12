import { lazy, Suspense, useEffect, useRef, useState } from 'react';
import { TourModal } from './ui/TourModal';
import { useWebGLCapability } from '../hooks/useWebGLCapability';
import { useSaveData } from '../hooks/useSaveData';
import { TOURS } from '../data/tours';

/**
 * HomeScanResolve — homepage host for the Scan Resolve set-piece.
 *
 * three.js MUST stay out of the initial homepage bundle: ScanResolve is only
 * pulled in via React.lazy, and only once the user scrolls near this section
 * on a capable device. Low-capability / Save-Data / reduced-motion visitors
 * get a static Brewhouse poster + live-tour CTA — no three.js on that path.
 */

// Lazy — this is the ONLY reference to ScanResolve on the homepage path, so
// its three.js chunk is code-split and never in the initial bundle.
const ScanResolve = lazy(() =>
  import('./labs/ScanResolve').then((m) => ({ default: m.ScanResolve }))
);

const WALK_TOUR = TOURS.brewhouse;

/** Static poster used both as Suspense fallback and as the low-capability path. */
function ScanResolvePoster() {
  return (
    <div className="sticky top-0 h-screen overflow-hidden">
      <picture>
        <source media="(max-width: 768px)" srcSet="/brewhouse-sm.webp" type="image/webp" />
        <source srcSet="/brewhouse.webp" type="image/webp" />
        <img
          src="/brewhouse.webp"
          alt=""
          aria-hidden="true"
          className="absolute inset-0 w-full h-full object-cover opacity-40"
          width="800"
          height="400"
          loading="lazy"
        />
      </picture>
      <div className="absolute inset-0 bg-[#0d1620]/60" />
    </div>
  );
}

export function HomeScanResolve() {
  const sectionRef = useRef(null);
  const [inView, setInView] = useState(false);
  const [showTour, setShowTour] = useState(false);

  const capability = useWebGLCapability();
  const saveData = useSaveData();
  const prefersReducedMotion =
    typeof window !== 'undefined' &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Capable device, not on Save-Data, not reduced-motion → the WebGL path.
  const shouldUseWebGL =
    capability.checked &&
    !capability.shouldUseFallback &&
    !saveData &&
    !prefersReducedMotion;

  // Load three.js only when the section approaches the viewport.
  useEffect(() => {
    if (!shouldUseWebGL) return;
    const el = sectionRef.current;
    if (!el) return;
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setInView(true);
          observer.disconnect();
        }
      },
      { rootMargin: '400px' }
    );
    observer.observe(el);
    return () => observer.disconnect();
  }, [shouldUseWebGL]);

  const useWebGL = shouldUseWebGL && inView;

  return (
    <section
      ref={sectionRef}
      aria-label="From scan to walkable 3D model"
      className="relative bg-[#0d1620]"
      style={useWebGL ? undefined : { minHeight: '100vh' }}
    >
      {useWebGL ? (
        <Suspense fallback={<ScanResolvePoster />}>
          <ScanResolve />
        </Suspense>
      ) : (
        <div className="relative min-h-screen flex items-center justify-center overflow-hidden">
          <picture>
            <source media="(max-width: 768px)" srcSet="/brewhouse-sm.webp" type="image/webp" />
            <source srcSet="/brewhouse.webp" type="image/webp" />
            <img
              src="/brewhouse.webp"
              alt=""
              aria-hidden="true"
              className="absolute inset-0 w-full h-full object-cover opacity-30"
              width="800"
              height="400"
              loading="lazy"
            />
          </picture>
          <div className="absolute inset-0 bg-[#0d1620]/70" />

          <div className="relative z-10 max-w-2xl mx-auto text-center px-6 py-24">
            <h2 className="text-4xl sm:text-5xl font-semibold text-white mb-4">
              Scan. Model. Walk.
            </h2>
            <p className="text-lg text-white/60 mb-8">
              We capture a real space as millions of measured points, turn it into
              an accurate 3D model, and hand you a walkable digital twin in your browser.
            </p>
            <button
              type="button"
              onClick={() => setShowTour(true)}
              className="px-8 py-4 rounded-full bg-white text-apple-gray-900 font-semibold text-lg hover:bg-apple-blue-50 transition-colors shadow-2xl focus-visible:ring-4 focus-visible:ring-apple-blue-500"
            >
              Walk a finished space →
            </button>
          </div>

          <TourModal
            isOpen={showTour}
            onClose={() => setShowTour(false)}
            tourUrl={WALK_TOUR.url}
            title={`${WALK_TOUR.name} — live 3D tour`}
          />
        </div>
      )}
    </section>
  );
}

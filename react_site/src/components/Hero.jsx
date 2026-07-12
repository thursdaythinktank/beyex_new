import { useState, useCallback, useEffect } from 'react';
import { motion } from 'framer-motion';
import { Button } from './ui/Button';
import { TourModal } from './ui/TourModal';
import { MatterportPreloader } from './ui/MatterportPreloader';
import { TOURS } from '../data/tours';
import { useSaveData } from '../hooks/useSaveData';

const TOUR_URL = TOURS.brewhouse.url;

/**
 * Hero section - Experience First approach
 * The tour preview IS the hero - visitors can try it immediately
 */
export function Hero() {
  const [showTour, setShowTour] = useState(false);
  const [shouldPreload, setShouldPreload] = useState(false);
  const saveData = useSaveData();

  // Auto-preload after page is idle (5 seconds after load).
  // Skipped when the user has Data Saver enabled — explicit intent (hover/tap)
  // still triggers preloading via handlePreloadStart.
  useEffect(() => {
    if (saveData) return;
    const timer = setTimeout(() => {
      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(() => setShouldPreload(true), { timeout: 5000 });
      } else {
        setShouldPreload(true);
      }
    }, 5000);
    return () => clearTimeout(timer);
  }, [saveData]);

  // Start preloading immediately on user intent (hover/focus)
  const handlePreloadStart = useCallback(() => {
    setShouldPreload(true);
  }, []);

  const scrollToProcess = () => {
    document.getElementById('process')?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <section className="relative pt-28 pb-16 px-6 min-h-screen flex flex-col justify-center">
      <div className="max-w-7xl mx-auto w-full flex flex-col">
        {/* Text content - centered above the tour.
            LCP elements (h1 + subhead) render at full opacity on first paint —
            no JS-gated invisibility. Non-LCP siblings below keep their entrance stagger. */}
        <div className="text-center mb-12 max-w-4xl mx-auto">
          <h1 className="text-5xl sm:text-6xl lg:text-7xl font-semibold tracking-tight text-apple-gray-900 leading-tight mb-6">
            Step Inside Any Space.
            <br />
            <span className="text-apple-blue-500">From Anywhere.</span>
          </h1>

          <p className="text-xl sm:text-2xl text-apple-gray-500 max-w-2xl mx-auto mb-8 md:bg-transparent md:backdrop-blur-none md:border-0 md:px-0 md:py-0 md:rounded-none bg-white/60 backdrop-blur-md border border-white/40 px-6 py-4 rounded-2xl">
            We capture real places — hotels, homes, heritage sites and industrial facilities — and turn them into immersive digital twins you can walk through in your browser.
          </p>

          <motion.div
            className="flex flex-col sm:flex-row gap-4 justify-center"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.1 }}
          >
            <Button
              size="lg"
              onClick={() => setShowTour(true)}
              onMouseEnter={handlePreloadStart}
              onFocus={handlePreloadStart}
            >
              <span className="flex items-center gap-2">
                <PlayIcon className="w-5 h-5" />
                Explore a Space
              </span>
            </Button>
            <Button size="lg" variant="secondary" onClick={scrollToProcess}>
              See How It Works
            </Button>
          </motion.div>

          {/* Proof strip - real captured clients only */}
          <motion.p
            className="mt-8 text-sm text-apple-gray-500 text-shadow-white"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 0.5, delay: 0.2 }}
          >
            Recent captures:{' '}
            <span className="font-medium text-apple-gray-900">Crowne Plaza</span> ·{' '}
            <span className="font-medium text-apple-gray-900">Week2Week Serviced Apartments</span> ·{' '}
            <span className="font-medium text-apple-gray-900">Blackwell Grange</span> ·{' '}
            <span className="font-medium text-apple-gray-900">Padocare</span>
          </motion.p>
        </div>

        {/* Featured Tour Showcase - whole card opens the live tour */}
        <motion.div
          className="relative cursor-pointer group mx-auto"
          initial={{ opacity: 0, scale: 0.95 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.5, delay: 0.15 }}
          role="button"
          tabIndex={0}
          aria-label="Open the Brewhouse virtual tour"
          onClick={() => setShowTour(true)}
          onKeyDown={(e) => {
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              setShowTour(true);
            }
          }}
          onMouseEnter={handlePreloadStart}
          onFocus={handlePreloadStart}
          onTouchStart={handlePreloadStart}
        >
          <div className="relative aspect-[2/1] max-h-[500px] max-w-[800px] rounded-3xl overflow-hidden shadow-2xl bg-apple-gray-900 group-focus-visible:ring-4 group-focus-visible:ring-apple-blue-500">
            {/* Brewhouse building image */}
            <picture>
              <source media="(max-width: 768px)" srcSet="/brewhouse-sm.webp" type="image/webp" />
              <source srcSet="/brewhouse.webp" type="image/webp" />
              <img
                src="/brewhouse.webp"
                alt="Brewhouse Building"
                className="w-full h-full object-cover"
                width="800"
                height="400"
                loading="eager"
                fetchPriority="high"
                decoding="async"
              />
            </picture>

            {/* Full-card hover dim (hover enhancement only, not the affordance) */}
            <div className="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300" />

            {/* Badge */}
            <div className="absolute top-6 left-6 px-4 py-2 rounded-full bg-black/40 backdrop-blur-md border border-white/20">
              <span className="text-white text-sm font-medium">Brewhouse - Virtual Tour</span>
            </div>

            {/* Always-visible affordance - works for touch, no hover required */}
            <div className="absolute bottom-6 right-6 flex items-center gap-2 px-4 py-2.5 rounded-full bg-black/50 backdrop-blur-md border border-white/25 group-hover:bg-apple-blue-500/80 transition-colors duration-300">
              <ExpandIcon className="w-4 h-4 text-white" />
              <span className="text-white text-sm font-medium">Tap to explore in 3D</span>
            </div>
          </div>
        </motion.div>
      </div>

      {/* Background preloader - loads after 3s idle or on hover intent */}
      {shouldPreload && <MatterportPreloader tourUrl={TOUR_URL} delay={0} />}

      {/* Tour Modal */}
      <TourModal
        isOpen={showTour}
        onClose={() => setShowTour(false)}
        tourUrl={TOUR_URL}
        title="Commercial Venue"
      />
    </section>
  );
}

function PlayIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path d="M8 5v14l11-7z" />
    </svg>
  );
}

function ExpandIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
    </svg>
  );
}

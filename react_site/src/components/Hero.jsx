import { useState, useCallback, useEffect } from 'react';
import { motion } from 'framer-motion';
import { Button } from './ui/Button';
import { TourModal } from './ui/TourModal';
import { MatterportPreloader } from './ui/MatterportPreloader';

const TOUR_URL = "https://my.matterport.com/show/?m=eStYzywQFMG";

/**
 * Hero section - Experience First approach
 * The tour preview IS the hero - visitors can try it immediately
 */
export function Hero() {
  const [showTour, setShowTour] = useState(false);
  const [shouldPreload, setShouldPreload] = useState(false);

  // Auto-preload after page is idle (5 seconds after load)
  useEffect(() => {
    const timer = setTimeout(() => {
      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(() => setShouldPreload(true), { timeout: 5000 });
      } else {
        setShouldPreload(true);
      }
    }, 5000);
    return () => clearTimeout(timer);
  }, []);

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
        {/* Text content - centered above the tour */}
        <motion.div
          className="text-center mb-12 max-w-4xl mx-auto"
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          <motion.h1
            className="text-5xl sm:text-6xl lg:text-7xl font-semibold tracking-tight text-apple-gray-900 leading-tight mb-6"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0 }}
          >
            Step Inside Any Space.
            <br />
            <span className="text-apple-blue-500">From Anywhere.</span>
          </motion.h1>

          <motion.p
            className="text-xl sm:text-2xl text-apple-gray-500 max-w-2xl mx-auto mb-8 md:bg-transparent md:backdrop-blur-none md:border-0 md:px-0 md:py-0 md:rounded-none bg-white/60 backdrop-blur-md border border-white/40 px-6 py-4 rounded-2xl"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.05 }}
          >
            We capture real places and transform them into immersive digital twins you can explore from anywhere in the world.
          </motion.p>

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
        </motion.div>

        {/* Featured Tour Showcase - Live Matterport Preview - centered */}
        <motion.div
          className="relative cursor-pointer group mx-auto"
          initial={{ opacity: 0, scale: 0.95 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.5, delay: 0.15 }}
        >
          <div className="relative aspect-[2/1] max-h-[500px] max-w-[800px] rounded-3xl overflow-hidden shadow-2xl bg-apple-gray-900">
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
              />
            </picture>

            {/* Clickable overlay to open full modal - positioned on the right side */}
            <div
              className="absolute top-0 right-0 bottom-0 w-1/3 cursor-pointer bg-gradient-to-l from-black/40 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
              onClick={() => setShowTour(true)}
              onMouseEnter={handlePreloadStart}
            >
              <motion.div
                className="flex flex-col items-center gap-4"
                initial={{ opacity: 0, x: 10 }}
                whileHover={{ scale: 1.05 }}
                animate={{ opacity: 1, x: 0 }}
              >
                <div className="w-20 h-20 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 hover:bg-white/30 transition-colors">
                  <ExpandIcon className="w-8 h-8 text-white" />
                </div>
                <span className="text-white text-lg font-medium drop-shadow-lg">Click for full experience</span>
              </motion.div>
            </div>

            {/* Badge */}
            <div className="absolute top-6 left-6 px-4 py-2 rounded-full bg-black/40 backdrop-blur-md border border-white/20">
              <span className="text-white text-sm font-medium">Brewhouse - Virtual Tour</span>
            </div>

            {/* Instructions hint */}
            <div className="absolute bottom-6 right-6 px-4 py-2 rounded-full bg-black/40 backdrop-blur-md border border-white/20">
              <span className="text-white/80 text-xs">Hover & click for full tour</span>
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

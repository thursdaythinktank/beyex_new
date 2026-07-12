import { useState, useMemo } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { TourCard } from './ui/TourCard';
import { TourModal } from './ui/TourModal';
import { LazyTourEmbed } from './ui/LazyTourEmbed';
import { TOURS } from '../data/tours';

/**
 * Evidence Wall — every published capture in one filterable place.
 * A lead capture is embedded live (poster-first); the rest open in a modal.
 * Merges the former FeaturedExperiences + RecentProjects sections.
 */

const LEAD = TOURS.crownePlaza;

// Every published capture except the hero's (Brewhouse) and the lead
const WALL = [
  TOURS.week2week,
  TOURS.blackwellGrange,
  TOURS.residential,
  TOURS.dosaKitchen,
  TOURS.padocare,
];

const FILTERS = ['All', ...new Set(WALL.map((t) => t.sector))];

export function EvidenceWall() {
  const [selectedTour, setSelectedTour] = useState(null);
  const [filter, setFilter] = useState('All');
  const { ref, inView } = useInView({ triggerOnce: true, threshold: 0.1 });

  const visible = useMemo(
    () => (filter === 'All' ? WALL : WALL.filter((t) => t.sector === filter)),
    [filter]
  );

  return (
    <>
      <section id="experiences" className="py-24">
        <div className="max-w-7xl mx-auto px-6">
          <motion.div
            ref={ref}
            className="text-center mb-12"
            initial={{ opacity: 0, y: 20 }}
            animate={inView ? { opacity: 1, y: 0 } : {}}
            transition={{ duration: 0.6 }}
          >
            <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
              Every space we publish, you can walk.
            </h2>
            <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
              Real captures for real clients — no renders, no mockups. Step inside any of them.
            </p>
          </motion.div>

          {/* Lead capture — live inline, poster-first */}
          <motion.div
            className="max-w-4xl mx-auto mb-6"
            initial={{ opacity: 0, y: 20 }}
            animate={inView ? { opacity: 1, y: 0 } : {}}
            transition={{ duration: 0.6, delay: 0.1 }}
          >
            <LazyTourEmbed tour={LEAD} />
            <DataPlate name={LEAD.name} sector={LEAD.sector} className="mt-3" />
          </motion.div>

          {/* Filter chips */}
          <motion.div
            className="flex flex-wrap justify-center gap-2 mb-10 mt-12"
            initial={{ opacity: 0 }}
            animate={inView ? { opacity: 1 } : {}}
            transition={{ duration: 0.6, delay: 0.2 }}
          >
            {FILTERS.map((f) => (
              <button
                key={f}
                type="button"
                onClick={() => setFilter(f)}
                aria-pressed={filter === f}
                className={`px-4 py-2 rounded-full text-sm font-medium transition-colors border ${
                  filter === f
                    ? 'bg-apple-gray-900 text-white border-apple-gray-900'
                    : 'bg-white/70 text-apple-gray-600 border-apple-gray-200 hover:border-apple-gray-400'
                }`}
              >
                {f}
              </button>
            ))}
          </motion.div>

          {/* Capture grid */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            {visible.map((tour) => (
              <motion.div
                key={tour.matterportId}
                layout
                className="group cursor-pointer"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.4 }}
                onClick={() => setSelectedTour(tour)}
              >
                <TourCard
                  thumbnail={tour.image}
                  thumbnailSm={tour.imageSm}
                  title={tour.name}
                  category={tour.sector}
                  onClick={() => setSelectedTour(tour)}
                />
                <DataPlate name={tour.name} sector={tour.sector} className="mt-3" />
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      <TourModal
        isOpen={!!selectedTour}
        onClose={() => setSelectedTour(null)}
        tourUrl={selectedTour?.url}
        title={selectedTour?.name}
      />
    </>
  );
}

/**
 * Data plate — verifiable, self-owned facts only. No invented metrics.
 */
function DataPlate({ name, sector, className = '' }) {
  return (
    <p
      className={`text-xs uppercase tracking-wider text-apple-gray-500 ${className}`}
      style={{ fontVariantNumeric: 'tabular-nums' }}
    >
      <span className="font-semibold text-apple-gray-700">{name}</span>
      <span className="mx-2 text-apple-gray-300">·</span>
      {sector}
      <span className="mx-2 text-apple-gray-300">·</span>
      Live 3D capture
    </p>
  );
}

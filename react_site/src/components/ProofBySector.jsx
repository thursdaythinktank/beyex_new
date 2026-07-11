import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Badge } from './ui/Badge';
import { TOURS } from '../data/tours';

/**
 * Proof by Sector — case-anchored sector rows.
 * Merges the former SectorShowcase + SectorGrid + UseCases sections:
 * every row is anchored to a named client capture and links to its
 * service page (tours themselves open from the Evidence Wall above).
 */

const ROWS = [
  {
    category: 'Hospitality',
    title: 'Book with confidence',
    outcome:
      'Guests experience rooms, suites and event spaces before booking. Event planners see layouts and plan with confidence — fewer site inspections, more direct bookings.',
    caseName: TOURS.blackwellGrange.name,
    image: TOURS.blackwellGrange.image,
    link: '/services/virtual-tours-hospitality',
  },
  {
    category: 'Real Estate & Commercial',
    title: 'Sell and lease faster',
    outcome:
      'Qualified buyers and tenants explore properties at their own pace, with accurate measurements and floor plans. They arrive pre-sold, ready to decide.',
    caseName: TOURS.residential.name,
    image: TOURS.residential.image,
    link: '/services/virtual-tours-commercial',
  },
  {
    category: 'Restaurants & Retail',
    title: 'Drive foot traffic',
    outcome:
      'Virtual foot traffic that converts to real visits. Customers step into your atmosphere, layout and style — and stand you apart from competitors.',
    caseName: TOURS.dosaKitchen.name,
    image: TOURS.dosaKitchen.image,
    link: '/services/virtual-tours-commercial',
  },
];

const ALSO_SERVING = [
  { name: 'Tourism, Heritage & Culture', link: '/services/virtual-tours-tourism' },
  { name: 'Education', link: '/services/virtual-tours-education' },
  { name: 'Energy & Solar', link: '/services/digital-twins-solar-energy' },
];

export function ProofBySector() {
  return (
    <section id="sectors" className="py-24">
      <div className="max-w-7xl mx-auto px-6">
        <motion.div
          className="text-center mb-20"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
            Proof by sector.
          </h2>
          <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
            Whatever you run — a hotel, a property, a restaurant, a factory — someone like you already works with us.
          </p>
        </motion.div>

        <div className="space-y-24">
          {ROWS.map((row, index) => (
            <SectorRow key={row.category} row={row} index={index} />
          ))}
        </div>
      </div>

      {/* Dark full-bleed row — Industries & Digital Twins */}
      <DarkIndustriesRow />

      {/* Compact strip for remaining sectors */}
      <div className="max-w-7xl mx-auto px-6 pt-16">
        <p className="text-center text-apple-gray-500">
          Also serving{' '}
          {ALSO_SERVING.map((s, i) => (
            <span key={s.link}>
              <Link
                to={s.link}
                className="font-medium text-apple-blue-500 hover:text-apple-blue-600 underline-offset-4 hover:underline"
              >
                {s.name}
              </Link>
              {i < ALSO_SERVING.length - 1 ? ' · ' : ''}
            </span>
          ))}
        </p>
      </div>
    </section>
  );
}

function SectorRow({ row, index }) {
  const { ref, inView } = useInView({ triggerOnce: true, threshold: 0.2 });
  const imageLeft = index % 2 === 1;

  return (
    <motion.div
      ref={ref}
      className={`grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center ${
        imageLeft ? '' : 'lg:[direction:rtl]'
      }`}
      initial={{ opacity: 0, y: 30 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{ duration: 0.6 }}
    >
      {/* Capture imagery — links to the sector's service page */}
      <Link to={row.link.split('#')[0]} className="block lg:[direction:ltr] group">
        <div className="relative aspect-[16/10] rounded-2xl overflow-hidden shadow-apple-lg bg-apple-gray-900">
          <img
            src={row.image}
            alt={`${row.caseName} — 3D capture`}
            className="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500"
            loading="lazy"
            decoding="async"
            width="1600"
            height="1000"
          />
          <span className="absolute bottom-4 left-4 px-3 py-1.5 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-xs font-medium">
            {row.caseName}
          </span>
        </div>
      </Link>

      {/* Copy */}
      <div className="lg:[direction:ltr]">
        <Badge>{row.category}</Badge>
        <h3 className="text-3xl sm:text-4xl font-semibold text-apple-gray-900 mt-4 mb-4">
          {row.title}
        </h3>
        <p className="text-lg text-apple-gray-600 mb-6 leading-relaxed">{row.outcome}</p>
        <Link
          to={row.link.split('#')[0]}
          className="inline-flex items-center gap-2 text-apple-blue-500 hover:text-apple-blue-600 font-medium"
        >
          See how {row.caseName} uses it
          <ArrowIcon className="w-4 h-4" />
        </Link>
      </div>
    </motion.div>
  );
}

/**
 * The page's one dark contrast peak — Industries & Digital Twins.
 */
function DarkIndustriesRow() {
  const { ref, inView } = useInView({ triggerOnce: true, threshold: 0.2 });

  return (
    <motion.div
      ref={ref}
      className="mt-24 bg-apple-gray-900 text-white"
      initial={{ opacity: 0 }}
      animate={inView ? { opacity: 1 } : {}}
      transition={{ duration: 0.8 }}
    >
      <div className="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
        <div>
          <span className="inline-block px-3 py-1 rounded-full bg-white/10 border border-white/20 text-sm font-medium mb-6">
            Industries & Digital Twins
          </span>
          <h3 className="text-3xl sm:text-4xl font-semibold mb-4">
            Beyond tours: operational twins.
          </h3>
          <p className="text-lg text-white/70 mb-6 leading-relaxed">
            Digital twins with live data overlays for predictive maintenance, remote monitoring
            and operator training. Padocare runs its 42 Factor AI staffing platform on a Beyex
            capture; ship crews train on AI video generated from our 3D scans.
          </p>
          <div className="flex flex-wrap gap-x-8 gap-y-3">
            <Link
              to="/services/digital-twins-industries"
              className="inline-flex items-center gap-2 text-apple-blue-200 hover:text-white font-medium"
            >
              Digital twins for industry
              <ArrowIcon className="w-4 h-4" />
            </Link>
            <Link
              to="/case-studies/ai-video-ship-maintenance"
              className="inline-flex items-center gap-2 text-apple-blue-200 hover:text-white font-medium"
            >
              Ship maintenance case study
              <ArrowIcon className="w-4 h-4" />
            </Link>
          </div>
        </div>

        <Link to="/services/digital-twins-industries" className="block group">
          <div className="relative aspect-[16/10] rounded-2xl overflow-hidden shadow-2xl">
            <img
              src={TOURS.padocare.image}
              alt={`${TOURS.padocare.name} — 3D capture`}
              className="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500"
              loading="lazy"
              decoding="async"
              width="1600"
              height="1000"
            />
            <span className="absolute bottom-4 left-4 px-3 py-1.5 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-xs font-medium">
              {TOURS.padocare.name}
            </span>
          </div>
        </Link>
      </div>
    </motion.div>
  );
}

function ArrowIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
      <path strokeLinecap="round" strokeLinejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
    </svg>
  );
}

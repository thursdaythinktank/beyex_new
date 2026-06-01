import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Badge } from './ui/Badge';
import { TourCard } from './ui/TourCard';
import { TourModal } from './ui/TourModal';

/**
 * Sector showcase with alternating layout
 * Clickable tour cards that open in fullscreen modal
 */
export function SectorShowcase() {
  const [selectedTour, setSelectedTour] = useState(null);

  const sectors = [
    {
      category: 'Hospitality',
      title: 'Book with confidence',
      description: 'Give guests and event planners the confidence to book without visiting. Immersive 3D tours of rooms, suites, and event spaces that drive direct bookings.',
      features: [
        'Room and suite virtual walkthroughs',
        'Conference and event space planning',
        'Increase direct booking conversion',
        'Reduce pre-visit site inspections',
      ],
      tourUrl: 'https://my.matterport.com/show/?m=bav7aPMSaUb',
      thumbnail: '/blackwell-grange-card.webp',
    },
    {
      category: 'Real Estate & Commercial',
      title: 'Sell and lease faster',
      description: 'Immersive property tours that showcase every detail. Buyers and tenants explore at their own pace, from anywhere in the world.',
      features: [
        'Accurate measurements and floor plans',
        'Virtual staging capabilities',
        '24/7 open house availability',
        'International buyer access',
      ],
      tourUrl: 'https://my.matterport.com/show/?m=eMkANY4WhdJ',
      thumbnail: '/home-card.webp',
    },
    {
      category: 'Restaurants & Retail',
      title: 'Drive foot traffic',
      description: 'Entice customers before they arrive. Let them experience your atmosphere, layout, and style through immersive virtual tours.',
      features: [
        'Showcase ambience and design',
        'Highlight key features and zones',
        'Build anticipation and excitement',
        'Differentiate from competitors',
      ],
      tourUrl: 'https://my.matterport.com/show/?m=8jrsKsP2cyY',
      thumbnail: '/dosakitchen-card.webp',
    },
  ];

  return (
    <>
      <section id="sectors" className="py-24">
        <div className="max-w-7xl mx-auto px-6 space-y-32">
          {sectors.map((sector, index) => (
            <SectorCard
              key={index}
              sector={sector}
              index={index}
              onTourClick={() => setSelectedTour(sector)}
            />
          ))}
        </div>
      </section>

      {/* Tour Modal */}
      <TourModal
        isOpen={!!selectedTour}
        onClose={() => setSelectedTour(null)}
        tourUrl={selectedTour?.tourUrl}
        title={selectedTour?.title}
      />
    </>
  );
}

function SectorCard({ sector, index, onTourClick }) {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const isEven = index % 2 === 0;

  return (
    <motion.div
      ref={ref}
      className={`grid grid-cols-1 lg:grid-cols-2 gap-16 items-center ${
        !isEven ? 'lg:grid-flow-dense' : ''
      } p-8 rounded-3xl bg-blue-50/40 backdrop-blur-xl border border-blue-100/50 shadow-sm`}
      initial={{ opacity: 0, y: 50 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{ duration: 0.8, delay: 0.2 }}
    >
      {/* Text content */}
      <div className={`space-y-6 ${!isEven ? 'lg:col-start-2' : ''}`}>
        <Badge>{sector.category}</Badge>

        <h3 className="text-4xl font-semibold text-apple-gray-900">
          {sector.title}
        </h3>

        <p className="text-lg text-apple-gray-700 leading-relaxed">
          {sector.description}
        </p>

        <ul className="space-y-3">
          {sector.features.map((feature, idx) => (
            <li key={idx} className="flex items-start gap-3">
              <CheckIcon />
              <span className="text-base text-apple-gray-800">{feature}</span>
            </li>
          ))}
        </ul>
      </div>

      {/* Tour card - clickable to open modal */}
      <div className={!isEven ? 'lg:col-start-1 lg:row-start-1' : ''}>
        <TourCard
          thumbnail={sector.thumbnail}
          title={sector.title}
          category={sector.category}
          onClick={onTourClick}
        />
      </div>
    </motion.div>
  );
}

function CheckIcon() {
  return (
    <svg className="w-5 h-5 text-apple-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
    </svg>
  );
}

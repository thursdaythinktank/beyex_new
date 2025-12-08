import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { TourModal } from './ui/TourModal';

/**
 * Featured Experiences - Show, don't tell
 * Benefits are demonstrated through actual tours with live Matterport previews
 */
export function FeaturedExperiences() {
  const [selectedTour, setSelectedTour] = useState(null);

  const experiences = [
    {
      title: 'Residential Property',
      description: 'Walk through every room, examine details, feel the space',
      badge: '4,200 sq ft captured',
      tourUrl: 'https://my.matterport.com/show/?m=eMkANY4WhdJ',
      // Embed URL with minimal UI for preview
      embedUrl: 'https://my.matterport.com/show/?m=eMkANY4WhdJ&play=1&qs=1&title=0&brand=0&mls=0&mt=0&tagNav=0&portal=0&f=0&dh=0&nozoom=1',
    },
    {
      title: 'Commercial Venue',
      description: 'Experience event spaces and plan layouts virtually',
      badge: '360° dollhouse view',
      tourUrl: 'https://my.matterport.com/show/?m=eStYzywQFMG',
      embedUrl: 'https://my.matterport.com/show/?m=eStYzywQFMG&play=1&qs=1&title=0&brand=0&mls=0&mt=0&tagNav=0&portal=0&f=0&dh=0&nozoom=1',
    },
    {
      title: 'Restaurant & Retail',
      description: 'Showcase ambience and atmosphere before the visit',
      badge: 'Street-level access',
      tourUrl: 'https://my.matterport.com/show/?m=8jrsKsP2cyY',
      embedUrl: 'https://my.matterport.com/show/?m=8jrsKsP2cyY&play=1&qs=1&title=0&brand=0&mls=0&mt=0&tagNav=0&portal=0&f=0&dh=0&nozoom=1',
    },
  ];

  return (
    <>
      <section id="experiences" className="py-24">
        <div className="max-w-7xl mx-auto px-6">
          <motion.div
            className="text-center mb-16"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
          >
            <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
              Explore real spaces.
            </h2>
            <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
              Click any space below to step inside and experience our digital twin technology firsthand.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {experiences.map((experience, index) => (
              <ExperienceCard
                key={index}
                experience={experience}
                index={index}
                onClick={() => setSelectedTour(experience)}
              />
            ))}
          </div>
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

function ExperienceCard({ experience, index, onClick }) {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  return (
    <motion.div
      ref={ref}
      className="group cursor-pointer"
      initial={{ opacity: 0, y: 30 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{
        duration: 0.6,
        delay: index * 0.15,
        type: 'spring',
        stiffness: 100,
      }}
    >
      {/* Card with live Matterport preview */}
      <div
        className="relative aspect-[4/3] rounded-2xl overflow-hidden mb-4 bg-apple-gray-900 shadow-lg group-hover:shadow-xl transition-shadow duration-300"
        onClick={onClick}
      >
        {/* Live Matterport iframe preview - auto-plays, minimal UI */}
        <iframe
          src={experience.embedUrl}
          className="w-full h-full"
          title={`${experience.title} Preview`}
          frameBorder="0"
          allow="xr-spatial-tracking"
          style={{ pointerEvents: 'none' }}
        />

        {/* Slight blue tint overlay */}
        <div className="absolute inset-0 bg-apple-blue-500/10 mix-blend-multiply pointer-events-none" />

        {/* Hover overlay */}
        <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
          <motion.div
            className="flex flex-col items-center gap-3"
            whileHover={{ scale: 1.05 }}
          >
            <div className="w-16 h-16 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 hover:bg-white/30 transition-colors">
              <ExpandIcon className="w-7 h-7 text-white" />
            </div>
            <span className="text-white text-base font-medium drop-shadow-lg">Full Experience</span>
          </motion.div>
        </div>

        {/* Badge */}
        <div className="absolute top-4 left-4 px-3 py-1.5 rounded-full bg-black/40 backdrop-blur-md border border-white/20">
          <span className="text-xs font-medium text-white">{experience.badge}</span>
        </div>

        {/* Live indicator */}
        <div className="absolute top-4 right-4 px-2 py-1 rounded-full bg-black/40 backdrop-blur-md border border-white/20 flex items-center gap-1.5">
          <span className="w-2 h-2 rounded-full bg-green-400 animate-pulse" />
          <span className="text-xs text-white/80">Live</span>
        </div>
      </div>

      {/* Text content */}
      <h3 className="text-xl font-semibold text-apple-gray-900 mb-1 group-hover:text-apple-blue-500 transition-colors">
        {experience.title}
      </h3>
      <p className="text-base text-apple-gray-500">
        {experience.description}
      </p>
    </motion.div>
  );
}

function ExpandIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
    </svg>
  );
}

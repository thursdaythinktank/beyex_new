import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { TourCard } from './ui/TourCard';
import { TourModal } from './ui/TourModal';
import { TOURS } from '../data/tours';

const projects = [
  {
    name: TOURS.crownePlaza.name,
    badge: TOURS.crownePlaza.sector,
    tourUrl: TOURS.crownePlaza.url,
    thumbnail: TOURS.crownePlaza.image,
  },
  {
    name: TOURS.week2week.name,
    badge: TOURS.week2week.sector,
    tourUrl: TOURS.week2week.url,
    thumbnail: TOURS.week2week.image,
  },
  {
    name: TOURS.padocare.name,
    badge: TOURS.padocare.sector,
    tourUrl: TOURS.padocare.url,
    thumbnail: TOURS.padocare.image,
  },
];

export function RecentProjects() {
  const [selectedTour, setSelectedTour] = useState(null);

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
              Explore real client spaces.
            </h2>
            <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
              Recent captures for real clients — click any space to step inside.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {projects.map((project, index) => (
              <ProjectCard
                key={index}
                project={project}
                index={index}
                onClick={() => setSelectedTour(project)}
              />
            ))}
          </div>
        </div>
      </section>

      <TourModal
        isOpen={!!selectedTour}
        onClose={() => setSelectedTour(null)}
        tourUrl={selectedTour?.tourUrl}
        title={selectedTour?.name}
      />
    </>
  );
}

function ProjectCard({ project, index, onClick }) {
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
      onClick={onClick}
    >
      <TourCard
        thumbnail={project.thumbnail}
        title={project.name}
        category={project.badge}
        onClick={onClick}
      />

      <div className="mt-4">
        <h3 className="text-xl font-semibold text-apple-gray-900 group-hover:text-apple-blue-500 transition-colors">
          {project.name}
        </h3>
      </div>
    </motion.div>
  );
}

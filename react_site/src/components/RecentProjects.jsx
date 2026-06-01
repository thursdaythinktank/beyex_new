import { useState } from 'react';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { TourCard } from './ui/TourCard';
import { TourModal } from './ui/TourModal';

const projects = [
  {
    name: 'Crowne Plaza Hotel',
    badge: 'Hospitality',
    tourUrl: 'https://my.matterport.com/show/?m=mFCax5W9jRC',
    thumbnail: '/crowne-plaza-card.webp',
  },
  {
    name: 'Week2Week Serviced Apartments',
    badge: 'Hospitality',
    tourUrl: 'https://my.matterport.com/show/?m=z5PMXpHT98k',
    thumbnail: '/week2week-card.webp',
  },
  {
    name: 'Padocare — 42 Factor AI',
    badge: 'Healthcare Tech',
    tourUrl: 'https://my.matterport.com/show/?m=KZtJ9Buye4f',
    thumbnail: '/padocare-card.webp',
  },
];

export function RecentProjects() {
  const [selectedTour, setSelectedTour] = useState(null);

  return (
    <>
      <section id="recent-projects" className="py-24">
        <div className="max-w-7xl mx-auto px-6">
          <motion.div
            className="text-center mb-16"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
          >
            <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
              Recent Projects
            </h2>
            <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
              Explore our latest 3D captures across different sectors.
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
        <span className="text-sm text-apple-gray-500">
          {project.badge}
        </span>
      </div>
    </motion.div>
  );
}

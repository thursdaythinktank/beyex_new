import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';

/**
 * Benefits grid with clean icons and concise copy
 * 3-column responsive layout
 */
export function BenefitsGrid() {
  const benefits = [
    {
      title: '24/7 Access',
      description: 'Prospects explore properties at their convenience, anywhere in the world.',
      icon: ClockIcon,
    },
    {
      title: 'Higher Engagement',
      description: 'Interactive tours keep visitors engaged 3x longer than static images.',
      icon: ChartIcon,
    },
    {
      title: 'Qualified Leads',
      description: 'Serious buyers self-qualify by taking virtual tours before enquiring.',
      icon: TargetIcon,
    },
    {
      title: 'Reduced Viewings',
      description: 'Filter out unsuitable prospects, saving time and resources.',
      icon: CalendarIcon,
    },
    {
      title: 'Global Reach',
      description: 'Attract international buyers without physical travel requirements.',
      icon: GlobeIcon,
    },
    {
      title: 'Faster Sales',
      description: 'Properties with 3D tours sell 31% faster than those without.',
      icon: RocketIcon,
    },
  ];

  return (
    <section id="benefits" className="py-24 bg-apple-gray-50">
      <div className="max-w-7xl mx-auto px-6">
        <motion.h2
          className="text-5xl font-semibold text-center mb-16 text-apple-gray-900"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          Why virtual tours work.
        </motion.h2>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
          {benefits.map((benefit, index) => (
            <BenefitCard key={index} benefit={benefit} index={index} />
          ))}
        </div>
      </div>
    </section>
  );
}

function BenefitCard({ benefit, index }) {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const Icon = benefit.icon;

  return (
    <motion.div
      ref={ref}
      className="space-y-4"
      initial={{ opacity: 0, y: 30 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{
        duration: 0.6,
        delay: index * 0.1,
        type: 'spring',
        stiffness: 100,
      }}
    >
      <div className="w-12 h-12 flex items-center justify-center">
        <Icon />
      </div>
      <h3 className="text-xl font-semibold text-apple-gray-900">{benefit.title}</h3>
      <p className="text-base text-apple-gray-600 leading-relaxed">{benefit.description}</p>
    </motion.div>
  );
}

// Simple, clean SVG icons (24px)
function ClockIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  );
}

function ChartIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
    </svg>
  );
}

function TargetIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  );
}

function CalendarIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
  );
}

function GlobeIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  );
}

function RocketIcon() {
  return (
    <svg className="w-6 h-6 text-apple-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
    </svg>
  );
}

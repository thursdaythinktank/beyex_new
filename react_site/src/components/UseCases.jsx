import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';

/**
 * Use Cases - Outcome focused, audience self-selection
 * Visitors identify their use case, see outcomes not features
 */
export function UseCases() {
  const useCases = [
    {
      icon: HomeIcon,
      title: 'Sell Properties Faster',
      audience: 'Real estate professionals',
      outcome: 'Qualified buyers explore properties 24/7 from anywhere. They arrive pre-sold, ready to make decisions.',
      link: '#experiences',
    },
    {
      icon: BuildingIcon,
      title: 'Showcase Your Venue',
      audience: 'Hotels, event spaces, hospitality',
      outcome: 'Guests experience your space before booking. Event planners see layouts and plan with confidence.',
      link: '#experiences',
    },
    {
      icon: StoreIcon,
      title: 'Attract More Customers',
      audience: 'Restaurants, retail, showrooms',
      outcome: 'Virtual foot traffic that converts to real visits. Stand out from competitors before they even arrive.',
      link: '#experiences',
    },
  ];

  return (
    <section id="use-cases" className="py-24">
      <div className="max-w-7xl mx-auto px-6">
        <motion.div
          className="text-center mb-16 glass-liquid rounded-3xl py-12 px-8 max-w-3xl mx-auto"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4 text-shadow-white">
            Built for your industry.
          </h2>
          <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto text-shadow-white">
            Whether you're selling spaces, hosting events, or welcoming customers — virtual tours work.
          </p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {useCases.map((useCase, index) => (
            <UseCaseCard key={index} useCase={useCase} index={index} />
          ))}
        </div>
      </div>
    </section>
  );
}

function UseCaseCard({ useCase, index }) {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const Icon = useCase.icon;

  return (
    <motion.a
      ref={ref}
      href={useCase.link}
      className="block p-8 rounded-2xl bg-white border border-apple-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:border-apple-blue-200 group"
      initial={{ opacity: 0, y: 30 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{
        duration: 0.6,
        delay: index * 0.15,
        type: 'spring',
        stiffness: 100,
      }}
    >
      {/* Icon */}
      <div className="w-14 h-14 rounded-xl bg-apple-blue-50 flex items-center justify-center mb-6 group-hover:bg-apple-blue-100 transition-colors">
        <Icon className="w-7 h-7 text-apple-blue-500" />
      </div>

      {/* Title & Audience */}
      <h3 className="text-xl font-semibold text-apple-gray-900 mb-2 group-hover:text-apple-blue-500 transition-colors">
        {useCase.title}
      </h3>
      <p className="text-sm text-apple-blue-500 mb-4">
        {useCase.audience}
      </p>

      {/* Outcome */}
      <p className="text-base text-apple-gray-600 leading-relaxed">
        {useCase.outcome}
      </p>

      {/* Link indicator */}
      <div className="mt-6 flex items-center gap-2 text-apple-blue-500 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
        <span>See example</span>
        <ArrowIcon className="w-4 h-4" />
      </div>
    </motion.a>
  );
}

// Icons
function HomeIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
    </svg>
  );
}

function BuildingIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    </svg>
  );
}

function StoreIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
    </svg>
  );
}

function ArrowIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
    </svg>
  );
}

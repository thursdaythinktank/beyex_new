import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import { Link } from 'react-router-dom';

/**
 * Use Cases - Outcome focused, audience self-selection
 * Visitors identify their use case, see outcomes not features.
 * Each card links to its real matching service page or showcase section.
 */
export function UseCases() {
  const useCases = [
    {
      icon: HomeIcon,
      title: 'Sell Properties Faster',
      audience: 'Real estate professionals',
      outcome: 'Qualified buyers explore properties at their own pace and arrive pre-sold, ready to make decisions.',
      link: '/services/virtual-tours-commercial',
    },
    {
      icon: BuildingIcon,
      title: 'Showcase Your Venue',
      audience: 'Hotels, event spaces, hospitality',
      outcome: 'Guests experience your space before booking. Event planners see layouts and plan with confidence.',
      link: '/services/virtual-tours-hospitality',
    },
    {
      icon: StoreIcon,
      title: 'Attract More Customers',
      audience: 'Restaurants, retail, showrooms',
      outcome: 'Virtual foot traffic that converts to real visits. Stand out from competitors with an atmosphere customers can step into.',
      link: '#sectors',
    },
    {
      icon: GlobeIcon,
      title: 'Attract More Visitors',
      audience: 'Tourism boards, destinations',
      outcome: 'Virtual previews that drive real visits. Accessible to international tourists year-round, increasing reach without increasing staffing.',
      link: '/services/virtual-tours-tourism',
    },
    {
      icon: CogIcon,
      title: 'Optimise Operations',
      audience: 'Factory managers, facility operators',
      outcome: 'Digital twins with live data overlays. Predictive maintenance, remote monitoring, and operator training in a spatial context.',
      link: '/services/digital-twins-industries',
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

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">
          {useCases.map((useCase, index) => (
            <UseCaseCard key={index} useCase={useCase} index={index} />
          ))}
        </div>
      </div>
    </section>
  );
}

const MotionLink = motion(Link);

function UseCaseCard({ useCase, index }) {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.2,
  });

  const Icon = useCase.icon;
  // Same-page anchors stay plain <a>; routes use client-side navigation
  const isAnchor = useCase.link.startsWith('#');
  const CardTag = isAnchor ? motion.a : MotionLink;
  const linkProps = isAnchor ? { href: useCase.link } : { to: useCase.link };

  return (
    <CardTag
      ref={ref}
      {...linkProps}
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
    </CardTag>
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

function GlobeIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A8.966 8.966 0 013 12c0-1.264.26-2.467.732-3.559" />
    </svg>
  );
}

function CogIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.28z" />
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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

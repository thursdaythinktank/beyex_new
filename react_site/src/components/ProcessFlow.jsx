import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';

/**
 * Process Flow - Simple 3-step visual
 * Shows WHAT happens, not HOW (technical details on request)
 */
export function ProcessFlow() {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.3,
  });

  const steps = [
    {
      number: '01',
      title: 'Capture',
      description:
        'A technician scans your space with professional 3D cameras — typically a few hours on site, no disruption to your business.',
      icon: CameraIcon,
    },
    {
      number: '02',
      title: 'Process',
      description:
        'We assemble the scans into a measurable digital twin: walkthrough, dollhouse view and floor plan included.',
      icon: ProcessIcon,
    },
    {
      number: '03',
      title: 'Publish',
      description:
        'Your tour goes live on a link you can embed on your website or listings — it runs in any browser, no app required.',
      icon: GlobeIcon,
    },
  ];

  return (
    <section id="process" className="py-24 bg-apple-gray-50/60 backdrop-blur-sm">
      <div className="max-w-7xl mx-auto px-6">
        <motion.div
          className="text-center mb-16"
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 mb-4">
            How it works.
          </h2>
          <p className="text-xl text-apple-gray-500 max-w-2xl mx-auto">
            From physical space to digital twin in three simple steps.
          </p>
        </motion.div>

        <div ref={ref} className="relative">
          {/* Connecting line - desktop only */}
          <div className="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 -translate-y-1/2 z-0">
            <motion.div
              className="h-full bg-gradient-to-r from-apple-blue-400 via-apple-blue-500 to-apple-blue-400"
              initial={{ scaleX: 0 }}
              animate={inView ? { scaleX: 1 } : {}}
              transition={{ duration: 1, delay: 0.3 }}
              style={{ transformOrigin: 'left' }}
            />
          </div>

          {/* Steps */}
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8 relative z-10">
            {steps.map((step, index) => (
              <ProcessStep
                key={index}
                step={step}
                index={index}
                inView={inView}
              />
            ))}
          </div>
        </div>

        {/* Spec strip — concrete facts, not adjectives */}
        <motion.div
          className="mt-16 max-w-4xl mx-auto"
          initial={{ opacity: 0, y: 20 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6, delay: 0.6 }}
        >
          <dl className="grid grid-cols-2 md:grid-cols-4 gap-px rounded-2xl overflow-hidden border border-apple-gray-200 bg-apple-gray-200">
            <SpecCell term="On-site capture" detail="Typically 2–4 hours" />
            <SpecCell term="Tour delivered" detail="Within days of capture" />
            <SpecCell term="Works on" detail="Any browser — no app" />
            <SpecCell term="You receive" detail="Walkthrough, dollhouse view & floor plan" />
          </dl>
        </motion.div>
      </div>
    </section>
  );
}

function SpecCell({ term, detail }) {
  return (
    <div className="bg-white/80 backdrop-blur-sm px-5 py-4 text-center">
      <dt className="text-xs uppercase tracking-wider text-apple-gray-400 mb-1">{term}</dt>
      <dd className="text-sm font-semibold text-apple-gray-900">{detail}</dd>
    </div>
  );
}

function ProcessStep({ step, index, inView }) {
  const Icon = step.icon;

  return (
    <motion.div
      className="text-center"
      initial={{ opacity: 0, y: 30 }}
      animate={inView ? { opacity: 1, y: 0 } : {}}
      transition={{
        duration: 0.6,
        delay: 0.2 + index * 0.2,
        type: 'spring',
        stiffness: 100,
      }}
    >
      {/* Icon circle */}
      <div className="relative inline-flex items-center justify-center mb-6">
        <motion.div
          className="w-24 h-24 rounded-full bg-white/70 backdrop-blur-md shadow-lg flex items-center justify-center border border-apple-gray-100/50"
          initial={{ scale: 0.8 }}
          animate={inView ? { scale: 1 } : {}}
          transition={{
            duration: 0.5,
            delay: 0.3 + index * 0.2,
            type: 'spring',
            stiffness: 200,
          }}
        >
          <Icon className="w-10 h-10 text-apple-blue-500" />
        </motion.div>

      </div>

      {/* Text */}
      <h3 className="text-2xl font-semibold text-apple-gray-900 mb-2">
        {step.title}
      </h3>
      <p className="text-base text-apple-gray-500 max-w-xs mx-auto">
        {step.description}
      </p>
    </motion.div>
  );
}

// Icons
function CameraIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  );
}

function ProcessIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  );
}

function GlobeIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
    </svg>
  );
}

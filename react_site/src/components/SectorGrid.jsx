import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';

// Icons — Heroicons outline style (24x24 viewBox, strokeWidth 1.5)

function BuildingIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
    </svg>
  );
}

function MuseumIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
    </svg>
  );
}

function HomeIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v3.818m0 0l3 1.636M3.75 21h16.5M12 3v1.5" />
    </svg>
  );
}

function AcademicCapIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
    </svg>
  );
}

function SunIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
    </svg>
  );
}

function FactoryIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M3.75 21h16.5M4.5 3h6v7.5H4.5V3zm0 7.5V21m6-10.5V21m1.5-18h1.5l4.5 6v12m-6-18v18m6 0V9m-3 3h.008v.008H16.5V12zm0 3h.008v.008H16.5V15zm0 3h.008v.008H16.5V18z" />
    </svg>
  );
}

// Each tile links to a distinct service page — never two tiles to the same URL
const sectors = [
  { name: 'Real Estate & Commercial', tagline: 'Sell and lease spaces faster', link: '/services/virtual-tours-commercial', icon: HomeIcon },
  { name: 'Hospitality', tagline: 'Room tours that convert bookings', link: '/services/virtual-tours-hospitality', icon: BuildingIcon },
  { name: 'Tourism, Heritage & Culture', tagline: 'Preserve and share spaces', link: '/services/virtual-tours-tourism', icon: MuseumIcon },
  { name: 'Education', tagline: 'Campus tours for recruitment', link: '/services/virtual-tours-education', icon: AcademicCapIcon },
  { name: 'Energy & Solar', tagline: 'Digital twins for solar operations', link: '/services/digital-twins-solar-energy', icon: SunIcon },
  { name: 'Industries', tagline: 'Digital twins and AI video', link: '/services/digital-twins-industries', icon: FactoryIcon },
];

export function SectorGrid() {
  const { ref, inView } = useInView({
    triggerOnce: true,
    threshold: 0.1,
  });

  return (
    <section className="py-24">
      <div className="max-w-7xl mx-auto px-6">
        <motion.div
          ref={ref}
          initial={{ opacity: 0, y: 30 }}
          animate={inView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 text-center mb-12">
            Sectors We Serve
          </h2>

          <div className="grid grid-cols-2 md:grid-cols-3 gap-6">
            {sectors.map((sector, index) => {
              const Icon = sector.icon;
              return (
                <motion.div
                  key={sector.name}
                  initial={{ opacity: 0, y: 20 }}
                  animate={inView ? { opacity: 1, y: 0 } : {}}
                  transition={{
                    duration: 0.5,
                    delay: index * 0.1,
                  }}
                >
                  <Link
                    to={sector.link}
                    className="block p-6 rounded-2xl border border-apple-gray-100 hover:border-apple-gray-200 hover:shadow-md transition-all group"
                  >
                    <Icon className="w-8 h-8 text-apple-blue-600 mb-3" />
                    <h3 className="font-semibold text-apple-gray-900 group-hover:text-apple-blue-500 transition-colors">
                      {sector.name}
                    </h3>
                    <p className="text-sm text-apple-gray-500 mt-1">
                      {sector.tagline}
                    </p>
                  </Link>
                </motion.div>
              );
            })}
          </div>
        </motion.div>
      </div>
    </section>
  );
}

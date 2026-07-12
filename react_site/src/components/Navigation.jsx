import { useState, useEffect } from 'react';
import { Button } from './ui/Button';
import { ServicesMenu } from './ServicesMenu';
import { menuPages } from '../config/services';
import { motion, AnimatePresence } from 'framer-motion';

const NAV_LINKS = [
  { href: '#experiences', label: 'Explore' },
  { href: '#sectors', label: 'Sectors' },
  { href: '#process', label: 'How It Works' },
];

/**
 * Fixed translucent navigation bar
 * Apple-style glass effect with backdrop blur
 */
export function Navigation() {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Close the mobile menu on Escape
  useEffect(() => {
    if (!mobileOpen) return;
    const onKey = (e) => {
      if (e.key === 'Escape') setMobileOpen(false);
    };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, [mobileOpen]);

  const scrollToGetStarted = () => {
    setMobileOpen(false);
    document.getElementById('get-started')?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <motion.nav
      className={`
        fixed top-0 w-full z-50
        transition-all duration-300
        ${isScrolled || mobileOpen ? 'glass-nav' : 'bg-transparent'}
      `}
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      transition={{ type: 'spring', stiffness: 100, damping: 20 }}
    >
      <div className="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
        <motion.a
          href="#"
          className="flex items-center"
          whileHover={{ scale: 1.02 }}
        >
          <img src="/logo.png" alt="Beyex" className="h-8" width="77" height="32" decoding="async" />
        </motion.a>

        <div className="hidden md:flex items-center gap-8">
          {NAV_LINKS.map((link) => (
            <NavLink key={link.href} href={link.href} isScrolled={isScrolled}>
              {link.label}
            </NavLink>
          ))}
          <ServicesMenu label="Use Cases" items={menuPages} />
          <NavLink href="/pricing" isScrolled={isScrolled}>Pricing</NavLink>
        </div>

        <div className="flex items-center gap-3">
          <Button size="sm" onClick={scrollToGetStarted}>Get Started</Button>

          {/* Mobile menu toggle */}
          <button
            type="button"
            className="md:hidden flex items-center justify-center w-10 h-10 rounded-lg text-apple-gray-900 hover:bg-apple-gray-100/60 focus-visible:ring-2 focus-visible:ring-apple-blue-500 transition-colors"
            aria-label={mobileOpen ? 'Close menu' : 'Open menu'}
            aria-expanded={mobileOpen}
            aria-controls="mobile-nav"
            onClick={() => setMobileOpen((open) => !open)}
          >
            {mobileOpen ? <CloseIcon className="w-6 h-6" /> : <MenuIcon className="w-6 h-6" />}
          </button>
        </div>
      </div>

      {/* Mobile menu panel */}
      <AnimatePresence>
        {mobileOpen && (
          <motion.div
            id="mobile-nav"
            className="md:hidden glass-nav border-t border-apple-gray-200/50 overflow-hidden"
            initial={{ height: 0, opacity: 0 }}
            animate={{ height: 'auto', opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            transition={{ duration: 0.2 }}
          >
            <div className="px-6 py-4 flex flex-col gap-1">
              {NAV_LINKS.map((link) => (
                <a
                  key={link.href}
                  href={link.href}
                  className="py-3 text-lg font-medium text-apple-gray-900 border-b border-apple-gray-200/50 last:border-b-0"
                  onClick={() => setMobileOpen(false)}
                >
                  {link.label}
                </a>
              ))}
              <a
                href="/pricing"
                className="py-3 text-lg font-medium text-apple-gray-900 border-b border-apple-gray-200/50 last:border-b-0"
                onClick={() => setMobileOpen(false)}
              >
                Pricing
              </a>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.nav>
  );
}

function NavLink({ href, children, isScrolled }) {
  return (
    <motion.a
      href={href}
      // Over the 3D scene (top state) links need the white text-shadow for contrast
      className={`text-base text-apple-gray-600 hover:text-apple-gray-900 transition-colors ${
        isScrolled ? '' : 'text-shadow-white font-medium'
      }`}
      whileHover={{ scale: 1.05 }}
      whileTap={{ scale: 0.95 }}
    >
      {children}
    </motion.a>
  );
}

function MenuIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
      <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  );
}

function CloseIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
      <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
    </svg>
  );
}

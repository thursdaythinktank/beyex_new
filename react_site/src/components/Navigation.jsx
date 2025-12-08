import { useState, useEffect } from 'react';
import { Button } from './ui/Button';
import { motion } from 'framer-motion';

/**
 * Fixed translucent navigation bar
 * Apple-style glass effect with backdrop blur
 */
export function Navigation() {
  const [isScrolled, setIsScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <motion.nav
      className={`
        fixed top-0 w-full z-50
        transition-all duration-300
        ${isScrolled ? 'glass-nav' : 'bg-transparent'}
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
          <img src="/logo.png" alt="Beyex" className="h-8" />
        </motion.a>

        <div className="hidden md:flex items-center gap-8">
          <NavLink href="#experiences">Explore</NavLink>
          <NavLink href="#process">How It Works</NavLink>
          <NavLink href="#use-cases">Use Cases</NavLink>
        </div>

        <Button size="sm" onClick={() => document.getElementById('get-started')?.scrollIntoView({ behavior: 'smooth' })}>Get Started</Button>
      </div>
    </motion.nav>
  );
}

function NavLink({ href, children }) {
  return (
    <motion.a
      href={href}
      className="text-base text-apple-gray-600 hover:text-apple-gray-900 transition-colors"
      whileHover={{ scale: 1.05 }}
      whileTap={{ scale: 0.95 }}
    >
      {children}
    </motion.a>
  );
}

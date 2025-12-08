import { useState, useEffect } from 'react';

/**
 * Track scroll position and progress (0-1) for animations
 * Returns scroll position in pixels and normalized progress
 */
export function useScrollProgress() {
  const [scrollY, setScrollY] = useState(0);
  const [scrollProgress, setScrollProgress] = useState(0);

  useEffect(() => {
    const handleScroll = () => {
      const currentScrollY = window.scrollY;
      const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
      const progress = maxScroll > 0 ? currentScrollY / maxScroll : 0;

      setScrollY(currentScrollY);
      setScrollProgress(Math.min(Math.max(progress, 0), 1));
    };

    // Throttle to 60fps
    let ticking = false;
    const throttledScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          handleScroll();
          ticking = false;
        });
        ticking = true;
      }
    };

    window.addEventListener('scroll', throttledScroll, { passive: true });
    handleScroll(); // Initial calculation

    return () => window.removeEventListener('scroll', throttledScroll);
  }, []);

  return { scrollY, scrollProgress };
}

import { useState, useEffect, useRef } from 'react';
import { useInView } from 'react-intersection-observer';

/**
 * Calculate distance-based opacity and blur (depth fog)
 * Elements fade and blur slightly as they move away from viewport center
 */
export function useDepthFog(intensity = 0.6) {
  const [fog, setFog] = useState({
    opacity: 1,
    blur: 0,
    scale: 1,
  });

  const { ref, inView } = useInView({
    threshold: [0, 0.25, 0.5, 0.75, 1],
    triggerOnce: false,
  });

  useEffect(() => {
    if (!inView) {
      setFog({
        opacity: 0.4,
        blur: 4,
        scale: 0.95,
      });
      return;
    }

    const handleScroll = () => {
      const element = ref.current;
      if (!element) return;

      const rect = element.getBoundingClientRect();
      const elementCenter = rect.top + rect.height / 2;
      const viewportCenter = window.innerHeight / 2;
      const distance = Math.abs(elementCenter - viewportCenter);
      const maxDistance = window.innerHeight / 2;
      const fogIntensity = Math.min(distance / maxDistance, 1);

      setFog({
        opacity: 1 - (fogIntensity * intensity),
        blur: fogIntensity * 4,
        scale: 1 - (fogIntensity * 0.1),
      });
    };

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
  }, [inView, intensity, ref]);

  return { fog, ref };
}

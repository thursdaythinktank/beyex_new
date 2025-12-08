import { useEffect, useRef } from 'react';

/**
 * Simple scroll hook with native scrolling
 * Provides scroll data without overriding browser behavior
 */
export function useLenis(onScroll) {
  const onScrollRef = useRef(onScroll);
  const lastScrollY = useRef(0);

  // Update ref when callback changes
  useEffect(() => {
    onScrollRef.current = onScroll;
  }, [onScroll]);

  useEffect(() => {
    const handleScroll = () => {
      const callback = onScrollRef.current;
      if (!callback) return;

      const scrollY = window.scrollY;
      const limit = document.documentElement.scrollHeight - window.innerHeight;
      const progress = limit > 0 ? scrollY / limit : 0;

      callback({
        scroll: scrollY,
        limit,
        velocity: 0,
        direction: scrollY > lastScrollY.current ? 1 : -1,
        progress,
      });

      lastScrollY.current = scrollY;
    };

    // Use passive listener for best performance
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Initial call
    handleScroll();

    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []); // Empty deps - only run once
}

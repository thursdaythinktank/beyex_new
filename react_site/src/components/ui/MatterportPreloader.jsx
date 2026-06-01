import { useEffect, useState } from 'react';

/**
 * Silently preloads Matterport tour in the background
 * Loads after initial page render to not affect performance
 * Hidden iframe caches the tour assets for faster modal load
 */
export function MatterportPreloader({ tourUrl, delay = 3000 }) {
  const [shouldLoad, setShouldLoad] = useState(false);

  useEffect(() => {
    // Wait for page to be fully loaded and idle before preloading
    const timer = setTimeout(() => {
      // Use requestIdleCallback if available, otherwise just load
      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(() => setShouldLoad(true), { timeout: 5000 });
      } else {
        setShouldLoad(true);
      }
    }, delay);

    return () => clearTimeout(timer);
  }, [delay]);

  if (!shouldLoad || !tourUrl) return null;

  return (
    <iframe
      src={tourUrl}
      title="Matterport Preloader"
      style={{
        position: 'absolute',
        width: '1px',
        height: '1px',
        top: '-9999px',
        left: '-9999px',
        opacity: 0,
        pointerEvents: 'none',
        visibility: 'hidden',
      }}
      tabIndex={-1}
      aria-hidden="true"
      loading="lazy"
    />
  );
}

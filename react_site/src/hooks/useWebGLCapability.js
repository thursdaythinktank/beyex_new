import { useState, useEffect } from 'react';

/**
 * Detects WebGL capability and determines if fallback should be used
 * Checks: WebGL support, mobile device, slow connection, reduced motion preference
 */
export function useWebGLCapability() {
  const [capability, setCapability] = useState({
    checked: false,
    shouldUseFallback: true, // Default to fallback until check completes
  });

  useEffect(() => {
    // Run capability checks
    const checks = {
      // Check if WebGL is supported
      webglSupported: (() => {
        try {
          const canvas = document.createElement('canvas');
          return !!(window.WebGLRenderingContext &&
            (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')));
        } catch (e) {
          return false;
        }
      })(),

      // Check if mobile device (width-based)
      isMobile: window.matchMedia('(max-width: 768px)').matches,

      // Check for slow connection
      slowConnection: ['slow-2g', '2g', '3g'].includes(
        navigator.connection?.effectiveType
      ),

      // Check for reduced motion preference
      prefersReducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
    };

    // Determine if fallback should be used
    const shouldUseFallback =
      !checks.webglSupported ||
      checks.isMobile ||
      checks.slowConnection ||
      checks.prefersReducedMotion;

    setCapability({
      checked: true,
      shouldUseFallback,
      ...checks,
    });
  }, []);

  return capability;
}

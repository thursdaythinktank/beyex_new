import { useState, useEffect } from 'react';

/**
 * Detects browser name and version from user agent
 * Returns { name, version } or { name: 'unknown', version: 0 }
 */
function detectBrowser() {
  const ua = navigator.userAgent;

  // Order matters - check more specific patterns first
  const browsers = [
    // Edge (Chromium-based, must check before Chrome)
    { name: 'edge', regex: /Edg(?:e|A|iOS)?\/(\d+)/ },
    // Opera (must check before Chrome)
    { name: 'opera', regex: /(?:OPR|Opera)\/(\d+)/ },
    // Samsung Internet
    { name: 'samsung', regex: /SamsungBrowser\/(\d+)/ },
    // UC Browser
    { name: 'ucbrowser', regex: /UCBrowser\/(\d+)/ },
    // Chrome
    { name: 'chrome', regex: /Chrome\/(\d+)/ },
    // Firefox
    { name: 'firefox', regex: /Firefox\/(\d+)/ },
    // Safari (must check after Chrome)
    { name: 'safari', regex: /Version\/(\d+).*Safari/ },
    // IE
    { name: 'ie', regex: /(?:MSIE |Trident.*rv:)(\d+)/ },
  ];

  for (const { name, regex } of browsers) {
    const match = ua.match(regex);
    if (match) {
      return { name, version: parseInt(match[1], 10) };
    }
  }

  return { name: 'unknown', version: 0 };
}

/**
 * Checks if browser version is capable of smooth WebGL performance
 * Returns true if browser is too old or known to have poor WebGL performance
 */
function isLowCapabilityBrowser() {
  const { name, version } = detectBrowser();

  // Minimum versions for reliable WebGL performance
  // These are conservative thresholds for smooth 3D rendering
  const minVersions = {
    chrome: 90,      // Chrome 90+ (March 2021)
    firefox: 90,     // Firefox 90+ (July 2021)
    safari: 15,      // Safari 15+ (Sept 2021) - better WebGL2 support
    edge: 90,        // Edge 90+ (same as Chromium)
    opera: 76,       // Opera 76+ (based on Chromium 90)
    samsung: 15,     // Samsung Internet 15+
    ucbrowser: 13,   // UC Browser - generally poor WebGL
    ie: Infinity,    // IE - always fallback
  };

  const minVersion = minVersions[name];

  // Unknown browsers: check if they have good GPU info
  if (minVersion === undefined) {
    return checkWeakGPU();
  }

  // If version is below minimum, use fallback
  if (version < minVersion) {
    return true;
  }

  // Even modern browsers may have weak GPUs
  return checkWeakGPU();
}

/**
 * Detects weak or software-rendered GPUs via WebGL renderer info
 */
function checkWeakGPU() {
  try {
    const canvas = document.createElement('canvas');
    const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
    if (!gl) return true;

    const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
    if (!debugInfo) return false; // Can't detect, assume capable

    const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL).toLowerCase();

    // Known weak/software renderers
    const weakRenderers = [
      'swiftshader',      // Software renderer
      'llvmpipe',         // Mesa software renderer
      'software',         // Generic software
      'microsoft basic',  // Windows basic renderer
      'vmware',           // Virtual machine
      'virtualbox',       // Virtual machine
      'intel hd graphics 3000', // Very old Intel GPU
      'intel hd graphics 2000', // Very old Intel GPU
      'intel gma',        // Ancient Intel graphics
    ];

    return weakRenderers.some(weak => renderer.includes(weak));
  } catch (e) {
    return false; // Can't detect, assume capable
  }
}

/**
 * Detects WebGL capability and determines if fallback should be used
 * Checks: WebGL support, mobile device, slow connection, reduced motion preference,
 * browser version, and GPU capability
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

      // Check browser version and GPU capability
      lowCapabilityBrowser: isLowCapabilityBrowser(),

      // Store detected browser info for debugging
      browser: detectBrowser(),
    };

    // Determine if fallback should be used
    const shouldUseFallback =
      !checks.webglSupported ||
      checks.isMobile ||
      checks.slowConnection ||
      checks.prefersReducedMotion ||
      checks.lowCapabilityBrowser;

    setCapability({
      checked: true,
      shouldUseFallback,
      ...checks,
    });
  }, []);

  return capability;
}

/**
 * Smooth scroll interpolation with Apple-style momentum
 */

export const smoothScrollConfig = {
  damping: 0.1,           // Smooth deceleration
  mass: 0.8,              // Light, responsive feel
  stiffness: 100,         // Moderate spring
  restDelta: 0.001,       // Precise stopping
};

/**
 * Interpolate between current and target value with easing
 */
export function lerp(start, end, factor) {
  return start + (end - start) * factor;
}

/**
 * Clamp value between min and max
 */
export function clamp(value, min, max) {
  return Math.min(Math.max(value, min), max);
}

/**
 * Map value from one range to another
 */
export function mapRange(value, inMin, inMax, outMin, outMax) {
  return ((value - inMin) * (outMax - outMin)) / (inMax - inMin) + outMin;
}

/**
 * Easing functions for smooth animations
 */
export const easing = {
  // Ease out cubic (Apple default)
  easeOutCubic: (t) => 1 - Math.pow(1 - t, 3),

  // Ease in out cubic
  easeInOutCubic: (t) => t < 0.5
    ? 4 * t * t * t
    : 1 - Math.pow(-2 * t + 2, 3) / 2,

  // Ease out expo (dramatic)
  easeOutExpo: (t) => t === 1 ? 1 : 1 - Math.pow(2, -10 * t),

  // Spring easing
  spring: (t) => {
    const p = 0.3;
    return Math.pow(2, -10 * t) * Math.sin((t - p / 4) * (2 * Math.PI) / p) + 1;
  },
};

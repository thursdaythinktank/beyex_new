import { useState, useEffect, useRef } from 'react';
import { useScrollProgress } from './useScrollProgress';

/**
 * Calculate parallax offset for depth layers
 * @param {number} speed - Scroll speed multiplier (0.3 for far, 0.6 for mid, 1.0 for near)
 * @param {number} offset - Additional offset in pixels
 */
export function useParallax(speed = 1.0, offset = 0) {
  const { scrollY } = useScrollProgress();
  const [parallaxOffset, setParallaxOffset] = useState(0);
  const elementRef = useRef(null);

  useEffect(() => {
    if (!elementRef.current) return;

    const elementTop = elementRef.current.getBoundingClientRect().top + window.scrollY;
    const relativeScroll = scrollY - elementTop + offset;
    const newOffset = relativeScroll * (1 - speed);

    setParallaxOffset(newOffset);
  }, [scrollY, speed, offset]);

  return { parallaxOffset, elementRef };
}

/**
 * Get transform string for parallax effect
 * @param {number} speed - Scroll speed multiplier
 */
export function useParallaxTransform(speed = 1.0) {
  const { parallaxOffset, elementRef } = useParallax(speed);

  const transform = `translateY(${parallaxOffset}px)`;

  return { transform, elementRef };
}

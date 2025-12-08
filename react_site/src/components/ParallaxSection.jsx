import { useParallaxTransform } from '../hooks/useParallax';
import { motion } from 'framer-motion';

/**
 * Wrapper component for depth-layered sections
 * Applies parallax effect based on depth layer (background, midground, foreground)
 */
export function ParallaxSection({
  children,
  layer = 'foreground', // 'background' | 'midground' | 'foreground'
  className = '',
}) {
  const speedMap = {
    background: 0.3,
    midground: 0.6,
    foreground: 1.0,
  };

  const { transform, elementRef } = useParallaxTransform(speedMap[layer]);

  return (
    <motion.div
      ref={elementRef}
      className={`depth-layer ${className}`}
      style={{ transform }}
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      transition={{ duration: 0.6 }}
    >
      {children}
    </motion.div>
  );
}

/**
 * Depth layer configuration for parallax effects
 * Defines scroll speeds, blur, and opacity for different z-axis layers
 */

export const depthLayers = {
  background: {
    scrollSpeed: 0.3,     // Slowest (farthest)
    blur: 'blur-sm',
    opacity: 0.4,
    scale: 0.85,
    zIndex: 0,
  },
  midground: {
    scrollSpeed: 0.6,     // Medium depth
    blur: 'blur-none',
    opacity: 0.7,
    scale: 1.0,
    zIndex: 10,
  },
  foreground: {
    scrollSpeed: 1.0,     // Normal (closest)
    blur: 'blur-none',
    opacity: 1.0,
    scale: 1.15,
    zIndex: 20,
  },
};

/**
 * Get depth layer properties by name
 */
export function getDepthLayer(layerName) {
  return depthLayers[layerName] || depthLayers.foreground;
}

/**
 * Calculate transform for depth layer
 */
export function getDepthTransform(layerName, scrollProgress = 0) {
  const layer = getDepthLayer(layerName);

  return {
    transform: `translateY(${scrollProgress * (1 - layer.scrollSpeed) * 100}px) scale(${layer.scale})`,
    opacity: layer.opacity,
    filter: layer.blur !== 'blur-none' ? `blur(${layer.blur === 'blur-sm' ? '4px' : '0'})` : 'none',
    zIndex: layer.zIndex,
  };
}

/**
 * Scene configuration - Camera paths and 3D positions
 * Single source of truth for the volumetric journey
 */

export const SCENE_CONFIG = {
  // Camera journey through rooms - increased distance for faster fly-through
  rooms: {
    hero: { zStart: 0, zEnd: 25, duration: 0.2 },
    benefits: { zStart: 25, zEnd: 50, duration: 0.3 },
    sectors: { zStart: 50, zEnd: 90, duration: 0.3 },
    demo: { zStart: 90, zEnd: 120, duration: 0.2 },
  },

  // Total camera travel distance - doubled for faster movement feel
  totalDistance: 120,

  // Camera config
  camera: {
    fov: 45,
    near: 0.1,
    far: 100,
  },
};

/**
 * Map scroll progress (0-1) to camera Z position
 */
export function scrollToCameraZ(scrollProgress) {
  return scrollProgress * SCENE_CONFIG.totalDistance;
}

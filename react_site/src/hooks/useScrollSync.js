import { useRef } from 'react';
import { useFrame } from '@react-three/fiber';
import { SCENE_CONFIG } from '../utils/constants/sceneConfig';

/**
 * London Scene Camera Path
 *
 * Camera ALWAYS looks at the London Eye hub center (fixed target).
 * Camera STARTS high (Y=45) above the Eye hub (Y=28.5) - looking DOWN.
 * Camera DESCENDS in a smooth curve as user scrolls.
 * Camera ENDS at ground level (Y=0) - looking UP at the Eye.
 *
 * Visual effect:
 * - At start: Looking slightly down at Eye from above
 * - As you scroll: Camera descends, Eye stays centered
 * - At end: Looking up at the majestic Eye towering above
 *
 * Three-phase speed:
 * 1. Fast initial descent (0-30% progress)
 * 2. Moderate approach (30-70% progress)
 * 3. Very slow final glide (70-100% progress)
 */

// Camera path configuration
const PATH = {
  // Starting position - HIGH above the London Eye hub (at Y≈28.5 with 1.5x scale)
  startX: 20,      // East of center
  startY: 45,      // ABOVE Eye hub - looking DOWN at Eye initially
  startZ: -20,     // Farther back for dramatic approach

  // End position - at Eye BASE level
  endX: -15,       // Closer to Eye X position (-25)
  endY: 0,         // At Eye BASE level - looking UP at Eye at end
  endZ: 60,        // Stop before river, Eye fills view

  // Look-at target - London Eye hub center (FIXED point)
  // Camera always looks at this point, pitch changes naturally as camera descends
  lookAtX: -25,    // London Eye X position
  lookAtY: 28.5,   // London Eye hub Y (wheelRadius=18 * 1.5 scale + base height)
  lookAtZ: 110,    // London Eye Z position
};

/**
 * Three-phase easing for bird-like landing
 * Fast → Moderate → Very Slow
 */
function threePhaseEase(t) {
  if (t < 0.3) {
    // Phase 1: Fast descent (0-30%)
    // Map 0-0.3 to 0-0.5 of actual progress (faster)
    const phase = t / 0.3;
    return phase * 0.5;
  } else if (t < 0.7) {
    // Phase 2: Moderate approach (30-70%)
    // Map 0.3-0.7 to 0.5-0.85 of actual progress (moderate)
    const phase = (t - 0.3) / 0.4;
    return 0.5 + phase * 0.35;
  } else {
    // Phase 3: Very slow final glide (70-100%)
    // Map 0.7-1.0 to 0.85-1.0 of actual progress (very slow)
    const phase = (t - 0.7) / 0.3;
    // Use ease-out for gentle landing
    const eased = 1 - Math.pow(1 - phase, 3);
    return 0.85 + eased * 0.15;
  }
}

/**
 * Get camera position along curved descent path
 */
function getCameraPosition(progress) {
  // Apply three-phase easing
  const easedProgress = threePhaseEase(progress);

  // Curved path using quadratic bezier-like interpolation
  // Control point creates smooth descending arc from high start to ground level
  const controlX = (PATH.startX + PATH.endX) / 2;
  const controlY = PATH.startY * 0.7;  // Arc peaks at 70% of start height (31.5)
  const controlZ = (PATH.startZ + PATH.endZ) / 2;

  // Quadratic bezier interpolation
  const t = easedProgress;
  const mt = 1 - t;
  const mt2 = mt * mt;
  const t2 = t * t;

  const x = mt2 * PATH.startX + 2 * mt * t * controlX + t2 * PATH.endX;
  const y = mt2 * PATH.startY + 2 * mt * t * controlY + t2 * PATH.endY;
  const z = mt2 * PATH.startZ + 2 * mt * t * controlZ + t2 * PATH.endZ;

  return { x, y, z };
}

/**
 * Get look-at target based on camera position
 * Camera ALWAYS looks at the HORIZON (same Y as camera)
 * This creates a natural cinematic view where:
 * - Buildings/landmarks below horizon appear in lower screen
 * - Balloons/sky above horizon appear in upper screen
 * - London Eye rises dramatically above the horizon line
 */
function getLookAtTarget(progress, cameraPos) {
  // Look at horizon = same Y as camera position
  // X and Z aim toward London Eye area in the distance
  return {
    x: PATH.lookAtX,  // -25 (toward London Eye)
    y: cameraPos.y,   // HORIZON - same height as camera
    z: PATH.lookAtZ   // 110 (far distance)
  };
}

/**
 * Scroll-to-camera sync hook for London scene
 * Maps scroll progress to cinematic bird-landing camera path
 */
export function useScrollSync(scrollData) {
  const targetProgress = useRef(0);
  const currentProgress = useRef(0);
  const velocity = useRef(0);
  const lastProgress = useRef(0);
  const introComplete = useRef(false);
  const introEndProgress = 0.08;

  // Update target progress when scroll changes
  if (scrollData) {
    targetProgress.current = scrollData.progress;
  }

  // Smoothly interpolate camera along path
  useFrame((state) => {
    // Ensure proper up vector
    state.camera.up.set(0, 1, 0);

    // Intro animation (first 2.5 seconds)
    if (!introComplete.current) {
      const elapsed = state.clock.elapsedTime;
      if (elapsed < 2.5) {
        const introProgress = elapsed / 2.5;
        const easedIntro = 1 - Math.pow(1 - introProgress, 3);
        const animProgress = easedIntro * introEndProgress;

        const pos = getCameraPosition(animProgress);
        state.camera.position.set(pos.x, pos.y, pos.z);

        // Look at the London Eye hub (Y=28.5 with 1.5x scale)
        // This creates natural pitch toward the Eye
        state.camera.lookAt(PATH.lookAtX, PATH.lookAtY, PATH.lookAtZ);

        currentProgress.current = animProgress;
        lastProgress.current = animProgress;
        return;
      }
      introComplete.current = true;
      currentProgress.current = introEndProgress;
      lastProgress.current = introEndProgress;
    }

    // Track velocity
    velocity.current = currentProgress.current - lastProgress.current;
    lastProgress.current = currentProgress.current;

    // Variable damping
    const baseDamping = 0.04;
    const velocityFactor = Math.min(Math.abs(velocity.current) * 3, 0.02);
    const damping = baseDamping + velocityFactor;

    // Smooth lerp progress toward target
    const effectiveTarget = Math.max(targetProgress.current, introEndProgress);
    currentProgress.current += (effectiveTarget - currentProgress.current) * damping;

    // Get position on curved path
    const pos = getCameraPosition(currentProgress.current);
    state.camera.position.set(pos.x, pos.y, pos.z);

    // Look at the London Eye hub - camera pitches naturally to keep Eye in view
    state.camera.lookAt(PATH.lookAtX, PATH.lookAtY, PATH.lookAtZ);
  });

  // Return Z position for other components
  const pos = getCameraPosition(currentProgress.current);
  return { cameraZ: pos.z, velocity: velocity.current };
}

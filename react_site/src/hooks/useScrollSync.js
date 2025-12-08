import { useRef } from 'react';
import { useFrame } from '@react-three/fiber';
import { scrollToCameraZ, SCENE_CONFIG } from '../utils/constants/sceneConfig';

/**
 * Curved camera path calculation
 * Starts at 45-degree angle, curves down to ground level, then goes straight
 */
function getCameraPosition(progress) {
  // Path parameters
  const startY = 15;      // Starting height (high up)
  const startZ = -30;     // Starting Z position (far back)
  const groundY = 0.5;    // Ground level camera height
  const curveEndZ = 30;   // Z position where curve ends and straight begins
  const totalZ = SCENE_CONFIG.totalDistance;

  // Curve phase: 0 to ~25% of journey (Z: -30 to 30)
  // Straight phase: 25% to 100% of journey (Z: 30 to 120)

  const curveLength = curveEndZ - startZ; // 60 units of curve
  const straightLength = totalZ - curveEndZ; // 90 units straight

  // Map progress to actual Z position
  const targetZ = startZ + (progress * (totalZ - startZ));

  if (targetZ <= curveEndZ) {
    // In the curve phase - use quadratic bezier-like curve
    const curveProgress = (targetZ - startZ) / curveLength;
    // Ease out curve for smooth descent
    const easedProgress = 1 - Math.pow(1 - curveProgress, 2);
    const y = startY - (startY - groundY) * easedProgress;
    return { y, z: targetZ };
  } else {
    // In the straight phase - maintain ground level
    return { y: groundY, z: targetZ };
  }
}

/**
 * Calculate look-at point based on camera position on curve
 * Initially points at buildings (Z=10-20 area), then looks ahead
 */
function getLookAtPosition(cameraY, cameraZ, progress) {
  // Buildings are at Z=10 (shop), Z=18 (restaurant) for first cluster
  const buildingTargetZ = 15; // Center of first building cluster

  // During intro/early curve phase, look at the buildings
  if (progress < 0.15) {
    // Look directly at buildings area, slightly above ground
    const lookY = 2; // Slightly above ground where buildings are
    // Blend from looking at buildings to looking ahead
    const blendFactor = progress / 0.15;
    const targetZ = buildingTargetZ + (blendFactor * 20);
    return { x: 0, y: lookY, z: targetZ };
  }

  // During curve phase, look ahead and toward ground
  if (progress < 0.35) {
    const lookAheadDistance = 30;
    const lookY = Math.max(0.5, cameraY - 8);
    return { x: 0, y: lookY, z: cameraZ + lookAheadDistance };
  }

  // In straight phase, look straight ahead
  return { x: 0, y: cameraY, z: cameraZ + 25 };
}

/**
 * Scroll-to-camera sync hook
 * Maps scroll progress to curved camera path with cinematic movement
 * Camera starts at 45-degree angle, curves down, then travels straight
 */
export function useScrollSync(scrollData) {
  const targetProgress = useRef(0);
  const currentProgress = useRef(0);
  const velocity = useRef(0);
  const lastProgress = useRef(0);
  const introComplete = useRef(false);
  const introEndProgress = 0.08; // Lock this as minimum progress

  // Update target progress when scroll changes
  if (scrollData) {
    targetProgress.current = scrollData.progress;
  }

  // Helper: consistent sway calculation (position-based)
  const calculateSway = (z) => Math.sin(z * 0.04) * 0.15;

  // Smoothly interpolate camera along curved path
  useFrame((state) => {
    // Ensure camera up vector is correct (prevents flipping)
    state.camera.up.set(0, 1, 0);

    // Intro animation (first 2.5 seconds) - sweep in from starting position
    if (!introComplete.current) {
      const elapsed = state.clock.elapsedTime;
      if (elapsed < 2.5) {
        // Animate from 0 to intro end progress
        const introProgress = elapsed / 2.5;
        const easedIntro = 1 - Math.pow(1 - introProgress, 3); // easeOutCubic
        const animProgress = easedIntro * introEndProgress;

        const pos = getCameraPosition(animProgress);

        // Always look ahead during intro (simpler, no flip risk)
        const lookAheadZ = pos.z + 40;
        const lookY = Math.max(0, pos.y - 6); // Look slightly down

        // Use position-based sway (consistent with post-intro)
        const sway = calculateSway(pos.z);

        state.camera.position.set(sway, pos.y, pos.z);
        state.camera.lookAt(0, lookY, lookAheadZ);

        currentProgress.current = animProgress;
        lastProgress.current = animProgress;
        return;
      }
      introComplete.current = true;
      currentProgress.current = introEndProgress;
      lastProgress.current = introEndProgress;
    }

    // Track velocity before updating position
    velocity.current = currentProgress.current - lastProgress.current;
    lastProgress.current = currentProgress.current;

    // Variable damping for smooth movement
    const baseDamping = 0.05;
    const velocityFactor = Math.min(Math.abs(velocity.current) * 5, 0.02);
    const damping = baseDamping + velocityFactor;

    // Smooth lerp progress toward target (but never go below intro end)
    const effectiveTarget = Math.max(targetProgress.current, introEndProgress);
    currentProgress.current += (effectiveTarget - currentProgress.current) * damping;

    // Get position on curved path
    const pos = getCameraPosition(currentProgress.current);

    // Simple look-ahead calculation (avoids complex phase transitions)
    const lookAheadZ = pos.z + 35;
    const lookY = pos.y > 2 ? Math.max(0, pos.y - 6) : pos.y; // Look down while high, straight when low

    // Consistent sway calculation
    const sway = calculateSway(pos.z);
    const bob = Math.cos(pos.z * 0.03) * 0.05;

    state.camera.position.set(sway, pos.y + bob, pos.z);
    state.camera.lookAt(0, lookY, lookAheadZ);

    // No rotation.z manipulation - let lookAt handle orientation
  });

  // Return Z position for other components
  const pos = getCameraPosition(currentProgress.current);
  return { cameraZ: pos.z, velocity: velocity.current };
}

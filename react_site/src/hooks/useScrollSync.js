import { useRef } from 'react';
import { useFrame } from '@react-three/fiber';

/**
 * London Scene Camera Path
 *
 * POSITION: Arch path — starts high, dips to hub level, rises toward the Eye.
 *   Start: (20, 80, -100) — high aerial vantage, far behind scene
 *   Lowest: ~Y=29 — at London Eye hub centre level (mid-journey)
 *   End: (-15, 45, 85) — risen back up, close to the Eye
 *
 * PITCH: Linear -45° → 0° → +45° over scroll progress.
 *   Start: -45° — looking down at the cityscape
 *   Lowest point: 0° — looking horizontally across the scene
 *   End: +45° — looking up at the London Eye towering above
 *
 * Three-phase speed: Fast descent → Moderate approach → Slow glide
 */

const PATH = {
  startX: 25,   startY: 120,  startZ: -160,
  endX: -15,    endY: 50,     endZ: 85,

  // Horizontal direction target (camera always faces toward Eye area)
  dirX: -25,
  dirZ: 110,
};

/**
 * Three-phase easing for bird-like landing
 */
function threePhaseEase(t) {
  if (t < 0.3) {
    const phase = t / 0.3;
    return phase * 0.5;
  } else if (t < 0.7) {
    const phase = (t - 0.3) / 0.4;
    return 0.5 + phase * 0.35;
  } else {
    const phase = (t - 0.7) / 0.3;
    const eased = 1 - Math.pow(1 - phase, 3);
    return 0.85 + eased * 0.15;
  }
}

/**
 * Camera position along arch path (bezier with dip to hub level).
 */
function getCameraPosition(progress) {
  const t = threePhaseEase(progress);
  const mt = 1 - t;

  // Control point — pulls curve down to hub level (~Y=29) at midpoint
  const cx = (PATH.startX + PATH.endX) / 2;
  const cy = -5;
  const cz = (PATH.startZ + PATH.endZ) / 2;

  return {
    x: mt * mt * PATH.startX + 2 * mt * t * cx + t * t * PATH.endX,
    y: mt * mt * PATH.startY + 2 * mt * t * cy + t * t * PATH.endY,
    z: mt * mt * PATH.startZ + 2 * mt * t * cz + t * t * PATH.endZ,
  };
}

/**
 * LookAt target based on linear pitch profile.
 * Pitch: -45° (start) → 0° (mid) → +45° (end)
 * Camera always faces toward the Eye area horizontally.
 */
function getLookAtTarget(progress, camPos) {
  // Linear pitch: -45° at start, 0° at midpoint, +45° at end
  const pitchDeg = -45 + 90 * progress;
  const pitchRad = pitchDeg * (Math.PI / 180);

  const lookDist = 30;

  // Horizontal direction: toward the Eye area
  const dx = PATH.dirX - camPos.x;
  const dz = PATH.dirZ - camPos.z;
  const hDist = Math.sqrt(dx * dx + dz * dz);
  const nx = dx / hDist;
  const nz = dz / hDist;

  return {
    x: camPos.x + nx * lookDist * Math.cos(pitchRad),
    y: camPos.y + lookDist * Math.sin(pitchRad),
    z: camPos.z + nz * lookDist * Math.cos(pitchRad),
  };
}

/**
 * Scroll-to-camera sync hook.
 */
export function useScrollSync(scrollData) {
  const targetProgress = useRef(0);
  const currentProgress = useRef(0);
  const velocity = useRef(0);
  const lastProgress = useRef(0);
  const introComplete = useRef(false);
  const introEndProgress = 0.08;

  if (scrollData) {
    targetProgress.current = scrollData.progress;
  }

  useFrame((state) => {
    state.camera.up.set(0, 1, 0);

    // Intro animation (first 2.5s)
    if (!introComplete.current) {
      const elapsed = state.clock.elapsedTime;
      if (elapsed < 2.5) {
        const introT = elapsed / 2.5;
        const easedIntro = 1 - Math.pow(1 - introT, 3);
        const p = easedIntro * introEndProgress;

        const pos = getCameraPosition(p);
        state.camera.position.set(pos.x, pos.y, pos.z);
        const target = getLookAtTarget(p, pos);
        state.camera.lookAt(target.x, target.y, target.z);

        currentProgress.current = p;
        lastProgress.current = p;
        return;
      }
      introComplete.current = true;
      currentProgress.current = introEndProgress;
      lastProgress.current = introEndProgress;
    }

    velocity.current = currentProgress.current - lastProgress.current;
    lastProgress.current = currentProgress.current;

    const damping = 0.04 + Math.min(Math.abs(velocity.current) * 3, 0.02);
    const effectiveTarget = Math.max(targetProgress.current, introEndProgress);
    currentProgress.current += (effectiveTarget - currentProgress.current) * damping;

    // Position uses eased progress (three-phase), pitch uses raw progress (linear)
    const pos = getCameraPosition(currentProgress.current);
    state.camera.position.set(pos.x, pos.y, pos.z);
    const target = getLookAtTarget(currentProgress.current, pos);
    state.camera.lookAt(target.x, target.y, target.z);
  });

  const pos = getCameraPosition(currentProgress.current);
  return { cameraZ: pos.z, velocity: velocity.current };
}

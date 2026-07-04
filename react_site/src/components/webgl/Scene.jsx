import { useRef, useMemo, useEffect } from 'react';
import { useFrame, useThree } from '@react-three/fiber';
import { useScrollSync } from '../../hooks/useScrollSync';
import { scrollStore } from '../../hooks/scrollStore';

import * as THREE from 'three';
import { SpeedLines } from './SpeedLines';
import { Buildings } from './Buildings';
import { HotAirBalloons } from './HotAirBalloons';

// London scene color palette
const COLORS = {
  fog: '#c8d8e8',         // Blue-gray fog
  ambient: '#e8f0ff',     // Cool ambient
  particle: '#6BA3E0',    // Light blue particles
};

/**
 * Floating particles - increased density for atmospheric obscuring effect
 * Creates immersive depth and "flying through space" sensation
 */
function FloatingParticles() {
  const particlesRef = useRef();
  const particleCount = 2500; // Increased for more atmospheric effect

  const { positions, colors } = useMemo(() => {
    const pos = new Float32Array(particleCount * 3);
    const col = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount; i++) {
      const i3 = i * 3;

      // Spread across extended camera journey (Z: -20 to 140)
      pos[i3] = (Math.random() - 0.5) * 100;      // X spread - wider
      pos[i3 + 1] = (Math.random() - 0.5) * 100;  // Y spread - wider
      pos[i3 + 2] = Math.random() * 160 - 20;     // Z from -20 to 140

      // Blue-gray spectrum for London atmosphere
      const t = Math.random();
      col[i3] = 0.45 + t * 0.2;                   // R - gray-blue
      col[i3 + 1] = 0.55 + t * 0.25;              // G - gray-blue
      col[i3 + 2] = 0.7 + t * 0.2;                // B - blue tint
    }

    return { positions: pos, colors: col };
  }, []);

  useFrame((state) => {
    if (particlesRef.current) {
      // Slow rotation for ambient movement
      particlesRef.current.rotation.y = state.clock.elapsedTime * 0.008;
      particlesRef.current.rotation.x = Math.sin(state.clock.elapsedTime * 0.015) * 0.03;
    }
  });

  return (
    <points ref={particlesRef}>
      <bufferGeometry>
        <bufferAttribute
          attach="attributes-position"
          array={positions}
          count={particleCount}
          itemSize={3}
        />
        <bufferAttribute
          attach="attributes-color"
          array={colors}
          count={particleCount}
          itemSize={3}
        />
      </bufferGeometry>
      <pointsMaterial
        vertexColors
        transparent
        opacity={0.7}
        size={0.18}
        sizeAttenuation
        blending={THREE.AdditiveBlending}
        depthWrite={false}
      />
    </points>
  );
}

/**
 * Viewport-aware field of view. The camera path was tuned on wide
 * screens; on portrait phones a 70° horizontal-ish fov crops the
 * landmarks out of frame, so widen it as the aspect ratio narrows.
 */
function ResponsiveCamera() {
  const camera = useThree((state) => state.camera);
  const size = useThree((state) => state.size);

  useEffect(() => {
    const aspect = size.width / size.height;
    // 70° on landscape, easing up to 95° on narrow portrait
    const fov = aspect >= 1 ? 70 : Math.min(95, 70 + (1 - aspect) * 35);
    if (camera.fov !== fov) {
      camera.fov = fov;
      camera.updateProjectionMatrix();
    }
  }, [camera, size]);

  return null;
}

/**
 * Key light that follows the camera along its Z path.
 * Position is updated in the frame loop from the transient scroll store,
 * so it needs no React re-renders.
 */
function FollowLight() {
  const lightRef = useRef();

  useFrame(() => {
    if (lightRef.current) {
      lightRef.current.position.z = scrollStore.cameraZ + 20;
    }
  });

  return (
    <directionalLight
      ref={lightRef}
      position={[10, 30, 20]}
      intensity={1.0}
      color="#FFFFFF"
    />
  );
}

/**
 * Main 3D Scene
 * Cinematic volumetric background with scroll-linked camera movement.
 * Renders exactly once — all scroll/animation data flows through refs
 * and the transient scroll store, never through React state.
 */
export function Scene() {
  // Sync camera to scroll position (frame-loop only, no renders)
  useScrollSync();

  return (
    <>
      {/* Wider fov on portrait screens so landmarks stay in frame */}
      <ResponsiveCamera />

      {/* Exponential fog for depth atmosphere */}
      <fogExp2 attach="fog" color={COLORS.fog} density={0.005} />

      {/* Two-light rig: ambient fill + one camera-following key light.
          The previous 7 extra point lights quadrupled per-fragment cost
          for a barely visible glow — faked cheaper with fog + emissive. */}
      <ambientLight intensity={1.0} color={COLORS.ambient} />
      <FollowLight />

      {/* Particle field */}
      <FloatingParticles />

      {/* London landmarks - wireframe city scene */}
      <Buildings />

      {/* Hot air balloons floating on the right side */}
      <HotAirBalloons />

      {/* Speed lines - velocity feedback (reads scrollStore.velocity) */}
      <SpeedLines />
    </>
  );
}

import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import { useScrollSync } from '../../hooks/useScrollSync';
import { EffectComposer, Bloom, Vignette, TiltShift2 } from '@react-three/postprocessing';
import * as THREE from 'three';
import { SpeedLines } from './SpeedLines';
import { Buildings } from './Buildings';
import { HotAirBalloons } from './HotAirBalloons';

// London scene color palette
const COLORS = {
  fog: '#c8d8e8',         // Blue-gray fog
  ambient: '#e8f0ff',     // Cool ambient
  grid: '#4A90D9',        // Blue grid
  particle: '#6BA3E0',    // Light blue particles
};

/**
 * Volumetric Grid - Multiple grid planes the camera flies through
 * Creates dramatic depth as user scrolls through 3D space
 */
function VolumetricGrid({ cameraZ = 0 }) {
  const groupRef = useRef();

  // Create grid geometry - larger and more visible
  const gridGeometry = useMemo(() => {
    const points = [];
    const gridSize = 80;
    const divisions = 40;
    const spacing = gridSize / divisions;

    // Horizontal lines
    for (let i = -divisions / 2; i <= divisions / 2; i++) {
      points.push(new THREE.Vector3(-gridSize / 2, i * spacing, 0));
      points.push(new THREE.Vector3(gridSize / 2, i * spacing, 0));
    }

    // Vertical lines
    for (let i = -divisions / 2; i <= divisions / 2; i++) {
      points.push(new THREE.Vector3(i * spacing, -gridSize / 2, 0));
      points.push(new THREE.Vector3(i * spacing, gridSize / 2, 0));
    }

    return new THREE.BufferGeometry().setFromPoints(points);
  }, []);

  // Grid positions spread across extended journey (Z: 0 to 130) - increased opacity for more atmosphere
  const gridConfigs = useMemo(() => [
    { z: 10, opacity: 0.4, scale: 1 },
    { z: 25, opacity: 0.35, scale: 1.1 },
    { z: 40, opacity: 0.32, scale: 1.2 },
    { z: 55, opacity: 0.28, scale: 1.3 },
    { z: 70, opacity: 0.25, scale: 1.4 },
    { z: 85, opacity: 0.22, scale: 1.5 },
    { z: 100, opacity: 0.18, scale: 1.6 },
    { z: 115, opacity: 0.15, scale: 1.7 },
  ], []);

  // Animate grids
  useFrame((state) => {
    if (groupRef.current) {
      groupRef.current.children.forEach((grid, i) => {
        // Subtle rotation based on time and position
        const offset = i * 0.5;
        grid.rotation.x = Math.sin(state.clock.elapsedTime * 0.1 + offset) * 0.1;
        grid.rotation.y = Math.cos(state.clock.elapsedTime * 0.08 + offset) * 0.1;
      });
    }
  });

  return (
    <group ref={groupRef}>
      {gridConfigs.map((config, i) => (
        <lineSegments
          key={i}
          geometry={gridGeometry}
          position={[0, 0, config.z]}
          scale={[config.scale, config.scale, 1]}
        >
          <lineBasicMaterial
            color={COLORS.grid}
            transparent
            opacity={config.opacity}
            blending={THREE.AdditiveBlending}
          />
        </lineSegments>
      ))}
    </group>
  );
}

/**
 * Floating particles - increased density for atmospheric obscuring effect
 * Creates immersive depth and "flying through space" sensation
 */
function FloatingParticles({ cameraZ = 0 }) {
  const particlesRef = useRef();
  const particleCount = 2500; // Increased for more atmospheric effect

  const { positions, colors, sizes } = useMemo(() => {
    const pos = new Float32Array(particleCount * 3);
    const col = new Float32Array(particleCount * 3);
    const siz = new Float32Array(particleCount);

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

      // Varied sizes - larger particles for more obscuring
      siz[i] = Math.random() * 0.4 + 0.1;
    }

    return { positions: pos, colors: col, sizes: siz };
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
 * Ambient glow spheres - subtle light sources for London scene
 */
function AmbientGlows({ cameraZ = 0 }) {
  const glowPositions = useMemo(() => [
    { pos: [15, 8, 20], color: '#4A90D9', intensity: 0.7 },
    { pos: [-20, 5, 40], color: '#6BA3E0', intensity: 0.5 },
    { pos: [10, 10, 60], color: '#4A90D9', intensity: 0.6 },
    { pos: [-25, 15, 65], color: '#8BB8E8', intensity: 0.8 }, // Near London Eye
    { pos: [25, 8, 70], color: '#6BA3E0', intensity: 0.5 },
  ], []);

  return (
    <group>
      {glowPositions.map((glow, i) => (
        <pointLight
          key={i}
          position={glow.pos}
          color={glow.color}
          intensity={glow.intensity}
          distance={35}
          decay={2}
        />
      ))}
    </group>
  );
}

/**
 * Main 3D Scene
 * Cinematic volumetric background with scroll-linked camera movement
 */
export function Scene({ scrollData }) {
  // Sync camera to scroll position - returns cameraZ and velocity
  const { cameraZ, velocity } = useScrollSync(scrollData);

  return (
    <>
      {/* Exponential fog for depth atmosphere - reduced for better visibility */}
      <fogExp2 attach="fog" color={COLORS.fog} density={0.008} />

      {/* Ambient lighting - increased for better visibility */}
      <ambientLight intensity={0.8} color={COLORS.ambient} />

      {/* Key light - follows camera roughly */}
      <directionalLight
        position={[10, 30, cameraZ + 20]}
        intensity={1.0}
        color="#FFFFFF"
      />

      {/* Additional light for buildings and balloons */}
      <pointLight position={[0, 20, cameraZ + 15]} intensity={1.2} distance={50} />
      <pointLight position={[30, 40, 10]} intensity={0.8} distance={60} /> {/* Light for balloons */}

      {/* Volumetric grid planes - hidden for cleaner look */}
      {/* <VolumetricGrid cameraZ={cameraZ} /> */}

      {/* Particle field */}
      <FloatingParticles cameraZ={cameraZ} />

      {/* Ambient glow lights */}
      <AmbientGlows cameraZ={cameraZ} />

      {/* London landmarks - wireframe city scene */}
      <Buildings cameraZ={cameraZ} />

      {/* Hot air balloons floating on the right side */}
      <HotAirBalloons />

      {/* Speed lines - velocity feedback */}
      <SpeedLines velocity={velocity} />

      {/* Post-processing effects with atmospheric blur */}
      <EffectComposer>
        <Bloom
          intensity={0.7}
          luminanceThreshold={0.25}
          luminanceSmoothing={0.9}
          mipmapBlur
        />

        {/* Tilt-shift for miniature/toy camera effect */}
        <TiltShift2
          blur={1.0}
          taper={0.6}
          start={[0.5, 0.28]}
          end={[0.5, 0.72]}
          samples={8}
        />

        <Vignette offset={0.4} darkness={0.5} />
      </EffectComposer>
    </>
  );
}

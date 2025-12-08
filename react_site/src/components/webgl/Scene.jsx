import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import { useScrollSync } from '../../hooks/useScrollSync';
import { EffectComposer, Bloom, Vignette, TiltShift2 } from '@react-three/postprocessing';
import * as THREE from 'three';
import { RoomPortals } from './RoomPortals';
import { SpeedLines } from './SpeedLines';
import { Buildings } from './Buildings';
import { Trees } from './Trees';
import { HotAirBalloons } from './HotAirBalloons';

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
            color="#007AFF"
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

      // Blue spectrum colors (cyan to deep blue) - slightly more white/misty
      const t = Math.random();
      col[i3] = 0.4 + t * 0.3;                    // R - more white
      col[i3 + 1] = 0.6 + t * 0.3;                // G - more white
      col[i3 + 2] = 0.85 + t * 0.15;              // B

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
 * Ambient glow spheres - subtle light sources along the journey
 */
function AmbientGlows({ cameraZ = 0 }) {
  const glowPositions = useMemo(() => [
    { pos: [8, 5, 15], color: '#007AFF', intensity: 0.8 },
    { pos: [-10, -3, 35], color: '#00D4FF', intensity: 0.6 },
    { pos: [5, 8, 55], color: '#007AFF', intensity: 0.7 },
    { pos: [-8, -6, 75], color: '#00D4FF', intensity: 0.5 },
    { pos: [12, 4, 95], color: '#007AFF', intensity: 0.6 },
    { pos: [-6, 5, 115], color: '#00D4FF', intensity: 0.5 },
  ], []);

  return (
    <group>
      {glowPositions.map((glow, i) => (
        <pointLight
          key={i}
          position={glow.pos}
          color={glow.color}
          intensity={glow.intensity}
          distance={25}
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
      {/* Exponential fog for depth atmosphere - increased for atmospheric obscuring */}
      <fogExp2 attach="fog" color="#d8e8f8" density={0.012} />

      {/* Ambient lighting */}
      <ambientLight intensity={0.5} color="#e8f0ff" />

      {/* Key light - follows camera roughly */}
      <directionalLight
        position={[10, 10, cameraZ + 20]}
        intensity={0.7}
        color="#FFFFFF"
      />

      {/* Additional light for buildings */}
      <pointLight position={[0, 5, cameraZ + 15]} intensity={0.8} distance={25} />

      {/* Volumetric grid planes */}
      <VolumetricGrid cameraZ={cameraZ} />

      {/* Particle field */}
      <FloatingParticles cameraZ={cameraZ} />

      {/* Ambient glow lights */}
      <AmbientGlows cameraZ={cameraZ} />

      {/* Glass portal frames at section transitions */}
      <RoomPortals />

      {/* Low-poly buildings along the scroll journey */}
      <Buildings cameraZ={cameraZ} />

      {/* Low-poly trees scattered across journey */}
      <Trees cameraZ={cameraZ} />

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

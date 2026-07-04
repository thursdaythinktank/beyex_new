import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import * as THREE from 'three';
import { scrollStore } from '../../hooks/scrollStore';

/**
 * Speed Lines - Velocity-reactive lines radiating from center
 * Creates "warp speed" effect when scrolling fast
 * Lines stretch and brighten based on scroll velocity,
 * read from the transient scroll store inside the frame loop.
 */
export function SpeedLines() {
  const groupRef = useRef();
  const linesRef = useRef();
  const lineCount = 150;

  // Create line geometry - radial pattern from center
  const { positions, directions, speeds } = useMemo(() => {
    const pos = new Float32Array(lineCount * 6); // 2 points per line * 3 coords
    const dir = new Float32Array(lineCount * 3);
    const spd = new Float32Array(lineCount);

    for (let i = 0; i < lineCount; i++) {
      // Random angle around center
      const angle = Math.random() * Math.PI * 2;
      const elevation = (Math.random() - 0.5) * Math.PI * 0.6; // Vertical spread

      // Direction vector
      const dx = Math.cos(angle) * Math.cos(elevation);
      const dy = Math.sin(elevation);
      const dz = Math.sin(angle) * Math.cos(elevation);

      dir[i * 3] = dx;
      dir[i * 3 + 1] = dy;
      dir[i * 3 + 2] = dz;

      // Random distance from center
      const minDist = 3;
      const maxDist = 15;
      const dist = minDist + Math.random() * (maxDist - minDist);

      // Line start (closer to center)
      const startDist = dist;
      pos[i * 6] = dx * startDist;
      pos[i * 6 + 1] = dy * startDist;
      pos[i * 6 + 2] = dz * startDist;

      // Line end (further from center)
      const lineLength = 0.5 + Math.random() * 1.5;
      const endDist = startDist + lineLength;
      pos[i * 6 + 3] = dx * endDist;
      pos[i * 6 + 4] = dy * endDist;
      pos[i * 6 + 5] = dz * endDist;

      // Random speed multiplier
      spd[i] = 0.5 + Math.random() * 1.5;
    }

    return { positions: pos, directions: dir, speeds: spd };
  }, []);

  // Animate lines based on velocity
  useFrame((state, delta) => {
    if (!linesRef.current || !groupRef.current) return;

    const posArray = linesRef.current.geometry.attributes.position.array;
    const absVelocity = Math.abs(scrollStore.velocity);

    // Opacity scales with velocity
    const targetOpacity = Math.min(absVelocity * 2, 0.6);
    linesRef.current.material.opacity += (targetOpacity - linesRef.current.material.opacity) * 0.1;

    // Move lines outward when scrolling
    if (absVelocity > 0.01) {
      for (let i = 0; i < lineCount; i++) {
        const speed = speeds[i] * absVelocity * 20;

        // Move both points outward
        posArray[i * 6] += directions[i * 3] * speed * delta;
        posArray[i * 6 + 1] += directions[i * 3 + 1] * speed * delta;
        posArray[i * 6 + 2] += directions[i * 3 + 2] * speed * delta;

        posArray[i * 6 + 3] += directions[i * 3] * speed * delta;
        posArray[i * 6 + 4] += directions[i * 3 + 1] * speed * delta;
        posArray[i * 6 + 5] += directions[i * 3 + 2] * speed * delta;

        // Reset if too far
        const dist = Math.sqrt(
          posArray[i * 6] ** 2 +
          posArray[i * 6 + 1] ** 2 +
          posArray[i * 6 + 2] ** 2
        );

        if (dist > 25) {
          const resetDist = 3 + Math.random() * 5;
          const lineLength = 0.5 + Math.random() * 1.5;

          posArray[i * 6] = directions[i * 3] * resetDist;
          posArray[i * 6 + 1] = directions[i * 3 + 1] * resetDist;
          posArray[i * 6 + 2] = directions[i * 3 + 2] * resetDist;

          posArray[i * 6 + 3] = directions[i * 3] * (resetDist + lineLength);
          posArray[i * 6 + 4] = directions[i * 3 + 1] * (resetDist + lineLength);
          posArray[i * 6 + 5] = directions[i * 3 + 2] * (resetDist + lineLength);
        }
      }

      linesRef.current.geometry.attributes.position.needsUpdate = true;
    }

    // Subtle rotation
    groupRef.current.rotation.z = state.clock.elapsedTime * 0.01;
  });

  return (
    <group ref={groupRef}>
      <lineSegments ref={linesRef}>
        <bufferGeometry>
          <bufferAttribute
            attach="attributes-position"
            array={positions}
            count={lineCount * 2}
            itemSize={3}
          />
        </bufferGeometry>
        <lineBasicMaterial
          color="#007AFF"
          transparent
          opacity={0}
          blending={THREE.AdditiveBlending}
          linewidth={1}
        />
      </lineSegments>
    </group>
  );
}

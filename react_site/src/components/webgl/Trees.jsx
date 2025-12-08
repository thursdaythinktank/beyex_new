import { useMemo } from 'react';
import * as THREE from 'three';

/**
 * Low-poly stylized trees scattered across the scroll journey
 * Creates depth and environmental richness
 * SOLID colors - not transparent
 */
export function Trees({ cameraZ = 0 }) {
  const treePositions = useMemo(() => [
    // Near start - visible during intro
    { pos: [-12, -3, 8], scale: 0.9 },
    { pos: [14, -3, 12], scale: 1.1 },
    { pos: [-9, -3, 18], scale: 0.8 },
    { pos: [11, -3, 25], scale: 1.0 },

    // Mid-journey
    { pos: [-14, -3, 38], scale: 0.85 },
    { pos: [12, -3, 45], scale: 1.2 },
    { pos: [-10, -3, 52], scale: 0.95 },
    { pos: [15, -3, 62], scale: 1.0 },

    // Far section
    { pos: [-13, -3, 75], scale: 1.1 },
    { pos: [10, -3, 85], scale: 0.9 },
    { pos: [-11, -3, 98], scale: 1.05 },
    { pos: [13, -3, 108], scale: 0.85 },
  ], []);

  return (
    <group>
      {treePositions.map((tree, i) => (
        <Tree key={i} position={tree.pos} scale={tree.scale} index={i} />
      ))}
    </group>
  );
}

/**
 * Single low-poly tree with stacked cone foliage
 * SOLID materials
 */
function Tree({ position, scale = 1, index }) {
  const trunkColor = '#007AFF';
  const foliageColor = '#00D4FF';

  return (
    <group position={position} scale={scale}>
      {/* Trunk */}
      <mesh position={[0, 0.6, 0]}>
        <cylinderGeometry args={[0.08, 0.12, 1.2, 6]} />
        <meshStandardMaterial color={trunkColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Foliage - stacked cones for low-poly aesthetic */}
      <mesh position={[0, 1.5, 0]}>
        <coneGeometry args={[0.7, 1.2, 6]} />
        <meshStandardMaterial color={foliageColor} metalness={0.3} roughness={0.7} />
      </mesh>

      <mesh position={[0, 2.1, 0]}>
        <coneGeometry args={[0.5, 0.9, 6]} />
        <meshStandardMaterial color={foliageColor} metalness={0.3} roughness={0.7} />
      </mesh>

      <mesh position={[0, 2.6, 0]}>
        <coneGeometry args={[0.3, 0.7, 6]} />
        <meshStandardMaterial color={foliageColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Wireframe outlines for stylized look */}
      <lineSegments position={[0, 1.5, 0]}>
        <edgesGeometry args={[new THREE.ConeGeometry(0.7, 1.2, 6)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

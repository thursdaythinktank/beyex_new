import { useRef, useMemo } from 'react';
import * as THREE from 'three';

/**
 * Hot Air Balloons - Floating in the sky on the right side
 * Visible during hero section for whimsical atmosphere
 */
export function HotAirBalloons() {
  // Camera starts at (5, 55, 0) looking at (-15, 0, 110) — steeply downward.
  // "Left" in screen space ≈ +X world direction.
  // "Bottom" in screen space ≈ -Y (below the look line).
  //
  // Balloons positioned at BOTTOM-LEFT of the starting view:
  // - High enough X to appear on left side of screen
  // - Low enough Y to appear near bottom edge (just tops peeking in)
  const balloons = useMemo(() => [
    { position: [20, 15, 15], scale: 1.0, color: '#7AB8E8' },   // Sky blue - bottom-left, just top visible
    { position: [17, 20, 12], scale: 0.8, color: '#6BA3E0' },   // Lighter blue - slightly higher, both peek in
  ], []);

  return (
    <group>
      {balloons.map((balloon, i) => (
        <HotAirBalloon
          key={i}
          position={balloon.position}
          scale={balloon.scale}
          color={balloon.color}
          speed={balloon.speed}
          index={i}
        />
      ))}
    </group>
  );
}

function HotAirBalloon({ position, scale = 1, color = '#007AFF', index }) {
  const groupRef = useRef();

  // Static position - no animation

  return (
    <group ref={groupRef} position={position} scale={scale}>
      {/* Balloon envelope (main balloon part) - large sphere */}
      <mesh position={[0, 3, 0]}>
        <sphereGeometry args={[2.5, 16, 12]} />
        <meshLambertMaterial
          color={color}
          emissive={color}
          emissiveIntensity={0.2}
          transparent
          opacity={0.85}
        />
      </mesh>

      {/* Balloon bottom taper - cone that overlaps into sphere for realistic shape */}
      <mesh position={[0, 0.8, 0]} rotation={[Math.PI, 0, 0]}>
        <coneGeometry args={[1.2, 2, 12]} />
        <meshLambertMaterial
          color={color}
          emissive={color}
          emissiveIntensity={0.15}
          transparent
          opacity={0.8}
        />
      </mesh>

      {/* Decorative stripes on balloon */}
      <mesh position={[0, 3, 0]} rotation={[0, Math.PI / 4, 0]}>
        <torusGeometry args={[2.2, 0.08, 4, 12]} />
        <meshLambertMaterial
          color="#FFFFFF"
          transparent
          opacity={0.5}
        />
      </mesh>
      <mesh position={[0, 3.8, 0]} rotation={[0, 0, 0]}>
        <torusGeometry args={[1.8, 0.06, 4, 12]} />
        <meshLambertMaterial
          color="#FFFFFF"
          transparent
          opacity={0.4}
        />
      </mesh>

      {/* Basket ropes - adjusted for new proportions */}
      {[[-0.3, 0, -0.3], [0.3, 0, -0.3], [-0.3, 0, 0.3], [0.3, 0, 0.3]].map((offset, i) => (
        <mesh key={i} position={[offset[0], -0.8, offset[2]]}>
          <cylinderGeometry args={[0.03, 0.03, 1.4, 4]} />
          <meshLambertMaterial
            color={color}
            transparent
            opacity={0.6}
          />
        </mesh>
      ))}

      {/* Basket */}
      <mesh position={[0, -1.6, 0]}>
        <boxGeometry args={[0.5, 0.3, 0.5]} />
        <meshLambertMaterial
          color={color}
          transparent
          opacity={0.55}
        />
      </mesh>

      {/* Basket rim */}
      <mesh position={[0, -1.42, 0]}>
        <boxGeometry args={[0.55, 0.08, 0.55]} />
        <meshLambertMaterial
          color="#FFFFFF"
          transparent
          opacity={0.4}
        />
      </mesh>

      {/* Wireframe outline for stylized look */}
      <lineSegments position={[0, 3, 0]}>
        <edgesGeometry args={[new THREE.SphereGeometry(2.5, 12, 10)]} />
        <lineBasicMaterial color={color} transparent opacity={0.4} />
      </lineSegments>
    </group>
  );
}

import { useRef, useMemo } from 'react';
import * as THREE from 'three';

/**
 * Hot Air Balloons - Floating in the sky on the right side
 * Visible during hero section for whimsical atmosphere
 */
export function HotAirBalloons() {
  // Camera: (20, 45, -20) looks at Eye (-25, 28.5, 110)
  // View direction: (-45, -16.5, 130) - pointing LEFT and FORWARD
  //
  // To appear on RIGHT side of screen, balloons must be:
  // - In the camera's view frustum (along the view direction)
  // - Offset RIGHT of the camera-to-Eye line
  //
  // At Z=40, the camera-to-Eye line passes through approximately:
  //   X = 20 + ((-25-20) * (40-(-20)) / (110-(-20))) = 20 + (-45 * 60/130) ≈ 20 - 20.8 ≈ -1
  // So at Z=40, center of view is around X=-1
  // RIGHT side = higher X values, so X=10 to X=20 should be visible on right
  //
  // Balloons positioned to be visible in frustum, on the right side
  const balloons = useMemo(() => [
    { position: [22, 36, 40], scale: 1.0, color: '#7AB8E8' },   // Sky blue - right side, smaller
    { position: [25, 40, 35], scale: 0.8, color: '#6BA3E0' },   // Lighter blue - right side, smaller
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
        <meshStandardMaterial
          color={color}
          emissive={color}
          emissiveIntensity={0.2}
          transparent
          opacity={0.85}
          metalness={0.2}
          roughness={0.5}
        />
      </mesh>

      {/* Balloon bottom taper - cone that overlaps into sphere for realistic shape */}
      <mesh position={[0, 0.8, 0]} rotation={[Math.PI, 0, 0]}>
        <coneGeometry args={[1.2, 2, 12]} />
        <meshStandardMaterial
          color={color}
          emissive={color}
          emissiveIntensity={0.15}
          transparent
          opacity={0.8}
          metalness={0.2}
          roughness={0.5}
        />
      </mesh>

      {/* Decorative stripes on balloon */}
      <mesh position={[0, 3, 0]} rotation={[0, Math.PI / 4, 0]}>
        <torusGeometry args={[2.2, 0.08, 4, 12]} />
        <meshStandardMaterial
          color="#FFFFFF"
          transparent
          opacity={0.5}
        />
      </mesh>
      <mesh position={[0, 3.8, 0]} rotation={[0, 0, 0]}>
        <torusGeometry args={[1.8, 0.06, 4, 12]} />
        <meshStandardMaterial
          color="#FFFFFF"
          transparent
          opacity={0.4}
        />
      </mesh>

      {/* Basket ropes - adjusted for new proportions */}
      {[[-0.3, 0, -0.3], [0.3, 0, -0.3], [-0.3, 0, 0.3], [0.3, 0, 0.3]].map((offset, i) => (
        <mesh key={i} position={[offset[0], -0.8, offset[2]]}>
          <cylinderGeometry args={[0.03, 0.03, 1.4, 4]} />
          <meshStandardMaterial
            color={color}
            transparent
            opacity={0.6}
          />
        </mesh>
      ))}

      {/* Basket */}
      <mesh position={[0, -1.6, 0]}>
        <boxGeometry args={[0.5, 0.3, 0.5]} />
        <meshStandardMaterial
          color={color}
          transparent
          opacity={0.55}
          metalness={0.5}
          roughness={0.3}
        />
      </mesh>

      {/* Basket rim */}
      <mesh position={[0, -1.42, 0]}>
        <boxGeometry args={[0.55, 0.08, 0.55]} />
        <meshStandardMaterial
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

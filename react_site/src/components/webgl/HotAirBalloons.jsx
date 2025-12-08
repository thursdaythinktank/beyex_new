import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import * as THREE from 'three';

/**
 * Hot Air Balloons - Floating in the sky on the right side
 * Visible during hero section for whimsical atmosphere
 */
export function HotAirBalloons() {
  // Negative X = right side of screen (camera faces +Z with slight sway)
  const balloons = useMemo(() => [
    { position: [-25, 20, 15], scale: 1.6, color: '#007AFF', speed: 0.3 },
    { position: [-35, 25, 30], scale: 1.3, color: '#00D4FF', speed: 0.4 },
    { position: [-30, 18, 45], scale: 1.4, color: '#007AFF', speed: 0.35 },
    { position: [-40, 22, 60], scale: 1.1, color: '#64D2FF', speed: 0.45 },
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

function HotAirBalloon({ position, scale = 1, color = '#007AFF', speed = 0.3, index }) {
  const groupRef = useRef();

  // Gentle floating animation
  useFrame((state) => {
    if (groupRef.current) {
      const time = state.clock.elapsedTime;
      // Gentle bobbing motion - larger amplitude for bigger balloons
      groupRef.current.position.y = position[1] + Math.sin(time * speed + index * 2) * 0.8;
      // Subtle sway - move left/right gently
      groupRef.current.position.x = position[0] + Math.sin(time * speed * 0.5 + index) * 0.5;
      // Very gentle rotation
      groupRef.current.rotation.y = Math.sin(time * 0.1 + index) * 0.15;
    }
  });

  return (
    <group ref={groupRef} position={position} scale={scale}>
      {/* Balloon envelope (main balloon part) - large sphere */}
      <mesh position={[0, 3, 0]}>
        <sphereGeometry args={[2.5, 12, 10]} />
        <meshStandardMaterial
          color={color}
          transparent
          opacity={0.7}
          metalness={0.3}
          roughness={0.4}
        />
      </mesh>

      {/* Balloon bottom taper - cone that overlaps into sphere for realistic shape */}
      <mesh position={[0, 0.8, 0]} rotation={[Math.PI, 0, 0]}>
        <coneGeometry args={[1.2, 2, 12]} />
        <meshStandardMaterial
          color={color}
          transparent
          opacity={0.65}
          metalness={0.3}
          roughness={0.4}
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

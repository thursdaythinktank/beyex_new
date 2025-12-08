import { useRef } from 'react';
import { useFrame } from '@react-three/fiber';
import * as THREE from 'three';

/**
 * Frosted glass panel with subtle animation
 * Creates Apple-style translucent material effect in 3D space
 */
export function GlassPanel({
  position = [0, 0, 0],
  rotation = [0, 0, 0],
  size = [4, 6],
  opacity = 0.15,
  color = '#ffffff'
}) {
  const meshRef = useRef();
  const materialRef = useRef();

  useFrame((state) => {
    if (meshRef.current) {
      // Subtle floating animation
      meshRef.current.position.y += Math.sin(state.clock.elapsedTime * 0.5 + position[2] * 0.1) * 0.001;
    }
    if (materialRef.current) {
      // Subtle opacity pulse
      materialRef.current.opacity = opacity + Math.sin(state.clock.elapsedTime * 0.3) * 0.02;
    }
  });

  return (
    <mesh ref={meshRef} position={position} rotation={rotation}>
      <planeGeometry args={[size[0], size[1]]} />
      <meshStandardMaterial
        ref={materialRef}
        color={color}
        transparent
        opacity={opacity}
        side={THREE.DoubleSide}
        roughness={0.1}
        metalness={0.1}
        envMapIntensity={0.5}
      />
    </mesh>
  );
}

/**
 * Glass frame - creates a portal-like doorway effect
 * Four panels forming a rectangular opening
 */
export function GlassFrame({
  position = [0, 0, 0],
  frameWidth = 12,
  frameHeight = 8,
  thickness = 0.8,
  opacity = 0.12
}) {
  const groupRef = useRef();

  useFrame((state) => {
    if (groupRef.current) {
      // Subtle rotation based on time
      groupRef.current.rotation.y = Math.sin(state.clock.elapsedTime * 0.1) * 0.02;
    }
  });

  const panelColor = '#e0f0ff';
  const borderColor = '#007AFF';

  return (
    <group ref={groupRef} position={position}>
      {/* Left panel */}
      <GlassPanel
        position={[-frameWidth / 2 - thickness / 2, 0, 0]}
        size={[thickness, frameHeight + thickness * 2]}
        opacity={opacity}
        color={panelColor}
      />

      {/* Right panel */}
      <GlassPanel
        position={[frameWidth / 2 + thickness / 2, 0, 0]}
        size={[thickness, frameHeight + thickness * 2]}
        opacity={opacity}
        color={panelColor}
      />

      {/* Top panel */}
      <GlassPanel
        position={[0, frameHeight / 2 + thickness / 2, 0]}
        size={[frameWidth, thickness]}
        opacity={opacity}
        color={panelColor}
      />

      {/* Bottom panel */}
      <GlassPanel
        position={[0, -frameHeight / 2 - thickness / 2, 0]}
        size={[frameWidth, thickness]}
        opacity={opacity}
        color={panelColor}
      />

      {/* Inner glow edges */}
      <lineSegments>
        <edgesGeometry args={[new THREE.BoxGeometry(frameWidth, frameHeight, 0.01)]} />
        <lineBasicMaterial color={borderColor} transparent opacity={0.3} />
      </lineSegments>
    </group>
  );
}

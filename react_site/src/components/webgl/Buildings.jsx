import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import * as THREE from 'three';

/**
 * Minimalist wireframe London scene
 * Blue/gray color palette, low-poly aesthetic
 * Camera approaches from northeast, London Eye in right third of frame
 */

// Color palette - Rich blue palette with variety and depth
const COLORS = {
  // Primary structures
  primary: '#4A90D9',        // Blue for main structures (London Eye frame)
  secondary: '#7EB8E5',      // Lighter blue for secondary elements
  accent: '#A5D4F7',         // Light cyan-blue for glass/highlights

  // River - much lighter, soft blue
  water: '#9DD4F5',          // Very light river blue
  waterDeep: '#7EC8F0',      // Slightly deeper accent

  // Buildings - varied palette
  building: '#5A8BC4',       // Standard blue-tinted buildings
  buildingAlt: '#4A7BB8',    // Darker blue buildings
  buildingLight: '#7BA8D4',  // Lighter buildings for variety
  buildingWarm: '#6B9BC8',   // Slightly warmer blue tone

  // Glass and windows - transparent elements
  glass: '#B8E0F7',          // Light blue glass
  glassEmissive: '#C5E8FA',  // Emissive glass glow

  // Clock face - distinctive lighter blue
  clockFace: '#E8F4FC',      // Very light blue for clock face
  clockDetail: '#A5D4F7',    // Clock details/hands

  // Wireframes
  wireframe: '#FFFFFF',      // White wireframes
  wireframeLight: '#E0F0FA', // Subtle blue-white wireframe
};

export function Buildings({ cameraZ = 0 }) {
  return (
    <group>
      {/* Hot air balloons are now rendered from HotAirBalloons.jsx in Scene.jsx */}

      {/* River Thames - runs across the scene at Z=75 */}
      <RiverThames />

      {/* Thames boat on the river */}
      <ThamesBoat position={[5, 0.3, 72]} rotation={[0, 0.3, 0]} />

      {/* London Eye - far background at Z=110, scaled 1.5x for prominence */}
      <LondonEye position={[-15, 0, 110]} scale={1.5} />

      {/* Tower Bridge - crosses the river perpendicularly */}
      <TowerBridge position={[20, 0, 75]} rotation={[0, Math.PI / 2 + Math.PI / 12 + Math.PI / 4 - Math.PI / 18, 0]} scale={0.8} />

      {/* Palace of Westminster + Big Ben - closer to camera, rotated 180° to show clock */}
      <PalaceOfWestminster position={[-50, 0, 55]} rotation={[0, Math.PI, 0]} />

      {/* Building clusters - NORTH of river (Z < 70) - city we fly over */}
      {/* Camera path: Z=-5 to Z=70, so these are all visible */}
      <BuildingCluster position={[5, 0, 5]} rotation={[0, 0.2, 0]} />
      <BuildingCluster position={[-15, 0, 15]} rotation={[0, -0.3, 0]} />
      <BuildingCluster position={[12, 0, 25]} rotation={[0, 0.4, 0]} />
      <BuildingCluster position={[-8, 0, 35]} rotation={[0, -0.1, 0]} />

      {/* Westminster Abbey - on north bank, back against river */}
      {/* River at Z=75, aligned with London Eye center at X=-25, rotated to show front (west facade) */}
      <WestminsterAbbey position={[-25, 0, 72]} rotation={[0, -Math.PI / 4, 0]} scale={0.6} />

      {/* REMOVED: County Hall (Z=120) and South building clusters (Z=95-105) */}
      {/* These were behind the London Eye and not visible from camera path */}
    </group>
  );
}

/**
 * River Thames - wide gently curved plane
 */
function RiverThames() {
  const riverRef = useRef();

  // Create a curved river shape
  const riverGeometry = useMemo(() => {
    const shape = new THREE.Shape();
    // River runs diagonally across scene from SW to NE
    shape.moveTo(-80, -15);
    shape.quadraticCurveTo(-40, -12, 0, -8);
    shape.quadraticCurveTo(40, -4, 80, 0);
    shape.lineTo(80, 8);
    shape.quadraticCurveTo(40, 4, 0, 0);
    shape.quadraticCurveTo(-40, -4, -80, -7);
    shape.lineTo(-80, -15);

    return new THREE.ShapeGeometry(shape);
  }, []);

  return (
    <group position={[0, -0.5, 75]} rotation={[-Math.PI / 2, 0, 0.15]}>
      {/* River surface - very light blue, bright and visible */}
      <mesh geometry={riverGeometry}>
        <meshStandardMaterial
          color={COLORS.water}
          emissive={COLORS.water}
          emissiveIntensity={0.15}
          metalness={0.2}
          roughness={0.4}
          transparent
          opacity={0.9}
          side={THREE.DoubleSide}
        />
      </mesh>

      {/* River edge wireframe - light blue tint */}
      <lineSegments>
        <edgesGeometry args={[riverGeometry]} />
        <lineBasicMaterial color={COLORS.wireframeLight} opacity={0.7} transparent />
      </lineSegments>
    </group>
  );
}

/* HotAirBalloon component moved to HotAirBalloons.jsx */

/**
 * Thames River Boat - Low-poly wireframe aesthetic
 * Gentle bobbing animation on the water
 */
function ThamesBoat({ position = [5, 0.3, 72], rotation = [0, 0.3, 0] }) {
  const boatRef = useRef();

  // Gentle bobbing animation
  useFrame((state) => {
    if (boatRef.current) {
      const time = state.clock.elapsedTime;
      // Subtle vertical bob
      boatRef.current.position.y = position[1] + Math.sin(time * 0.8) * 0.08;
      // Slight rotation for wave effect
      boatRef.current.rotation.z = Math.sin(time * 0.6) * 0.02;
      boatRef.current.rotation.x = Math.cos(time * 0.5) * 0.01;
    }
  });

  return (
    <group ref={boatRef} position={position} rotation={rotation}>
      {/* Hull - main body */}
      <mesh position={[0, 0, 0]}>
        <boxGeometry args={[3.5, 0.8, 1.4]} />
        <meshStandardMaterial color={COLORS.building} metalness={0.4} roughness={0.6} />
      </mesh>
      <lineSegments position={[0, 0, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(3.5, 0.8, 1.4)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Bow (front) - pointed section */}
      <mesh position={[2.1, 0, 0]} rotation={[0, 0, Math.PI / 4]}>
        <boxGeometry args={[0.8, 0.8, 1.2]} />
        <meshStandardMaterial color={COLORS.building} metalness={0.4} roughness={0.6} />
      </mesh>
      <lineSegments position={[2.1, 0, 0]} rotation={[0, 0, Math.PI / 4]}>
        <edgesGeometry args={[new THREE.BoxGeometry(0.8, 0.8, 1.2)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Stern (back) */}
      <mesh position={[-1.9, 0.1, 0]}>
        <boxGeometry args={[0.4, 0.6, 1.3]} />
        <meshStandardMaterial color={COLORS.buildingAlt} metalness={0.4} roughness={0.6} />
      </mesh>
      <lineSegments position={[-1.9, 0.1, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(0.4, 0.6, 1.3)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Cabin */}
      <group position={[-0.3, 0.7, 0]}>
        <mesh>
          <boxGeometry args={[1.8, 0.9, 1.0]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments>
          <edgesGeometry args={[new THREE.BoxGeometry(1.8, 0.9, 1.0)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Cabin windows - transparent glass */}
        <mesh position={[0, 0, 0.51]}>
          <planeGeometry args={[1.2, 0.4]} />
          <meshStandardMaterial
            color={COLORS.glass}
            emissive={COLORS.glassEmissive}
            emissiveIntensity={0.4}
            transparent
            opacity={0.7}
          />
        </mesh>
        <mesh position={[0, 0, -0.51]} rotation={[0, Math.PI, 0]}>
          <planeGeometry args={[1.2, 0.4]} />
          <meshStandardMaterial
            color={COLORS.glass}
            emissive={COLORS.glassEmissive}
            emissiveIntensity={0.4}
            transparent
            opacity={0.7}
          />
        </mesh>
      </group>

      {/* Chimney/Funnel */}
      <group position={[-1.0, 1.0, 0]}>
        <mesh>
          <cylinderGeometry args={[0.12, 0.15, 0.5, 6]} />
          <meshStandardMaterial color={COLORS.buildingAlt} metalness={0.6} roughness={0.4} />
        </mesh>
        <lineSegments>
          <edgesGeometry args={[new THREE.CylinderGeometry(0.12, 0.15, 0.5, 6)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
      </group>
    </group>
  );
}

/**
 * London Eye - Large observation wheel with 32 capsules
 * Realistic: two parallel rims with crisscross cables, oval horizontal pods, A-frame support
 * Scale prop allows sizing the entire structure uniformly
 */
function LondonEye({ position, scale = 1 }) {
  const wheelRef = useRef();
  const capsulesRef = useRef();
  const wheelRadius = 18;  // Base radius (scaled by group scale prop)
  const capsuleCount = 32;
  const rotationSpeed = 0.012;
  const rimSpacing = 4;  // Distance between the two parallel rims

  // Slow rotation - update both wheel and capsule positions
  useFrame((state) => {
    const rotation = state.clock.elapsedTime * rotationSpeed;

    if (wheelRef.current) {
      wheelRef.current.rotation.z = rotation;
    }

    // Update capsule positions to follow wheel rotation while staying upright
    if (capsulesRef.current) {
      capsulesRef.current.children.forEach((capsule, i) => {
        const baseAngle = (i / capsuleCount) * Math.PI * 2;
        const currentAngle = baseAngle + rotation;
        const x = Math.cos(currentAngle) * wheelRadius;
        const y = Math.sin(currentAngle) * wheelRadius;
        capsule.position.set(x, y, 0);
      });
    }
  });

  return (
    <group position={position} scale={scale}>
      {/* A-frame support - legs lean INWARD toward hub (correct orientation) */}
      {/* Left leg - starts wide at bottom, angles inward to hub */}
      <mesh position={[-3, 10, 0]} rotation={[0, 0, -0.18]}>
        <boxGeometry args={[0.6, 22, 0.6]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
      </mesh>
      <lineSegments position={[-3, 10, 0]} rotation={[0, 0, -0.18]}>
        <edgesGeometry args={[new THREE.BoxGeometry(0.6, 22, 0.6)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Right leg - mirrors left, angles inward */}
      <mesh position={[3, 10, 0]} rotation={[0, 0, 0.18]}>
        <boxGeometry args={[0.6, 22, 0.6]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
      </mesh>
      <lineSegments position={[3, 10, 0]} rotation={[0, 0, 0.18]}>
        <edgesGeometry args={[new THREE.BoxGeometry(0.6, 22, 0.6)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Horizontal brace between A-frame legs */}
      <mesh position={[0, 8, 0]}>
        <boxGeometry args={[5, 0.3, 0.3]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>

      {/* Central hub - small */}
      <mesh position={[0, 19.5, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <cylinderGeometry args={[1, 1, rimSpacing + 0.5, 16]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.6} roughness={0.4} />
      </mesh>
      <lineSegments position={[0, 19.5, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <edgesGeometry args={[new THREE.CylinderGeometry(1, 1, rimSpacing + 0.5, 16)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Rotating wheel group - TWO parallel rims with crisscross cables */}
      <group ref={wheelRef} position={[0, 19.5, 0]}>
        {/* Front rim */}
        <mesh position={[0, 0, rimSpacing / 2]}>
          <torusGeometry args={[wheelRadius, 0.15, 8, 64]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments position={[0, 0, rimSpacing / 2]}>
          <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius, 0.15, 8, 64)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Back rim */}
        <mesh position={[0, 0, -rimSpacing / 2]}>
          <torusGeometry args={[wheelRadius, 0.15, 8, 64]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments position={[0, 0, -rimSpacing / 2]}>
          <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius, 0.15, 8, 64)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Middle rim - between outer rim and hub */}
        <mesh position={[0, 0, rimSpacing / 2]}>
          <torusGeometry args={[wheelRadius * 0.8, 0.12, 8, 64]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments position={[0, 0, rimSpacing / 2]}>
          <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius * 0.8, 0.12, 8, 64)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
        <mesh position={[0, 0, -rimSpacing / 2]}>
          <torusGeometry args={[wheelRadius * 0.8, 0.12, 8, 64]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments position={[0, 0, -rimSpacing / 2]}>
          <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius * 0.8, 0.12, 8, 64)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Zig-zag cross lines between outer rim and middle rim - diamond mesh pattern */}
        {Array.from({ length: 64 }).map((_, i) => {
          const angle1 = (i / 64) * Math.PI * 2;
          const angle2 = ((i + 1) / 64) * Math.PI * 2;
          const angle0 = ((i - 1 + 64) / 64) * Math.PI * 2; // Previous angle

          // Points on outer and middle rims
          const outerX1 = Math.cos(angle1) * wheelRadius;
          const outerY1 = Math.sin(angle1) * wheelRadius;
          const middleX1 = Math.cos(angle1) * (wheelRadius * 0.8);
          const middleY1 = Math.sin(angle1) * (wheelRadius * 0.8);
          const outerX2 = Math.cos(angle2) * wheelRadius;
          const outerY2 = Math.sin(angle2) * wheelRadius;
          const middleX0 = Math.cos(angle0) * (wheelRadius * 0.8);
          const middleY0 = Math.sin(angle0) * (wheelRadius * 0.8);

          // Line from middle[i] to outer[i+1] (diagonal forward)
          const mid2X = (middleX1 + outerX2) / 2;
          const mid2Y = (middleY1 + outerY2) / 2;
          const len2 = Math.sqrt((outerX2 - middleX1) ** 2 + (outerY2 - middleY1) ** 2);
          const rot2 = Math.atan2(outerY2 - middleY1, outerX2 - middleX1);

          // Line from outer[i] to middle[i-1] (diagonal backward) - complementary pattern
          const mid3X = (outerX1 + middleX0) / 2;
          const mid3Y = (outerY1 + middleY0) / 2;
          const len3 = Math.sqrt((outerX1 - middleX0) ** 2 + (outerY1 - middleY0) ** 2);
          const rot3 = Math.atan2(outerY1 - middleY0, outerX1 - middleX0);

          return (
            <group key={`zigzag-${i}`}>
              {/* Line from middle to next outer (diagonal forward) */}
              <mesh position={[mid2X, mid2Y, 0]} rotation={[0, 0, rot2]}>
                <boxGeometry args={[len2, 0.05, 0.05]} />
                <meshStandardMaterial color={COLORS.secondary} />
              </mesh>
              {/* Line from outer to previous middle (diagonal backward) - creates X pattern */}
              <mesh position={[mid3X, mid3Y, 0]} rotation={[0, 0, rot3]}>
                <boxGeometry args={[len3, 0.05, 0.05]} />
                <meshStandardMaterial color={COLORS.secondary} />
              </mesh>
            </group>
          );
        })}

        {/* Straight scaffolding bars connecting front and back rims at outer edge */}
        {Array.from({ length: 64 }).map((_, i) => {
          const angle = (i / 64) * Math.PI * 2;
          const x = Math.cos(angle) * wheelRadius;
          const y = Math.sin(angle) * wheelRadius;

          return (
            <mesh
              key={`bar-${i}`}
              position={[x, y, 0]}
              rotation={[Math.PI / 2, 0, 0]}
            >
              <cylinderGeometry args={[0.06, 0.06, rimSpacing, 6]} />
              <meshStandardMaterial color={COLORS.secondary} />
            </mesh>
          );
        })}

        {/* Scaffolding bars connecting front and back middle rims */}
        {Array.from({ length: 32 }).map((_, i) => {
          const angle = (i / 32) * Math.PI * 2;
          const x = Math.cos(angle) * (wheelRadius * 0.8);
          const y = Math.sin(angle) * (wheelRadius * 0.8);

          return (
            <mesh
              key={`mid-bar-${i}`}
              position={[x, y, 0]}
              rotation={[Math.PI / 2, 0, 0]}
            >
              <cylinderGeometry args={[0.05, 0.05, rimSpacing, 6]} />
              <meshStandardMaterial color={COLORS.secondary} />
            </mesh>
          );
        })}

        {/* Radial spokes from hub to rims */}
        {Array.from({ length: 32 }).map((_, i) => {
          const angle = (i / 32) * Math.PI * 2;
          const x = Math.cos(angle) * (wheelRadius / 2);
          const y = Math.sin(angle) * (wheelRadius / 2);
          return (
            <group key={`spoke-${i}`}>
              {/* Front spoke */}
              <mesh position={[x, y, rimSpacing / 4]} rotation={[0, 0, angle + Math.PI / 2]}>
                <boxGeometry args={[0.05, wheelRadius - 1, 0.05]} />
                <meshStandardMaterial color={COLORS.secondary} />
              </mesh>
              {/* Back spoke */}
              <mesh position={[x, y, -rimSpacing / 4]} rotation={[0, 0, angle + Math.PI / 2]}>
                <boxGeometry args={[0.05, wheelRadius - 1, 0.05]} />
                <meshStandardMaterial color={COLORS.secondary} />
              </mesh>
            </group>
          );
        })}
      </group>

      {/* Capsules - horizontal oval pods (rotated 90°) */}
      <group ref={capsulesRef} position={[0, 19.5, 0]}>
        {Array.from({ length: capsuleCount }).map((_, i) => {
          const angle = (i / capsuleCount) * Math.PI * 2;
          const x = Math.cos(angle) * wheelRadius;
          const y = Math.sin(angle) * wheelRadius;
          return (
            <group key={`capsule-${i}`} position={[x, y, 0]}>
              {/* Horizontal oval capsule (wider than tall) */}
              <mesh scale={[1.5, 0.9, 1.1]} rotation={[0, 0, 0]}>
                <sphereGeometry args={[1.1, 16, 12]} />
                <meshStandardMaterial
                  color={COLORS.glass}
                  emissive={COLORS.glassEmissive}
                  emissiveIntensity={0.3}
                  metalness={0.1}
                  roughness={0.2}
                  transparent
                  opacity={0.85}
                />
              </mesh>
              {/* Capsule mounting bracket */}
              <mesh position={[0, 1.2, 0]}>
                <boxGeometry args={[0.2, 0.8, 0.2]} />
                <meshStandardMaterial color={COLORS.primary} />
              </mesh>
            </group>
          );
        })}
      </group>

      {/* Base platform */}
      <mesh position={[0, 0.3, 0]}>
        <boxGeometry args={[10, 0.5, 5]} />
        <meshStandardMaterial color={COLORS.buildingAlt} />
      </mesh>
      <lineSegments position={[0, 0.3, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(10, 0.5, 5)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>
    </group>
  );
}

/**
 * Tower Bridge - Iconic Victorian bridge with twin Gothic towers
 * Features: two towers, upper walkway, bascule span, suspension side spans
 */
function TowerBridge({ position, rotation = [0, -0.3, 0], scale = 1 }) {
  const towerHeight = 28;
  const towerWidth = 6;
  const towerDepth = 5;
  const towerSpacing = 18; // Distance between tower centers
  const walkwayHeight = 22;
  const deckHeight = 3;

  // Tower colors
  const towerColor = COLORS.building;       // Main tower
  const towerDark = COLORS.buildingAlt;     // Details, roofs
  const walkwayColor = COLORS.secondary;    // Upper walkway
  const deckColor = COLORS.buildingWarm;    // Bridge deck

  // Single tower component
  const Tower = ({ xPos }) => (
    <group position={[xPos, 0, 0]}>
      {/* Main tower body - lower section */}
      <mesh position={[0, towerHeight / 2, 0]}>
        <boxGeometry args={[towerWidth, towerHeight, towerDepth]} />
        <meshStandardMaterial color={towerColor} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, towerHeight / 2, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(towerWidth, towerHeight, towerDepth)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Pointed roof */}
      <mesh position={[0, towerHeight + 3, 0]}>
        <coneGeometry args={[towerWidth / 2 + 0.5, 6, 4]} />
        <meshStandardMaterial color={towerDark} />
      </mesh>
      <lineSegments position={[0, towerHeight + 3, 0]}>
        <edgesGeometry args={[new THREE.ConeGeometry(towerWidth / 2 + 0.5, 6, 4)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Corner turrets (4 corners) */}
      {[[-1, -1], [-1, 1], [1, -1], [1, 1]].map(([x, z], i) => (
        <group key={`turret-${i}`} position={[x * (towerWidth / 2 - 0.3), 0, z * (towerDepth / 2 - 0.3)]}>
          {/* Turret body */}
          <mesh position={[0, towerHeight / 2 + 2, 0]}>
            <cylinderGeometry args={[0.8, 0.8, towerHeight + 4, 8]} />
            <meshStandardMaterial color={towerColor} />
          </mesh>
          {/* Turret cap */}
          <mesh position={[0, towerHeight + 5.5, 0]}>
            <coneGeometry args={[1, 3, 8]} />
            <meshStandardMaterial color={towerDark} />
          </mesh>
        </group>
      ))}

      {/* Windows - front and back */}
      {[-1, 1].map((side, i) => (
        <group key={`windows-${i}`}>
          {/* Large arched window */}
          <mesh position={[0, walkwayHeight - 2, side * (towerDepth / 2 + 0.1)]}>
            <boxGeometry args={[3, 6, 0.3]} />
            <meshStandardMaterial color={COLORS.glass} transparent opacity={0.6} />
          </mesh>
          {/* Lower windows */}
          {[8, 14].map((y, j) => (
            <mesh key={`win-${j}`} position={[0, y, side * (towerDepth / 2 + 0.1)]}>
              <boxGeometry args={[2, 3, 0.3]} />
              <meshStandardMaterial color={COLORS.glass} transparent opacity={0.5} />
            </mesh>
          ))}
        </group>
      ))}

      {/* Horizontal band detail */}
      <mesh position={[0, walkwayHeight - 6, 0]}>
        <boxGeometry args={[towerWidth + 0.5, 1, towerDepth + 0.5]} />
        <meshStandardMaterial color={towerDark} />
      </mesh>
    </group>
  );

  return (
    <group position={position} rotation={rotation} scale={scale}>
      {/* Left Tower */}
      <Tower xPos={-towerSpacing / 2} />

      {/* Right Tower */}
      <Tower xPos={towerSpacing / 2} />

      {/* Upper Walkway - Two parallel walkways */}
      {[-1.2, 1.2].map((zOffset, i) => (
        <group key={`walkway-${i}`}>
          <mesh position={[0, walkwayHeight, zOffset]}>
            <boxGeometry args={[towerSpacing - towerWidth, 1, 2]} />
            <meshStandardMaterial color={walkwayColor} metalness={0.4} roughness={0.6} />
          </mesh>
          <lineSegments position={[0, walkwayHeight, zOffset]}>
            <edgesGeometry args={[new THREE.BoxGeometry(towerSpacing - towerWidth, 1, 2)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>

          {/* Walkway windows/railings */}
          <mesh position={[0, walkwayHeight + 1, zOffset]}>
            <boxGeometry args={[towerSpacing - towerWidth - 1, 1.5, 0.3]} />
            <meshStandardMaterial color={COLORS.glass} transparent opacity={0.4} />
          </mesh>
        </group>
      ))}

      {/* Walkway roof */}
      <mesh position={[0, walkwayHeight + 2.5, 0]}>
        <boxGeometry args={[towerSpacing - towerWidth + 1, 0.5, 5]} />
        <meshStandardMaterial color={towerDark} />
      </mesh>

      {/* Center Bascule Span (the drawbridge deck) */}
      <mesh position={[0, deckHeight, 0]}>
        <boxGeometry args={[towerSpacing - towerWidth + 2, 0.8, 5]} />
        <meshStandardMaterial color={deckColor} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, deckHeight, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(towerSpacing - towerWidth + 2, 0.8, 5)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Side Spans - Left */}
      <group position={[-towerSpacing / 2 - 10, 0, 0]}>
        {/* Deck */}
        <mesh position={[0, deckHeight, 0]}>
          <boxGeometry args={[16, 0.8, 4.5]} />
          <meshStandardMaterial color={deckColor} />
        </mesh>
        <lineSegments position={[0, deckHeight, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(16, 0.8, 4.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Suspension cables */}
        {[-5, 0, 5].map((x, i) => (
          <group key={`cable-l-${i}`}>
            <mesh position={[x, deckHeight + 5, 1.8]}>
              <cylinderGeometry args={[0.08, 0.08, 10, 6]} />
              <meshStandardMaterial color={COLORS.accent} />
            </mesh>
            <mesh position={[x, deckHeight + 5, -1.8]}>
              <cylinderGeometry args={[0.08, 0.08, 10, 6]} />
              <meshStandardMaterial color={COLORS.accent} />
            </mesh>
          </group>
        ))}

        {/* Support pier */}
        <mesh position={[-6, deckHeight / 2, 0]}>
          <boxGeometry args={[2, deckHeight + 1, 5]} />
          <meshStandardMaterial color={towerDark} />
        </mesh>
      </group>

      {/* Side Spans - Right */}
      <group position={[towerSpacing / 2 + 10, 0, 0]}>
        {/* Deck */}
        <mesh position={[0, deckHeight, 0]}>
          <boxGeometry args={[16, 0.8, 4.5]} />
          <meshStandardMaterial color={deckColor} />
        </mesh>
        <lineSegments position={[0, deckHeight, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(16, 0.8, 4.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Suspension cables */}
        {[-5, 0, 5].map((x, i) => (
          <group key={`cable-r-${i}`}>
            <mesh position={[x, deckHeight + 5, 1.8]}>
              <cylinderGeometry args={[0.08, 0.08, 10, 6]} />
              <meshStandardMaterial color={COLORS.accent} />
            </mesh>
            <mesh position={[x, deckHeight + 5, -1.8]}>
              <cylinderGeometry args={[0.08, 0.08, 10, 6]} />
              <meshStandardMaterial color={COLORS.accent} />
            </mesh>
          </group>
        ))}

        {/* Support pier */}
        <mesh position={[6, deckHeight / 2, 0]}>
          <boxGeometry args={[2, deckHeight + 1, 5]} />
          <meshStandardMaterial color={towerDark} />
        </mesh>
      </group>

      {/* Railings on deck */}
      <mesh position={[0, deckHeight + 0.8, 2.3]}>
        <boxGeometry args={[50, 0.5, 0.1]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>
      <mesh position={[0, deckHeight + 0.8, -2.3]}>
        <boxGeometry args={[50, 0.5, 0.1]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>

      {/* Car on the bridge - centered on deck */}
      <group position={[0, deckHeight + 0.9, 0.5]}>
        {/* Car body */}
        <mesh position={[0, 0, 0]}>
          <boxGeometry args={[3, 1, 1.5]} />
          <meshStandardMaterial color={COLORS.buildingAlt} metalness={0.5} roughness={0.4} />
        </mesh>
        <lineSegments position={[0, 0, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(3, 1, 1.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
        {/* Car cabin */}
        <mesh position={[0, 0.7, 0]}>
          <boxGeometry args={[1.8, 0.8, 1.3]} />
          <meshStandardMaterial color={COLORS.glass} transparent opacity={0.6} />
        </mesh>
        <lineSegments position={[0, 0.7, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(1.8, 0.8, 1.3)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
        {/* Wheels */}
        {[[-1, -0.6], [-1, 0.6], [1, -0.6], [1, 0.6]].map(([x, z], i) => (
          <mesh key={`wheel-${i}`} position={[x, -0.4, z]} rotation={[Math.PI / 2, 0, 0]}>
            <cylinderGeometry args={[0.3, 0.3, 0.2, 8]} />
            <meshStandardMaterial color={COLORS.buildingAlt} />
          </mesh>
        ))}
      </group>

      {/* Extended road - Left approach */}
      <group position={[-towerSpacing / 2 - 33, 0, 0]}>
        <mesh position={[0, deckHeight - 0.5, 0]}>
          <boxGeometry args={[35, 0.8, 4.5]} />
          <meshStandardMaterial color={deckColor} />
        </mesh>
        <lineSegments position={[0, deckHeight - 0.5, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(35, 0.8, 4.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
        {/* Road railings */}
        <mesh position={[0, deckHeight + 0.3, 2.3]}>
          <boxGeometry args={[35, 0.5, 0.1]} />
          <meshStandardMaterial color={COLORS.primary} />
        </mesh>
        <mesh position={[0, deckHeight + 0.3, -2.3]}>
          <boxGeometry args={[35, 0.5, 0.1]} />
          <meshStandardMaterial color={COLORS.primary} />
        </mesh>
      </group>

      {/* Extended road - Right approach */}
      <group position={[towerSpacing / 2 + 33, 0, 0]}>
        <mesh position={[0, deckHeight - 0.5, 0]}>
          <boxGeometry args={[35, 0.8, 4.5]} />
          <meshStandardMaterial color={deckColor} />
        </mesh>
        <lineSegments position={[0, deckHeight - 0.5, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(35, 0.8, 4.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
        {/* Road railings */}
        <mesh position={[0, deckHeight + 0.3, 2.3]}>
          <boxGeometry args={[35, 0.5, 0.1]} />
          <meshStandardMaterial color={COLORS.primary} />
        </mesh>
        <mesh position={[0, deckHeight + 0.3, -2.3]}>
          <boxGeometry args={[35, 0.5, 0.1]} />
          <meshStandardMaterial color={COLORS.primary} />
        </mesh>
      </group>
    </group>
  );
}

/**
 * Palace of Westminster + Big Ben
 * Long horizontal Gothic building with jagged roofline + clock tower
 */
function PalaceOfWestminster({ position, rotation = [0, 0, 0], scale = 1 }) {
  return (
    <group position={position} rotation={rotation} scale={scale}>
      {/* Main Palace building - long horizontal block */}
      <mesh position={[0, 4, 0]}>
        <boxGeometry args={[35, 8, 10]} />
        <meshStandardMaterial color={COLORS.building} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, 4, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(35, 8, 10)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Jagged Gothic roofline - series of peaks */}
      {Array.from({ length: 12 }).map((_, i) => {
        const xPos = (i - 5.5) * 2.8;
        const height = 2 + Math.random() * 1.5;
        return (
          <group key={`peak-${i}`} position={[xPos, 8, 0]}>
            <mesh>
              <coneGeometry args={[1.2, height, 4]} />
              <meshStandardMaterial color={COLORS.buildingAlt} />
            </mesh>
            <lineSegments>
              <edgesGeometry args={[new THREE.ConeGeometry(1.2, height, 4)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>
          </group>
        );
      })}

      {/* Big Ben - Clock Tower */}
      <group position={[-20, 0, 0]}>
        {/* Tower base */}
        <mesh position={[0, 10, 0]}>
          <boxGeometry args={[4, 20, 4]} />
          <meshStandardMaterial color={COLORS.building} metalness={0.4} roughness={0.6} />
        </mesh>
        <lineSegments position={[0, 10, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(4, 20, 4)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Clock face section */}
        <mesh position={[0, 18, 0]}>
          <boxGeometry args={[4.5, 4, 4.5]} />
          <meshStandardMaterial color={COLORS.secondary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments position={[0, 18, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(4.5, 4, 4.5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Clock faces - 4 sides with lighter blue */}
        {[0, Math.PI/2, Math.PI, -Math.PI/2].map((rot, i) => (
          <group key={`clock-${i}`} position={[
            Math.sin(rot) * 2.3,
            18,
            Math.cos(rot) * 2.3
          ]} rotation={[0, rot, 0]}>
            {/* Clock face - very light blue */}
            <mesh>
              <circleGeometry args={[1.5, 24]} />
              <meshStandardMaterial
                color={COLORS.clockFace}
                emissive={COLORS.clockFace}
                emissiveIntensity={0.3}
                side={THREE.DoubleSide}
              />
            </mesh>
            {/* Clock hands - 10:10 position (V shape) */}
            {/* Hour hand pointing to 10 */}
            <mesh position={[0, 0.3, 0.02]} rotation={[0, 0, Math.PI / 3]}>
              <boxGeometry args={[0.08, 0.7, 0.02]} />
              <meshStandardMaterial color={COLORS.clockDetail} />
            </mesh>
            {/* Minute hand pointing to 2 */}
            <mesh position={[0, 0.4, 0.02]} rotation={[0, 0, -Math.PI / 3]}>
              <boxGeometry args={[0.06, 1.0, 0.02]} />
              <meshStandardMaterial color={COLORS.clockDetail} />
            </mesh>
            {/* Clock rim */}
            <mesh>
              <torusGeometry args={[1.5, 0.1, 8, 24]} />
              <meshStandardMaterial color={COLORS.secondary} />
            </mesh>
          </group>
        ))}

        {/* Pointed spire */}
        <mesh position={[0, 23, 0]}>
          <coneGeometry args={[2, 6, 4]} />
          <meshStandardMaterial color={COLORS.buildingAlt} />
        </mesh>
        <lineSegments position={[0, 23, 0]}>
          <edgesGeometry args={[new THREE.ConeGeometry(2, 6, 4)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>
      </group>

      {/* Victoria Tower - other end */}
      <group position={[15, 0, 0]}>
        <mesh position={[0, 8, 0]}>
          <boxGeometry args={[5, 16, 5]} />
          <meshStandardMaterial color={COLORS.building} />
        </mesh>
        <lineSegments position={[0, 8, 0]}>
          <edgesGeometry args={[new THREE.BoxGeometry(5, 16, 5)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Spire */}
        <mesh position={[0, 18, 0]}>
          <coneGeometry args={[2.5, 5, 4]} />
          <meshStandardMaterial color={COLORS.buildingAlt} />
        </mesh>
      </group>
    </group>
  );
}

/**
 * County Hall - Long gentle curved neoclassical block behind the Eye
 */
/* CountyHall component removed - was positioned at Z=120, not visible from camera path */

/**
 * Westminster Abbey - Gothic cathedral with detailed architecture
 * Blue wireframe theme matching scene palette
 * Full detail: nave, transepts, towers, chapter house, lady chapel
 */
function WestminsterAbbey({ position = [0, 0, 0], rotation = [0, 0, 0], scale = 0.6 }) {
  // Blue color palette matching scene
  const ABBEY_COLORS = {
    stone: '#7EB8E5',        // Light blue (primary structure)
    stoneDark: '#5A8BC4',    // Medium blue (buttresses, accents)
    roof: '#4A7BB8',         // Dark blue (roofs)
    window: '#2D3748',       // Dark gray-blue (windows)
    copper: '#4A90D9',       // Accent blue (Lady Chapel roof)
  };

  // Dimensions
  const naveWidth = 12, naveLength = 50, naveHeight = 18;
  const bayCount = 10;
  const bayWidth = naveLength / bayCount;
  const transeptZ = 10;
  const transeptLength = 24, transeptHeight = 20;

  // Memoized roof shape for nave
  const naveRoofShape = useMemo(() => {
    const shape = new THREE.Shape();
    shape.moveTo(-naveWidth/2 - 1, 0);
    shape.lineTo(0, 8);
    shape.lineTo(naveWidth/2 + 1, 0);
    shape.closePath();
    return shape;
  }, []);

  // Memoized roof shape for transept
  const transeptRoofShape = useMemo(() => {
    const shape = new THREE.Shape();
    shape.moveTo(-5.5, 0);
    shape.lineTo(0, 6);
    shape.lineTo(5.5, 0);
    shape.closePath();
    return shape;
  }, []);

  // Lady chapel roof shape
  const ladyRoofShape = useMemo(() => {
    const ladyWidth = 14;
    const shape = new THREE.Shape();
    shape.moveTo(-ladyWidth/2 - 0.5, 0);
    shape.lineTo(0, 5);
    shape.lineTo(ladyWidth/2 + 0.5, 0);
    shape.closePath();
    return shape;
  }, []);

  return (
    <group position={position} rotation={rotation} scale={scale}>
      {/* === NAVE WITH WINDOW BAYS === */}
      {[...Array(bayCount)].map((_, i) => {
        const zPos = -naveLength/2 + bayWidth/2 + i * bayWidth;
        return (
          <group key={`bay-${i}`}>
            {/* Wall section */}
            <mesh position={[0, naveHeight/2, zPos]}>
              <boxGeometry args={[naveWidth, naveHeight, bayWidth * 0.7]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>
            <lineSegments position={[0, naveHeight/2, zPos]}>
              <edgesGeometry args={[new THREE.BoxGeometry(naveWidth, naveHeight, bayWidth * 0.7)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Buttress piers on each side */}
            {[-1, 1].map(side => {
              const pierH = naveHeight + 2;
              return (
                <group key={`pier-${i}-${side}`}>
                  <mesh position={[side * (naveWidth/2 + 0.5), pierH/2, zPos + bayWidth * 0.35]}>
                    <boxGeometry args={[2, pierH, 1.5]} />
                    <meshStandardMaterial color={ABBEY_COLORS.stoneDark} metalness={0.3} roughness={0.7} />
                  </mesh>
                  <lineSegments position={[side * (naveWidth/2 + 0.5), pierH/2, zPos + bayWidth * 0.35]}>
                    <edgesGeometry args={[new THREE.BoxGeometry(2, pierH, 1.5)]} />
                    <lineBasicMaterial color={COLORS.wireframe} />
                  </lineSegments>

                  {/* Pinnacle on pier */}
                  <mesh position={[side * (naveWidth/2 + 0.5), pierH + 1.5, zPos + bayWidth * 0.35]}>
                    <coneGeometry args={[0.5, 3, 4]} />
                    <meshStandardMaterial color={ABBEY_COLORS.stone} />
                  </mesh>
                </group>
              );
            })}

            {/* Window recesses */}
            {[-1, 1].map(side => (
              <mesh key={`win-${i}-${side}`} position={[side * (naveWidth/2 - 0.2), naveHeight * 0.55, zPos]}>
                <boxGeometry args={[0.5, naveHeight * 0.6, bayWidth * 0.5]} />
                <meshStandardMaterial color={ABBEY_COLORS.window} />
              </mesh>
            ))}
          </group>
        );
      })}

      {/* Clerestory (upper nave) */}
      <mesh position={[0, naveHeight + 2.5, 0]}>
        <boxGeometry args={[naveWidth * 0.7, 5, naveLength]} />
        <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, naveHeight + 2.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(naveWidth * 0.7, 5, naveLength)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Nave peaked roof */}
      <mesh position={[0, naveHeight + 5, -naveLength/2]}>
        <extrudeGeometry args={[naveRoofShape, { depth: naveLength, bevelEnabled: false }]} />
        <meshStandardMaterial color={ABBEY_COLORS.roof} side={THREE.DoubleSide} />
      </mesh>

      {/* === FLYING BUTTRESSES === */}
      {[...Array(bayCount - 2)].map((_, i) => {
        const zPos = -naveLength/2 + bayWidth/2 + (i + 1) * bayWidth + bayWidth * 0.35;
        return [-1, 1].map(side => {
          const outerPierH = naveHeight * 0.7;
          return (
            <group key={`fly-${i}-${side}`}>
              {/* Outer pier */}
              <mesh position={[side * (naveWidth/2 + 6), outerPierH/2, zPos]}>
                <boxGeometry args={[2, outerPierH, 2]} />
                <meshStandardMaterial color={ABBEY_COLORS.stoneDark} metalness={0.3} roughness={0.7} />
              </mesh>
              <lineSegments position={[side * (naveWidth/2 + 6), outerPierH/2, zPos]}>
                <edgesGeometry args={[new THREE.BoxGeometry(2, outerPierH, 2)]} />
                <lineBasicMaterial color={COLORS.wireframe} />
              </lineSegments>

              {/* Pinnacle on outer pier */}
              <mesh position={[side * (naveWidth/2 + 6), outerPierH + 2, zPos]}>
                <coneGeometry args={[0.7, 4, 4]} />
                <meshStandardMaterial color={ABBEY_COLORS.stone} />
              </mesh>

              {/* Flying arch (upper) */}
              <mesh position={[side * (naveWidth/2 + 3.5), outerPierH * 0.85, zPos]} rotation={[0, 0, side * -0.3]}>
                <boxGeometry args={[1, 1.5, 5]} />
                <meshStandardMaterial color={ABBEY_COLORS.stone} />
              </mesh>

              {/* Lower flying arch */}
              <mesh position={[side * (naveWidth/2 + 3.5), outerPierH * 0.5, zPos]} rotation={[0, 0, side * -0.2]}>
                <boxGeometry args={[1, 1, 5]} />
                <meshStandardMaterial color={ABBEY_COLORS.stone} />
              </mesh>
            </group>
          );
        });
      })}

      {/* === TRANSEPTS === */}
      {[-1, 1].map(side => (
        <group key={`transept-${side}`}>
          {/* Main transept body */}
          <mesh position={[side * (transeptLength/2 + naveWidth/2 - 2), transeptHeight/2, transeptZ]}>
            <boxGeometry args={[transeptLength, transeptHeight, 10]} />
            <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
          </mesh>
          <lineSegments position={[side * (transeptLength/2 + naveWidth/2 - 2), transeptHeight/2, transeptZ]}>
            <edgesGeometry args={[new THREE.BoxGeometry(transeptLength, transeptHeight, 10)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>

          {/* Transept windows */}
          {[0, 1, 2].map(w => (
            <mesh key={`t-win-${side}-${w}`} position={[side * (naveWidth/2 + 4 + w * 6), transeptHeight * 0.5, transeptZ + 5]}>
              <boxGeometry args={[3, transeptHeight * 0.5, 0.5]} />
              <meshStandardMaterial color={ABBEY_COLORS.window} />
            </mesh>
          ))}

          {/* Rose window on transept end */}
          <mesh position={[side * (transeptLength + naveWidth/2 - 2), transeptHeight * 0.6, transeptZ]} rotation={[0, 0, Math.PI/2]}>
            <cylinderGeometry args={[4, 4, 0.5, 16]} />
            <meshStandardMaterial color={ABBEY_COLORS.window} />
          </mesh>

          {/* Transept roof */}
          <mesh
            position={[side === 1 ? naveWidth/2 - 2 : -naveWidth/2 + 2, transeptHeight, transeptZ]}
            rotation={[0, side === 1 ? -Math.PI/2 : Math.PI/2, 0]}
          >
            <extrudeGeometry args={[transeptRoofShape, { depth: transeptLength, bevelEnabled: false }]} />
            <meshStandardMaterial color={ABBEY_COLORS.roof} side={THREE.DoubleSide} />
          </mesh>

          {/* Transept buttresses */}
          {[0, 1].map(b => (
            <group key={`t-butt-${side}-${b}`}>
              <mesh position={[side * (naveWidth/2 + 5 + b * 10), transeptHeight/2, transeptZ + 5.5]}>
                <boxGeometry args={[1.5, transeptHeight, 2]} />
                <meshStandardMaterial color={ABBEY_COLORS.stoneDark} />
              </mesh>
              <lineSegments position={[side * (naveWidth/2 + 5 + b * 10), transeptHeight/2, transeptZ + 5.5]}>
                <edgesGeometry args={[new THREE.BoxGeometry(1.5, transeptHeight, 2)]} />
                <lineBasicMaterial color={COLORS.wireframe} />
              </lineSegments>
            </group>
          ))}
        </group>
      ))}

      {/* === CENTRAL TOWER (Lantern) === */}
      {(() => {
        const towerSize = 10, towerHeight = 32;
        return (
          <group>
            <mesh position={[0, towerHeight/2, transeptZ]}>
              <boxGeometry args={[towerSize, towerHeight, towerSize]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>
            <lineSegments position={[0, towerHeight/2, transeptZ]}>
              <edgesGeometry args={[new THREE.BoxGeometry(towerSize, towerHeight, towerSize)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Tower windows (4 sides) */}
            {[0, 1, 2, 3].map(i => {
              const angle = i * Math.PI / 2;
              return (
                <mesh
                  key={`tower-win-${i}`}
                  position={[Math.sin(angle) * (towerSize/2 + 0.2), towerHeight * 0.7, transeptZ + Math.cos(angle) * (towerSize/2 + 0.2)]}
                  rotation={[0, angle, 0]}
                >
                  <boxGeometry args={[3, 8, 0.5]} />
                  <meshStandardMaterial color={ABBEY_COLORS.window} />
                </mesh>
              );
            })}

            {/* Tower corner pinnacles */}
            {[[-1,-1], [-1,1], [1,-1], [1,1]].map(([x, z], i) => (
              <mesh key={`tower-pinn-${i}`} position={[x * towerSize/2, towerHeight + 2.5, transeptZ + z * towerSize/2]}>
                <coneGeometry args={[0.8, 5, 4]} />
                <meshStandardMaterial color={ABBEY_COLORS.stone} />
              </mesh>
            ))}

            {/* Pyramid cap */}
            <mesh position={[0, towerHeight + 2, transeptZ]} rotation={[0, Math.PI/4, 0]}>
              <coneGeometry args={[towerSize * 0.6, 4, 4]} />
              <meshStandardMaterial color={ABBEY_COLORS.roof} />
            </mesh>
          </group>
        );
      })()}

      {/* === TWIN WESTERN TOWERS === */}
      {(() => {
        const wtHeight = 45, wtWidth = 7;
        return [-1, 1].map(side => (
          <group key={`west-tower-${side}`}>
            {/* Tower in 3 stages */}
            {[0, 1, 2].map(stage => {
              const stageH = wtHeight / 3;
              const stageW = wtWidth - stage * 0.8;
              return (
                <group key={`stage-${stage}`}>
                  <mesh position={[side * (naveWidth/2 + 1), stageH/2 + stage * stageH, -naveLength/2 - 2]}>
                    <boxGeometry args={[stageW, stageH, stageW]} />
                    <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
                  </mesh>
                  <lineSegments position={[side * (naveWidth/2 + 1), stageH/2 + stage * stageH, -naveLength/2 - 2]}>
                    <edgesGeometry args={[new THREE.BoxGeometry(stageW, stageH, stageW)]} />
                    <lineBasicMaterial color={COLORS.wireframe} />
                  </lineSegments>

                  {/* Windows on each stage */}
                  {stage < 2 && (
                    <mesh position={[side * (naveWidth/2 + 1), stageH * 0.6 + stage * stageH, -naveLength/2 - 2 - stageW/2]}>
                      <boxGeometry args={[2, stageH * 0.5, 0.5]} />
                      <meshStandardMaterial color={ABBEY_COLORS.window} />
                    </mesh>
                  )}
                </group>
              );
            })}

            {/* Corner pinnacles */}
            {[[-1,-1], [-1,1], [1,-1], [1,1]].map(([x, z], i) => (
              <mesh
                key={`wt-pinn-${side}-${i}`}
                position={[side * (naveWidth/2 + 1) + x * 2.5, wtHeight + 2, -naveLength/2 - 2 + z * 2.5]}
              >
                <coneGeometry args={[0.8, 4, 4]} />
                <meshStandardMaterial color={ABBEY_COLORS.stone} />
              </mesh>
            ))}

            {/* Central pinnacle */}
            <mesh position={[side * (naveWidth/2 + 1), wtHeight + 3, -naveLength/2 - 2]}>
              <coneGeometry args={[1.5, 6, 4]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} />
            </mesh>
          </group>
        ));
      })()}

      {/* Great West Door */}
      <mesh position={[0, 6, -naveLength/2 - 2]}>
        <boxGeometry args={[8, 12, 2]} />
        <meshStandardMaterial color={ABBEY_COLORS.stoneDark} />
      </mesh>
      <lineSegments position={[0, 6, -naveLength/2 - 2]}>
        <edgesGeometry args={[new THREE.BoxGeometry(8, 12, 2)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* West window */}
      <mesh position={[0, 17, -naveLength/2 - 1]}>
        <boxGeometry args={[6, 10, 0.5]} />
        <meshStandardMaterial color={ABBEY_COLORS.window} />
      </mesh>

      {/* === CHAPTER HOUSE (Octagonal) === */}
      {(() => {
        const chapterRadius = 8, chapterHeight = 15;
        return (
          <group>
            {/* Octagonal base */}
            <mesh position={[22, chapterHeight/2, 2]}>
              <cylinderGeometry args={[chapterRadius, chapterRadius, chapterHeight, 8]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>
            <lineSegments position={[22, chapterHeight/2, 2]}>
              <edgesGeometry args={[new THREE.CylinderGeometry(chapterRadius, chapterRadius, chapterHeight, 8)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Buttresses on each face */}
            {[...Array(8)].map((_, i) => {
              const angle = (i / 8) * Math.PI * 2 + Math.PI / 8;
              const buttH = chapterHeight + 3;
              return (
                <group key={`ch-butt-${i}`}>
                  <mesh
                    position={[22 + Math.cos(angle) * (chapterRadius + 0.5), buttH/2, 2 + Math.sin(angle) * (chapterRadius + 0.5)]}
                    rotation={[0, -angle, 0]}
                  >
                    <boxGeometry args={[1.5, buttH, 2]} />
                    <meshStandardMaterial color={ABBEY_COLORS.stoneDark} />
                  </mesh>

                  {/* Pinnacle */}
                  <mesh position={[22 + Math.cos(angle) * (chapterRadius + 0.5), buttH + 1.5, 2 + Math.sin(angle) * (chapterRadius + 0.5)]}>
                    <coneGeometry args={[0.6, 3, 4]} />
                    <meshStandardMaterial color={ABBEY_COLORS.stone} />
                  </mesh>

                  {/* Windows between buttresses */}
                  {(() => {
                    const winAngle = angle + Math.PI / 8;
                    return (
                      <mesh
                        position={[22 + Math.cos(winAngle) * (chapterRadius - 0.2), chapterHeight * 0.5, 2 + Math.sin(winAngle) * (chapterRadius - 0.2)]}
                        rotation={[0, -winAngle, 0]}
                      >
                        <boxGeometry args={[0.5, chapterHeight * 0.6, 3]} />
                        <meshStandardMaterial color={ABBEY_COLORS.window} />
                      </mesh>
                    );
                  })()}
                </group>
              );
            })}

            {/* Conical roof */}
            <mesh position={[22, chapterHeight + 4, 2]}>
              <coneGeometry args={[chapterRadius + 1, 8, 8]} />
              <meshStandardMaterial color={ABBEY_COLORS.roof} />
            </mesh>
            <lineSegments position={[22, chapterHeight + 4, 2]}>
              <edgesGeometry args={[new THREE.ConeGeometry(chapterRadius + 1, 8, 8)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Connecting cloister */}
            <mesh position={[14, 3, 2]}>
              <boxGeometry args={[8, 6, 12]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} />
            </mesh>
            <lineSegments position={[14, 3, 2]}>
              <edgesGeometry args={[new THREE.BoxGeometry(8, 6, 12)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>
          </group>
        );
      })()}

      {/* === HENRY VII LADY CHAPEL (East End) === */}
      {(() => {
        const ladyLength = 22, ladyWidth = 14, ladyHeight = 20;
        return (
          <group>
            {/* Main body */}
            <mesh position={[0, ladyHeight/2, naveLength/2 + ladyLength/2]}>
              <boxGeometry args={[ladyWidth, ladyHeight, ladyLength]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>
            <lineSegments position={[0, ladyHeight/2, naveLength/2 + ladyLength/2]}>
              <edgesGeometry args={[new THREE.BoxGeometry(ladyWidth, ladyHeight, ladyLength)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Apse (rounded east end) */}
            <mesh position={[0, ladyHeight/2, naveLength/2 + ladyLength]} rotation={[Math.PI/2, Math.PI/2, 0]}>
              <cylinderGeometry args={[ladyWidth/2, ladyWidth/2, ladyHeight, 8, 1, false, 0, Math.PI]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>

            {/* Lady chapel buttresses with pinnacles */}
            {[...Array(5)].map((_, i) => {
              const zPos = naveLength/2 + 3 + i * 4.5;
              return [-1, 1].map(side => {
                const buttH = ladyHeight + 2;
                return (
                  <group key={`lady-butt-${i}-${side}`}>
                    <mesh position={[side * (ladyWidth/2 + 0.5), buttH/2, zPos]}>
                      <boxGeometry args={[2, buttH, 1.5]} />
                      <meshStandardMaterial color={ABBEY_COLORS.stoneDark} />
                    </mesh>
                    <lineSegments position={[side * (ladyWidth/2 + 0.5), buttH/2, zPos]}>
                      <edgesGeometry args={[new THREE.BoxGeometry(2, buttH, 1.5)]} />
                      <lineBasicMaterial color={COLORS.wireframe} />
                    </lineSegments>

                    {/* Tall pinnacle (Tudor Gothic) */}
                    <mesh position={[side * (ladyWidth/2 + 0.5), buttH + 3, zPos]}>
                      <coneGeometry args={[0.6, 6, 4]} />
                      <meshStandardMaterial color={ABBEY_COLORS.stone} />
                    </mesh>

                    {/* Flying buttress to lady chapel */}
                    {i > 0 && i < 4 && (
                      <group>
                        <mesh position={[side * (ladyWidth/2 + 5), ladyHeight * 0.25, zPos]}>
                          <boxGeometry args={[1.5, ladyHeight * 0.5, 1.5]} />
                          <meshStandardMaterial color={ABBEY_COLORS.stoneDark} />
                        </mesh>
                        <mesh position={[side * (ladyWidth/2 + 2.8), ladyHeight * 0.4, zPos]} rotation={[0, 0, side * -0.25]}>
                          <boxGeometry args={[0.8, 1, 4]} />
                          <meshStandardMaterial color={ABBEY_COLORS.stone} />
                        </mesh>
                      </group>
                    )}
                  </group>
                );
              });
            })}

            {/* Lady chapel windows */}
            {[...Array(4)].map((_, i) => {
              const zPos = naveLength/2 + 5 + i * 4.5;
              return [-1, 1].map(side => (
                <mesh key={`lady-win-${i}-${side}`} position={[side * (ladyWidth/2 - 0.2), ladyHeight * 0.5, zPos]}>
                  <boxGeometry args={[0.5, ladyHeight * 0.65, 3]} />
                  <meshStandardMaterial color={ABBEY_COLORS.window} />
                </mesh>
              ));
            })}

            {/* Lady chapel copper roof */}
            <mesh position={[0, ladyHeight, naveLength/2 - 1]}>
              <extrudeGeometry args={[ladyRoofShape, { depth: ladyLength + 2, bevelEnabled: false }]} />
              <meshStandardMaterial color={ABBEY_COLORS.copper} side={THREE.DoubleSide} />
            </mesh>
          </group>
        );
      })()}

      {/* === CHOIR === */}
      {(() => {
        const choirLength = 18;
        return (
          <group>
            <mesh position={[0, naveHeight/2, transeptZ + choirLength/2 + 5]}>
              <boxGeometry args={[naveWidth + 2, naveHeight, choirLength]} />
              <meshStandardMaterial color={ABBEY_COLORS.stone} metalness={0.3} roughness={0.7} />
            </mesh>
            <lineSegments position={[0, naveHeight/2, transeptZ + choirLength/2 + 5]}>
              <edgesGeometry args={[new THREE.BoxGeometry(naveWidth + 2, naveHeight, choirLength)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>
          </group>
        );
      })()}
    </group>
  );
}

/**
 * Building Cluster - 5-8 simple rectangular buildings
 * City fabric we fly over in the foreground/mid-ground
 */
function BuildingCluster({ position, rotation = [0, 0, 0] }) {
  // Varied building colors for visual interest
  const buildingColors = [COLORS.building, COLORS.buildingAlt, COLORS.buildingLight, COLORS.buildingWarm];

  const buildings = useMemo(() => {
    const result = [];
    const count = 5 + Math.floor(Math.random() * 4); // 5-8 buildings

    for (let i = 0; i < count; i++) {
      const width = 2 + Math.random() * 4;
      const depth = 2 + Math.random() * 4;
      const height = 4 + Math.random() * 8; // 5-8 stories equivalent
      const x = (Math.random() - 0.5) * 15;
      const z = (Math.random() - 0.5) * 15;
      const hasPitchedRoof = Math.random() > 0.6;
      const hasGlassFacade = Math.random() > 0.7; // 30% chance of glass facade

      result.push({
        width, depth, height, x, z, hasPitchedRoof, hasGlassFacade,
        color: buildingColors[Math.floor(Math.random() * buildingColors.length)],
      });
    }
    return result;
  }, []);

  return (
    <group position={position} rotation={rotation}>
      {buildings.map((b, i) => (
        <group key={i} position={[b.x, 0, b.z]}>
          {/* Main building body */}
          <mesh position={[0, b.height / 2, 0]}>
            <boxGeometry args={[b.width, b.height, b.depth]} />
            <meshStandardMaterial
              color={b.hasGlassFacade ? COLORS.glass : b.color}
              metalness={b.hasGlassFacade ? 0.2 : 0.3}
              roughness={b.hasGlassFacade ? 0.1 : 0.7}
              transparent={b.hasGlassFacade}
              opacity={b.hasGlassFacade ? 0.5 : 1}
            />
          </mesh>
          <lineSegments position={[0, b.height / 2, 0]}>
            <edgesGeometry args={[new THREE.BoxGeometry(b.width, b.height, b.depth)]} />
            <lineBasicMaterial color={b.hasGlassFacade ? COLORS.wireframeLight : COLORS.wireframe} />
          </lineSegments>

          {/* Pitched roof if applicable - pyramid aligned to building corners */}
          {b.hasPitchedRoof && (
            <group position={[0, b.height + 1, 0]} rotation={[0, Math.PI / 4, 0]}>
              {/* Scale cone to match building footprint: radius = diagonal/2 */}
              <mesh scale={[b.width / Math.sqrt(2), 1, b.depth / Math.sqrt(2)]}>
                <coneGeometry args={[1, 2, 4]} />
                <meshStandardMaterial color={COLORS.buildingAlt} />
              </mesh>
              <lineSegments scale={[b.width / Math.sqrt(2), 1, b.depth / Math.sqrt(2)]}>
                <edgesGeometry args={[new THREE.ConeGeometry(1, 2, 4)]} />
                <lineBasicMaterial color={COLORS.wireframe} />
              </lineSegments>
            </group>
          )}

          {/* Windows - transparent glass panels */}
          {Array.from({ length: Math.floor(b.height / 2) }).map((_, floor) => (
            <mesh key={`window-${floor}`} position={[b.width / 2 + 0.01, floor * 2 + 1.5, 0]}>
              <planeGeometry args={[0.8, 0.6]} />
              <meshStandardMaterial
                color={COLORS.glass}
                emissive={COLORS.glassEmissive}
                emissiveIntensity={0.3}
                transparent
                opacity={0.65}
              />
            </mesh>
          ))}

          {/* Additional windows on opposite side for glass buildings */}
          {b.hasGlassFacade && Array.from({ length: Math.floor(b.height / 2) }).map((_, floor) => (
            <mesh key={`window-back-${floor}`} position={[-b.width / 2 - 0.01, floor * 2 + 1.5, 0]} rotation={[0, Math.PI, 0]}>
              <planeGeometry args={[0.8, 0.6]} />
              <meshStandardMaterial
                color={COLORS.glass}
                emissive={COLORS.glassEmissive}
                emissiveIntensity={0.3}
                transparent
                opacity={0.65}
              />
            </mesh>
          ))}
        </group>
      ))}
    </group>
  );
}

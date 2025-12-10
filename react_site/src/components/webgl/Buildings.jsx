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
      <LondonEye position={[-25, 0, 110]} scale={1.5} />

      {/* Westminster Bridge - crosses the river at Z=78 */}
      <WestminsterBridge position={[15, 0, 78]} />

      {/* Palace of Westminster + Big Ben - north bank at Z=65 */}
      <PalaceOfWestminster position={[35, 0, 65]} />

      {/* Building clusters - NORTH of river (Z < 70) - city we fly over */}
      {/* Camera path: Z=-5 to Z=70, so these are all visible */}
      <BuildingCluster position={[5, 0, 5]} rotation={[0, 0.2, 0]} />
      <BuildingCluster position={[-15, 0, 15]} rotation={[0, -0.3, 0]} />
      <BuildingCluster position={[12, 0, 25]} rotation={[0, 0.4, 0]} />
      <BuildingCluster position={[-8, 0, 35]} rotation={[0, -0.1, 0]} />

      {/* Brewhouse and Kitchen - on north bank, back against river */}
      {/* River at Z=75, building depth 6, so center at Z=72 (back wall at Z=75) */}
      {/* Aligned with London Eye center at X=-25, rotated to face camera */}
      <Brewhouse position={[-25, 0, 72]} rotation={[0, Math.PI, 0]} scale={1.0} />

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
 * London Eye - Large observation wheel with 32 spokes
 * Geometrically accurate with A-frame supports
 * Scale prop allows sizing the entire structure uniformly
 */
function LondonEye({ position, scale = 1 }) {
  const wheelRef = useRef();
  const capsulesRef = useRef();
  const wheelRadius = 18;  // Base radius (scaled by group scale prop)
  const spokeCount = 32;
  const capsuleCount = 32;
  const rotationSpeed = 0.012;  // Slightly slower for larger wheel

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
        // Capsules stay upright (no rotation) due to gravity
      });
    }
  });

  return (
    <group position={position} scale={scale}>
      {/* A-frame support - left leg */}
      <mesh position={[-4.5, 9, -1.5]} rotation={[0.1, 0, 0.15]}>
        <boxGeometry args={[1.2, 21, 1.2]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
      </mesh>
      <lineSegments position={[-4.5, 9, -1.5]} rotation={[0.1, 0, 0.15]}>
        <edgesGeometry args={[new THREE.BoxGeometry(1.2, 21, 1.2)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* A-frame support - right leg (scaled 1.5x) */}
      <mesh position={[4.5, 9, -1.5]} rotation={[0.1, 0, -0.15]}>
        <boxGeometry args={[1.2, 21, 1.2]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
      </mesh>
      <lineSegments position={[4.5, 9, -1.5]} rotation={[0.1, 0, -0.15]}>
        <edgesGeometry args={[new THREE.BoxGeometry(1.2, 21, 1.2)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Cross braces (scaled 1.5x) */}
      <mesh position={[0, 6, -1.5]}>
        <boxGeometry args={[7.5, 0.6, 0.6]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>
      <mesh position={[0, 12, -1.5]}>
        <boxGeometry args={[6, 0.45, 0.45]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>

      {/* Central hub (scaled 1.5x, Y=19.5) - cylinder along Z axis */}
      <mesh position={[0, 19.5, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <cylinderGeometry args={[2.25, 2.25, 1.8, 16]} />
        <meshStandardMaterial color={COLORS.primary} metalness={0.6} roughness={0.4} />
      </mesh>
      <lineSegments position={[0, 19.5, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <edgesGeometry args={[new THREE.CylinderGeometry(2.25, 2.25, 1.8, 16)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Rotating wheel group (centered at Y=19.5) - rim and spokes only */}
      <group ref={wheelRef} position={[0, 19.5, 0]}>
        {/* Outer rim - THIN torus (in XY plane, no rotation needed) */}
        <mesh>
          <torusGeometry args={[wheelRadius, 0.15, 8, 64]} />
          <meshStandardMaterial color={COLORS.primary} metalness={0.5} roughness={0.5} />
        </mesh>
        <lineSegments>
          <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius, 0.15, 8, 64)]} />
          <lineBasicMaterial color={COLORS.wireframe} />
        </lineSegments>

        {/* Inner rim - also thin */}
        <mesh>
          <torusGeometry args={[wheelRadius * 0.7, 0.1, 8, 48]} />
          <meshStandardMaterial color={COLORS.secondary} metalness={0.4} roughness={0.6} />
        </mesh>

        {/* 32 Spokes (scaled) */}
        {Array.from({ length: spokeCount }).map((_, i) => {
          const angle = (i / spokeCount) * Math.PI * 2;
          const midX = Math.cos(angle) * (wheelRadius / 2);
          const midY = Math.sin(angle) * (wheelRadius / 2);
          return (
            <mesh
              key={`spoke-${i}`}
              position={[midX, midY, 0]}
              rotation={[0, 0, angle + Math.PI / 2]}
            >
              <boxGeometry args={[0.12, wheelRadius, 0.12]} />
              <meshStandardMaterial color={COLORS.primary} />
            </mesh>
          );
        })}
      </group>

      {/* Capsules group - NOT inside rotating wheel, positions updated in useFrame */}
      {/* Capsules stay UPRIGHT (gravity) while moving with the wheel */}
      <group ref={capsulesRef} position={[0, 19.5, 0]}>
        {Array.from({ length: capsuleCount }).map((_, i) => {
          const angle = (i / capsuleCount) * Math.PI * 2;
          const x = Math.cos(angle) * wheelRadius;
          const y = Math.sin(angle) * wheelRadius;
          return (
            <group key={`capsule-${i}`} position={[x, y, 0]}>
              {/* Capsule stays upright - NO rotation */}
              <mesh>
                <boxGeometry args={[3, 4.5, 2.2]} />
                <meshStandardMaterial
                  color={COLORS.glass}
                  emissive={COLORS.glassEmissive}
                  emissiveIntensity={0.3}
                  metalness={0.1}
                  roughness={0.2}
                  transparent
                  opacity={0.5}
                />
              </mesh>
              <lineSegments>
                <edgesGeometry args={[new THREE.BoxGeometry(3, 4.5, 2.2)]} />
                <lineBasicMaterial color={COLORS.wireframe} />
              </lineSegments>
            </group>
          );
        })}
      </group>

      {/* Base platform (scaled 1.5x) */}
      <mesh position={[0, 0.3, 0]}>
        <boxGeometry args={[12, 0.6, 6]} />
        <meshStandardMaterial color={COLORS.buildingAlt} />
      </mesh>
      <lineSegments position={[0, 0.3, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(12, 0.6, 6)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>
    </group>
  );
}

/**
 * Westminster Bridge - 5-7 arched spans
 */
function WestminsterBridge({ position }) {
  const archCount = 7;
  const archWidth = 6;
  const bridgeLength = archCount * archWidth;

  return (
    <group position={position} rotation={[0, -0.3, 0]}>
      {/* Bridge deck */}
      <mesh position={[0, 1.5, 0]}>
        <boxGeometry args={[bridgeLength, 0.8, 4]} />
        <meshStandardMaterial color={COLORS.building} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, 1.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(bridgeLength, 0.8, 4)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Bridge arches */}
      {Array.from({ length: archCount }).map((_, i) => {
        const xPos = (i - (archCount - 1) / 2) * archWidth;
        return (
          <group key={`arch-${i}`} position={[xPos, 0, 0]}>
            {/* Arch pier */}
            <mesh position={[0, 0.5, 0]}>
              <boxGeometry args={[1.2, 2, 4.5]} />
              <meshStandardMaterial color={COLORS.buildingAlt} />
            </mesh>
            <lineSegments position={[0, 0.5, 0]}>
              <edgesGeometry args={[new THREE.BoxGeometry(1.2, 2, 4.5)]} />
              <lineBasicMaterial color={COLORS.wireframe} />
            </lineSegments>

            {/* Arch - half torus */}
            <mesh position={[0, 1, 0]} rotation={[Math.PI / 2, 0, 0]}>
              <torusGeometry args={[2.5, 0.4, 8, 16, Math.PI]} />
              <meshStandardMaterial color={COLORS.building} />
            </mesh>
          </group>
        );
      })}

      {/* Railings */}
      <mesh position={[0, 2.2, 1.8]}>
        <boxGeometry args={[bridgeLength, 0.6, 0.15]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>
      <mesh position={[0, 2.2, -1.8]}>
        <boxGeometry args={[bridgeLength, 0.6, 0.15]} />
        <meshStandardMaterial color={COLORS.primary} />
      </mesh>
    </group>
  );
}

/**
 * Palace of Westminster + Big Ben
 * Long horizontal Gothic building with jagged roofline + clock tower
 */
function PalaceOfWestminster({ position }) {
  return (
    <group position={position}>
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
            {/* Clock hands - hour */}
            <mesh position={[0, 0.3, 0.02]} rotation={[0, 0, Math.PI / 6]}>
              <boxGeometry args={[0.08, 0.8, 0.02]} />
              <meshStandardMaterial color={COLORS.clockDetail} />
            </mesh>
            {/* Clock hands - minute */}
            <mesh position={[0, 0.4, 0.02]} rotation={[0, 0, -Math.PI / 3]}>
              <boxGeometry args={[0.06, 1.1, 0.02]} />
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
 * Brewhouse and Kitchen - Detailed architectural model
 * Yellow brick pub with curved corner, hip roof, outdoor deck
 * Positioned in front of London Eye on the south bank
 */
function Brewhouse({ position = [0, 0, 0], rotation = [0, 0, 0], scale = 1 }) {
  // Brewhouse colors - warm yellows/browns for brick, dark for roof
  const BREWHOUSE_COLORS = {
    brick: '#D4A84B',        // Yellow brick
    brickDark: '#C49A3F',    // Darker brick accent
    roof: '#4A5568',         // Dark slate roof
    roofTile: '#3D4852',     // Darker roof accent
    window: '#87CEEB',       // Light blue glass
    windowFrame: '#2D3748',  // Dark window frames
    wood: '#8B7355',         // Wood deck
    signage: '#2D3748',      // Dark signage band
    foliage: '#4A7C59',      // Green planters
    umbrella: '#C53030',     // Red umbrellas
    metal: '#718096',        // Metal poles
  };

  // Create curved corner geometry (quarter cylinder approximation)
  const curvedCornerSegments = 10;

  return (
    <group position={position} rotation={rotation} scale={scale}>
      {/* === BASE BUILDING === */}
      {/* Main two-story rectangular mass - wide 3:1 ratio */}
      <mesh position={[0, 4, 0]}>
        <boxGeometry args={[18, 8, 6]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.brick} metalness={0.1} roughness={0.8} />
      </mesh>
      <lineSegments position={[0, 4, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(18, 8, 6)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Curved corner section (right side) - quarter cylinder */}
      <mesh position={[9, 4, 0]} rotation={[0, 0, 0]}>
        <cylinderGeometry args={[3, 3, 8, curvedCornerSegments, 1, false, 0, Math.PI / 2]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.brick} metalness={0.1} roughness={0.8} side={THREE.DoubleSide} />
      </mesh>
      <lineSegments position={[9, 4, 0]}>
        <edgesGeometry args={[new THREE.CylinderGeometry(3, 3, 8, curvedCornerSegments, 1, false, 0, Math.PI / 2)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* === HIP ROOF === */}
      {/* Main roof - trapezoidal prism approximated with box + cones */}
      <mesh position={[0, 9, 0]}>
        <boxGeometry args={[16, 1.5, 5]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.roof} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, 9, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(16, 1.5, 5)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Roof ridge */}
      <mesh position={[0, 10, 0]}>
        <boxGeometry args={[14, 1, 3]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.roofTile} metalness={0.3} roughness={0.7} />
      </mesh>
      <lineSegments position={[0, 10, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(14, 1, 3)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Chimney - offset toward center-right */}
      <mesh position={[3, 11.5, 0]}>
        <boxGeometry args={[1.2, 2.5, 1]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.brickDark} metalness={0.2} roughness={0.8} />
      </mesh>
      <lineSegments position={[3, 11.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(1.2, 2.5, 1)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* === GROUND FLOOR WINDOWS (4 large panels) === */}
      {[-6, -2, 2, 6].map((xPos, i) => (
        <group key={`gf-window-${i}`} position={[xPos, 2.5, 3.05]}>
          {/* Window frame - slight extrusion */}
          <mesh>
            <boxGeometry args={[2.5, 3.5, 0.15]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.windowFrame} metalness={0.4} roughness={0.6} />
          </mesh>
          {/* Window glass */}
          <mesh position={[0, 0, 0.1]}>
            <planeGeometry args={[2.2, 3.2]} />
            <meshStandardMaterial
              color={BREWHOUSE_COLORS.window}
              emissive={BREWHOUSE_COLORS.window}
              emissiveIntensity={0.2}
              transparent
              opacity={0.6}
              metalness={0.1}
              roughness={0.1}
            />
          </mesh>
          <lineSegments>
            <edgesGeometry args={[new THREE.BoxGeometry(2.5, 3.5, 0.15)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>
        </group>
      ))}

      {/* === UPPER FLOOR WINDOWS (6 smaller) === */}
      {[-7, -4.2, -1.4, 1.4, 4.2, 7].map((xPos, i) => (
        <group key={`uf-window-${i}`} position={[xPos, 6, 3.05]}>
          {/* Window frame */}
          <mesh>
            <boxGeometry args={[1.8, 2, 0.12]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.windowFrame} metalness={0.4} roughness={0.6} />
          </mesh>
          {/* Window glass */}
          <mesh position={[0, 0, 0.08]}>
            <planeGeometry args={[1.5, 1.7]} />
            <meshStandardMaterial
              color={BREWHOUSE_COLORS.window}
              emissive={BREWHOUSE_COLORS.window}
              emissiveIntensity={0.15}
              transparent
              opacity={0.6}
            />
          </mesh>
          <lineSegments>
            <edgesGeometry args={[new THREE.BoxGeometry(1.8, 2, 0.12)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>
        </group>
      ))}

      {/* === ARCHED DOORWAYS (2x) === */}
      {[-4.5, 4.5].map((xPos, i) => (
        <group key={`door-${i}`} position={[xPos, 1.8, 3.1]}>
          {/* Door frame rectangle */}
          <mesh position={[0, -0.3, 0]}>
            <boxGeometry args={[2, 2.6, 0.2]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.windowFrame} metalness={0.3} roughness={0.7} />
          </mesh>
          {/* Arch top - half cylinder */}
          <mesh position={[0, 1, 0]} rotation={[Math.PI / 2, 0, 0]}>
            <cylinderGeometry args={[1, 1, 0.2, 16, 1, false, 0, Math.PI]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.windowFrame} metalness={0.3} roughness={0.7} side={THREE.DoubleSide} />
          </mesh>
          <lineSegments position={[0, -0.3, 0]}>
            <edgesGeometry args={[new THREE.BoxGeometry(2, 2.6, 0.2)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>
        </group>
      ))}

      {/* === SIGNAGE BAND === */}
      <mesh position={[0, 4.5, 3.1]}>
        <boxGeometry args={[16, 0.8, 0.15]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.signage} metalness={0.2} roughness={0.8} />
      </mesh>
      <lineSegments position={[0, 4.5, 3.1]}>
        <edgesGeometry args={[new THREE.BoxGeometry(16, 0.8, 0.15)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* === OUTDOOR DECK === */}
      {/* Deck platform */}
      <mesh position={[0, 0.15, 6]}>
        <boxGeometry args={[20, 0.3, 5]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.wood} metalness={0.1} roughness={0.9} />
      </mesh>
      <lineSegments position={[0, 0.15, 6]}>
        <edgesGeometry args={[new THREE.BoxGeometry(20, 0.3, 5)]} />
        <lineBasicMaterial color={COLORS.wireframe} />
      </lineSegments>

      {/* Tables with umbrellas */}
      {[-6, -2, 2, 6].map((xPos, i) => (
        <group key={`table-${i}`} position={[xPos, 0.3, 6]}>
          {/* Table top */}
          <mesh position={[0, 0.8, 0]}>
            <boxGeometry args={[1.5, 0.1, 1.5]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.wood} metalness={0.2} roughness={0.8} />
          </mesh>
          {/* Table leg */}
          <mesh position={[0, 0.4, 0]}>
            <cylinderGeometry args={[0.1, 0.1, 0.8, 8]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.metal} metalness={0.6} roughness={0.4} />
          </mesh>
          {/* Umbrella pole */}
          <mesh position={[0, 2, 0]}>
            <cylinderGeometry args={[0.06, 0.06, 2.4, 6]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.metal} metalness={0.6} roughness={0.4} />
          </mesh>
          {/* Umbrella canopy - cone */}
          <mesh position={[0, 3.2, 0]}>
            <coneGeometry args={[1.5, 0.8, 8]} />
            <meshStandardMaterial color={i % 2 === 0 ? BREWHOUSE_COLORS.umbrella : '#2B6CB0'} metalness={0.1} roughness={0.7} />
          </mesh>
          <lineSegments position={[0, 3.2, 0]}>
            <edgesGeometry args={[new THREE.ConeGeometry(1.5, 0.8, 8)]} />
            <lineBasicMaterial color={COLORS.wireframe} />
          </lineSegments>
          {/* Benches (2 per table) */}
          <mesh position={[0, 0.45, 1]}>
            <boxGeometry args={[1.2, 0.1, 0.4]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.wood} />
          </mesh>
          <mesh position={[0, 0.45, -1]}>
            <boxGeometry args={[1.2, 0.1, 0.4]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.wood} />
          </mesh>
        </group>
      ))}

      {/* === ROOFTOP PLANTERS === */}
      {[-7, -3.5, 0, 3.5, 7].map((xPos, i) => (
        <group key={`planter-${i}`} position={[xPos, 8.8, -2.5]}>
          {/* Planter box */}
          <mesh position={[0, 0.3, 0]}>
            <boxGeometry args={[1.5, 0.6, 0.8]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.brickDark} metalness={0.1} roughness={0.9} />
          </mesh>
          {/* Foliage - simple sphere billboards */}
          <mesh position={[0, 0.9, 0]}>
            <sphereGeometry args={[0.6, 8, 6]} />
            <meshStandardMaterial color={BREWHOUSE_COLORS.foliage} metalness={0.0} roughness={0.9} />
          </mesh>
        </group>
      ))}

      {/* === FENCE along deck edge === */}
      {/* Fence posts */}
      {[-9, -6, -3, 0, 3, 6, 9].map((xPos, i) => (
        <mesh key={`fence-post-${i}`} position={[xPos, 0.7, 8.3]}>
          <cylinderGeometry args={[0.08, 0.08, 1.1, 6]} />
          <meshStandardMaterial color={BREWHOUSE_COLORS.metal} metalness={0.5} roughness={0.5} />
        </mesh>
      ))}
      {/* Fence horizontal rails */}
      <mesh position={[0, 0.5, 8.3]}>
        <boxGeometry args={[18.5, 0.06, 0.06]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.metal} metalness={0.5} roughness={0.5} />
      </mesh>
      <mesh position={[0, 0.9, 8.3]}>
        <boxGeometry args={[18.5, 0.06, 0.06]} />
        <meshStandardMaterial color={BREWHOUSE_COLORS.metal} metalness={0.5} roughness={0.5} />
      </mesh>
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

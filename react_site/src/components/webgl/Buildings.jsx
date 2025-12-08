import { useRef, useMemo } from 'react';
import { useFrame } from '@react-three/fiber';
import * as THREE from 'three';

/**
 * Low-poly stylized buildings for scroll background effect
 * Restaurant, Office, Factory, Shop, Apartment, Warehouse, and FerrisWheel
 * All structures are SOLID (not transparent)
 */
export function Buildings({ cameraZ = 0 }) {
  const buildings = useMemo(() => [
    // Front cluster - visible during intro zoom
    { type: 'shop', position: [5, -2, 10], rotation: [0, -0.3, 0], scale: 2 },
    { type: 'restaurant', position: [-5, -2, 18], rotation: [0, 0.4, 0], scale: 2.5 },

    // Early journey
    { type: 'apartment', position: [7, -1.5, 32], rotation: [0, -0.2, 0], scale: 2.4 },
    { type: 'shop', position: [-6, -2, 40], rotation: [0, 0.5, 0], scale: 1.8 },

    // Mid-journey cluster
    { type: 'office', position: [6, -1, 55], rotation: [0, -0.4, 0], scale: 3 },
    { type: 'warehouse', position: [-8, -2, 65], rotation: [0, 0.3, 0], scale: 2.2 },

    // Far section
    { type: 'restaurant', position: [5, -2, 78], rotation: [0, -0.25, 0], scale: 2 },
    { type: 'factory', position: [-6, -2, 90], rotation: [0, 0.6, 0], scale: 2.8 },
    { type: 'apartment', position: [8, -1.5, 102], rotation: [0, -0.35, 0], scale: 2.3 },
    { type: 'office', position: [-7, -1, 115], rotation: [0, 0.2, 0], scale: 2.5 },

    // London Eye style ferris wheel - far back, right side (negative X)
    { type: 'ferriswheel', position: [-35, -2, 85], rotation: [0, 0.4, 0], scale: 2.5 },
  ], []);

  return (
    <group>
      {buildings.map((b, i) => (
        <Building
          key={i}
          type={b.type}
          position={b.position}
          rotation={b.rotation}
          scale={b.scale}
          cameraZ={cameraZ}
          index={i}
        />
      ))}
    </group>
  );
}

function Building({ type, position, rotation, scale, cameraZ, index }) {
  const groupRef = useRef();

  useFrame(() => {
    if (groupRef.current) {
      const depth = position[2];
      const parallaxFactor = 0.1 * (1 - depth / 60);
      groupRef.current.position.x = position[0] + (cameraZ * parallaxFactor * 0.5);
      groupRef.current.position.y = position[1] + Math.sin(Date.now() * 0.0005 + index) * 0.1;
    }
  });

  const BuildingComponent = {
    restaurant: Restaurant,
    office: OfficeBuilding,
    factory: Factory,
    shop: Shop,
    apartment: Apartment,
    warehouse: Warehouse,
    ferriswheel: FerrisWheel,
  }[type];

  return (
    <group ref={groupRef} position={position} rotation={rotation} scale={scale}>
      <BuildingComponent />
    </group>
  );
}

/**
 * Restaurant - Low building with peaked roof and awning
 */
function Restaurant() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';

  return (
    <group>
      {/* Main building body */}
      <mesh position={[0, 1, 0]}>
        <boxGeometry args={[4, 2, 3]} />
        <meshStandardMaterial color={mainColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Peaked roof */}
      <mesh position={[0, 2.5, 0]}>
        <coneGeometry args={[2.5, 1.5, 4]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Front awning */}
      <mesh position={[0, 1.8, 1.8]} rotation={[-0.3, 0, 0]}>
        <boxGeometry args={[3.5, 0.1, 1]} />
        <meshStandardMaterial color={accentColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Outdoor seating area (tables) */}
      {[-1, 1].map((x, i) => (
        <group key={i} position={[x, 0.3, 2.5]}>
          <mesh position={[0, 0.2, 0]}>
            <cylinderGeometry args={[0.3, 0.3, 0.05, 8]} />
            <meshStandardMaterial color={mainColor} />
          </mesh>
          <mesh position={[0, 0, 0]}>
            <cylinderGeometry args={[0.05, 0.05, 0.4, 6]} />
            <meshStandardMaterial color={mainColor} />
          </mesh>
        </group>
      ))}

      {/* Door */}
      <mesh position={[0, 0.7, 1.51]}>
        <boxGeometry args={[0.8, 1.4, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.3} />
      </mesh>

      {/* Windows */}
      {[-1.2, 1.2].map((x, i) => (
        <mesh key={i} position={[x, 1.2, 1.51]}>
          <boxGeometry args={[0.6, 0.8, 0.05]} />
          <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.2} />
        </mesh>
      ))}

      {/* Wireframe outline */}
      <lineSegments position={[0, 1, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(4, 2, 3)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * Office Building - Multi-story tower with window grid
 */
function OfficeBuilding() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';
  const floors = 6;

  return (
    <group>
      {/* Main tower */}
      <mesh position={[0, 3, 0]}>
        <boxGeometry args={[3, 6, 2.5]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Window grid */}
      {Array.from({ length: floors }).map((_, floor) =>
        Array.from({ length: 3 }).map((_, col) => (
          <mesh key={`${floor}-${col}`} position={[(col - 1) * 0.8, floor * 0.9 + 0.8, 1.26]}>
            <boxGeometry args={[0.5, 0.6, 0.05]} />
            <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.15} />
          </mesh>
        ))
      )}

      {/* Entrance */}
      <mesh position={[0, 0.8, 1.26]}>
        <boxGeometry args={[1, 1.6, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.3} />
      </mesh>

      {/* Roof detail */}
      <mesh position={[0, 6.2, 0]}>
        <boxGeometry args={[2.5, 0.4, 2]} />
        <meshStandardMaterial color={mainColor} metalness={0.5} roughness={0.5} />
      </mesh>

      {/* Antenna */}
      <mesh position={[0.8, 7, 0]}>
        <cylinderGeometry args={[0.03, 0.03, 1.5, 6]} />
        <meshStandardMaterial color={mainColor} />
      </mesh>

      {/* Wireframe outline */}
      <lineSegments position={[0, 3, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(3, 6, 2.5)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * Factory - Industrial complex with smokestacks
 */
function Factory() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';

  return (
    <group>
      {/* Main building */}
      <mesh position={[0, 1.5, 0]}>
        <boxGeometry args={[6, 3, 4]} />
        <meshStandardMaterial color={mainColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Roof section (sawtooth pattern) */}
      {[-1.5, 0, 1.5].map((x, i) => (
        <mesh key={i} position={[x, 3.4, 0]} rotation={[0, 0, Math.PI / 4]}>
          <boxGeometry args={[1.2, 1.2, 3.8]} />
          <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
        </mesh>
      ))}

      {/* Smokestacks */}
      {[[-2, 4, -1], [2.2, 5, -1.2]].map(([x, y, z], i) => (
        <group key={i} position={[x, 0, z]}>
          <mesh position={[0, y / 2, 0]}>
            <cylinderGeometry args={[0.25, 0.35, y, 8]} />
            <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
          </mesh>
          <mesh position={[0, y, 0]}>
            <cylinderGeometry args={[0.35, 0.25, 0.2, 8]} />
            <meshStandardMaterial color={mainColor} />
          </mesh>
        </group>
      ))}

      {/* Loading dock */}
      <mesh position={[0, 0.3, 2.3]}>
        <boxGeometry args={[4, 0.6, 0.5]} />
        <meshStandardMaterial color={mainColor} />
      </mesh>

      {/* Large windows/doors */}
      {[-1.5, 1.5].map((x, i) => (
        <mesh key={i} position={[x, 1.2, 2.01]}>
          <boxGeometry args={[1.5, 2, 0.05]} />
          <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.3} />
        </mesh>
      ))}

      {/* Wireframe outline */}
      <lineSegments position={[0, 1.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(6, 3, 4)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * Shop - Small retail building with awning and display window
 */
function Shop() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';

  return (
    <group>
      {/* Main building */}
      <mesh position={[0, 1, 0]}>
        <boxGeometry args={[2.5, 2, 2]} />
        <meshStandardMaterial color={mainColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Awning */}
      <mesh position={[0, 1.8, 1.2]} rotation={[-0.2, 0, 0]}>
        <boxGeometry args={[2.8, 0.08, 0.8]} />
        <meshStandardMaterial color={accentColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Large display window */}
      <mesh position={[0, 0.8, 1.01]}>
        <boxGeometry args={[1.8, 1.2, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.35} />
      </mesh>

      {/* Door */}
      <mesh position={[0.9, 0.7, 1.01]}>
        <boxGeometry args={[0.5, 1.4, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.25} />
      </mesh>

      {/* Sign box on top */}
      <mesh position={[0, 2.2, 0.3]}>
        <boxGeometry args={[2, 0.4, 0.1]} />
        <meshStandardMaterial color={mainColor} emissive={accentColor} emissiveIntensity={0.15} />
      </mesh>

      {/* Wireframe outline */}
      <lineSegments position={[0, 1, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(2.5, 2, 2)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * Apartment - Multi-story residential with balconies
 */
function Apartment() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';
  const floors = 5;

  return (
    <group>
      {/* Main building */}
      <mesh position={[0, 2.5, 0]}>
        <boxGeometry args={[3.5, 5, 3]} />
        <meshStandardMaterial color={mainColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Balconies */}
      {[1, 2.2, 3.4, 4.6].map((y, i) => (
        <mesh key={i} position={[0, y, 1.7]}>
          <boxGeometry args={[3.2, 0.1, 0.6]} />
          <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
        </mesh>
      ))}

      {/* Windows - grid pattern */}
      {Array.from({ length: floors }).map((_, floor) =>
        Array.from({ length: 3 }).map((_, col) => (
          <mesh key={`${floor}-${col}`} position={[(col - 1) * 0.9, floor * 0.9 + 0.7, 1.51]}>
            <boxGeometry args={[0.5, 0.55, 0.05]} />
            <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.2} />
          </mesh>
        ))
      )}

      {/* Roof detail */}
      <mesh position={[0, 5.15, 0]}>
        <boxGeometry args={[3.8, 0.3, 3.3]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Entrance */}
      <mesh position={[0, 0.6, 1.51]}>
        <boxGeometry args={[1, 1.2, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.3} />
      </mesh>

      {/* Wireframe outline */}
      <lineSegments position={[0, 2.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(3.5, 5, 3)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * Warehouse - Industrial storage with curved roof
 */
function Warehouse() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';

  return (
    <group>
      {/* Main structure */}
      <mesh position={[0, 1.5, 0]}>
        <boxGeometry args={[5, 3, 4]} />
        <meshStandardMaterial color={mainColor} metalness={0.3} roughness={0.7} />
      </mesh>

      {/* Curved roof (half cylinder) */}
      <mesh position={[0, 3.2, 0]} rotation={[0, 0, Math.PI / 2]}>
        <cylinderGeometry args={[2.2, 2.2, 5, 12, 1, false, 0, Math.PI]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Loading bay doors */}
      {[-1.3, 1.3].map((x, i) => (
        <mesh key={i} position={[x, 1, 2.01]}>
          <boxGeometry args={[1.4, 2, 0.05]} />
          <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.25} />
        </mesh>
      ))}

      {/* Loading platform */}
      <mesh position={[0, 0.25, 2.3]}>
        <boxGeometry args={[4.5, 0.5, 0.6]} />
        <meshStandardMaterial color={mainColor} />
      </mesh>

      {/* Small office section */}
      <mesh position={[-2, 1.8, 1.5]}>
        <boxGeometry args={[1, 1.6, 1]} />
        <meshStandardMaterial color={mainColor} />
      </mesh>

      {/* Office window */}
      <mesh position={[-2, 1.8, 2.01]}>
        <boxGeometry args={[0.6, 0.5, 0.05]} />
        <meshStandardMaterial color={accentColor} emissive={accentColor} emissiveIntensity={0.3} />
      </mesh>

      {/* Wireframe outline */}
      <lineSegments position={[0, 1.5, 0]}>
        <edgesGeometry args={[new THREE.BoxGeometry(5, 3, 4)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

/**
 * FerrisWheel - London Eye style observation wheel
 * SOLID colors - highly visible
 */
function FerrisWheel() {
  const mainColor = '#007AFF';
  const accentColor = '#64D2FF';
  const wheelRef = useRef();
  const capsuleCount = 24;
  const wheelRadius = 8;

  useFrame((state) => {
    if (wheelRef.current) {
      wheelRef.current.rotation.z = state.clock.elapsedTime * 0.02;
    }
  });

  return (
    <group>
      {/* Main support structure - A-frame legs */}
      <mesh position={[-1.5, 4.5, 0]} rotation={[0, 0, 0.2]}>
        <boxGeometry args={[0.6, 11, 0.6]} />
        <meshStandardMaterial color={mainColor} metalness={0.5} roughness={0.5} />
      </mesh>
      <mesh position={[1.5, 4.5, 0]} rotation={[0, 0, -0.2]}>
        <boxGeometry args={[0.6, 11, 0.6]} />
        <meshStandardMaterial color={mainColor} metalness={0.5} roughness={0.5} />
      </mesh>

      {/* Cross braces */}
      <mesh position={[0, 3, 0]}>
        <boxGeometry args={[2.5, 0.3, 0.3]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>
      <mesh position={[0, 6, 0]}>
        <boxGeometry args={[2, 0.25, 0.25]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Central hub */}
      <mesh position={[0, 9, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <cylinderGeometry args={[1.2, 1.2, 1, 16]} />
        <meshStandardMaterial color={mainColor} metalness={0.6} roughness={0.4} />
      </mesh>

      {/* Rotating wheel group */}
      <group ref={wheelRef} position={[0, 9, 0]}>
        {/* Outer rim - thick torus */}
        <mesh rotation={[Math.PI / 2, 0, 0]}>
          <torusGeometry args={[wheelRadius, 0.25, 8, 48]} />
          <meshStandardMaterial color={mainColor} metalness={0.5} roughness={0.5} />
        </mesh>

        {/* Inner rim */}
        <mesh rotation={[Math.PI / 2, 0, 0]}>
          <torusGeometry args={[wheelRadius * 0.75, 0.15, 8, 48]} />
          <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
        </mesh>

        {/* Spokes */}
        {Array.from({ length: capsuleCount }).map((_, i) => {
          const angle = (i / capsuleCount) * Math.PI * 2;
          const midX = Math.cos(angle) * (wheelRadius / 2);
          const midY = Math.sin(angle) * (wheelRadius / 2);
          return (
            <mesh
              key={`spoke-${i}`}
              position={[midX, midY, 0]}
              rotation={[0, 0, angle + Math.PI / 2]}
            >
              <boxGeometry args={[0.12, wheelRadius, 0.12]} />
              <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
            </mesh>
          );
        })}

        {/* Passenger capsules */}
        {Array.from({ length: capsuleCount }).map((_, i) => {
          const angle = (i / capsuleCount) * Math.PI * 2;
          const x = Math.cos(angle) * wheelRadius;
          const y = Math.sin(angle) * wheelRadius;
          return (
            <group key={`capsule-${i}`} position={[x, y, 0]}>
              <mesh>
                <sphereGeometry args={[0.5, 12, 8]} />
                <meshStandardMaterial
                  color={accentColor}
                  emissive={accentColor}
                  emissiveIntensity={0.3}
                  metalness={0.3}
                  roughness={0.7}
                />
              </mesh>
            </group>
          );
        })}
      </group>

      {/* Base platform */}
      <mesh position={[0, 0.2, 0]}>
        <boxGeometry args={[6, 0.4, 3]} />
        <meshStandardMaterial color={mainColor} metalness={0.4} roughness={0.6} />
      </mesh>

      {/* Wireframe outline for wheel */}
      <lineSegments position={[0, 9, 0]} rotation={[Math.PI / 2, 0, 0]}>
        <edgesGeometry args={[new THREE.TorusGeometry(wheelRadius, 0.25, 8, 48)]} />
        <lineBasicMaterial color="#FFFFFF" />
      </lineSegments>
    </group>
  );
}

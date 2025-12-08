import { useMemo } from 'react';
import { GlassFrame } from './GlassPanel';

/**
 * Room Portals - Glass portal frames at section transitions
 * Camera flies through these creating dramatic spatial transitions
 *
 * Positioned at key Z depths matching content sections:
 * - Z=12: Benefits section transition
 * - Z=28: Sectors section transition
 * - Z=42: Demo section transition
 */
export function RoomPortals() {
  const portalConfigs = useMemo(() => [
    {
      z: 12,
      frameWidth: 14,
      frameHeight: 9,
      opacity: 0.1,
      label: 'benefits'
    },
    {
      z: 28,
      frameWidth: 16,
      frameHeight: 10,
      opacity: 0.08,
      label: 'sectors'
    },
    {
      z: 42,
      frameWidth: 18,
      frameHeight: 11,
      opacity: 0.06,
      label: 'demo'
    }
  ], []);

  return (
    <group>
      {portalConfigs.map((portal, i) => (
        <GlassFrame
          key={portal.label}
          position={[0, 0, portal.z]}
          frameWidth={portal.frameWidth}
          frameHeight={portal.frameHeight}
          opacity={portal.opacity}
          thickness={0.6 + i * 0.1}
        />
      ))}
    </group>
  );
}

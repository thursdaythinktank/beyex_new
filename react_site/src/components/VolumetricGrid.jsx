import { useScrollProgress } from '../hooks/useScrollProgress';

/**
 * Isometric grid background that warps subtly with scroll
 * Creates spatial awareness without distraction
 */
export function VolumetricGrid() {
  const { scrollProgress } = useScrollProgress();

  // Calculate warp based on scroll
  const skewY = scrollProgress * 2;
  const scale = 1 + scrollProgress * 0.05;

  return (
    <div className="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
      <svg className="w-full h-full text-apple-gray-900" style={{ opacity: 0.03 }}>
        <defs>
          <pattern
            id="volumetric-grid"
            width="40"
            height="40"
            patternUnits="userSpaceOnUse"
          >
            <path
              d="M 40 0 L 0 0 0 40"
              fill="none"
              stroke="currentColor"
              strokeWidth="0.5"
              style={{
                transform: `skewY(${skewY}deg) scale(${scale})`,
                transformOrigin: 'center',
              }}
            />
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#volumetric-grid)" />
      </svg>
    </div>
  );
}

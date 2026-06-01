/**
 * StaticBackground - Clean gradient fallback for mobile/low-capability devices
 * Modern, minimal design that loads instantly
 */
export function StaticBackground() {
  return (
    <div className="fixed inset-0 z-0 overflow-hidden pointer-events-none">
      {/* Modern gradient background */}
      <div
        className="absolute inset-0"
        style={{
          background: `
            linear-gradient(180deg,
              #f8fafc 0%,
              #f1f5f9 25%,
              #e2e8f0 50%,
              #f1f5f9 75%,
              #ffffff 100%
            )
          `,
        }}
      />

      {/* Subtle blue accent orb - top right */}
      <div
        className="absolute -top-32 -right-32 w-96 h-96 rounded-full opacity-20"
        style={{
          background: 'radial-gradient(circle, #007AFF 0%, transparent 70%)',
        }}
      />

      {/* Subtle blue accent orb - bottom left */}
      <div
        className="absolute -bottom-48 -left-48 w-[500px] h-[500px] rounded-full opacity-10"
        style={{
          background: 'radial-gradient(circle, #007AFF 0%, transparent 70%)',
        }}
      />

      {/* Very subtle noise texture overlay for depth */}
      <div
        className="absolute inset-0 opacity-[0.02]"
        style={{
          backgroundImage: `url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E")`,
        }}
      />
    </div>
  );
}

/**
 * StaticBackground - SVG fallback for mobile/low-capability devices
 * Stylized London skyline matching the WebGL scene aesthetic
 * Elements positioned to be visible in hero area
 */
export function StaticBackground() {
  return (
    <div className="fixed inset-0 z-0 overflow-hidden pointer-events-none">
      {/* Sky gradient background */}
      <div className="absolute inset-0 bg-gradient-to-b from-[#E8F4FC] via-[#F0F8FF] to-white" />

      {/* SVG Scene - positioned to show in hero viewport */}
      <svg
        className="absolute top-0 left-0 w-full"
        style={{ height: '100vh' }}
        viewBox="0 0 400 500"
        preserveAspectRatio="xMidYMax slice"
        xmlns="http://www.w3.org/2000/svg"
      >
        <defs>
          {/* Gradient for river */}
          <linearGradient id="riverGradient" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stopColor="#B8E0F7" />
            <stop offset="50%" stopColor="#9DD4F5" />
            <stop offset="100%" stopColor="#B8E0F7" />
          </linearGradient>

          {/* Building color */}
          <linearGradient id="buildingGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stopColor="#7EB8E5" />
            <stop offset="100%" stopColor="#5A8BC4" />
          </linearGradient>
        </defs>

        {/* Clouds - scattered across top */}
        <g opacity="0.6">
          <ellipse cx="50" cy="30" rx="35" ry="12" fill="#FFFFFF" />
          <ellipse cx="75" cy="27" rx="25" ry="9" fill="#FFFFFF" />
          <ellipse cx="330" cy="40" rx="40" ry="14" fill="#FFFFFF" />
          <ellipse cx="365" cy="36" rx="28" ry="10" fill="#FFFFFF" />
          <ellipse cx="200" cy="22" rx="30" ry="10" fill="#FFFFFF" />
        </g>

        {/* Hot Air Balloon - left */}
        <g transform="translate(50, 80)">
          <ellipse cx="0" cy="0" rx="18" ry="24" fill="#7AB8E8" stroke="#FFFFFF" strokeWidth="1.5" />
          <path d="M-7 21 L-4 34 L4 34 L7 21" fill="#6BA3E0" stroke="#FFFFFF" strokeWidth="1" />
          <rect x="-5" y="34" width="10" height="8" fill="#5A8BC4" stroke="#FFFFFF" strokeWidth="1" />
        </g>

        {/* Hot Air Balloon - right */}
        <g transform="translate(355, 65)">
          <ellipse cx="0" cy="0" rx="14" ry="19" fill="#6BA3E0" stroke="#FFFFFF" strokeWidth="1.5" />
          <path d="M-6 17 L-3 28 L3 28 L6 17" fill="#5A8BC4" stroke="#FFFFFF" strokeWidth="1" />
          <rect x="-4" y="28" width="8" height="6" fill="#4A7BB8" stroke="#FFFFFF" strokeWidth="1" />
        </g>

        {/* London Eye - right side */}
        <g transform="translate(310, 220)">
          {/* Support structure */}
          <line x1="-24" y1="80" x2="0" y2="0" stroke="#4A90D9" strokeWidth="3.5" />
          <line x1="24" y1="80" x2="0" y2="0" stroke="#4A90D9" strokeWidth="3.5" />
          <line x1="-14" y1="52" x2="14" y2="52" stroke="#4A90D9" strokeWidth="2" />

          {/* Outer wheel */}
          <circle cx="0" cy="0" r="62" fill="none" stroke="#4A90D9" strokeWidth="2.5" />
          {/* Inner wheel */}
          <circle cx="0" cy="0" r="40" fill="none" stroke="#7EB8E5" strokeWidth="1.5" opacity="0.5" />

          {/* Spokes */}
          {[...Array(12)].map((_, i) => {
            const angle = (i * 360) / 12;
            const rad = (angle * Math.PI) / 180;
            const x2 = Math.cos(rad) * 62;
            const y2 = Math.sin(rad) * 62;
            return (
              <line
                key={i}
                x1="0"
                y1="0"
                x2={x2}
                y2={y2}
                stroke="#4A90D9"
                strokeWidth="1"
                opacity="0.7"
              />
            );
          })}

          {/* Capsules */}
          {[...Array(12)].map((_, i) => {
            const angle = (i * 360) / 12;
            const rad = (angle * Math.PI) / 180;
            const cx = Math.cos(rad) * 62;
            const cy = Math.sin(rad) * 62;
            return (
              <rect
                key={i}
                x={cx - 4}
                y={cy - 5}
                width="8"
                height="10"
                rx="2"
                fill="#B8E0F7"
                stroke="#FFFFFF"
                strokeWidth="1"
                opacity="0.9"
              />
            );
          })}

          {/* Hub */}
          <circle cx="0" cy="0" r="6" fill="#4A90D9" stroke="#FFFFFF" strokeWidth="1.5" />
        </g>

        {/* Big Ben / Parliament - left side */}
        <g transform="translate(70, 180)">
          {/* Clock Tower */}
          <rect x="0" y="0" width="24" height="100" fill="#5A8BC4" stroke="#FFFFFF" strokeWidth="1.5" />

          {/* Spire */}
          <polygon points="12,-20 0,0 24,0" fill="#4A7BB8" stroke="#FFFFFF" strokeWidth="1" />

          {/* Clock face */}
          <circle cx="12" cy="30" r="8" fill="#E8F4FC" stroke="#7EB8E5" strokeWidth="1.5" />
          <line x1="12" y1="30" x2="12" y2="25" stroke="#4A90D9" strokeWidth="1.5" />
          <line x1="12" y1="30" x2="16" y2="28" stroke="#4A90D9" strokeWidth="1" />

          {/* Main Parliament building */}
          <rect x="24" y="40" width="68" height="60" fill="url(#buildingGradient)" stroke="#FFFFFF" strokeWidth="1.5" />

          {/* Gothic peaks */}
          {[...Array(4)].map((_, i) => (
            <polygon
              key={i}
              points={`${32 + i * 16},40 ${24 + i * 16},27 ${40 + i * 16},40`}
              fill="#4A7BB8"
              stroke="#FFFFFF"
              strokeWidth="1"
            />
          ))}
        </g>

        {/* Brewhouse - center left */}
        <g transform="translate(20, 265)">
          {/* Main building */}
          <rect x="0" y="16" width="58" height="40" fill="#D4A84B" stroke="#FFFFFF" strokeWidth="1.5" />

          {/* Sloped roof */}
          <polygon points="0,16 29,0 58,16" fill="#4A5568" stroke="#FFFFFF" strokeWidth="1" />

          {/* Windows */}
          <rect x="7" y="25" width="10" height="12" fill="#87CEEB" stroke="#2D3748" strokeWidth="1" />
          <rect x="24" y="25" width="10" height="12" fill="#87CEEB" stroke="#2D3748" strokeWidth="1" />
          <rect x="41" y="25" width="10" height="12" fill="#87CEEB" stroke="#2D3748" strokeWidth="1" />

          {/* Door */}
          <rect x="24" y="44" width="10" height="12" fill="#2D3748" />

          {/* Chimney */}
          <rect x="42" y="-5" width="6" height="12" fill="#C49A3F" stroke="#FFFFFF" strokeWidth="1" />
        </g>

        {/* Thames River */}
        <path
          d="M0 310 Q100 300 200 308 Q300 316 400 305 L400 345 Q300 355 200 347 Q100 339 0 350 Z"
          fill="url(#riverGradient)"
          opacity="0.8"
        />

        {/* Westminster Bridge */}
        <g transform="translate(110, 302)">
          <rect x="0" y="0" width="110" height="6" fill="#5A8BC4" />
          {[...Array(3)].map((_, i) => (
            <g key={i} transform={`translate(${15 + i * 40}, 6)`}>
              <rect x="0" y="0" width="5" height="12" fill="#4A7BB8" />
              <path d="M-6 12 Q4 20 14 12" fill="none" stroke="#5A8BC4" strokeWidth="3" />
            </g>
          ))}
        </g>

        {/* Additional buildings for depth */}
        <g transform="translate(165, 250)">
          <rect x="0" y="25" width="40" height="52" fill="#7BA8D4" stroke="#FFFFFF" strokeWidth="1" opacity="0.5" />
          <rect x="48" y="38" width="30" height="39" fill="#6B9BC8" stroke="#FFFFFF" strokeWidth="1" opacity="0.4" />
        </g>

        {/* Foreground buildings - left */}
        <g transform="translate(6, 345)">
          <rect x="0" y="12" width="26" height="60" fill="#7BA8D4" stroke="#FFFFFF" strokeWidth="1" opacity="0.6" />
          <polygon points="13,2 0,12 26,12" fill="#6B9BC8" stroke="#FFFFFF" strokeWidth="1" opacity="0.6" />

          <rect x="32" y="24" width="22" height="48" fill="#5A8BC4" stroke="#FFFFFF" strokeWidth="1" opacity="0.5" />
        </g>

        {/* Foreground buildings - right */}
        <g transform="translate(330, 350)">
          <rect x="0" y="10" width="30" height="55" fill="#7BA8D4" stroke="#FFFFFF" strokeWidth="1" opacity="0.5" />
          <rect x="36" y="22" width="26" height="43" fill="#5A8BC4" stroke="#FFFFFF" strokeWidth="1" opacity="0.4" />
        </g>

        {/* Subtle wireframe grid */}
        <g opacity="0.025" stroke="#4A90D9" strokeWidth="0.5" fill="none">
          {[...Array(10)].map((_, i) => (
            <line key={`h${i}`} x1="0" y1={i * 50} x2="400" y2={i * 50} />
          ))}
          {[...Array(8)].map((_, i) => (
            <line key={`v${i}`} x1={i * 50} y1="0" x2={i * 50} y2="500" />
          ))}
        </g>
      </svg>
    </div>
  );
}

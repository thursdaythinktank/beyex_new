import { useState, useEffect, useRef, useMemo } from 'react';
import { Canvas, useFrame, useThree } from '@react-three/fiber';
import * as THREE from 'three';
import { TOURS } from '../../data/tours';

/**
 * Scan Resolve — the redesign's signature set-piece (PROTOTYPE).
 *
 * A pinned scroll section: a cloud of measured points knits itself into a
 * walkable space as you scroll (scatter → assembled room + CTA), then offers
 * a clearly separate "walk a finished example" step that loads a real,
 * already-public Matterport tour (unmounting WebGL the moment the iframe
 * goes interactive).
 *
 * IMPORTANT framing: the point cloud is ILLUSTRATIVE and generic. It is a
 * PROCEDURAL room (~19k generated points), not a named client's scan, and is
 * never labelled as one. The only real, named example is the walkthrough tour
 * behind the CTA.
 *
 * Perf budget: 2 draw calls (one <points>, one <lineSegments>), no lights,
 * scroll progress via refs/uniforms only — React never re-renders on scroll.
 */

// Real, already-public example tour — used ONLY at the "walk a finished
// example" CTA, never attached to the illustrative point cloud above it.
const WALK_TOUR = TOURS.brewhouse;

// ---------------------------------------------------------------------------
// Procedural stand-in scan: a taproom sampled as a point cloud
// ---------------------------------------------------------------------------

function pushPoint(arrays, x, y, z, r, g, b) {
  arrays.targets.push(x, y, z);
  // Start position: scattered on a large rough sphere around the room
  const theta = Math.random() * Math.PI * 2;
  const phi = Math.acos(2 * Math.random() - 1);
  const rad = 18 + Math.random() * 14;
  arrays.starts.push(
    Math.sin(phi) * Math.cos(theta) * rad,
    Math.abs(Math.cos(phi)) * rad * 0.7 + 2,
    Math.sin(phi) * Math.sin(theta) * rad
  );
  const shade = 0.85 + Math.random() * 0.3;
  arrays.colors.push(r * shade, g * shade, b * shade);
  arrays.seeds.push(Math.random());
}

function samplePlane(arrays, origin, u, v, nu, nv, color, jitter = 0.03) {
  for (let i = 0; i <= nu; i++) {
    for (let j = 0; j <= nv; j++) {
      const fu = i / nu;
      const fv = j / nv;
      pushPoint(
        arrays,
        origin[0] + u[0] * fu + v[0] * fv + (Math.random() - 0.5) * jitter,
        origin[1] + u[1] * fu + v[1] * fv + (Math.random() - 0.5) * jitter,
        origin[2] + u[2] * fu + v[2] * fv + (Math.random() - 0.5) * jitter,
        ...color
      );
    }
  }
}

function sampleBox(arrays, cx, cy, cz, w, h, d, density, color) {
  // Top + 4 sides (no bottom — scanners don't see it either)
  const nu = Math.round(w * density);
  const nv = Math.round(d * density);
  const nh = Math.round(h * density);
  samplePlane(arrays, [cx - w / 2, cy + h / 2, cz - d / 2], [w, 0, 0], [0, 0, d], nu, nv, color);
  samplePlane(arrays, [cx - w / 2, cy - h / 2, cz - d / 2], [w, 0, 0], [0, h, 0], nu, nh, color);
  samplePlane(arrays, [cx - w / 2, cy - h / 2, cz + d / 2], [w, 0, 0], [0, h, 0], nu, nh, color);
  samplePlane(arrays, [cx - w / 2, cy - h / 2, cz - d / 2], [0, 0, d], [0, h, 0], nv, nh, color);
  samplePlane(arrays, [cx + w / 2, cy - h / 2, cz - d / 2], [0, 0, d], [0, h, 0], nv, nh, color);
}

function sampleDisc(arrays, cx, cy, cz, radius, n, color) {
  for (let i = 0; i < n; i++) {
    const a = Math.random() * Math.PI * 2;
    const r = Math.sqrt(Math.random()) * radius;
    pushPoint(arrays, cx + Math.cos(a) * r, cy, cz + Math.sin(a) * r, ...color);
  }
}

function sampleColumn(arrays, cx, cy0, cy1, radius, n, color) {
  for (let i = 0; i < n; i++) {
    const a = Math.random() * Math.PI * 2;
    const y = cy0 + Math.random() * (cy1 - cy0);
    pushPoint(arrays, cx[0] + Math.cos(a) * radius, y, cx[1] + Math.sin(a) * radius, ...color);
  }
}

// Palette (0-1 rgb): scan blues + one warm accent for the bar
const C_FLOOR = [0.22, 0.34, 0.48];
const C_WALL = [0.42, 0.56, 0.72];
const C_BEAM = [0.3, 0.42, 0.56];
const C_BAR = [0.85, 0.62, 0.32];
const C_TABLE = [0.55, 0.68, 0.82];

function generateRoomPoints() {
  const arrays = { targets: [], starts: [], colors: [], seeds: [] };

  // Room shell: 12m x 8m, 3.5m high
  samplePlane(arrays, [-6, 0, -4], [12, 0, 0], [0, 0, 8], 95, 65, C_FLOOR); // floor
  samplePlane(arrays, [-6, 0, -4], [12, 0, 0], [0, 3.5, 0], 85, 26, C_WALL); // back wall
  samplePlane(arrays, [-6, 0, -4], [0, 0, 8], [0, 3.5, 0], 55, 26, C_WALL); // left wall
  samplePlane(arrays, [6, 0, -4], [0, 0, 8], [0, 3.5, 0], 55, 26, C_WALL); // right wall

  // Bar counter along the back-left, with a warm top
  sampleBox(arrays, -3.5, 0.55, -3, 3, 1.1, 1, 14, C_BAR);
  // Back bar shelf
  sampleBox(arrays, -3.5, 1.4, -3.85, 3, 1.6, 0.25, 10, C_BEAM);

  // Round tables + centre columns + stools
  const tables = [
    [1.2, -1.2],
    [3.8, 1.2],
    [0.6, 2.2],
    [-2.5, 1.6],
  ];
  for (const [tx, tz] of tables) {
    sampleDisc(arrays, tx, 0.78, tz, 0.55, 420, C_TABLE);
    sampleColumn(arrays, [tx, tz], 0, 0.78, 0.06, 90, C_BEAM);
    for (let s = 0; s < 3; s++) {
      const a = (s / 3) * Math.PI * 2 + tx;
      sampleDisc(arrays, tx + Math.cos(a) * 0.95, 0.48, tz + Math.sin(a) * 0.95, 0.18, 70, C_BEAM);
    }
  }

  // Ceiling beams
  for (const bz of [-2.5, 0, 2.5]) {
    sampleBox(arrays, 0, 3.3, bz, 12, 0.25, 0.25, 7, C_BEAM);
  }

  // Pendant lights over the bar (bright points)
  for (const lx of [-4.5, -3.5, -2.5]) {
    sampleColumn(arrays, [lx, -3], 2.2, 3.3, 0.015, 25, C_WALL);
    sampleDisc(arrays, lx, 2.2, -3, 0.12, 60, [1.0, 0.9, 0.7]);
  }

  return {
    targets: new Float32Array(arrays.targets),
    starts: new Float32Array(arrays.starts),
    colors: new Float32Array(arrays.colors),
    seeds: new Float32Array(arrays.seeds),
    count: arrays.seeds.length,
  };
}

// Room edge lines for the "knit" phase
function generateRoomEdges() {
  const p = [];
  const line = (a, b) => p.push(...a, ...b);
  // Floor rectangle
  line([-6, 0, -4], [6, 0, -4]);
  line([6, 0, -4], [6, 0, 4]);
  line([6, 0, 4], [-6, 0, 4]);
  line([-6, 0, 4], [-6, 0, -4]);
  // Verticals + ceiling edges (back/left/right)
  for (const [x, z] of [[-6, -4], [6, -4], [-6, 4], [6, 4]]) {
    line([x, 0, z], [x, 3.5, z]);
  }
  line([-6, 3.5, -4], [6, 3.5, -4]);
  line([-6, 3.5, -4], [-6, 3.5, 4]);
  line([6, 3.5, -4], [6, 3.5, 4]);
  // Bar counter outline
  const bx0 = -5, bx1 = -2, bz0 = -3.5, bz1 = -2.5, bh = 1.1;
  line([bx0, bh, bz0], [bx1, bh, bz0]);
  line([bx1, bh, bz0], [bx1, bh, bz1]);
  line([bx1, bh, bz1], [bx0, bh, bz1]);
  line([bx0, bh, bz1], [bx0, bh, bz0]);
  for (const [x, z] of [[bx0, bz0], [bx1, bz0], [bx1, bz1], [bx0, bz1]]) {
    line([x, 0, z], [x, bh, z]);
  }
  return new Float32Array(p);
}

// ---------------------------------------------------------------------------
// WebGL internals
// ---------------------------------------------------------------------------

const VERT = /* glsl */ `
  attribute vec3 aStart;
  attribute vec3 aColor;
  attribute float aSeed;
  uniform float uProgress;
  uniform float uPixelRatio;
  varying vec3 vColor;
  varying float vT;

  void main() {
    // Per-point stagger: each point starts flying at seed*0.55 progress
    float t = clamp((uProgress - aSeed * 0.55) / 0.45, 0.0, 1.0);
    t = 1.0 - pow(1.0 - t, 3.0); // easeOutCubic

    // Gentle swirl while in flight
    float swirl = (1.0 - t) * 1.5;
    vec3 flight = mix(aStart, position, t);
    float ca = cos(swirl), sa = sin(swirl);
    flight.xz = mat2(ca, -sa, sa, ca) * flight.xz;

    vColor = aColor;
    vT = t;
    vec4 mv = modelViewMatrix * vec4(flight, 1.0);
    gl_Position = projectionMatrix * mv;
    gl_PointSize = (1.4 + 1.6 * t) * uPixelRatio * (14.0 / max(1.0, -mv.z));
  }
`;

const FRAG = /* glsl */ `
  varying vec3 vColor;
  varying float vT;

  void main() {
    vec2 c = gl_PointCoord - 0.5;
    if (dot(c, c) > 0.25) discard;
    gl_FragColor = vec4(vColor, 0.25 + 0.75 * vT);
  }
`;

function PointRoom({ progressRef }) {
  const materialRef = useRef();
  const linesMatRef = useRef();
  const cloud = useMemo(generateRoomPoints, []);
  const edges = useMemo(generateRoomEdges, []);
  const camera = useThree((state) => state.camera);

  const uniforms = useMemo(
    () => ({
      uProgress: { value: 0 },
      uPixelRatio: { value: Math.min(window.devicePixelRatio, 1.5) },
    }),
    []
  );

  useFrame(() => {
    // Normalise so the room is fully assembled by ASSEMBLED_AT; the remaining
    // scroll is a settled hold under the CTA overlay.
    const a = Math.min(1, progressRef.current / ASSEMBLED_AT);
    uniforms.uProgress.value = a;

    // Knit lines fade in during the settle phase
    if (linesMatRef.current) {
      linesMatRef.current.opacity = THREE.MathUtils.smoothstep(a, 0.55, 0.9) * 0.5;
    }

    // Camera: slow orbit that settles into an interior three-quarter view
    const angle = -0.9 + a * 0.75;
    const radius = 16 - a * 6.5;
    const height = 7.5 - a * 5.2;
    camera.position.set(Math.sin(angle) * radius, height, Math.cos(angle) * radius);
    camera.lookAt(0, 1.1, -0.5);
  });

  return (
    <>
      <points frustumCulled={false}>
        <bufferGeometry>
          <bufferAttribute attach="attributes-position" array={cloud.targets} count={cloud.count} itemSize={3} />
          <bufferAttribute attach="attributes-aStart" array={cloud.starts} count={cloud.count} itemSize={3} />
          <bufferAttribute attach="attributes-aColor" array={cloud.colors} count={cloud.count} itemSize={3} />
          <bufferAttribute attach="attributes-aSeed" array={cloud.seeds} count={cloud.count} itemSize={1} />
        </bufferGeometry>
        <shaderMaterial
          ref={materialRef}
          vertexShader={VERT}
          fragmentShader={FRAG}
          uniforms={uniforms}
          transparent
          depthWrite={false}
        />
      </points>

      <lineSegments frustumCulled={false}>
        <bufferGeometry>
          <bufferAttribute attach="attributes-position" array={edges} count={edges.length / 3} itemSize={3} />
        </bufferGeometry>
        <lineBasicMaterial ref={linesMatRef} color="#8BB8E8" transparent opacity={0} />
      </lineSegments>
    </>
  );
}

// ---------------------------------------------------------------------------
// The pinned section
// ---------------------------------------------------------------------------

// Two phases: (0) scatter — points fly in; (1) assembled room + CTA overlay.
// A single caption carries phase 0; the CTA overlay handles phase 1.
const SCATTER_CAPTION = 'From millions of measured points, into a space you can walk.';
const ASSEMBLED_AT = 0.75; // scroll progress where the CTA overlay takes over

export function ScanResolve() {
  const wrapperRef = useRef(null);
  const [reducedMotion] = useState(
    () => window.matchMedia('(prefers-reduced-motion: reduce)').matches
  );
  const progressRef = useRef(reducedMotion ? 1 : 0);
  // phase 0 = scatter/assembling, phase 1 = assembled + CTA overlay
  const [phase, setPhase] = useState(reducedMotion ? 1 : 0);
  const [canvasActive, setCanvasActive] = useState(false);
  const [walking, setWalking] = useState(false);

  // Scroll → progress ref (no React state per scroll; phase state only flips
  // at the single threshold, i.e. a couple of renders per full scrub)
  useEffect(() => {
    if (reducedMotion) return;

    const onScroll = () => {
      const el = wrapperRef.current;
      if (!el) return;
      const rect = el.getBoundingClientRect();
      const total = el.offsetHeight - window.innerHeight;
      const p = THREE.MathUtils.clamp(-rect.top / Math.max(1, total), 0, 1);
      progressRef.current = p;

      const next = p >= ASSEMBLED_AT ? 1 : 0;
      setPhase((prev) => (prev === next ? prev : next));
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
    return () => window.removeEventListener('scroll', onScroll);
  }, [reducedMotion]);

  // Render loop only while the section is on screen
  useEffect(() => {
    const el = wrapperRef.current;
    if (!el || walking) return;
    const observer = new IntersectionObserver(
      ([entry]) => setCanvasActive(entry.isIntersecting),
      { rootMargin: '100px' }
    );
    observer.observe(el);
    return () => observer.disconnect();
  }, [walking]);

  return (
    <section
      ref={wrapperRef}
      className="relative bg-[#0d1620]"
      style={{ height: reducedMotion ? '100vh' : '200vh' }}
    >
      <div className="sticky top-0 h-screen overflow-hidden">
        {walking ? (
          /* GPU handoff: WebGL is unmounted the moment the tour goes live */
          <iframe
            src={WALK_TOUR.url}
            title={`${WALK_TOUR.name} — live 3D tour`}
            className="absolute inset-0 w-full h-full"
            frameBorder="0"
            allowFullScreen
            allow="xr-spatial-tracking"
          />
        ) : (
          <>
            <Canvas
              // 'demand' renders the single static final frame under reduced motion
              frameloop={reducedMotion ? 'demand' : canvasActive ? 'always' : 'never'}
              camera={{ position: [-12, 7.5, 10], fov: 55, near: 0.1, far: 120 }}
              gl={{ antialias: false, alpha: false, powerPreference: 'high-performance' }}
              dpr={[1, 1.5]}
              onCreated={({ scene }) => {
                scene.background = new THREE.Color('#0d1620');
              }}
            >
              <PointRoom progressRef={progressRef} />
            </Canvas>

            {/* Scatter caption (phase 0) — describes the illustrative cloud,
                no named client attached */}
            <div className="absolute inset-x-0 top-[12%] text-center px-6 pointer-events-none">
              <p
                className={`absolute inset-x-0 text-xl sm:text-2xl font-medium text-white/85 transition-opacity duration-700 ${
                  phase === 0 ? 'opacity-100' : 'opacity-0'
                }`}
              >
                {SCATTER_CAPTION}
              </p>
            </div>

            {/* Assembled overlay (phase 1) — the points are a generic space we
                captured; the real, named example lives behind the CTA */}
            <div
              className={`absolute inset-x-0 bottom-[14%] text-center px-6 transition-opacity duration-700 ${
                phase === 1 ? 'opacity-100' : 'opacity-0 pointer-events-none'
              }`}
            >
              <h2 className="text-4xl sm:text-5xl font-semibold text-white mb-3">
                A space you can walk.
              </h2>
              <p className="text-lg text-white/60 mb-8">
                This is how we turn a captured space into a 3D model. Step into a
                finished example next.
              </p>
              <button
                type="button"
                onClick={() => setWalking(true)}
                className="px-8 py-4 rounded-full bg-white text-apple-gray-900 font-semibold text-lg hover:bg-apple-blue-50 transition-colors shadow-2xl focus-visible:ring-4 focus-visible:ring-apple-blue-500"
              >
                Walk a finished space — {WALK_TOUR.name} →
              </button>
            </div>

            {/* Scroll hint */}
            <p
              className={`absolute inset-x-0 bottom-6 text-center text-white/40 text-sm transition-opacity duration-500 ${
                phase === 1 || reducedMotion ? 'opacity-0' : 'opacity-100'
              }`}
            >
              Keep scrolling
            </p>
          </>
        )}
      </div>
    </section>
  );
}

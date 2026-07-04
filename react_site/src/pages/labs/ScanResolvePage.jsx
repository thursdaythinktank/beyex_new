import { Link } from 'react-router-dom';
import { ScanResolve } from '../../components/labs/ScanResolve';
import { SEOHead } from '../../components/SEOHead';

/**
 * /labs/scan-resolve — private demo of the redesign's signature set-piece.
 *
 * Decision gate: the London cityscape does not get deleted until this
 * prototype has been seen and approved. Not linked from anywhere; noindex.
 */
export default function ScanResolvePage() {
  return (
    <div className="min-h-screen bg-[#0d1620]">
      <SEOHead
        title="Scan Resolve — Prototype | Beyex Labs"
        description="Internal prototype."
        noindex
      />

      {/* Minimal lab chrome */}
      <header className="px-6 py-5 flex items-center justify-between">
        <Link to="/" className="flex items-center gap-3">
          <img src="/logo.png" alt="Beyex" className="h-7 brightness-0 invert" width="67" height="28" />
          <span className="text-white/40 text-sm font-medium uppercase tracking-widest">Labs</span>
        </Link>
        <Link to="/" className="text-sm text-white/50 hover:text-white transition-colors">
          Back to site
        </Link>
      </header>

      <div className="max-w-2xl mx-auto px-6 py-16 text-white/70">
        <h1 className="text-3xl sm:text-4xl font-semibold text-white mb-6">
          Scan Resolve — prototype
        </h1>
        <p className="mb-4">
          This is the proposed signature moment for the homepage redesign: scroll down and a
          cloud of measured points knits itself into a walkable space, ending on the live tour.
        </p>
        <p className="mb-4">
          <strong className="text-white">What you're seeing is a stand-in.</strong> The room below
          is procedural — a taproom built from ~19,000 generated points. The production version
          replaces it with a real point cloud exported from your Matterport account (MatterPak),
          which is a data swap, not a rebuild. Before that: confirm MatterPak export rights for
          the Brewhouse capture.
        </p>
        <p className="mb-4">
          Perf: 2 draw calls, no lights, renders only while on screen, and the WebGL canvas is
          unmounted the instant the live tour loads. Under reduced-motion it shows a single
          static frame. Scroll-scrubbing runs through refs — no React renders while scrubbing.
        </p>
        <p className="text-white/50 text-sm">
          The decision this demo informs: replace the London cityscape with this set-piece
          (plus a static background) on the homepage. The cityscape stays until you approve.
        </p>
      </div>

      <ScanResolve />

      <div className="max-w-2xl mx-auto px-6 py-20 text-white/50 text-sm">
        <p>
          End of prototype. If the motion feels right, the next steps are: MatterPak licensing
          check → parse the real point cloud → pre-rendered frame-sequence variant for mobile →
          wire into the homepage and retire the cityscape.
        </p>
      </div>
    </div>
  );
}

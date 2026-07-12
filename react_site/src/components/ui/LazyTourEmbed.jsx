import { useState } from 'react';
import { TourEmbed } from './TourEmbed';

/**
 * Poster-first Matterport embed: shows the tour thumbnail with a load
 * affordance, and only mounts the (heavy) live iframe when the visitor
 * asks for it. Keeps content pages fast while still offering a real tour.
 */
export function LazyTourEmbed({ tour, className = '' }) {
  const [active, setActive] = useState(false);

  if (active) {
    return <TourEmbed src={tour.url} title={tour.name} className={className} />;
  }

  return (
    <button
      type="button"
      onClick={() => setActive(true)}
      className={`relative w-full rounded-xl overflow-hidden shadow-apple-lg group cursor-pointer block text-left focus-visible:ring-4 focus-visible:ring-apple-blue-500 ${className}`}
      style={{ aspectRatio: '16 / 9' }}
      aria-label={`Load the ${tour.name} 3D tour`}
    >
      <img
        src={tour.image}
        alt={`${tour.name} - 3D tour preview`}
        className="absolute inset-0 w-full h-full object-cover"
        width="1280"
        height="720"
        loading="lazy"
        decoding="async"
      />
      <div className="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition-colors" />

      {/* Always-visible affordance (touch-friendly) */}
      <div className="absolute inset-0 flex items-center justify-center">
        <span className="flex items-center gap-2 px-5 py-3 rounded-full bg-black/50 backdrop-blur-md border border-white/25 text-white font-medium group-hover:bg-apple-blue-500/80 transition-colors">
          <PlayIcon className="w-5 h-5" />
          Step inside in 3D
        </span>
      </div>

      {/* Name badge */}
      <span className="absolute top-4 left-4 px-3 py-1.5 rounded-full bg-black/40 backdrop-blur-md border border-white/20 text-white text-xs font-medium">
        {tour.name}
      </span>
    </button>
  );
}

function PlayIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <path d="M8 5v14l11-7z" />
    </svg>
  );
}

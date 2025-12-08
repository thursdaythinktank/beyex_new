import { motion } from 'framer-motion';

/**
 * Clickable tour card with thumbnail and hover overlay
 * Opens tour modal on click
 */
export function TourCard({ thumbnail, title, category, onClick }) {
  return (
    <motion.div
      className="relative cursor-pointer group rounded-2xl overflow-hidden aspect-video glass-liquid glass-specular glass-glow"
      onClick={onClick}
      whileHover={{ scale: 1.02 }}
      transition={{ duration: 0.3, type: 'spring', stiffness: 300 }}
    >
      <img
        src={thumbnail}
        alt={title}
        className="w-full h-full object-cover"
      />

      {/* Hover overlay */}
      <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <div className="absolute bottom-0 left-0 right-0 p-6">
          <div className="flex items-center gap-3 text-white">
            <PlayIcon className="w-12 h-12" />
            <div>
              <p className="text-sm font-medium opacity-80">{category}</p>
              <p className="text-lg font-semibold">View 3D Tour</p>
            </div>
          </div>
        </div>
      </div>
    </motion.div>
  );
}

function PlayIcon({ className }) {
  return (
    <svg className={className} fill="currentColor" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10" fill="white" opacity="0.2" />
      <path d="M8 5v14l11-7z" />
    </svg>
  );
}

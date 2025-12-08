import { useState } from 'react';
import { motion } from 'framer-motion';
import { use3DTransform } from '../../hooks/use3DTransform';

/**
 * Matterport 3D tour embed with volumetric entrance
 * Aspect ratio: 16:9
 */
export function TourEmbed({ src, title = '3D Virtual Tour', className = '' }) {
  const [isLoading, setIsLoading] = useState(true);
  const { transform, opacity, ref } = use3DTransform({
    rotateX: -5,
    rotateY: 2,
    translateZ: 30,
    scaleAmount: 0.05,
  });

  return (
    <motion.div
      ref={ref}
      className={`relative w-full rounded-xl overflow-hidden shadow-apple-lg ${className}`}
      style={{
        transform,
        opacity,
        aspectRatio: '16 / 9',
      }}
    >
      {isLoading && (
        <div className="absolute inset-0 bg-apple-gray-100 flex items-center justify-center">
          <div className="w-12 h-12 border-4 border-apple-blue-500 border-t-transparent rounded-full animate-spin"></div>
        </div>
      )}
      <iframe
        src={src}
        title={title}
        className="absolute inset-0 w-full h-full"
        frameBorder="0"
        allowFullScreen
        allow="xr-spatial-tracking"
        onLoad={() => setIsLoading(false)}
      />
    </motion.div>
  );
}

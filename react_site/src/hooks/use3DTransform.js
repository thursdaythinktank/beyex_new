import { useState, useEffect } from 'react';
import { useInView } from 'react-intersection-observer';

/**
 * Scroll-triggered 3D CSS transforms
 * Elements rotate and scale in 3D space as they enter/exit viewport
 */
export function use3DTransform(options = {}) {
  const {
    rotateX = 5,
    rotateY = 3,
    translateZ = 20,
    scaleAmount = 0.1,
  } = options;

  const [transform, setTransform] = useState({
    rotateX: 0,
    rotateY: 0,
    translateZ: 0,
    scale: 1,
    opacity: 0,
  });

  const { ref, inView, entry } = useInView({
    threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1],
    triggerOnce: false,
  });

  useEffect(() => {
    if (!entry) return;

    const calculateTransform = () => {
      const intersectionRatio = entry.intersectionRatio;
      const progress = intersectionRatio;

      setTransform({
        rotateX: progress * rotateX,
        rotateY: progress * rotateY,
        translateZ: progress * translateZ,
        scale: 1 + (progress * scaleAmount),
        opacity: progress,
      });
    };

    calculateTransform();
  }, [entry, rotateX, rotateY, translateZ, scaleAmount]);

  const transformString = `
    perspective(1000px)
    rotateX(${transform.rotateX}deg)
    rotateY(${transform.rotateY}deg)
    translateZ(${transform.translateZ}px)
    scale(${transform.scale})
  `.replace(/\s+/g, ' ').trim();

  return {
    transform: transformString,
    opacity: transform.opacity,
    ref,
    inView,
  };
}

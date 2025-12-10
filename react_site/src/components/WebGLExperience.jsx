import { useState, useEffect, useRef } from 'react';
import { Canvas } from '@react-three/fiber';
import { Scene } from './webgl/Scene';
import { useLenis } from '../hooks/useLenis';

/**
 * WebGL Experience wrapper
 * Canvas stops above GetStarted section, buildings partially visible
 */
export function WebGLExperience({ children }) {
  const [scrollData, setScrollData] = useState(null);
  const [canvasHeight, setCanvasHeight] = useState('100vh');
  const containerRef = useRef(null);

  // Initialize Lenis smooth scroll
  useLenis((data) => {
    setScrollData(data);
  });

  // Calculate canvas height to stop above #get-started section
  useEffect(() => {
    const calculateHeight = () => {
      const getStartedSection = document.getElementById('get-started');
      if (getStartedSection) {
        // Get the top position of GetStarted section
        const rect = getStartedSection.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const sectionTop = rect.top + scrollTop;
        // Set canvas height to stop 100px before GetStarted
        setCanvasHeight(`${sectionTop - 100}px`);
      }
    };

    // Calculate on mount and resize
    calculateHeight();
    window.addEventListener('resize', calculateHeight);

    // Recalculate after content loads
    const timer = setTimeout(calculateHeight, 500);

    return () => {
      window.removeEventListener('resize', calculateHeight);
      clearTimeout(timer);
    };
  }, []);

  return (
    <div className="min-h-screen" ref={containerRef}>
      {/* Background gradient layer */}
      <div className="fixed inset-0 z-0 bg-gradient-to-b from-apple-gray-50 via-white to-apple-gray-50 pointer-events-none" />

      {/* WebGL Canvas - renders on top of background, below content */}
      <div
        className="fixed top-0 left-0 right-0 z-[2] pointer-events-none overflow-hidden"
        style={{ height: canvasHeight }}
      >
        <Canvas
          camera={{
            position: [0, 15, -30],  // Start high up for 45-degree angle approach
            fov: 110,
            near: 0.1,
            far: 300,  // Extended for curved approach path
          }}
          gl={{
            antialias: true,
            alpha: true,
            powerPreference: 'high-performance',
          }}
          dpr={[1, 2]}
        >
          <Scene scrollData={scrollData} />
        </Canvas>

        {/* Fade out gradient at the bottom of canvas */}
        <div
          className="absolute bottom-0 left-0 right-0 h-48 pointer-events-none"
          style={{
            background: 'linear-gradient(to bottom, transparent, white)',
          }}
        />
      </div>

      {/* DOM Content - fully interactive */}
      <div className="relative z-10">
        {children}
      </div>
    </div>
  );
}

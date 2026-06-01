import { useState, useEffect, useRef, Component } from 'react';
import { Canvas } from '@react-three/fiber';
import { Scene } from './webgl/Scene';
import { useLenis } from '../hooks/useLenis';
import { useWebGLCapability } from '../hooks/useWebGLCapability';
import { StaticBackground } from './StaticBackground';

/**
 * Error Boundary to catch WebGL/Three.js crashes
 * Falls back to static background when errors occur
 */
class WebGLErrorBoundary extends Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false };
  }

  static getDerivedStateFromError() {
    return { hasError: true };
  }

  componentDidCatch(error, errorInfo) {
    // Log error for debugging (could send to error tracking service)
    console.warn('WebGL crashed, falling back to static background:', error.message);

    // Notify parent component
    if (this.props.onError) {
      this.props.onError(error, errorInfo);
    }
  }

  render() {
    if (this.state.hasError) {
      return this.props.fallback;
    }
    return this.props.children;
  }
}

/**
 * WebGL Experience wrapper
 * Canvas stops above GetStarted section, buildings partially visible
 * Falls back to static SVG on mobile/low-capability devices or on crash
 */
export function WebGLExperience({ children }) {
  const { checked, shouldUseFallback } = useWebGLCapability();
  const [scrollData, setScrollData] = useState(null);
  const [canvasHeight, setCanvasHeight] = useState('100vh');
  const [hasCrashed, setHasCrashed] = useState(false);
  const containerRef = useRef(null);
  const canvasRef = useRef(null);

  // Handle WebGL errors and crashes
  const handleWebGLError = (error) => {
    console.warn('WebGL error detected:', error?.message || error);
    setHasCrashed(true);
  };

  // Initialize Lenis smooth scroll (only when not using fallback and not crashed)
  useLenis((data) => {
    if (!shouldUseFallback && !hasCrashed) {
      setScrollData(data);
    }
  });

  // Listen for WebGL context loss (GPU crash, memory issues, etc.)
  useEffect(() => {
    if (shouldUseFallback || hasCrashed) return;

    const handleContextLost = (event) => {
      event.preventDefault();
      console.warn('WebGL context lost, falling back to static background');
      setHasCrashed(true);
    };

    const handleContextError = () => {
      console.warn('WebGL context creation error');
      setHasCrashed(true);
    };

    // Find canvas element and attach listeners
    const canvas = canvasRef.current?.querySelector('canvas');
    if (canvas) {
      canvas.addEventListener('webglcontextlost', handleContextLost);
      canvas.addEventListener('webglcontextcreationerror', handleContextError);

      return () => {
        canvas.removeEventListener('webglcontextlost', handleContextLost);
        canvas.removeEventListener('webglcontextcreationerror', handleContextError);
      };
    }
  }, [shouldUseFallback, hasCrashed]);

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

  // Show loading state until capability check completes
  if (!checked) {
    return (
      <div className="min-h-screen">
        <div className="fixed inset-0 z-0 bg-gradient-to-b from-apple-gray-50 via-white to-apple-gray-50" />
        <div className="relative z-10">{children}</div>
      </div>
    );
  }

  // Use static SVG fallback for mobile/low-capability devices or after crash
  if (shouldUseFallback || hasCrashed) {
    return (
      <div className="min-h-screen" ref={containerRef}>
        <StaticBackground />
        <div className="relative z-10">{children}</div>
      </div>
    );
  }

  // Full WebGL experience for capable devices
  return (
    <div className="min-h-screen" ref={containerRef}>
      {/* Background gradient layer */}
      <div className="fixed inset-0 z-0 bg-gradient-to-b from-apple-gray-50 via-white to-apple-gray-50 pointer-events-none" />

      {/* WebGL Canvas - renders on top of background, below content */}
      <div
        ref={canvasRef}
        className="fixed top-0 left-0 right-0 z-[2] pointer-events-none overflow-hidden"
        style={{ height: canvasHeight }}
      >
        <WebGLErrorBoundary
          onError={handleWebGLError}
          fallback={<StaticBackground />}
        >
          <Canvas
            camera={{
              position: [0, 15, -30],  // Start high up for 45-degree angle approach
              fov: 70,
              near: 0.1,
              far: 300,  // Extended for curved approach path
            }}
            gl={{
              antialias: true,
              alpha: true,
              powerPreference: 'high-performance',
              failIfMajorPerformanceCaveat: true, // Fail early if GPU is too weak
            }}
            onCreated={({ gl, scene }) => {
              // Only cap DPR if canvas would exceed GPU max texture size
              const maxSize = gl.capabilities.maxTextureSize || 4096;
              const canvas = gl.domElement;
              const maxDpr = maxSize / Math.max(canvas.clientWidth, canvas.clientHeight);
              if (window.devicePixelRatio > maxDpr) {
                gl.setPixelRatio(maxDpr);
              }

              // Additional runtime error handling
              gl.domElement.addEventListener('webglcontextlost', (e) => {
                e.preventDefault();
                handleWebGLError(new Error('WebGL context lost'));
              });
            }}
            dpr={[1, 2]}
          >
            <Scene scrollData={scrollData} />
          </Canvas>
        </WebGLErrorBoundary>

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

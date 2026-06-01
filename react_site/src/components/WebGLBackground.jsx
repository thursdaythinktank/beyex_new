import { useState, useEffect, useRef, Component } from 'react';
import { Canvas } from '@react-three/fiber';
import { Scene } from './webgl/Scene';
import { useLenis } from '../hooks/useLenis';
import { StaticBackground } from './StaticBackground';

/**
 * Error Boundary to catch WebGL/Three.js crashes
 */
class WebGLErrorBoundary extends Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false };
  }

  static getDerivedStateFromError() {
    return { hasError: true };
  }

  componentDidCatch(error) {
    console.warn('WebGL crashed, falling back to static background:', error.message);
    if (this.props.onError) {
      this.props.onError(error);
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
 * WebGL Background - renders only the 3D canvas as a fixed background layer
 * Content is rendered separately in the parent (not as children)
 */
export default function WebGLBackground() {
  const [scrollData, setScrollData] = useState(null);
  const [canvasHeight, setCanvasHeight] = useState('100vh');
  const [hasCrashed, setHasCrashed] = useState(false);
  const canvasRef = useRef(null);

  const handleWebGLError = (error) => {
    console.warn('WebGL error detected:', error?.message || error);
    setHasCrashed(true);
  };

  // Initialize Lenis smooth scroll
  useLenis((data) => {
    if (!hasCrashed) {
      setScrollData(data);
    }
  });

  // Listen for WebGL context loss
  useEffect(() => {
    if (hasCrashed) return;

    const handleContextLost = (event) => {
      event.preventDefault();
      console.warn('WebGL context lost, falling back to static background');
      setHasCrashed(true);
    };

    const canvas = canvasRef.current?.querySelector('canvas');
    if (canvas) {
      canvas.addEventListener('webglcontextlost', handleContextLost);
      return () => canvas.removeEventListener('webglcontextlost', handleContextLost);
    }
  }, [hasCrashed]);

  // Calculate canvas height to stop above #get-started section
  useEffect(() => {
    const calculateHeight = () => {
      const getStartedSection = document.getElementById('get-started');
      if (getStartedSection) {
        const rect = getStartedSection.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const sectionTop = rect.top + scrollTop;
        setCanvasHeight(`${sectionTop - 100}px`);
      }
    };

    calculateHeight();
    window.addEventListener('resize', calculateHeight);
    const timer = setTimeout(calculateHeight, 500);

    return () => {
      window.removeEventListener('resize', calculateHeight);
      clearTimeout(timer);
    };
  }, []);

  // If WebGL crashed, show static background
  if (hasCrashed) {
    return <StaticBackground />;
  }

  return (
    <>
      {/* Background gradient layer */}
      <div className="fixed inset-0 z-0 bg-gradient-to-b from-apple-gray-50 via-white to-apple-gray-50 pointer-events-none" />

      {/* WebGL Canvas */}
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
              position: [25, 120, -160],
              fov: 70,
              near: 0.1,
              far: 300,
            }}
            gl={{
              antialias: true,
              alpha: true,
              powerPreference: 'high-performance',
              failIfMajorPerformanceCaveat: true,
            }}
            onCreated={({ gl, scene }) => {
              // Only cap DPR if canvas would exceed GPU max texture size
              const maxSize = gl.capabilities.maxTextureSize || 4096;
              const canvas = gl.domElement;
              const maxDpr = maxSize / Math.max(canvas.clientWidth, canvas.clientHeight);
              if (window.devicePixelRatio > maxDpr) {
                gl.setPixelRatio(maxDpr);
              }

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

        {/* CSS vignette — replaces Three.js Vignette (which destroyed canvas alpha) */}
        <div
          className="absolute inset-0 pointer-events-none"
          style={{
            boxShadow: 'inset 0 0 150px 60px rgba(255,255,255,0.5)',
          }}
        />

        {/* Fade out gradient at the bottom of canvas */}
        <div
          className="absolute bottom-0 left-0 right-0 h-48 pointer-events-none"
          style={{
            background: 'linear-gradient(to bottom, transparent, white)',
          }}
        />
      </div>
    </>
  );
}

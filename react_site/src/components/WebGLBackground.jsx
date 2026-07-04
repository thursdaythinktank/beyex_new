import { useState, useEffect, useRef, Component } from 'react';
import { Canvas } from '@react-three/fiber';
import { Scene } from './webgl/Scene';
import { startScrollTracking } from '../hooks/scrollStore';
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
 * WebGL Background - renders only the 3D canvas as a fixed background layer.
 *
 * Scroll data flows through the transient scrollStore (a mutable module
 * object read inside useFrame), NOT React state — so scrolling never
 * re-renders the scene tree. The only scroll-driven state here is the
 * rarely-flipping frameloop gate.
 */
export default function WebGLBackground() {
  const [canvasHeight, setCanvasHeight] = useState('100vh');
  const [hasCrashed, setHasCrashed] = useState(false);
  // Render loop runs only while the canvas is actually in view; past the
  // canvas end (the get-started section covers the viewport) it pauses.
  const [frameloopActive, setFrameloopActive] = useState(true);
  const canvasHeightPx = useRef(Infinity);
  const canvasRef = useRef(null);

  const handleWebGLError = (error) => {
    console.warn('WebGL error detected:', error?.message || error);
    setHasCrashed(true);
  };

  // Feed the transient scroll store + maintain the frameloop gate.
  useEffect(() => {
    const stopTracking = startScrollTracking();

    const updateGate = () => {
      // 100px hysteresis so the gate doesn't flap at the boundary
      const y = window.scrollY;
      setFrameloopActive((prev) => {
        const limit = canvasHeightPx.current;
        if (prev && y > limit + 100) return false;
        if (!prev && y < limit - 100) return true;
        return prev;
      });
    };

    window.addEventListener('scroll', updateGate, { passive: true });
    updateGate();

    return () => {
      stopTracking();
      window.removeEventListener('scroll', updateGate);
    };
  }, []);

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
        canvasHeightPx.current = sectionTop - 100;
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
            frameloop={frameloopActive ? 'always' : 'never'}
            camera={{
              position: [25, 120, -160],
              fov: 70,
              near: 0.1,
              far: 300,
            }}
            gl={{
              // No MSAA: the scene is fog-softened and CSS-vignetted, so
              // antialiasing a background layer is wasted fragment work
              antialias: false,
              alpha: true,
              powerPreference: 'high-performance',
              failIfMajorPerformanceCaveat: true,
            }}
            onCreated={({ gl }) => {
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
            dpr={[1, 1.5]}
          >
            <Scene />
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

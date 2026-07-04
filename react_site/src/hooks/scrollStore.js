/**
 * Transient scroll store — written by a passive scroll listener, read inside
 * useFrame loops. Deliberately not React state: scrolling must never
 * re-render the WebGL scene tree.
 */
export const scrollStore = {
  progress: 0,
  direction: 0,
  // Written each frame by useScrollSync for other frame loops (lights, speed lines)
  velocity: 0,
  cameraZ: 0,
};

let subscribers = 0;
let lastY = 0;

function handleScroll() {
  const y = window.scrollY;
  const limit = document.documentElement.scrollHeight - window.innerHeight;
  scrollStore.direction = y > lastY ? 1 : -1;
  scrollStore.progress = limit > 0 ? y / limit : 0;
  lastY = y;
}

/**
 * Attach the shared scroll listener. Returns a cleanup function.
 * Safe to call from multiple components — one listener is shared.
 */
export function startScrollTracking() {
  if (subscribers === 0) {
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });
  }
  subscribers++;
  return () => {
    subscribers--;
    if (subscribers === 0) {
      window.removeEventListener('scroll', handleScroll);
    }
  };
}

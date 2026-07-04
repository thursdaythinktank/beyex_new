import { useState, useEffect, useRef, useCallback } from 'react';
import { createPortal } from 'react-dom';
import { motion, AnimatePresence } from 'framer-motion';

/**
 * Floating WhatsApp button - appears when user scrolls to GetStarted section
 * Modern, minimal design that doesn't distract from the experience
 */
export function FloatingWhatsApp() {
  const [isVisible, setIsVisible] = useState(false);
  const [portalContainer, setPortalContainer] = useState(null);
  const ticking = useRef(false);

  // Create portal container outside #root to fix position:fixed with perspective
  useEffect(() => {
    let container = document.getElementById('floating-buttons-portal');
    if (!container) {
      container = document.createElement('div');
      container.id = 'floating-buttons-portal';
      document.body.appendChild(container);
    }
    setPortalContainer(container);
  }, []);

  const checkVisibility = useCallback(() => {
    const getStartedSection = document.getElementById('get-started');
    if (!getStartedSection) {
      ticking.current = false;
      return;
    }

    const rect = getStartedSection.getBoundingClientRect();
    // Show once the visitor is browsing (past the hero), but hide while the
    // contact section is on screen — its form/Calendly card must not compete
    // with floating buttons at the same scroll position.
    const pastHero = window.scrollY > window.innerHeight;
    const contactOnScreen =
      rect.top < window.innerHeight * 0.9 && rect.bottom > window.innerHeight * 0.25;
    setIsVisible(pastHero && !contactOnScreen);
    ticking.current = false;
  }, []);

  useEffect(() => {
    const handleScroll = () => {
      // Throttle using requestAnimationFrame
      if (!ticking.current) {
        ticking.current = true;
        requestAnimationFrame(checkVisibility);
      }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    checkVisibility(); // Check initial state

    return () => window.removeEventListener('scroll', handleScroll);
  }, [checkVisibility]);

  if (!portalContainer) return null;

  return createPortal(
    <AnimatePresence>
      {isVisible && (
        <motion.a
          href="https://wa.me/447836405319?text=Hi%2C%20I'm%20interested%20in%20your%203D%20virtual%20tour%20services."
          target="_blank"
          rel="noopener noreferrer"
          className="fixed bottom-6 right-6 z-50 group"
          initial={{ opacity: 0, scale: 0.8, y: 20 }}
          animate={{ opacity: 1, scale: 1, y: 0 }}
          exit={{ opacity: 0, scale: 0.8, y: 20 }}
          transition={{ type: 'spring', stiffness: 400, damping: 25 }}
        >
          {/* Tooltip */}
          <span className="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-white text-apple-gray-800 text-sm font-medium px-3 py-2 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
            Chat with us
          </span>

          {/* Button */}
          <div className="relative">
            {/* Subtle pulse ring */}
            <span className="absolute inset-0 rounded-full bg-green-500/20 animate-ping" style={{ animationDuration: '3s' }} />

            {/* Main button */}
            <div className="relative w-14 h-14 bg-green-500 hover:bg-green-600 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center">
              <svg className="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </div>
          </div>
        </motion.a>
      )}
    </AnimatePresence>,
    portalContainer
  );
}

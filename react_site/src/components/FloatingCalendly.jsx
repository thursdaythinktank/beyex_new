import { useState, useEffect, useRef, useCallback } from 'react';
import { createPortal } from 'react-dom';
import { motion, AnimatePresence } from 'framer-motion';
import { CalendlyModal } from './calendly/CalendlyModal';

/**
 * Floating Calendly button - appears when user scrolls to GetStarted section
 * Positioned on bottom-left (opposite to WhatsApp on right)
 */
export function FloatingCalendly() {
  const [isVisible, setIsVisible] = useState(false);
  const [isModalOpen, setIsModalOpen] = useState(false);
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
    // Show when the section is in view (top of section reaches 80% of viewport height)
    const shouldShow = rect.top <= window.innerHeight * 0.8;
    setIsVisible(shouldShow);
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

  return (
    <>
      {portalContainer && createPortal(
        <AnimatePresence>
          {isVisible && (
            <motion.button
              onClick={() => setIsModalOpen(true)}
              className="fixed bottom-6 left-6 z-50 group"
              initial={{ opacity: 0, scale: 0.8, y: 20 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.8, y: 20 }}
              transition={{ type: 'spring', stiffness: 400, damping: 25 }}
              aria-label="Book a call"
            >
              {/* Tooltip */}
              <span className="absolute left-full ml-3 top-1/2 -translate-y-1/2 bg-white text-apple-gray-800 text-sm font-medium px-3 py-2 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                Book a call
              </span>

              {/* Button */}
              <div className="relative">
                {/* Subtle pulse ring */}
                <span className="absolute inset-0 rounded-full bg-apple-blue-500/20 animate-ping" style={{ animationDuration: '3s' }} />

                {/* Main button */}
                <div className="relative w-14 h-14 bg-apple-blue-500 hover:bg-apple-blue-600 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center">
                  <CalendarIcon className="w-7 h-7 text-white" />
                </div>
              </div>
            </motion.button>
          )}
        </AnimatePresence>,
        portalContainer
      )}

      {/* Calendly Modal */}
      <CalendlyModal
        isOpen={isModalOpen}
        onClose={() => setIsModalOpen(false)}
      />
    </>
  );
}

function CalendarIcon({ className }) {
  return (
    <svg className={className} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
      <path strokeLinecap="round" strokeLinejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
  );
}

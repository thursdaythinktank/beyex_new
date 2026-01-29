import { useEffect, useState } from 'react';
import { createPortal } from 'react-dom';
import { PopupModal, useCalendlyEventListener } from 'react-calendly';
import { CALENDLY_CONFIG } from '../../config/calendly';

/**
 * CalendlyModal - Wrapper around react-calendly's PopupModal
 * Uses a portal to render outside #root to avoid perspective/transform issues
 */
export function CalendlyModal({ isOpen, onClose, prefill = {} }) {
  const [portalContainer, setPortalContainer] = useState(null);

  // Create a container for the portal outside #root
  useEffect(() => {
    let container = document.getElementById('calendly-portal');
    if (!container) {
      container = document.createElement('div');
      container.id = 'calendly-portal';
      document.body.appendChild(container);
    }
    setPortalContainer(container);

    return () => {
      // Don't remove the container on unmount - it may be reused
    };
  }, []);

  // Track booking events (optional - for analytics)
  useCalendlyEventListener({
    onEventScheduled: (event) => {
      console.log('Calendly event scheduled:', event.data.payload);
      // Could track with analytics here
    },
  });

  // Prevent body scroll when modal is open
  useEffect(() => {
    if (isOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
    return () => {
      document.body.style.overflow = '';
    };
  }, [isOpen]);

  if (!portalContainer) return null;

  return createPortal(
    <PopupModal
      url={CALENDLY_CONFIG.url}
      onModalClose={onClose}
      open={isOpen}
      rootElement={portalContainer}
      pageSettings={CALENDLY_CONFIG.pageSettings}
      utm={CALENDLY_CONFIG.utm}
      prefill={prefill}
    />,
    portalContainer
  );
}

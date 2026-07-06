import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { getCookieConsent, setCookieConsent, loadAnalytics } from '../lib/analytics';

/**
 * GDPR cookie-consent banner.
 * Shown only on the first visit (no stored choice). Analytics loads on Accept.
 */
export function CookieConsent() {
  const [visible, setVisible] = useState(false);

  useEffect(() => {
    if (!getCookieConsent()) setVisible(true);
  }, []);

  const accept = () => {
    setCookieConsent('granted');
    loadAnalytics();
    setVisible(false);
  };

  const decline = () => {
    setCookieConsent('denied');
    setVisible(false);
  };

  if (!visible) return null;

  return (
    <div
      role="dialog"
      aria-label="Cookie consent"
      className="fixed bottom-4 left-1/2 -translate-x-1/2 z-[60] w-[calc(100%-2rem)] max-w-lg
                 bg-white/95 backdrop-blur-md border border-apple-gray-200 rounded-2xl shadow-xl
                 p-5 md:p-6"
    >
      <p className="text-sm text-apple-gray-700 leading-relaxed">
        We use cookies to understand how visitors use our site and improve it. Analytics
        cookies load only if you accept. See our{' '}
        <Link to="/cookies-policy" className="text-apple-blue-600 hover:underline">
          Cookie Policy
        </Link>
        .
      </p>
      <div className="mt-4 flex gap-3">
        <button
          type="button"
          onClick={accept}
          className="flex-1 px-4 py-2.5 rounded-full bg-apple-blue-600 text-white text-sm font-medium
                     hover:bg-apple-blue-500 transition-colors"
        >
          Accept
        </button>
        <button
          type="button"
          onClick={decline}
          className="flex-1 px-4 py-2.5 rounded-full bg-apple-gray-100 text-apple-gray-700 text-sm font-medium
                     hover:bg-apple-gray-200 transition-colors"
        >
          Decline
        </button>
      </div>
    </div>
  );
}

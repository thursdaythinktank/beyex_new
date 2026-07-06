/**
 * Consent-gated tracking loaders (GA4 + Meta Pixel + LinkedIn Insight Tag).
 *
 * No tag is injected until the visitor grants consent (see CookieConsent.jsx),
 * keeping the site GDPR-friendly: no analytics/ad cookies before opt-in.
 * Note: the analytics script domains must also be allow-listed in the nginx
 * Content-Security-Policy `script-src` (googletagmanager, google-analytics,
 * connect.facebook.net, snap.licdn.com).
 */
const GA_MEASUREMENT_ID = 'G-9KYHC00464';
const META_PIXEL_ID = '1599995737760270';
const LINKEDIN_PARTNER_ID = '10260105';
const CONSENT_KEY = 'beyex-cookie-consent';

let gaLoaded = false;
let metaLoaded = false;
let linkedinLoaded = false;

/** @returns {'granted' | 'denied' | null} */
export function getCookieConsent() {
  try {
    return localStorage.getItem(CONSENT_KEY);
  } catch {
    return null;
  }
}

/** @param {'granted' | 'denied'} value */
export function setCookieConsent(value) {
  try {
    localStorage.setItem(CONSENT_KEY, value);
  } catch {
    /* localStorage unavailable (private mode) — consent simply isn't persisted */
  }
}

/** Google Analytics 4 */
function loadGA() {
  if (gaLoaded || typeof window === 'undefined' || !GA_MEASUREMENT_ID) return;
  gaLoaded = true;

  const script = document.createElement('script');
  script.async = true;
  script.src = `https://www.googletagmanager.com/gtag/js?id=${GA_MEASUREMENT_ID}`;
  document.head.appendChild(script);

  window.dataLayer = window.dataLayer || [];
  function gtag() {
    window.dataLayer.push(arguments);
  }
  window.gtag = gtag;
  gtag('js', new Date());
  gtag('config', GA_MEASUREMENT_ID, { anonymize_ip: true });
}

/** Meta (Facebook) Pixel */
function loadMetaPixel() {
  if (metaLoaded || typeof window === 'undefined' || !META_PIXEL_ID) return;
  metaLoaded = true;

  /* eslint-disable */
  !(function (f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function () {
      n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = '2.0';
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s);
  })(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
  /* eslint-enable */

  window.fbq('init', META_PIXEL_ID);
  window.fbq('track', 'PageView');
}

/** LinkedIn Insight Tag (no-op until a Partner ID is configured) */
function loadLinkedIn() {
  if (linkedinLoaded || typeof window === 'undefined' || !LINKEDIN_PARTNER_ID) return;
  linkedinLoaded = true;

  window._linkedin_partner_id = LINKEDIN_PARTNER_ID;
  window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
  window._linkedin_data_partner_ids.push(LINKEDIN_PARTNER_ID);
  if (!window.lintrk) {
    window.lintrk = function (a, b) {
      window.lintrk.q.push([a, b]);
    };
    window.lintrk.q = [];
  }
  const s = document.getElementsByTagName('script')[0];
  const b = document.createElement('script');
  b.type = 'text/javascript';
  b.async = true;
  b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';
  s.parentNode.insertBefore(b, s);
}

/** Load every consent-gated tracker. Each loader is individually guarded. */
export function loadAnalytics() {
  loadGA();
  loadMetaPixel();
  loadLinkedIn();
}

/** Load trackers on app start only if the visitor previously opted in. */
export function initAnalytics() {
  if (getCookieConsent() === 'granted') {
    loadAnalytics();
  }
}

/** Record an SPA page view across loaded trackers (GA4 'config' fires the first). */
export function trackPageview(path) {
  if (gaLoaded && typeof window.gtag === 'function') {
    window.gtag('event', 'page_view', { page_path: path });
  }
  if (metaLoaded && typeof window.fbq === 'function') {
    window.fbq('track', 'PageView');
  }
}

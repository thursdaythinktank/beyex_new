import { lazy, Suspense, useEffect } from 'react';
import { BrowserRouter, Routes, Route, useLocation } from 'react-router-dom';
import { MotionConfig } from 'framer-motion';
import Home from './pages/Home';
import NotFound from './pages/NotFound';
import { FloatingWhatsApp } from './components/FloatingWhatsApp';
import { FloatingCalendly } from './components/FloatingCalendly';
import { CookieConsent } from './components/CookieConsent';
import { initAnalytics, trackPageview } from './lib/analytics';

// Lazy-loaded content pages (code-split to avoid impacting initial bundle)
const Terms = lazy(() => import('./pages/Terms'));
const PrivacyPolicy = lazy(() => import('./pages/PrivacyPolicy'));
const Pricing = lazy(() => import('./pages/Pricing'));
const CookiesPolicy = lazy(() => import('./pages/CookiesPolicy'));
const Contact = lazy(() => import('./pages/Contact'));
const About = lazy(() => import('./pages/About'));
const VirtualToursEducation = lazy(() => import('./pages/services/VirtualToursEducation'));
const DigitalTwinsSolarEnergy = lazy(() => import('./pages/services/DigitalTwinsSolarEnergy'));
const VirtualToursCommercial = lazy(() => import('./pages/services/VirtualToursCommercial'));
const VirtualToursHospitality = lazy(() => import('./pages/services/VirtualToursHospitality'));
const VirtualToursTourism = lazy(() => import('./pages/services/VirtualToursTourism'));
const DigitalTwinsIndustries = lazy(() => import('./pages/services/DigitalTwinsIndustries'));
const VirtualToursRealEstate = lazy(() => import('./pages/services/VirtualToursRealEstate'));
const VirtualToursConstruction = lazy(() => import('./pages/services/VirtualToursConstruction'));
const DigitalTwinsManufacturingService = lazy(() => import('./pages/services/DigitalTwinsManufacturingService'));
const Blog = lazy(() => import('./pages/Blog'));
const VirtualTourCostUK = lazy(() => import('./pages/blog/VirtualTourCostUK'));
const MatterportVsLocalProvider = lazy(() => import('./pages/blog/MatterportVsLocalProvider'));
const AIVideoShipMaintenance = lazy(() => import('./pages/case-studies/AIVideoShipMaintenance'));
const DigitalTwinsManufacturing = lazy(() => import('./pages/resources/DigitalTwinsManufacturing'));
// Labs: private prototypes (noindex, unlinked)
const ScanResolvePage = lazy(() => import('./pages/labs/ScanResolvePage'));

/**
 * Sends a GA4 page_view on every SPA route change (the initial view is sent by
 * gtag 'config'). No-op until the visitor has accepted analytics cookies.
 */
function AnalyticsRouteTracker() {
  const location = useLocation();
  useEffect(() => {
    trackPageview(location.pathname + location.search);
  }, [location]);
  return null;
}

/**
 * Resets scroll to the top on route change. Without this, SPA navigation keeps
 * the previous scroll position — e.g. clicking a footer link leaves you stuck at
 * the footer, making the new page look unresponsive. Hash links still scroll to
 * their target element.
 */
function ScrollToTop() {
  const { pathname, hash } = useLocation();
  useEffect(() => {
    if (hash) {
      const el = document.getElementById(hash.slice(1));
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        return;
      }
    }
    window.scrollTo(0, 0);
  }, [pathname, hash]);
  return null;
}

/**
 * Main App component with routing
 */
function App() {
  // Load analytics for returning visitors who already opted in.
  useEffect(() => {
    initAnalytics();
  }, []);

  return (
    <MotionConfig reducedMotion="user">
    <BrowserRouter>
      <AnalyticsRouteTracker />
      <ScrollToTop />
      <Suspense fallback={<div className="min-h-screen bg-white" />}>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/terms" element={<Terms />} />
          <Route path="/privacy-policy" element={<PrivacyPolicy />} />
          <Route path="/pricing" element={<Pricing />} />
          <Route path="/cookies-policy" element={<CookiesPolicy />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/about" element={<About />} />
          {/* Content pages */}
          <Route path="/services/virtual-tours-education" element={<VirtualToursEducation />} />
          <Route path="/services/digital-twins-solar-energy" element={<DigitalTwinsSolarEnergy />} />
          <Route path="/services/virtual-tours-commercial" element={<VirtualToursCommercial />} />
          <Route path="/services/virtual-tours-hospitality" element={<VirtualToursHospitality />} />
          <Route path="/services/virtual-tours-tourism" element={<VirtualToursTourism />} />
          <Route path="/services/digital-twins-industries" element={<DigitalTwinsIndustries />} />
          <Route path="/services/virtual-tours-real-estate" element={<VirtualToursRealEstate />} />
          <Route path="/services/virtual-tours-construction" element={<VirtualToursConstruction />} />
          <Route path="/services/digital-twins-manufacturing" element={<DigitalTwinsManufacturingService />} />
          {/* Blog */}
          <Route path="/blog" element={<Blog />} />
          <Route path="/blog/3d-virtual-tour-cost-uk" element={<VirtualTourCostUK />} />
          <Route path="/blog/matterport-vs-local-provider" element={<MatterportVsLocalProvider />} />
          <Route path="/case-studies/ai-video-ship-maintenance" element={<AIVideoShipMaintenance />} />
          <Route path="/resources/digital-twins-manufacturing" element={<DigitalTwinsManufacturing />} />
          {/* Labs prototype — decision gate for the cityscape replacement */}
          <Route path="/labs/scan-resolve" element={<ScanResolvePage />} />
          {/* 404 catch-all — must be last */}
          <Route path="*" element={<NotFound />} />
        </Routes>
      </Suspense>
      {/* Floating buttons - appear when get-started section is visible */}
      <FloatingWhatsApp />
      <FloatingCalendly />
      <CookieConsent />
    </BrowserRouter>
    </MotionConfig>
  );
}

export default App;

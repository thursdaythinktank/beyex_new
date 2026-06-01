import { lazy, Suspense } from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import Terms from './pages/Terms';
import PrivacyPolicy from './pages/PrivacyPolicy';
import Pricing from './pages/Pricing';
import CookiesPolicy from './pages/CookiesPolicy';
import Contact from './pages/Contact';
import { FloatingWhatsApp } from './components/FloatingWhatsApp';
import { FloatingCalendly } from './components/FloatingCalendly';

// Lazy-loaded content pages (code-split to avoid impacting initial bundle)
const VirtualToursEducation = lazy(() => import('./pages/services/VirtualToursEducation'));
const DigitalTwinsSolarEnergy = lazy(() => import('./pages/services/DigitalTwinsSolarEnergy'));
const VirtualToursCommercial = lazy(() => import('./pages/services/VirtualToursCommercial'));
const VirtualToursHospitality = lazy(() => import('./pages/services/VirtualToursHospitality'));
const VirtualToursTourism = lazy(() => import('./pages/services/VirtualToursTourism'));
const DigitalTwinsIndustries = lazy(() => import('./pages/services/DigitalTwinsIndustries'));
const AIVideoShipMaintenance = lazy(() => import('./pages/case-studies/AIVideoShipMaintenance'));
const DigitalTwinsManufacturing = lazy(() => import('./pages/resources/DigitalTwinsManufacturing'));

/**
 * Main App component with routing
 */
function App() {
  return (
    <BrowserRouter>
      <Suspense fallback={<div className="min-h-screen bg-white" />}>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/terms" element={<Terms />} />
          <Route path="/privacy-policy" element={<PrivacyPolicy />} />
          <Route path="/pricing" element={<Pricing />} />
          <Route path="/cookies-policy" element={<CookiesPolicy />} />
          <Route path="/contact" element={<Contact />} />
          {/* Content pages */}
          <Route path="/services/virtual-tours-education" element={<VirtualToursEducation />} />
          <Route path="/services/digital-twins-solar-energy" element={<DigitalTwinsSolarEnergy />} />
          <Route path="/services/virtual-tours-commercial" element={<VirtualToursCommercial />} />
          <Route path="/services/virtual-tours-hospitality" element={<VirtualToursHospitality />} />
          <Route path="/services/virtual-tours-tourism" element={<VirtualToursTourism />} />
          <Route path="/services/digital-twins-industries" element={<DigitalTwinsIndustries />} />
          <Route path="/case-studies/ai-video-ship-maintenance" element={<AIVideoShipMaintenance />} />
          <Route path="/resources/digital-twins-manufacturing" element={<DigitalTwinsManufacturing />} />
        </Routes>
      </Suspense>
      {/* Floating buttons - appear when get-started section is visible */}
      <FloatingWhatsApp />
      <FloatingCalendly />
    </BrowserRouter>
  );
}

export default App;

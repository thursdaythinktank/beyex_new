import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import Terms from './pages/Terms';
import PrivacyPolicy from './pages/PrivacyPolicy';
import Pricing from './pages/Pricing';
import CookiesPolicy from './pages/CookiesPolicy';
import Contact from './pages/Contact';
import { FloatingWhatsApp } from './components/FloatingWhatsApp';
import { FloatingCalendly } from './components/FloatingCalendly';

/**
 * Main App component with routing
 */
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/terms" element={<Terms />} />
        <Route path="/privacy-policy" element={<PrivacyPolicy />} />
        <Route path="/pricing" element={<Pricing />} />
        <Route path="/cookies-policy" element={<CookiesPolicy />} />
        <Route path="/contact" element={<Contact />} />
      </Routes>
      {/* Floating buttons - appear when get-started section is visible */}
      <FloatingWhatsApp />
      <FloatingCalendly />
    </BrowserRouter>
  );
}

export default App;

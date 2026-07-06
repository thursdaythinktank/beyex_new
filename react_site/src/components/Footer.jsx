import { Link, useLocation } from 'react-router-dom';
import { Button } from './ui/Button';
import { Newsletter } from './Newsletter';

/**
 * Site footer: closing CTA band, balanced link columns, small-print bottom bar
 * Apple-style simplicity
 */
export function Footer() {
  const currentYear = new Date().getFullYear();
  const location = useLocation();
  const isHomePage = location.pathname === '/';

  // For hash links, scroll if on home page, otherwise navigate to home with hash
  const handleHashLink = (e, hash) => {
    if (isHomePage) {
      e.preventDefault();
      const element = document.getElementById(hash);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }
  };

  return (
    <footer className="bg-apple-gray-50 border-t border-apple-gray-200">
      {/* Closing CTA band */}
      <div className="bg-gradient-to-r from-apple-blue-500 to-apple-blue-600">
        <div className="max-w-7xl mx-auto px-6 py-12 text-center">
          <h2 className="text-2xl md:text-3xl font-semibold text-white mb-3 tracking-tight">
            Ready to capture your space?
          </h2>
          <p className="text-blue-100 mb-6 max-w-xl mx-auto">
            Get a free, no-obligation quote and see how a digital twin can work for your business.
          </p>
          <Link to="/#get-started" onClick={(e) => handleHashLink(e, 'get-started')}>
            <Button
              variant="secondary"
              size="lg"
              className="bg-white text-apple-gray-900 hover:bg-apple-gray-100 border-white"
            >
              Get Your Free Quote
            </Button>
          </Link>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-6 py-12">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
          {/* Brand */}
          <div className="col-span-2 md:col-span-1 space-y-4">
            <Link to="/">
              <img src="/logo.png" alt="Beyex" className="h-8" width="77" height="32" />
            </Link>
            <p className="text-sm text-apple-gray-600">
              Digital twins that let anyone step inside your space.
            </p>
          </div>

          {/* Services */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Services</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/services/virtual-tours-commercial" className="hover:text-apple-gray-900 transition-colors">
                  Real Estate &amp; Commercial
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-hospitality" className="hover:text-apple-gray-900 transition-colors">
                  Hospitality
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-tourism" className="hover:text-apple-gray-900 transition-colors">
                  Tourism &amp; Heritage
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-education" className="hover:text-apple-gray-900 transition-colors">
                  Education
                </Link>
              </li>
              <li>
                <Link to="/services/digital-twins-solar-energy" className="hover:text-apple-gray-900 transition-colors">
                  Energy &amp; Solar
                </Link>
              </li>
              <li>
                <Link to="/services/digital-twins-industries" className="hover:text-apple-gray-900 transition-colors">
                  Industries
                </Link>
              </li>
            </ul>
          </div>

          {/* Resources */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Resources</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/case-studies/ai-video-ship-maintenance" className="hover:text-apple-gray-900 transition-colors">
                  Ship Maintenance Case Study
                </Link>
              </li>
              <li>
                <Link to="/resources/digital-twins-manufacturing" className="hover:text-apple-gray-900 transition-colors">
                  Digital Twins Guide
                </Link>
              </li>
              <li>
                <Link
                  to="/#experiences"
                  onClick={(e) => handleHashLink(e, 'experiences')}
                  className="hover:text-apple-gray-900 transition-colors"
                >
                  Featured Tours
                </Link>
              </li>
              <li>
                <Link
                  to="/#process"
                  onClick={(e) => handleHashLink(e, 'process')}
                  className="hover:text-apple-gray-900 transition-colors"
                >
                  How It Works
                </Link>
              </li>
            </ul>
          </div>

          {/* Company */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Company</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/about" className="hover:text-apple-gray-900 transition-colors">
                  About
                </Link>
              </li>
              <li>
                <Link to="/pricing" className="hover:text-apple-gray-900 transition-colors">
                  Pricing
                </Link>
              </li>
              <li>
                <Link to="/blog" className="hover:text-apple-gray-900 transition-colors">
                  Blog
                </Link>
              </li>
              <li>
                <Link to="/contact" className="hover:text-apple-gray-900 transition-colors">
                  Contact
                </Link>
              </li>
              <li>
                <Link to="/terms" className="hover:text-apple-gray-900 transition-colors">
                  Terms of Service
                </Link>
              </li>
              <li>
                <Link to="/privacy-policy" className="hover:text-apple-gray-900 transition-colors">
                  Privacy Policy
                </Link>
              </li>
              <li>
                <Link to="/cookies-policy" className="hover:text-apple-gray-900 transition-colors">
                  Cookie Policy
                </Link>
              </li>
            </ul>
          </div>
        </div>

        {/* Newsletter */}
        <div className="pt-8 border-t border-apple-gray-200 mb-8 max-w-md">
          <Newsletter />
        </div>

        {/* Small-print bottom bar */}
        <div className="pt-8 border-t border-apple-gray-200 flex flex-col md:flex-row items-center justify-between gap-2 text-center md:text-left">
          <p className="text-xs text-apple-gray-500">
            © {currentYear} Beyex Ltd. All rights reserved.
          </p>
          <div className="text-xs text-apple-gray-500 md:text-right">
            <p>VAT: 509 4886 54 · Beyex Ltd, 8 Kielder, Washington, United Kingdom, NE38 0NW</p>
            <p>CPV 71355100 — Photogrammetry services · CPV 71700000 — Monitoring and control services</p>
          </div>
        </div>
      </div>
    </footer>
  );
}

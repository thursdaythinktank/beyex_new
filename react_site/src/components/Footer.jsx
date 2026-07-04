import { Link, useLocation } from 'react-router-dom';

/**
 * Minimal footer with organized links
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
      <div className="max-w-7xl mx-auto px-6 py-12">
        <div className="grid grid-cols-1 md:grid-cols-5 gap-8 mb-12">
          {/* Brand */}
          <div className="space-y-4">
            <Link to="/">
              <img src="/logo.png" alt="Beyex" className="h-8" width="77" height="32" />
            </Link>
            <p className="text-sm text-apple-gray-600">
              Digital twins that let anyone step inside your space.
            </p>
            <p className="text-xs text-apple-gray-500 mb-1">VAT: 509 4886 54</p>
            <address className="text-xs text-apple-gray-500 not-italic">
              <p>Beyex Ltd</p>
              <p>8 Kielder, Washington</p>
              <p>United Kingdom, NE38 0NW</p>
            </address>
          </div>

          {/* Explore */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Explore</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
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
              <li>
                <Link
                  to="/#use-cases"
                  onClick={(e) => handleHashLink(e, 'use-cases')}
                  className="hover:text-apple-gray-900 transition-colors"
                >
                  Use Cases
                </Link>
              </li>
              <li>
                <Link to="/pricing" className="hover:text-apple-gray-900 transition-colors">
                  Pricing
                </Link>
              </li>
            </ul>
          </div>

          {/* Company */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Company</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/contact" className="hover:text-apple-gray-900 transition-colors">
                  Contact
                </Link>
              </li>
              <li>
                <Link
                  to="/#get-started"
                  onClick={(e) => handleHashLink(e, 'get-started')}
                  className="hover:text-apple-gray-900 transition-colors"
                >
                  Get a Quote
                </Link>
              </li>
            </ul>
          </div>

          {/* Resources */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Resources</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/services/virtual-tours-education" className="hover:text-apple-gray-900 transition-colors">
                  Virtual Tours for Education
                </Link>
              </li>
              <li>
                <Link to="/services/digital-twins-solar-energy" className="hover:text-apple-gray-900 transition-colors">
                  Digital Twins for Solar Energy
                </Link>
              </li>
              <li>
                <Link to="/case-studies/ai-video-ship-maintenance" className="hover:text-apple-gray-900 transition-colors">
                  AI Video for Ship Maintenance
                </Link>
              </li>
              <li>
                <Link to="/resources/digital-twins-manufacturing" className="hover:text-apple-gray-900 transition-colors">
                  Digital Twins in Manufacturing
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-commercial" className="hover:text-apple-gray-900 transition-colors">
                  Commercial Venue Tours
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-hospitality" className="hover:text-apple-gray-900 transition-colors">
                  Hotels & Hospitality Tours
                </Link>
              </li>
              <li>
                <Link to="/services/virtual-tours-tourism" className="hover:text-apple-gray-900 transition-colors">
                  Tourism & Attractions
                </Link>
              </li>
              <li>
                <Link to="/services/digital-twins-industries" className="hover:text-apple-gray-900 transition-colors">
                  Digital Twins for Industries
                </Link>
              </li>
            </ul>
          </div>

          {/* Legal */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Legal</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li>
                <Link to="/privacy-policy" className="hover:text-apple-gray-900 transition-colors">
                  Privacy Policy
                </Link>
              </li>
              <li>
                <Link to="/terms" className="hover:text-apple-gray-900 transition-colors">
                  Terms of Service
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

        {/* Copyright */}
        <div className="pt-8 border-t border-apple-gray-200">
          <p className="text-sm text-apple-gray-500 text-center">
            © {currentYear} Beyex Ltd. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
}

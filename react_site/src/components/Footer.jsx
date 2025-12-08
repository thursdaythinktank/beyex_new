/**
 * Minimal footer with organized links
 * Apple-style simplicity
 */
export function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-apple-gray-50 border-t border-apple-gray-200">
      <div className="max-w-7xl mx-auto px-6 py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
          {/* Brand */}
          <div className="space-y-4">
            <img src="/logo.png" alt="Beyex" className="h-8" />
            <p className="text-sm text-apple-gray-600">
              Digital twins that let anyone step inside your space, from anywhere.
            </p>
          </div>

          {/* Explore */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Explore</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li><a href="#experiences" className="hover:text-apple-gray-900 transition-colors">Featured Tours</a></li>
              <li><a href="#process" className="hover:text-apple-gray-900 transition-colors">How It Works</a></li>
              <li><a href="#use-cases" className="hover:text-apple-gray-900 transition-colors">Use Cases</a></li>
            </ul>
          </div>

          {/* Company */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Company</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li><a href="#" className="hover:text-apple-gray-900 transition-colors">About</a></li>
              <li><a href="#get-started" className="hover:text-apple-gray-900 transition-colors">Contact</a></li>
            </ul>
          </div>

          {/* Legal */}
          <div className="space-y-4">
            <h4 className="text-sm font-semibold text-apple-gray-900">Legal</h4>
            <ul className="space-y-2 text-sm text-apple-gray-600">
              <li><a href="#" className="hover:text-apple-gray-900 transition-colors">Privacy</a></li>
              <li><a href="#" className="hover:text-apple-gray-900 transition-colors">Terms</a></li>
            </ul>
          </div>
        </div>

        {/* Copyright */}
        <div className="pt-8 border-t border-apple-gray-200">
          <p className="text-sm text-apple-gray-500 text-center">
            © {currentYear} Beyex. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
}

import { Link } from 'react-router-dom';
import { Footer } from './Footer';

/**
 * Shared layout for legal/policy pages
 * Clean, readable typography for legal content
 */
export function LegalPageLayout({ title, lastUpdated, children }) {
  return (
    <div className="min-h-screen bg-white">
      <a href="#main-content" className="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-white focus:text-apple-gray-900 focus:rounded-lg focus:shadow-lg">Skip to content</a>
      {/* Simple Navigation */}
      <nav className="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-apple-gray-100">
        <div className="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
          <Link to="/" className="flex items-center">
            <img src="/logo.png" alt="Beyex" className="h-8" width="77" height="32" />
          </Link>
          <Link
            to="/"
            className="text-sm text-apple-gray-600 hover:text-apple-gray-900 transition-colors"
          >
            Back to Home
          </Link>
        </div>
      </nav>

      {/* Content */}
      <main id="main-content" className="pt-24 pb-16">
        <div className="max-w-3xl mx-auto px-6">
          {/* Header */}
          <header className="mb-12">
            <h1 className="text-4xl font-semibold text-apple-gray-900 mb-4">
              {title}
            </h1>
            {lastUpdated && (
              <p className="text-sm text-apple-gray-500">
                Last updated: {lastUpdated}
              </p>
            )}
          </header>

          {/* Legal content */}
          <article className="prose prose-apple max-w-none">
            {children}
          </article>
        </div>
      </main>

      {/* Footer */}
      <Footer />
    </div>
  );
}

import { Link } from 'react-router-dom';
import { Footer } from './Footer';
import { SEOHead } from './SEOHead';
import { Button } from './ui/Button';

/**
 * Layout for content/blog/service pages
 * Enhanced visual hierarchy matching the quality of Pricing/Contact pages
 */
export function ContentPageLayout({
  title,
  subtitle,
  author = 'Beyex Team',
  lastUpdated,
  breadcrumbs = [],
  seoProps = {},
  children,
}) {
  return (
    <div className="min-h-screen bg-white">
      <SEOHead {...seoProps} />

      {/* Navigation */}
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

      {/* Hero header with background */}
      <div className="bg-apple-gray-50 pt-28 pb-16 border-b border-apple-gray-100">
        <div className="max-w-4xl mx-auto px-6">
          {/* Breadcrumbs */}
          {breadcrumbs.length > 0 && (
            <nav className="mb-6 text-sm" aria-label="Breadcrumb">
              <ol className="flex items-center gap-1.5 text-apple-gray-500">
                <li>
                  <Link to="/" className="hover:text-apple-gray-900 transition-colors">Home</Link>
                </li>
                {breadcrumbs.map((crumb, i) => (
                  <li key={i} className="flex items-center gap-1.5">
                    <svg className="w-4 h-4 text-apple-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                    </svg>
                    {crumb.href ? (
                      <Link to={crumb.href} className="hover:text-apple-gray-900 transition-colors">
                        {crumb.label}
                      </Link>
                    ) : (
                      <span className="text-apple-gray-700 font-medium">{crumb.label}</span>
                    )}
                  </li>
                ))}
              </ol>
            </nav>
          )}

          <h1 className="text-4xl md:text-5xl font-semibold text-apple-gray-900 mb-4 tracking-tight">
            {title}
          </h1>
          {subtitle && (
            <p className="text-xl text-apple-gray-600 max-w-3xl leading-relaxed">
              {subtitle}
            </p>
          )}
          <div className="mt-6 flex items-center gap-3 text-sm text-apple-gray-500">
            <div className="w-8 h-8 rounded-full bg-apple-blue-600 flex items-center justify-center">
              <span className="text-white text-xs font-semibold">B</span>
            </div>
            <span className="font-medium text-apple-gray-700">{author}</span>
            {lastUpdated && (
              <>
                <span className="text-apple-gray-300">|</span>
                <span>{lastUpdated}</span>
              </>
            )}
          </div>
        </div>
      </div>

      <main className="py-16">
        <div className="max-w-4xl mx-auto px-6">
          {/* Content */}
          <article>
            {children}
          </article>

          {/* CTA Section */}
          <section className="mt-20 py-16 px-8 bg-apple-blue-600 rounded-2xl text-center">
            <h2 className="text-3xl font-semibold text-white mb-4">
              Ready to create your digital twin?
            </h2>
            <p className="text-blue-200 mb-8 max-w-xl mx-auto text-lg">
              Get a free, no-obligation quote for your space. Our team will guide you through the entire process.
            </p>
            <Link to="/#get-started">
              <Button variant="secondary" size="lg" className="bg-white text-apple-gray-900 hover:bg-apple-gray-100 border-white">
                Get Your Free Quote
              </Button>
            </Link>
          </section>
        </div>
      </main>

      <Footer />
    </div>
  );
}

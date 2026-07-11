import { Link } from 'react-router-dom';
import { Footer } from './Footer';
import { SEOHead } from './SEOHead';
import { Button } from './ui/Button';
import { ServicesMenu } from './ServicesMenu';
import { menuPages } from '../config/services';
import { TourEmbed } from './ui/TourEmbed';
import { SectorLeadForm } from './SectorLeadForm';

/**
 * Layout for content/blog/service pages
 * Enhanced visual hierarchy matching the quality of Pricing/Contact pages
 *
 * Sector landing-page extras (all optional):
 * - demoTour: { src, title } — embeds a Matterport demo near the top
 * - faqs: [{ q, a }] — renders an FAQ block (pass matching FAQPage schema via seoProps)
 * - leadFormSector: string — renders an on-page lead form posting to /api/contact
 * - ctaTitle / ctaText — override the closing call-to-action copy
 */
export function ContentPageLayout({
  title,
  subtitle,
  author = 'Beyex Team',
  lastUpdated,
  breadcrumbs = [],
  seoProps = {},
  cta = {},
  demoTour,
  faqs = [],
  leadFormSector,
  ctaTitle,
  ctaText,
  children,
}) {
  // Revamp `cta` object takes precedence; local ctaTitle/ctaText act as fallbacks.
  const {
    title: ctaHeading = ctaTitle ?? 'Ready to create your digital twin?',
    description: ctaDescription = ctaText ?? 'Get a free, no-obligation quote for your space. Our team will guide you through the entire process.',
    buttonLabel: ctaButtonLabel = 'Get Your Free Quote',
  } = cta;

  // Build BreadcrumbList JSON-LD when breadcrumbs are provided.
  // The visual nav always prepends "Home" → "/", so we mirror that here.
  const breadcrumbSchema =
    breadcrumbs.length > 0
      ? {
          '@context': 'https://schema.org',
          '@type': 'BreadcrumbList',
          itemListElement: [
            {
              '@type': 'ListItem',
              position: 1,
              name: 'Home',
              item: 'https://beyex.com',
            },
            ...breadcrumbs.map((crumb, i) => ({
              '@type': 'ListItem',
              position: i + 2,
              name: crumb.label,
              item: `https://beyex.com${crumb.href ?? ''}`,
            })),
          ],
        }
      : null;

  const mergedSchema = breadcrumbSchema
    ? [...(Array.isArray(seoProps.schema) ? seoProps.schema : seoProps.schema ? [seoProps.schema] : []), breadcrumbSchema]
    : seoProps.schema;

  return (
    <div className="min-h-screen bg-white">
      <a href="#main-content" className="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-white focus:text-apple-gray-900 focus:rounded-lg focus:shadow-lg">Skip to content</a>
      <SEOHead {...seoProps} schema={mergedSchema} />

      {/* Navigation */}
      <nav className="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-apple-gray-100">
        <div className="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
          <Link to="/" className="flex items-center">
            <img src="/logo.png" alt="Beyex" className="h-8" width="77" height="32" />
          </Link>
          <div className="flex items-center gap-6">
            <div className="hidden md:flex items-center gap-6">
              <ServicesMenu label="Use Cases" items={menuPages} />
              <Link to="/pricing" className="text-base text-apple-gray-600 hover:text-apple-gray-900 transition-colors">
                Pricing
              </Link>
            </div>
            <Link
              to="/contact"
              className="text-sm text-apple-gray-600 hover:text-apple-gray-900 transition-colors"
            >
              Contact
            </Link>
          </div>
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

      <main id="main-content" className="py-16">
        <div className="max-w-4xl mx-auto px-6">
          {/* Embedded demo tour */}
          {demoTour && (
            <section className="mb-14">
              <h2 className="text-2xl font-semibold text-apple-gray-900 mb-5">See it in action</h2>
              <TourEmbed src={demoTour.src} title={demoTour.title || 'Sample 3D virtual tour'} />
            </section>
          )}

          {/* Content */}
          <article>
            {children}
          </article>

          {/* FAQ */}
          {faqs.length > 0 && (
            <section className="mt-16">
              <h2 className="text-3xl font-semibold text-apple-gray-900 mb-8">Frequently asked questions</h2>
              <div className="space-y-4">
                {faqs.map((faq, i) => (
                  <details key={i} className="group rounded-xl border border-apple-gray-100 bg-white p-5">
                    <summary className="cursor-pointer list-none font-medium text-apple-gray-900 flex items-center justify-between gap-4">
                      {faq.q}
                      <span className="text-apple-gray-400 group-open:rotate-180 transition-transform">
                        <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                          <path strokeLinecap="round" strokeLinejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                      </span>
                    </summary>
                    <p className="mt-3 text-apple-gray-600 text-sm leading-relaxed">{faq.a}</p>
                  </details>
                ))}
              </div>
            </section>
          )}

          {/* On-page lead form */}
          {leadFormSector && <SectorLeadForm sector={leadFormSector} />}

          {/* CTA Section */}
          <section className="mt-20 py-16 px-8 bg-apple-blue-600 rounded-2xl text-center">
            <h2 className="text-3xl font-semibold text-white mb-4">
              {ctaHeading}
            </h2>
            <p className="text-blue-200 mb-8 max-w-xl mx-auto text-lg">
              {ctaDescription}
            </p>
            <Link to="/#get-started">
              <Button variant="secondary" size="lg" className="bg-white text-apple-gray-900 hover:bg-apple-gray-100 border-white">
                {ctaButtonLabel}
              </Button>
            </Link>
          </section>
        </div>
      </main>

      <Footer />
    </div>
  );
}

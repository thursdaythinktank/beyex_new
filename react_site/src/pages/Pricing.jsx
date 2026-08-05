import { Link } from 'react-router-dom';
import { Footer } from '../components/Footer';
import { Button } from '../components/ui/Button';
import { SEOHead } from '../components/SEOHead';

// NOTE: The full pricing page (tiers, comparison table, FAQ) is temporarily
// disabled. The previous version is preserved in git history — restore it by
// reverting this change when pricing is finalised.
export default function Pricing() {
  const pricingSchema = [
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Pricing', item: 'https://beyex.com/pricing' },
      ],
    },
  ];

  return (
    <div className="min-h-screen bg-white">
      <a href="#main-content" className="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-white focus:text-apple-gray-900 focus:rounded-lg focus:shadow-lg">Skip to content</a>
      <SEOHead
        title="Pricing — 3D Virtual Tour Packages"
        description="Beyex 3D virtual tours start from £399. Contact us for a tailored quote for your space."
        canonicalUrl="https://beyex.com/pricing"
        schema={pricingSchema}
      />
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

      <main id="main-content">
        <section className="pt-32 pb-24 px-6 min-h-[70vh] flex items-center">
          <div className="max-w-2xl mx-auto text-center">
            <h1 className="text-5xl font-semibold text-apple-gray-900 mb-6">
              Simple, transparent pricing
            </h1>
            <p className="text-2xl text-apple-gray-700 mb-4">
              Our pricing starts from <span className="font-semibold text-apple-gray-900">£399</span>.
            </p>
            <p className="text-lg text-apple-gray-600 mb-10 max-w-xl mx-auto">
              Every space is different. Tell us about yours and we&rsquo;ll send a tailored,
              no-obligation quote — usually within one business day.
            </p>
            <Link to="/contact">
              <Button size="lg">Contact us for a tailored quote →</Button>
            </Link>
            <p className="text-sm text-apple-gray-500 mt-6">
              Prices exclude VAT where applicable.
            </p>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
}

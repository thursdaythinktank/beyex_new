import { Link } from 'react-router-dom';
import { Footer } from '../components/Footer';
import { Button } from '../components/ui/Button';
import { SEOHead } from '../components/SEOHead';

export default function Pricing() {
  const pricingSchema = [
    {
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: [
        {
          '@type': 'Question',
          name: "What's included in the price?",
          acceptedAnswer: {
            '@type': 'Answer',
            text: 'All packages include on-site scanning, professional processing, and an embed code for your website. Hosting is included complimentary for the first six months. Clients with an active service agreement continue to enjoy hosting at no additional cost; otherwise, a standard hosting fee applies.',
          },
        },
        {
          '@type': 'Question',
          name: 'How long does the process take?',
          acceptedAnswer: {
            '@type': 'Answer',
            text: 'On-site scanning typically takes 1-4 hours depending on property size. Your virtual tour is usually ready within 3-5 business days.',
          },
        },
        {
          '@type': 'Question',
          name: "What's your refund policy?",
          acceptedAnswer: {
            '@type': 'Answer',
            text: 'Full refund if cancelled before the property scan. Once scanning begins, no refunds are available.',
          },
        },
        {
          '@type': 'Question',
          name: 'Do you offer volume discounts?',
          acceptedAnswer: {
            '@type': 'Answer',
            text: 'Yes! We offer discounts for multiple properties or ongoing partnerships. Contact us to discuss your requirements.',
          },
        },
      ],
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Pricing', item: 'https://beyex.com/pricing' },
      ],
    },
  ];
  const pricingTiers = [
    {
      name: 'Small',
      size: 'Up to 3,000 sq. ft.',
      priceRange: '£111 - £185',
      description: 'Perfect for flats, small homes, and boutique retail spaces',
      features: [
        'Full 3D virtual tour',
        'High-resolution photography',
        'Interactive floor plan',
        '6 months complimentary hosting',
        'Embed code for your website',
      ],
    },
    {
      name: 'Medium',
      size: '3,000 - 10,000 sq. ft.',
      priceRange: '£222 - £1,111',
      description: 'Ideal for larger homes, offices, and commercial spaces',
      features: [
        'Everything in Small',
        'Multi-floor scanning',
        'Guided tour creation',
        'Measurement tools',
        'Priority support',
      ],
      popular: true,
    },
    {
      name: 'Enterprise',
      size: '10,000+ sq. ft.',
      priceRange: 'Custom Quote',
      description: 'For large venues, hotels, and industrial spaces',
      features: [
        'Everything in Medium',
        'Dedicated project manager',
        'Custom branding options',
        'API integration support',
        'Volume discounts',
      ],
    },
  ];

  return (
    <div className="min-h-screen bg-white">
      <SEOHead
        title="Pricing — 3D Virtual Tour Packages"
        description="Transparent pricing for professional 3D virtual tours. From small flats to large commercial venues, get an instant quote based on your property size."
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

      {/* Hero */}
      <section className="pt-32 pb-16 px-6">
        <div className="max-w-4xl mx-auto text-center">
          <h1 className="text-5xl font-semibold text-apple-gray-900 mb-6">
            Simple, transparent pricing
          </h1>
          <p className="text-xl text-apple-gray-600 max-w-2xl mx-auto">
            Professional 3D virtual tours for any space. Get an instant quote based on your property size.
          </p>
        </div>
      </section>

      {/* Pricing Cards */}
      <section className="pb-24 px-6">
        <div className="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
          {pricingTiers.map((tier) => (
            <div
              key={tier.name}
              className={`relative rounded-2xl p-8 ${
                tier.popular
                  ? 'bg-apple-blue-600 text-white ring-4 ring-apple-blue-600 ring-offset-2'
                  : 'bg-apple-gray-50 text-apple-gray-900'
              }`}
            >
              {tier.popular && (
                <div className="absolute -top-4 left-1/2 -translate-x-1/2 bg-apple-gray-900 text-white px-4 py-1 rounded-full text-sm font-medium">
                  Most Popular
                </div>
              )}

              <div className="mb-6">
                <h3 className={`text-lg font-semibold mb-1 ${tier.popular ? 'text-white' : 'text-apple-gray-900'}`}>
                  {tier.name}
                </h3>
                <p className={`text-sm ${tier.popular ? 'text-white/80' : 'text-apple-gray-600'}`}>
                  {tier.size}
                </p>
              </div>

              <div className="mb-6">
                <span className={`text-3xl font-bold ${tier.popular ? 'text-white' : 'text-apple-gray-900'}`}>
                  {tier.priceRange}
                </span>
              </div>

              <p className={`mb-6 text-sm ${tier.popular ? 'text-white/80' : 'text-apple-gray-600'}`}>
                {tier.description}
              </p>

              <ul className="space-y-3 mb-8">
                {tier.features.map((feature) => (
                  <li key={feature} className="flex items-start gap-3">
                    <svg
                      className={`w-5 h-5 flex-shrink-0 ${tier.popular ? 'text-white' : 'text-apple-blue-600'}`}
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fillRule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clipRule="evenodd"
                      />
                    </svg>
                    <span className={`text-sm ${tier.popular ? 'text-white/90' : 'text-apple-gray-700'}`}>
                      {feature}
                    </span>
                  </li>
                ))}
              </ul>

              <Link to="/#get-started">
                <Button
                  className={`w-full ${
                    tier.popular
                      ? 'bg-white text-apple-blue-600 hover:bg-apple-gray-50'
                      : ''
                  }`}
                  variant={tier.popular ? 'secondary' : 'primary'}
                >
                  Get Quote
                </Button>
              </Link>
            </div>
          ))}
        </div>

        {/* Disclaimer */}
        <p className="text-center text-sm text-apple-gray-500 mt-12 max-w-2xl mx-auto">
          Final pricing may vary based on property complexity, location, and specific requirements.
          All prices exclude VAT where applicable. Contact us for a detailed quote.
        </p>
      </section>

      {/* Comparison: owned tour vs platform subscription */}
      <section className="py-24 px-6">
        <div className="max-w-4xl mx-auto">
          <h2 className="text-3xl font-semibold text-apple-gray-900 text-center mb-4">
            Own your tour — no subscription
          </h2>
          <p className="text-apple-gray-600 text-center mb-12 max-w-2xl mx-auto">
            We capture with the same professional Matterport Pro3 technology as the big platforms —
            but you keep your tour, with a one-off fee instead of recurring charges.
          </p>
          <div className="overflow-x-auto rounded-2xl border border-apple-gray-100">
            <table className="w-full text-left text-sm">
              <thead>
                <tr className="border-b border-apple-gray-200 bg-apple-gray-50 text-apple-gray-900">
                  <th className="py-4 px-5 font-semibold">&nbsp;</th>
                  <th className="py-4 px-5 font-semibold">Beyex</th>
                  <th className="py-4 px-5 font-semibold">Platform subscription</th>
                </tr>
              </thead>
              <tbody className="text-apple-gray-700">
                <tr className="border-b border-apple-gray-100">
                  <td className="py-4 px-5 font-medium">Ownership</td>
                  <td className="py-4 px-5">You own the finished tour</td>
                  <td className="py-4 px-5">Access tied to an ongoing subscription</td>
                </tr>
                <tr className="border-b border-apple-gray-100">
                  <td className="py-4 px-5 font-medium">Cost model</td>
                  <td className="py-4 px-5">One-off capture fee, hosting included</td>
                  <td className="py-4 px-5">Recurring monthly/annual fees</td>
                </tr>
                <tr className="border-b border-apple-gray-100">
                  <td className="py-4 px-5 font-medium">Support</td>
                  <td className="py-4 px-5">Local UK team, direct contact</td>
                  <td className="py-4 px-5">Self-serve / platform support</td>
                </tr>
                <tr>
                  <td className="py-4 px-5 font-medium">Capture quality</td>
                  <td className="py-4 px-5">Matterport Pro3</td>
                  <td className="py-4 px-5">Matterport Pro3</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p className="text-center text-sm text-apple-gray-500 mt-6">
            Read more: <Link to="/blog/matterport-vs-local-provider" className="text-apple-blue-600 hover:underline">Matterport vs a local provider</Link>
          </p>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="bg-apple-gray-50 py-24 px-6">
        <div className="max-w-3xl mx-auto">
          <h2 className="text-3xl font-semibold text-apple-gray-900 text-center mb-12">
            Frequently Asked Questions
          </h2>

          <div className="space-y-8">
            <div>
              <h3 className="text-lg font-semibold text-apple-gray-900 mb-2">
                What's included in the price?
              </h3>
              <p className="text-apple-gray-600">
                All packages include on-site scanning, professional processing, and an embed code
                for your website. Hosting is included complimentary for the first six months.
                Clients with an active service agreement continue to enjoy hosting at no additional
                cost; otherwise, a standard hosting fee applies.
              </p>
            </div>

            <div>
              <h3 className="text-lg font-semibold text-apple-gray-900 mb-2">
                How long does the process take?
              </h3>
              <p className="text-apple-gray-600">
                On-site scanning typically takes 1-4 hours depending on property size.
                Your virtual tour is usually ready within 3-5 business days.
              </p>
            </div>

            <div>
              <h3 className="text-lg font-semibold text-apple-gray-900 mb-2">
                What's your refund policy?
              </h3>
              <p className="text-apple-gray-600">
                Full refund if cancelled before the property scan. Once scanning begins,
                no refunds are available. See our{' '}
                <Link to="/terms" className="text-apple-blue-600 hover:underline">
                  Terms of Service
                </Link>{' '}
                for details.
              </p>
            </div>

            <div>
              <h3 className="text-lg font-semibold text-apple-gray-900 mb-2">
                Do you offer volume discounts?
              </h3>
              <p className="text-apple-gray-600">
                Yes! We offer discounts for multiple properties or ongoing partnerships.
                Contact us to discuss your requirements.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="py-24 px-6">
        <div className="max-w-4xl mx-auto text-center">
          <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">
            Ready to get started?
          </h2>
          <p className="text-xl text-apple-gray-600 mb-8">
            Get a personalised quote for your property in minutes.
          </p>
          <Link to="/#get-started">
            <Button size="lg">Get Your Free Quote</Button>
          </Link>
        </div>
      </section>

      <Footer />
    </div>
  );
}

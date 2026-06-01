import { LegalPageLayout } from '../components/LegalPageLayout';
import { SEOHead } from '../components/SEOHead';

export default function Terms() {
  return (
    <LegalPageLayout title="Terms of Service" lastUpdated="4 January 2026">
      <SEOHead
        title="Terms of Service"
        description="Terms of Service for Beyex Ltd 3D virtual tour services. Covers pricing, refunds, intellectual property, and liability."
        canonicalUrl="https://beyex.com/terms"
        noindex
        schema={{
          '@context': 'https://schema.org',
          '@type': 'BreadcrumbList',
          itemListElement: [
            { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
            { '@type': 'ListItem', position: 2, name: 'Terms of Service', item: 'https://beyex.com/terms' },
          ],
        }}
      />
      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">1. Introduction</h2>
        <p className="text-apple-gray-700 mb-4">
          Welcome to Beyex. These Terms of Service ("Terms") govern your use of our website
          at beyex.com and the 3D virtual tour services ("Services") provided by Beyex Ltd,
          a company registered in England and Wales.
        </p>
        <p className="text-apple-gray-700 mb-4">
          By accessing our website or using our Services, you agree to be bound by these Terms.
          If you do not agree, please do not use our Services.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">2. Services</h2>
        <p className="text-apple-gray-700 mb-4">
          Beyex provides professional 3D virtual tour and digital twin services, including:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>On-site 3D scanning and photography of properties</li>
          <li>Processing and creation of immersive virtual tours</li>
          <li>Hosting and delivery of digital twin experiences</li>
          <li>Integration support for embedding tours on third-party websites</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">3. Pricing and Payment</h2>
        <p className="text-apple-gray-700 mb-4">
          Pricing is based on property size and complexity. All prices quoted are in British Pounds (GBP)
          and are exclusive of VAT where applicable.
        </p>
        <p className="text-apple-gray-700 mb-4">
          We accept payments via:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>PayPal</li>
          <li>Stripe (credit/debit cards)</li>
          <li>Bank transfer (for invoiced amounts)</li>
        </ul>
        <p className="text-apple-gray-700 mb-4">
          Payment terms will be agreed upon before work commences. A deposit may be required
          for larger projects.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">4. Cancellation and Refund Policy</h2>
        <p className="text-apple-gray-700 mb-4">
          <strong>Full Refund:</strong> You are entitled to a full refund if you cancel your booking
          before the scheduled property scan takes place.
        </p>
        <p className="text-apple-gray-700 mb-4">
          <strong>No Refund:</strong> Once the property scanning has commenced, no refunds will be
          provided as the work involves time, travel, and equipment costs that cannot be recovered.
        </p>
        <p className="text-apple-gray-700 mb-4">
          To cancel a booking, please contact us at{' '}
          <a href="mailto:contact@beyex.com" className="text-apple-blue-600 hover:underline">
            contact@beyex.com
          </a>{' '}
          or call{' '}
          <a href="tel:+447459177457" className="text-apple-blue-600 hover:underline">
            +44 7459 177457
          </a>.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">5. Intellectual Property</h2>
        <p className="text-apple-gray-700 mb-4">
          Upon full payment, you will receive a license to use the virtual tour for your
          intended purposes. Beyex retains copyright over the underlying technology, processes,
          and methodologies used to create the tours.
        </p>
        <p className="text-apple-gray-700 mb-4">
          You may not resell, redistribute, or sublicense the virtual tour without prior
          written consent from Beyex.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">6. Your Responsibilities</h2>
        <p className="text-apple-gray-700 mb-4">
          When using our Services, you agree to:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>Provide accurate information about your property</li>
          <li>Ensure lawful access to the property for scanning</li>
          <li>Obtain any necessary permissions from property owners or tenants</li>
          <li>Not use the Services for any unlawful purpose</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">7. Limitation of Liability</h2>
        <p className="text-apple-gray-700 mb-4">
          To the maximum extent permitted by law, Beyex Ltd shall not be liable for any
          indirect, incidental, special, consequential, or punitive damages arising from
          your use of our Services.
        </p>
        <p className="text-apple-gray-700 mb-4">
          Our total liability for any claim arising from these Terms or our Services shall
          not exceed the amount you paid for the specific Service giving rise to the claim.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">8. Privacy</h2>
        <p className="text-apple-gray-700 mb-4">
          Your privacy is important to us. Please review our{' '}
          <a href="/privacy-policy" className="text-apple-blue-600 hover:underline">
            Privacy Policy
          </a>{' '}
          to understand how we collect, use, and protect your personal information.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">9. Governing Law</h2>
        <p className="text-apple-gray-700 mb-4">
          These Terms shall be governed by and construed in accordance with the laws of
          England and Wales. Any disputes arising from these Terms shall be subject to the
          exclusive jurisdiction of the courts of England and Wales.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">10. Dispute Resolution</h2>
        <p className="text-apple-gray-700 mb-4">
          In the event of any dispute, we encourage you to contact us first at{' '}
          <a href="mailto:contact@beyex.com" className="text-apple-blue-600 hover:underline">
            contact@beyex.com
          </a>{' '}
          to seek an amicable resolution. If a resolution cannot be reached, disputes may be
          referred to mediation before court proceedings.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">11. Changes to Terms</h2>
        <p className="text-apple-gray-700 mb-4">
          We may update these Terms from time to time. Any changes will be posted on this page
          with an updated "Last updated" date. Your continued use of our Services after changes
          constitutes acceptance of the revised Terms.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">12. Contact Us</h2>
        <p className="text-apple-gray-700 mb-4">
          If you have any questions about these Terms, please contact us:
        </p>
        <address className="text-apple-gray-700 not-italic">
          <p className="font-semibold">Beyex Ltd</p>
          <p>8 Kielder</p>
          <p>Washington</p>
          <p>United Kingdom</p>
          <p>NE38 0NW</p>
          <p className="mt-4">
            Email:{' '}
            <a href="mailto:contact@beyex.com" className="text-apple-blue-600 hover:underline">
              contact@beyex.com
            </a>
          </p>
          <p>
            Phone:{' '}
            <a href="tel:+447459177457" className="text-apple-blue-600 hover:underline">
              +44 7459 177457
            </a>
          </p>
        </address>
      </section>
    </LegalPageLayout>
  );
}

import { LegalPageLayout } from '../components/LegalPageLayout';
import { SEOHead } from '../components/SEOHead';

export default function PrivacyPolicy() {
  return (
    <LegalPageLayout title="Privacy Policy" lastUpdated="4 January 2026">
      <SEOHead
        title="Privacy Policy"
        description="How Beyex Ltd collects, uses, and protects your personal data. Compliant with UK GDPR and the Data Protection Act 2018."
        canonicalUrl="https://beyex.com/privacy-policy"
        noindex
        schema={{
          '@context': 'https://schema.org',
          '@type': 'BreadcrumbList',
          itemListElement: [
            { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
            { '@type': 'ListItem', position: 2, name: 'Privacy Policy', item: 'https://beyex.com/privacy-policy' },
          ],
        }}
      />
      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">1. Introduction</h2>
        <p className="text-apple-gray-700 mb-4">
          Beyex Ltd ("we", "us", "our") is committed to protecting your privacy. This Privacy
          Policy explains how we collect, use, disclose, and safeguard your personal data when
          you visit our website or use our services.
        </p>
        <p className="text-apple-gray-700 mb-4">
          We comply with the UK General Data Protection Regulation (UK GDPR), the Data Protection
          Act 2018, and the EU Digital Markets Act (DMA) where applicable.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">2. Data Controller</h2>
        <p className="text-apple-gray-700 mb-4">
          The data controller responsible for your personal data is:
        </p>
        <address className="text-apple-gray-700 not-italic mb-4">
          <p className="font-semibold">Beyex Ltd</p>
          <p>8 Kielder</p>
          <p>Washington</p>
          <p>United Kingdom</p>
          <p>NE38 0NW</p>
          <p className="mt-2">
            Email:{' '}
            <a href="mailto:contact@beyex.com" className="text-apple-blue-600 hover:underline">
              contact@beyex.com
            </a>
          </p>
        </address>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">3. Information We Collect</h2>
        <p className="text-apple-gray-700 mb-4">
          We may collect the following types of personal data:
        </p>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Information you provide:</h3>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>Name and contact information (email address, phone number)</li>
          <li>Property details (address, square footage, number of floors)</li>
          <li>Payment information (processed securely via PayPal or Stripe)</li>
          <li>Communications you send to us</li>
        </ul>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Information collected automatically:</h3>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>Device information (browser type, operating system)</li>
          <li>IP address and approximate location</li>
          <li>Pages visited and interactions on our website</li>
          <li>Cookies and similar technologies (see our{' '}
            <a href="/cookies-policy" className="text-apple-blue-600 hover:underline">Cookie Policy</a>)
          </li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">4. How We Use Your Information</h2>
        <p className="text-apple-gray-700 mb-4">
          We use your personal data for the following purposes:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li><strong>Service delivery:</strong> To provide our 3D virtual tour services</li>
          <li><strong>Communication:</strong> To respond to inquiries and provide quotes</li>
          <li><strong>Payment processing:</strong> To process transactions securely</li>
          <li><strong>Improvement:</strong> To analyse website usage and improve our services</li>
          <li><strong>Legal compliance:</strong> To comply with legal obligations</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">5. Legal Basis for Processing</h2>
        <p className="text-apple-gray-700 mb-4">
          We process your personal data based on the following legal grounds:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li><strong>Contract:</strong> Processing necessary to perform our services</li>
          <li><strong>Legitimate interests:</strong> To improve our services and communicate with you</li>
          <li><strong>Consent:</strong> For marketing communications and analytics cookies</li>
          <li><strong>Legal obligation:</strong> To comply with applicable laws</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">6. Third-Party Services</h2>
        <p className="text-apple-gray-700 mb-4">
          We may share your data with the following third-party service providers:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li><strong>PayPal:</strong> For payment processing</li>
          <li><strong>Stripe:</strong> For payment processing</li>
          <li><strong>Google Analytics (GA4):</strong> For website analytics</li>
          <li><strong>Microsoft Clarity:</strong> For user experience analysis</li>
          <li><strong>Resend:</strong> For email delivery</li>
        </ul>
        <p className="text-apple-gray-700 mb-4">
          These providers have their own privacy policies governing their use of your data.
          We ensure all third parties provide adequate data protection safeguards.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">7. Data Retention</h2>
        <p className="text-apple-gray-700 mb-4">
          We retain your personal data for as long as necessary to:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>Provide our services to you</li>
          <li>Comply with legal obligations (e.g., tax records: 7 years)</li>
          <li>Resolve disputes and enforce agreements</li>
        </ul>
        <p className="text-apple-gray-700 mb-4">
          Quote requests are retained for 2 years. Completed project records are retained
          for 7 years for legal and tax purposes.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">8. Your Rights</h2>
        <p className="text-apple-gray-700 mb-4">
          Under UK GDPR, you have the following rights:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li><strong>Right of access:</strong> Request a copy of your personal data</li>
          <li><strong>Right to rectification:</strong> Request correction of inaccurate data</li>
          <li><strong>Right to erasure:</strong> Request deletion of your data ("right to be forgotten")</li>
          <li><strong>Right to restrict processing:</strong> Request limitation of processing</li>
          <li><strong>Right to data portability:</strong> Receive your data in a portable format</li>
          <li><strong>Right to object:</strong> Object to processing based on legitimate interests</li>
          <li><strong>Right to withdraw consent:</strong> Withdraw consent at any time</li>
        </ul>
        <p className="text-apple-gray-700 mb-4">
          To exercise any of these rights, please contact us at{' '}
          <a href="mailto:contact@beyex.com" className="text-apple-blue-600 hover:underline">
            contact@beyex.com
          </a>.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">9. Cookies</h2>
        <p className="text-apple-gray-700 mb-4">
          Our website uses cookies to enhance your experience. For detailed information about
          the cookies we use and how to manage them, please see our{' '}
          <a href="/cookies-policy" className="text-apple-blue-600 hover:underline">
            Cookie Policy
          </a>.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">10. International Transfers</h2>
        <p className="text-apple-gray-700 mb-4">
          Some of our third-party service providers may process data outside the UK. Where this
          occurs, we ensure appropriate safeguards are in place, such as Standard Contractual
          Clauses approved by the UK Information Commissioner's Office.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">11. Data Security</h2>
        <p className="text-apple-gray-700 mb-4">
          We implement appropriate technical and organisational measures to protect your personal
          data against unauthorised access, alteration, disclosure, or destruction. This includes:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>SSL/TLS encryption for data in transit</li>
          <li>Secure payment processing via PCI-compliant providers</li>
          <li>Limited access to personal data on a need-to-know basis</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">12. Complaints</h2>
        <p className="text-apple-gray-700 mb-4">
          If you are unhappy with how we handle your personal data, you have the right to lodge
          a complaint with the Information Commissioner's Office (ICO):
        </p>
        <address className="text-apple-gray-700 not-italic mb-4">
          <p className="font-semibold">Information Commissioner's Office</p>
          <p>Wycliffe House, Water Lane</p>
          <p>Wilmslow, Cheshire</p>
          <p>SK9 5AF</p>
          <p className="mt-2">
            Website:{' '}
            <a href="https://ico.org.uk" className="text-apple-blue-600 hover:underline" target="_blank" rel="noopener noreferrer">
              ico.org.uk
            </a>
          </p>
        </address>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">13. Changes to This Policy</h2>
        <p className="text-apple-gray-700 mb-4">
          We may update this Privacy Policy from time to time. Any changes will be posted on
          this page with an updated "Last updated" date. We encourage you to review this policy
          periodically.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">14. Contact Us</h2>
        <p className="text-apple-gray-700 mb-4">
          If you have any questions about this Privacy Policy or our data practices, please contact us:
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

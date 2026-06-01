import { LegalPageLayout } from '../components/LegalPageLayout';
import { SEOHead } from '../components/SEOHead';

export default function CookiesPolicy() {
  return (
    <LegalPageLayout title="Cookie Policy" lastUpdated="4 January 2026">
      <SEOHead
        title="Cookie Policy"
        description="Information about cookies used on beyex.com, including analytics cookies from Google Analytics and Microsoft Clarity."
        canonicalUrl="https://beyex.com/cookies-policy"
        noindex
        schema={{
          '@context': 'https://schema.org',
          '@type': 'BreadcrumbList',
          itemListElement: [
            { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
            { '@type': 'ListItem', position: 2, name: 'Cookie Policy', item: 'https://beyex.com/cookies-policy' },
          ],
        }}
      />
      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">1. Introduction</h2>
        <p className="text-apple-gray-700 mb-4">
          This Cookie Policy explains how Beyex Ltd ("we", "us", "our") uses cookies and similar
          technologies on our website beyex.com. By using our website, you consent to the use of
          cookies as described in this policy.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">2. What Are Cookies?</h2>
        <p className="text-apple-gray-700 mb-4">
          Cookies are small text files that are stored on your device (computer, tablet, or mobile)
          when you visit a website. They help websites function properly, provide analytics about
          visitor behaviour, and enable personalised experiences.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">3. Types of Cookies We Use</h2>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Essential Cookies</h3>
        <p className="text-apple-gray-700 mb-4">
          These cookies are necessary for the website to function and cannot be switched off.
          They are usually set in response to actions you take, such as setting your privacy
          preferences or filling in forms.
        </p>
        <div className="bg-apple-gray-50 rounded-xl p-4 mb-4">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-apple-gray-600">
                <th className="pb-2">Cookie</th>
                <th className="pb-2">Purpose</th>
                <th className="pb-2">Duration</th>
              </tr>
            </thead>
            <tbody className="text-apple-gray-700">
              <tr>
                <td className="py-2 font-mono text-xs">cookie_consent</td>
                <td className="py-2">Stores your cookie preferences</td>
                <td className="py-2">1 year</td>
              </tr>
            </tbody>
          </table>
        </div>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Analytics Cookies</h3>
        <p className="text-apple-gray-700 mb-4">
          These cookies help us understand how visitors interact with our website by collecting
          and reporting information anonymously. This helps us improve our website and services.
        </p>

        <h4 className="font-semibold text-apple-gray-800 mt-4 mb-2">Google Analytics (GA4)</h4>
        <p className="text-apple-gray-700 mb-4">
          We use Google Analytics to analyse website traffic and user behaviour.
        </p>
        <div className="bg-apple-gray-50 rounded-xl p-4 mb-4">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-apple-gray-600">
                <th className="pb-2">Cookie</th>
                <th className="pb-2">Purpose</th>
                <th className="pb-2">Duration</th>
              </tr>
            </thead>
            <tbody className="text-apple-gray-700">
              <tr>
                <td className="py-2 font-mono text-xs">_ga</td>
                <td className="py-2">Distinguishes unique users</td>
                <td className="py-2">2 years</td>
              </tr>
              <tr>
                <td className="py-2 font-mono text-xs">_ga_*</td>
                <td className="py-2">Maintains session state</td>
                <td className="py-2">2 years</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p className="text-apple-gray-700 mb-4">
          Learn more:{' '}
          <a
            href="https://policies.google.com/privacy"
            className="text-apple-blue-600 hover:underline"
            target="_blank"
            rel="noopener noreferrer"
          >
            Google Privacy Policy
          </a>
        </p>

        <h4 className="font-semibold text-apple-gray-800 mt-4 mb-2">Microsoft Clarity</h4>
        <p className="text-apple-gray-700 mb-4">
          We use Microsoft Clarity to understand how users interact with our website through
          session recordings and heatmaps.
        </p>
        <div className="bg-apple-gray-50 rounded-xl p-4 mb-4">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-apple-gray-600">
                <th className="pb-2">Cookie</th>
                <th className="pb-2">Purpose</th>
                <th className="pb-2">Duration</th>
              </tr>
            </thead>
            <tbody className="text-apple-gray-700">
              <tr>
                <td className="py-2 font-mono text-xs">_clck</td>
                <td className="py-2">Persists Clarity User ID</td>
                <td className="py-2">1 year</td>
              </tr>
              <tr>
                <td className="py-2 font-mono text-xs">_clsk</td>
                <td className="py-2">Connects pageviews to session</td>
                <td className="py-2">1 day</td>
              </tr>
              <tr>
                <td className="py-2 font-mono text-xs">CLID</td>
                <td className="py-2">First-party user identifier</td>
                <td className="py-2">1 year</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p className="text-apple-gray-700 mb-4">
          Learn more:{' '}
          <a
            href="https://privacy.microsoft.com/en-gb/privacystatement"
            className="text-apple-blue-600 hover:underline"
            target="_blank"
            rel="noopener noreferrer"
          >
            Microsoft Privacy Statement
          </a>
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">4. Managing Cookies</h2>
        <p className="text-apple-gray-700 mb-4">
          You can manage your cookie preferences in several ways:
        </p>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Browser Settings</h3>
        <p className="text-apple-gray-700 mb-4">
          Most web browsers allow you to control cookies through their settings. You can:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>View what cookies are stored on your device</li>
          <li>Delete individual or all cookies</li>
          <li>Block cookies from specific or all websites</li>
          <li>Block third-party cookies</li>
          <li>Accept all cookies</li>
        </ul>
        <p className="text-apple-gray-700 mb-4">
          Links to manage cookies in popular browsers:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>
            <a
              href="https://support.google.com/chrome/answer/95647"
              className="text-apple-blue-600 hover:underline"
              target="_blank"
              rel="noopener noreferrer"
            >
              Google Chrome
            </a>
          </li>
          <li>
            <a
              href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer"
              className="text-apple-blue-600 hover:underline"
              target="_blank"
              rel="noopener noreferrer"
            >
              Mozilla Firefox
            </a>
          </li>
          <li>
            <a
              href="https://support.apple.com/en-gb/guide/safari/sfri11471/mac"
              className="text-apple-blue-600 hover:underline"
              target="_blank"
              rel="noopener noreferrer"
            >
              Safari
            </a>
          </li>
          <li>
            <a
              href="https://support.microsoft.com/en-us/windows/delete-and-manage-cookies-168dab11-0753-043d-7c16-ede5947fc64d"
              className="text-apple-blue-600 hover:underline"
              target="_blank"
              rel="noopener noreferrer"
            >
              Microsoft Edge
            </a>
          </li>
        </ul>

        <h3 className="text-lg font-semibold text-apple-gray-900 mt-6 mb-3">Opt-Out Tools</h3>
        <p className="text-apple-gray-700 mb-4">
          You can also opt out of specific analytics services:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>
            <a
              href="https://tools.google.com/dlpage/gaoptout"
              className="text-apple-blue-600 hover:underline"
              target="_blank"
              rel="noopener noreferrer"
            >
              Google Analytics Opt-out Browser Add-on
            </a>
          </li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">5. Impact of Disabling Cookies</h2>
        <p className="text-apple-gray-700 mb-4">
          Please note that blocking or deleting cookies may affect your experience on our website:
        </p>
        <ul className="list-disc pl-6 text-apple-gray-700 mb-4 space-y-2">
          <li>Some features may not work properly</li>
          <li>Your preferences may not be saved</li>
          <li>You may see the cookie consent notice repeatedly</li>
        </ul>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">6. Updates to This Policy</h2>
        <p className="text-apple-gray-700 mb-4">
          We may update this Cookie Policy from time to time to reflect changes in our practices
          or for legal, operational, or regulatory reasons. The "Last updated" date at the top
          indicates when this policy was last revised.
        </p>
      </section>

      <section className="mb-8">
        <h2 className="text-2xl font-semibold text-apple-gray-900 mb-4">7. Contact Us</h2>
        <p className="text-apple-gray-700 mb-4">
          If you have any questions about our use of cookies, please contact us:
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
        </address>
      </section>
    </LegalPageLayout>
  );
}

import { Link } from 'react-router-dom';
import { ContentPageLayout } from '../../components/ContentPageLayout';
import { ContentSection, Lead, SectionHeading, PullQuote, Callout } from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'Do I own the tour with a local provider?',
    a: 'With Beyex, yes — you keep full ownership of your finished tour rather than renting access through a subscription.',
  },
  {
    q: 'Is Matterport technology bad?',
    a: 'Not at all — the capture technology is excellent, and we use Matterport Pro3 cameras. The difference is the commercial model: who owns the tour, how it is hosted, and the level of local support.',
  },
];

export default function MatterportVsLocalProvider() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'BlogPosting',
      headline: 'Matterport vs a Local Virtual Tour Provider: Which Is Right for Your Business?',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-06-01',
      dateModified: '2026-06-01',
      mainEntityOfPage: 'https://beyex.com/blog/matterport-vs-local-provider',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Blog', item: 'https://beyex.com/blog' },
        { '@type': 'ListItem', position: 3, name: 'Matterport vs a local provider', item: 'https://beyex.com/blog/matterport-vs-local-provider' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="Matterport vs a Local Virtual Tour Provider"
      subtitle="Subscription platform, or a local provider you own your tour with? A practical comparison to help you choose."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Blog', href: '/blog' }, { label: 'Matterport vs a local provider' }]}
      seoProps={{
        title: 'Matterport vs a Local Virtual Tour Provider',
        description:
          'A practical comparison of Matterport vs a local virtual tour provider — ownership, hosting, cost model, and support — to help UK businesses choose.',
        canonicalUrl: 'https://beyex.com/blog/matterport-vs-local-provider',
        ogType: 'article',
        schema,
      }}
      leadFormSector="Provider comparison"
      ctaTitle="Prefer to own your tour?"
      ctaText="Get a free, no-obligation quote — your tour, your space, fully owned by you."
      faqs={faqs}
    >
      <ContentSection>
        <Lead>
          Matterport is the best-known name in 3D virtual tours, and for good reason — the capture
          technology is excellent, and we use Matterport Pro3 cameras ourselves.
        </Lead>
        <p className="mt-6 text-lg text-apple-gray-700 leading-relaxed">
          But the brand and the commercial model are two different things. The real decision for most
          businesses is not the camera; it is who owns the finished tour, how it is hosted, and who
          you call when you need help.
        </p>
      </ContentSection>

      <PullQuote cite="The camera is the same. The commercial model is not.">
        The real decision isn&rsquo;t the camera &mdash; it&rsquo;s who owns the finished tour.
      </PullQuote>

      <ContentSection shaded>
        <SectionHeading eyebrow="Comparison">The key differences</SectionHeading>
        <div className="overflow-x-auto">
          <table className="w-full text-left text-sm">
            <thead>
              <tr className="border-b border-apple-gray-200 text-apple-gray-900">
                <th className="py-3 pr-4 font-semibold">&nbsp;</th>
                <th className="py-3 pr-4 font-semibold">Local provider (Beyex)</th>
                <th className="py-3 font-semibold">Platform subscription</th>
              </tr>
            </thead>
            <tbody className="text-apple-gray-700">
              <tr className="border-b border-apple-gray-100">
                <td className="py-3 pr-4 font-medium">Ownership</td>
                <td className="py-3 pr-4">You own the finished tour</td>
                <td className="py-3">Access tied to an ongoing subscription</td>
              </tr>
              <tr className="border-b border-apple-gray-100">
                <td className="py-3 pr-4 font-medium">Cost model</td>
                <td className="py-3 pr-4">One-off capture fee, hosting included</td>
                <td className="py-3">Recurring monthly/annual fees</td>
              </tr>
              <tr className="border-b border-apple-gray-100">
                <td className="py-3 pr-4 font-medium">Support</td>
                <td className="py-3 pr-4">Local team, direct contact</td>
                <td className="py-3">Self-serve / platform support</td>
              </tr>
              <tr>
                <td className="py-3 pr-4 font-medium">Capture quality</td>
                <td className="py-3 pr-4">Matterport Pro3</td>
                <td className="py-3">Matterport Pro3</td>
              </tr>
            </tbody>
          </table>
        </div>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Verdict">Which should you choose?</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed mb-4">
          If you want the lowest long-term cost and full control of your asset, a local provider that
          delivers an owned tour usually wins. If you need a large, centrally-managed estate with
          deep platform integrations, a subscription may suit. For most UK SMEs marketing a property
          or venue, ownership plus included hosting is the more economical route.
        </p>
        <Callout title="Not sure what your space needs?" variant="blue">
          Tell us about your space and we will recommend the most cost-effective option — even if
          that is not us. <Link to="/contact" className="underline font-medium">Get in touch →</Link>
        </Callout>
        <p className="text-lg text-apple-gray-700 leading-relaxed mt-4">
          Wondering about budget? See{' '}
          <Link to="/blog/3d-virtual-tour-cost-uk" className="text-apple-blue-600 hover:underline">
            how much a 3D virtual tour costs in the UK
          </Link>
          .
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

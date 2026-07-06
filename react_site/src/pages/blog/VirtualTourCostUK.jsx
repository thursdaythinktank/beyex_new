import { Link } from 'react-router-dom';
import { ContentPageLayout } from '../../components/ContentPageLayout';
import { ContentSection, Callout } from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'Is hosting included in the price?',
    a: 'Yes. Hosting is included for six months and remains free of charge while you have an active service agreement. You also keep full ownership of your tour.',
  },
  {
    q: 'Do prices include VAT?',
    a: 'Prices are shown excluding VAT where applicable. Your quote will confirm the final figure for your space.',
  },
  {
    q: 'How is the final price decided?',
    a: 'Mainly by floor area and complexity — number of floors, rooms, and any add-ons such as guided tours or measurement tools. Use our instant quote tool for an estimate.',
  },
];

export default function VirtualTourCostUK() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'BlogPosting',
      headline: 'How Much Does a 3D Virtual Tour Cost in the UK?',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-06-01',
      dateModified: '2026-06-01',
      mainEntityOfPage: 'https://beyex.com/blog/3d-virtual-tour-cost-uk',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Blog', item: 'https://beyex.com/blog' },
        { '@type': 'ListItem', position: 3, name: 'Cost of a 3D virtual tour in the UK', item: 'https://beyex.com/blog/3d-virtual-tour-cost-uk' },
      ],
    },
    {
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: faqs.map((f) => ({
        '@type': 'Question',
        name: f.q,
        acceptedAnswer: { '@type': 'Answer', text: f.a },
      })),
    },
  ];

  return (
    <ContentPageLayout
      title="How Much Does a 3D Virtual Tour Cost in the UK?"
      subtitle="A straightforward guide to what drives the price of a 3D virtual tour, what is included, and how to budget for your space."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Blog', href: '/blog' }, { label: 'Cost of a 3D virtual tour' }]}
      seoProps={{
        title: 'How Much Does a 3D Virtual Tour Cost in the UK?',
        description:
          'UK 3D virtual tour pricing explained: what drives cost, what is included, and how to budget. Clear price bands and an instant quote tool.',
        canonicalUrl: 'https://beyex.com/blog/3d-virtual-tour-cost-uk',
        ogType: 'article',
        schema,
      }}
      leadFormSector="Pricing enquiry"
      ctaTitle="Want an exact figure for your space?"
      ctaText="Use our instant quote tool or request a tailored quote — no obligation."
      faqs={faqs}
    >
      <ContentSection>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          If you are considering a 3D virtual tour for your property or business, the first question
          is usually the most practical one: how much will it cost? The honest answer is that it
          depends on the size and complexity of the space — but UK pricing is more predictable than
          most people expect, and you can get an exact figure in seconds with an online quote.
        </p>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What drives the price</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Three factors account for most of the variation in cost:
        </p>
        <ul className="list-disc pl-6 space-y-2 text-apple-gray-700">
          <li><strong>Floor area</strong> — larger spaces take longer to capture and process.</li>
          <li><strong>Complexity</strong> — number of floors, rooms, and separate areas.</li>
          <li><strong>Add-ons</strong> — guided tours, measurement tools, custom branding, and integrations.</li>
        </ul>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Typical price bands</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          As a guide, our own UK pricing is structured by floor area:
        </p>
        <ul className="list-disc pl-6 space-y-2 text-apple-gray-700">
          <li><strong>Small</strong> (up to 3,000 sq ft): around £111–£185.</li>
          <li><strong>Medium</strong> (3,000–10,000 sq ft): around £222–£1,111.</li>
          <li><strong>Enterprise</strong> (10,000+ sq ft): custom quote with volume options.</li>
        </ul>
        <p className="text-apple-gray-700 leading-relaxed mt-4">
          See the full breakdown on our <Link to="/pricing" className="text-apple-blue-600 hover:underline">pricing page</Link>.
        </p>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What is included</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A good package should cover the capture, the finished interactive tour, an embed code for
          your website, and hosting. With Beyex you also keep full ownership of your tour — it is not
          locked behind a subscription. Curious how that compares to platform providers? Read{' '}
          <Link to="/blog/matterport-vs-local-provider" className="text-apple-blue-600 hover:underline">
            Matterport vs a local provider
          </Link>
          .
        </p>
        <Callout title="Tip" variant="blue">
          The cheapest quote is not always the best value. Check whether hosting, ownership, and
          ongoing support are included before comparing on headline price alone.
        </Callout>
      </ContentSection>
    </ContentPageLayout>
  );
}

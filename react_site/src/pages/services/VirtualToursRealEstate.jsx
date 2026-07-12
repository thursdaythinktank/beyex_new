import { ContentPageLayout } from '../../components/ContentPageLayout';
import { FeatureCard, ProcessStep, ContentSection } from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'How do virtual tours reduce wasted viewings?',
    a: 'Buyers and tenants self-qualify online — they walk the property in 3D before booking, so the in-person viewings you do host are with genuinely interested, better-informed people.',
  },
  {
    q: 'Can the tour be added to portals like Rightmove?',
    a: 'Yes. You receive a shareable link and an embed code that can be added to your own listings and the major property portals that support virtual tours.',
  },
  {
    q: 'How long does a property scan take?',
    a: 'A typical home is captured in a couple of hours with no disruption, and your interactive tour is usually delivered within 3 to 5 business days.',
  },
];

export default function VirtualToursRealEstate() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Virtual Tours for Estate Agents & Real Estate',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-06-01',
      dateModified: '2026-06-01',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'Service',
      serviceType: '3D Virtual Tours for Real Estate',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description:
        'Immersive 3D virtual tours for estate agents and property marketing — reduce wasted viewings and market listings 24/7.',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-real-estate' },
        { '@type': 'ListItem', position: 3, name: 'Real Estate', item: 'https://beyex.com/services/virtual-tours-real-estate' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Virtual Tours for Estate Agents & Real Estate"
      subtitle="Market every listing 24/7, cut wasted viewings, and give buyers the confidence to act — with immersive 3D virtual tours."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Services' }, { label: 'Real Estate' }]}
      seoProps={{
        title: '3D Virtual Tours for Estate Agents & Real Estate',
        description:
          'Virtual tours for estate agents and property marketing. Reduce wasted viewings, market listings 24/7, and win more instructions with immersive 3D tours.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-real-estate',
        ogType: 'article',
        schema,
      }}
      demoTour={{ src: 'https://my.matterport.com/show/?m=z5PMXpHT98k', title: 'Sample property 3D virtual tour' }}
      leadFormSector="Real Estate"
      ctaTitle="Ready to reduce wasted viewings?"
      ctaText="Get a free, no-obligation quote for your listing or portfolio. We will guide you through the whole process."
      faqs={faqs}
    >
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Estate Agents Use 3D Virtual Tours</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Property decisions start online. Before anyone books a viewing, they have already browsed
          portals, compared photos, and formed an opinion. Flat images cannot convey how a home
          flows, how rooms connect, or how much space there really is. A 3D virtual tour lets a
          prospective buyer or tenant walk the property end to end, at any hour, from anywhere.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The result is fewer, better viewings: the people who book have already self-qualified, so
          your team spends time with serious applicants instead of tyre-kickers.
        </p>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What You Gain</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard title="Fewer wasted viewings">
            Buyers and tenants explore the property in full before booking, so in-person viewings are
            with informed, motivated applicants.
          </FeatureCard>
          <FeatureCard title="Always-on marketing">
            A tour markets the listing 24/7 across your website and property portals — no scheduling,
            no travel, no missed opportunities.
          </FeatureCard>
          <FeatureCard title="Win more instructions">
            Offering immersive tours signals a modern, professional service that helps you stand out
            when pitching for new instructions.
          </FeatureCard>
          <FeatureCard title="Reach distant buyers">
            Relocating, overseas, and investor buyers can commit with confidence without travelling to
            view in person.
          </FeatureCard>
        </div>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">How It Works</h2>
        <div className="mt-8">
          <ProcessStep number={1} title="Book a scan">
            We arrange a convenient time and capture the property on site — a typical home takes a
            couple of hours.
          </ProcessStep>
          <ProcessStep number={2} title="We build the tour">
            Your interactive 3D tour is produced within 3 to 5 business days.
          </ProcessStep>
          <ProcessStep number={3} title="Publish everywhere">
            You receive an embed code and a shareable link for your website, portals, and social
            channels.
          </ProcessStep>
        </div>
      </ContentSection>
    </ContentPageLayout>
  );
}

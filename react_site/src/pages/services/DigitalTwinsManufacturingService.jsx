import { ContentPageLayout } from '../../components/ContentPageLayout';
import { FeatureCard, ProcessStep, ContentSection } from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'How is a digital twin different from a one-off 3D scan?',
    a: 'A scan captures the space at a point in time. A digital twin pairs that 3D model with live operational data, so it becomes a working tool for planning, monitoring, and maintenance rather than just a record.',
  },
  {
    q: 'Will capture interrupt production?',
    a: 'No. We scan around your production schedule, typically capturing a facility in hours and phasing larger sites to avoid downtime.',
  },
  {
    q: 'Can the twin be used for staff training and remote audits?',
    a: 'Yes. Teams and auditors can walk the facility remotely for onboarding, safety inductions, and inspections without travelling to site.',
  },
];

export default function DigitalTwinsManufacturingService() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: 'Digital Twins for Manufacturing',
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
      serviceType: 'Digital Twins for Manufacturing',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description:
        'Digital twins for manufacturing — factory layout planning, remote audits, staff training, and maintenance support built on accurate 3D capture.',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/digital-twins-manufacturing' },
        { '@type': 'ListItem', position: 3, name: 'Manufacturing', item: 'https://beyex.com/services/digital-twins-manufacturing' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="Digital Twins for Manufacturing"
      subtitle="Plan layouts, run remote audits, train staff, and support maintenance with an accurate digital twin of your factory floor."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Services' }, { label: 'Manufacturing' }]}
      seoProps={{
        title: 'Digital Twins for Manufacturing',
        description:
          'Digital twins for manufacturing — factory layout planning, remote audits, staff training, and maintenance support built on accurate 3D capture.',
        canonicalUrl: 'https://beyex.com/services/digital-twins-manufacturing',
        ogType: 'article',
        schema,
      }}
      demoTour={{ src: 'https://my.matterport.com/show/?m=KZtJ9Buye4f', title: 'Sample facility 3D capture' }}
      leadFormSector="Manufacturing"
      ctaTitle="Ready to digitise your factory floor?"
      ctaText="Get a free, no-obligation quote for your facility. We will guide you through the whole process."
      faqs={faqs}
    >
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Manufacturers Build Digital Twins</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A manufacturing facility is a complex, constantly evolving environment. An accurate 3D
          digital twin gives every stakeholder — operations, engineering, health and safety, and
          visiting auditors — a shared, measurable view of the floor without everyone being on site.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          From planning a new line to inducting a new hire, decisions get faster and safer when they
          start from a precise model of the real space.
        </p>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What You Gain</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard title="Layout & line planning">
            Measure and plan reconfigurations against an accurate model before moving a single
            machine.
          </FeatureCard>
          <FeatureCard title="Remote audits & inspections">
            Auditors and head-office teams review the facility remotely, cutting travel and
            scheduling friction.
          </FeatureCard>
          <FeatureCard title="Faster onboarding">
            New staff and contractors learn the layout, hazards, and procedures before they set foot
            on the floor.
          </FeatureCard>
          <FeatureCard title="Maintenance reference">
            A precise spatial record supports maintenance planning and reduces time spent locating
            assets.
          </FeatureCard>
        </div>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">How It Works</h2>
        <div className="mt-8">
          <ProcessStep number={1} title="Capture the facility">
            We scan your floor around your production schedule, typically in hours, phasing larger
            sites to avoid downtime.
          </ProcessStep>
          <ProcessStep number={2} title="Build the twin">
            We produce a navigable 3D model that can be paired with operational data where useful.
          </ProcessStep>
          <ProcessStep number={3} title="Put it to work">
            Your teams plan, train, and inspect from a shareable link — with updates as the floor
            changes.
          </ProcessStep>
        </div>
      </ContentSection>
    </ContentPageLayout>
  );
}

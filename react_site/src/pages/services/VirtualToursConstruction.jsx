import { ContentPageLayout } from '../../components/ContentPageLayout';
import { FeatureCard, ProcessStep, ContentSection } from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'How does 3D scanning support the Building Safety Act "Golden Thread"?',
    a: 'Regular 3D captures create a time-stamped, navigable record of a building as it is constructed — an accurate digital reference that supports the Golden Thread of information through design, construction, and handover.',
  },
  {
    q: 'Can you capture an active construction site?',
    a: 'Yes. We scan progressively throughout the build, working around site activity, so you have an as-built record at each key stage.',
  },
  {
    q: 'What do we receive?',
    a: 'A navigable 3D model and tour you can share with your team, clients, and investors for remote inspection, progress tracking, and dispute resolution — delivered within days of each capture.',
  },
];

export default function VirtualToursConstruction() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Scanning & Digital Twins for Construction',
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
      serviceType: '3D Scanning for Construction',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description:
        'Progressive 3D scanning and digital twins for construction — as-built records, progress tracking, remote inspection, and Building Safety Act Golden Thread support.',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-construction' },
        { '@type': 'ListItem', position: 3, name: 'Construction', item: 'https://beyex.com/services/virtual-tours-construction' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Scanning & Digital Twins for Construction"
      subtitle="Document every stage of the build, inspect remotely, and support the Building Safety Act Golden Thread with accurate as-built 3D records."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Services' }, { label: 'Construction' }]}
      seoProps={{
        title: '3D Scanning & Digital Twins for Construction',
        description:
          '3D scanning for construction — as-built records, progress tracking, remote site inspection, and Building Safety Act Golden Thread support.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-construction',
        ogType: 'article',
        schema,
      }}
      demoTour={{ src: 'https://my.matterport.com/show/?m=KZtJ9Buye4f', title: 'Sample site 3D capture' }}
      leadFormSector="Construction"
      ctaTitle="Ready to document your build in 3D?"
      ctaText="Get a free, no-obligation quote for your project or site. We will guide you through the whole process."
      faqs={faqs}
    >
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Construction Teams Scan in 3D</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A construction site changes daily, and photographs only capture fragments. A 3D scan
          records the whole space exactly as it stood on a given date — every wall, service run, and
          structural detail — before it is covered by the next trade. That record becomes a single
          source of truth for the project team, clients, and investors.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          With regulation tightening under the Building Safety Act, an accurate, navigable digital
          record is no longer just convenient — it supports the Golden Thread of building information
          that must be maintained from design through handover.
        </p>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What You Gain</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard title="As-built records">
            Capture what is behind the wall before it is closed up — invaluable for maintenance,
            future works, and dispute resolution.
          </FeatureCard>
          <FeatureCard title="Remote progress tracking">
            Clients, investors, and head-office teams inspect progress from anywhere, reducing site
            visits and travel.
          </FeatureCard>
          <FeatureCard title="Golden Thread support">
            Time-stamped 3D captures contribute to the building information record required under the
            Building Safety Act.
          </FeatureCard>
          <FeatureCard title="Fewer disputes">
            An objective visual record of each stage helps resolve questions over what was built, and
            when.
          </FeatureCard>
        </div>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">How It Works</h2>
        <div className="mt-8">
          <ProcessStep number={1} title="Scan at key stages">
            We capture the site progressively — for example at first fix, second fix, and handover —
            working around site activity.
          </ProcessStep>
          <ProcessStep number={2} title="We build the record">
            Each capture becomes a navigable 3D model and tour, delivered within days.
          </ProcessStep>
          <ProcessStep number={3} title="Share and inspect">
            Your team accesses every stage remotely through a shareable link, building a complete
            as-built history of the project.
          </ProcessStep>
        </div>
      </ContentSection>
    </ContentPageLayout>
  );
}

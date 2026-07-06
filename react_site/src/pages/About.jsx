import { ContentPageLayout } from '../components/ContentPageLayout';
import {
  FeatureCard,
  StatCard,
  CheckList,
  Callout,
  ContentSection,
} from '../components/ui/ContentElements';

/*
 * About page. Copy is drawn from verified facts (UK-based, Washington/Tyne & Wear,
 * Matterport Pro3, 20+ yrs construction leadership, Chamber of Commerce member).
 * TODO: add the founder's name + a team photo once the client provides them.
 */
export default function About() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'AboutPage',
      name: 'About Beyex Ltd',
      description:
        'Beyex Ltd is a UK-based provider of immersive 3D virtual tours and digital twins, based in Washington, Tyne and Wear.',
      url: 'https://beyex.com/about',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'Organization',
      name: 'Beyex Ltd',
      url: 'https://beyex.com',
      logo: 'https://beyex.com/logo.png',
      foundingLocation: 'Washington, Tyne and Wear, United Kingdom',
      vatID: '509 4886 54',
      address: {
        '@type': 'PostalAddress',
        streetAddress: '8 Kielder',
        addressLocality: 'Washington',
        addressRegion: 'Tyne and Wear',
        postalCode: 'NE38 0NW',
        addressCountry: 'GB',
      },
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'About', item: 'https://beyex.com/about' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="About Beyex"
      subtitle="A UK team turning real spaces into immersive digital twins anyone can explore, from anywhere."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'About' }]}
      seoProps={{
        title: 'About Beyex — 3D Virtual Tours & Digital Twins',
        description:
          'Beyex Ltd is a UK-based 3D virtual tour and digital twin company in Washington, Tyne and Wear, led by 20+ years of construction-industry experience.',
        canonicalUrl: 'https://beyex.com/about',
        ogType: 'website',
        schema,
      }}
    >
      {/* Who we are */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Who We Are</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Beyex Ltd is a UK-based company specialising in immersive 3D virtual tours and digital
          twins. From our base in Washington, Tyne and Wear, we capture real places with
          professional Matterport Pro3 camera technology and turn them into accurate, interactive
          digital experiences that anyone can explore online.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          We believe a photograph can only show you a space — a virtual tour lets you understand it.
          Whether someone is choosing a hotel, evaluating a commercial unit, or planning a visit to a
          heritage site, stepping inside beforehand builds the confidence that turns interest into a
          decision.
        </p>
      </ContentSection>

      {/* Facts row */}
      <ContentSection>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          <StatCard value="20+ yrs" label="Construction-industry leadership" />
          <StatCard value="Matterport Pro3" label="Capture technology" />
          <StatCard value="UK-based" label="Washington, Tyne & Wear" />
          <StatCard value="Member" label="Chamber of Commerce" />
        </div>
      </ContentSection>

      {/* Leadership */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Our Leadership</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Beyex is led by a director with over 20 years of experience in the construction industry.
          That background shapes how we work: we understand buildings, sites, and how the people who
          use them actually move through a space — so the tours we produce are practical tools, not
          just attractive visuals.
        </p>
        <p className="text-apple-gray-700 leading-relaxed">
          As an active member of the local Chamber of Commerce, we are proud to be part of the North
          East business community and to support organisations across the region in presenting their
          spaces online.
        </p>
      </ContentSection>

      {/* What we do */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What We Do</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard title="Immersive 3D virtual tours">
            Realistic, navigable walkthroughs of any space — captured on site and delivered as an
            embeddable tour for your website and marketing channels.
          </FeatureCard>
          <FeatureCard title="Digital twins">
            Accurate digital replicas of physical environments for planning, documentation, remote
            inspection, and collaboration across industrial and commercial settings.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Sectors */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Sectors We Serve</h2>
        <CheckList
          columns={2}
          items={[
            'Property and real estate',
            'Hospitality and serviced accommodation',
            'Commercial and retail spaces',
            'Construction and architecture',
            'Tourism, heritage, and culture',
            'Education and industrial facilities',
          ]}
        />
      </ContentSection>

      {/* Why Beyex */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Work With Beyex</h2>
        <Callout title="You own your tour" variant="blue">
          Unlike subscription-locked platforms, our clients keep full ownership of their finished
          virtual tour. We pair that with transparent, competitive pricing and ongoing support —
          including troubleshooting and updates as your space changes.
        </Callout>
        <p className="text-apple-gray-700 leading-relaxed">
          A typical scan takes only a few hours and is non-disruptive to your day-to-day operations.
          You receive a polished, interactive tour — ready to share — within days.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

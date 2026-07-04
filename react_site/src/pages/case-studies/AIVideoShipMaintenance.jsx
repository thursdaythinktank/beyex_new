import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  FeatureCard,
  StatCard,
  CheckList,
  ProcessStep,
  ContentSection,
} from '../../components/ui/ContentElements';
import { LazyTourEmbed } from '../../components/ui/LazyTourEmbed';
import { TOURS } from '../../data/tours';

export default function AIVideoShipMaintenance() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: 'AI Video Generation for Ship Maintenance Training',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-03-14',
      dateModified: '2026-03-14',
      articleSection: 'Case Studies',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Case Studies', item: 'https://beyex.com/case-studies/ai-video-ship-maintenance' },
        { '@type': 'ListItem', position: 3, name: 'AI Video for Ship Maintenance', item: 'https://beyex.com/case-studies/ai-video-ship-maintenance' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="AI Video Generation for Ship Maintenance Training"
      subtitle="How 3D scanning and AI-generated video are transforming maritime maintenance training — reducing costs, improving safety, and accelerating crew readiness."
      author="Beyex Team"
      lastUpdated="March 2026"
      breadcrumbs={[
        { label: 'Case Studies' },
        { label: 'AI Video for Ship Maintenance' },
      ]}
      seoProps={{
        title: 'AI Video Generation for Ship Maintenance Training',
        description: 'Case study: how 3D digital twins and AI video generation reduce ship maintenance training costs by up to 40% while improving crew safety and competence.',
        canonicalUrl: 'https://beyex.com/case-studies/ai-video-ship-maintenance',
        ogType: 'article',
        schema,
      }}
      cta={{ title: 'Have a training problem like this one?', description: 'Talk to us about turning your facility into training-ready 3D and AI video.', buttonLabel: 'Get Your Free Quote' }}
    >
      {/* The Challenge */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">The Challenge</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Maritime maintenance training is expensive, logistically complex, and often dangerous. Ships are in constant operation, and pulling a vessel out of service for crew training is rarely an option. Traditional training methods — classroom instruction, printed manuals, and supervised on-the-job learning — have significant limitations.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            }
            title="Access constraints"
          >
            Training on live equipment in confined spaces like engine rooms carries inherent safety risks. Certain procedures can only be practised when the vessel is in dry dock, which may happen once every five years.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            }
            title="Inconsistent quality"
          >
            Training quality depends heavily on the experience of the supervising engineer. Without standardised visual materials specific to the vessel, knowledge transfer is inconsistent.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            }
            title="High costs"
          >
            Travel, accommodation, and the opportunity cost of taking experienced crew members off operational duties to train juniors add up quickly across a fleet.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            }
            title="Documentation gaps"
          >
            As-built conditions rarely match original technical drawings, especially on older vessels that have undergone multiple refits.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* The Solution */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">The Solution: 3D Scans + AI Video</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The approach combines two technologies: high-fidelity 3D scanning of the vessel and AI-powered video generation from the resulting digital twin.
        </p>

        <h3 className="text-xl font-semibold mb-3">Step 1: 3D Scanning the Vessel</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          During a scheduled maintenance window, the vessel is scanned using a combination of LiDAR and photogrammetry. The focus is on areas most relevant to maintenance training: engine rooms, pump rooms, ballast systems, HVAC compartments, and deck machinery.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The scan captures not just geometry, but the current as-built condition — including modifications, retrofits, and the actual routing of pipes, cables, and ducting that may differ from original plans.
        </p>

        <h3 className="text-xl font-semibold mb-3">Step 2: Creating the Digital Twin</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The raw scan data is processed into a navigable 3D model — a digital twin of the vessel. This model can be explored interactively, with the ability to measure distances, annotate components, and link to technical documentation.
        </p>

        <h3 className="text-xl font-semibold mb-3">Step 3: AI Video Generation</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Using the 3D digital twin as the visual foundation, AI video generation tools create training videos that show specific maintenance procedures within the actual vessel environment. These videos can include:
        </p>
        <CheckList
          items={[
            'Step-by-step walkthroughs of maintenance procedures',
            'Annotated views highlighting valves, switches, and access panels',
            'Safety briefings showing escape routes and hazard zones',
            'Comparison views showing normal vs. faulty component states',
          ]}
        />
      </ContentSection>

      {/* Live Tour */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Step Inside a Real Capture</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-6">
          This is a real Beyex 3D capture — the Week2Week serviced apartments. It shows the kind of navigable model the scanning process described above produces, before AI video generation is layered on top.
        </p>
        <LazyTourEmbed tour={TOURS.week2week} />
      </ContentSection>

      {/* Results */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Results</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The combination of digital twins and AI-generated training content delivers measurable improvements across several dimensions:
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <StatCard value="Up to 40%" label="Reduction in training costs by eliminating travel and reducing on-site training time" />
          <StatCard value="3x Faster" label="New crew familiarisation compared to traditional manual-based onboarding" />
          <StatCard value="On demand" label="Training materials available around the clock, on any device, from any location" />
          <StatCard value="Improved Safety" label="Crew can practise procedures virtually before performing them on live equipment" />
        </div>
      </ContentSection>

      {/* Methodology */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Methodology</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The project followed a structured approach designed to minimise disruption to vessel operations:
        </p>
        <ProcessStep number={1} title="Scoping">
          Identified 12 key maintenance procedures to digitise, prioritised by frequency, safety criticality, and training difficulty.
        </ProcessStep>
        <ProcessStep number={2} title="Scanning">
          Completed the full vessel scan during a 3-day maintenance window. Engine room, pump room, and deck machinery areas were captured at sub-centimetre accuracy.
        </ProcessStep>
        <ProcessStep number={3} title="Processing">
          Built the digital twin over 2 weeks, including annotation of 200+ components with technical metadata and maintenance schedules.
        </ProcessStep>
        <ProcessStep number={4} title="Video production">
          Generated AI training videos for each procedure, reviewed by senior engineers for technical accuracy.
        </ProcessStep>
        <ProcessStep number={5} title="Deployment">
          Delivered via a secure web platform accessible to fleet crew on tablets and laptops, with offline capability for use at sea.
        </ProcessStep>
      </ContentSection>

      {/* Broader Applications */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Broader Applications</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          While this case study focuses on maritime maintenance, the same approach applies to any industry where complex equipment requires hands-on training:
        </p>
        <CheckList
          columns={2}
          items={[
            'Oil and gas platform operations',
            'Power generation plant maintenance',
            'Manufacturing equipment servicing',
            'Data centre infrastructure management',
            'Aviation ground crew training',
          ]}
        />
      </ContentSection>
    </ContentPageLayout>
  );
}

import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  FeatureCard,
  CheckList,
  ProcessStep,
  Callout,
  ContentSection,
} from '../../components/ui/ContentElements';
import { LazyTourEmbed } from '../../components/ui/LazyTourEmbed';
import { TOURS } from '../../data/tours';

export default function DigitalTwinsManufacturing() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: 'The Complete Guide to Digital Twins in Manufacturing',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-03-14',
      dateModified: '2026-03-14',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'HowTo',
      name: 'How to Implement Digital Twins in Manufacturing',
      description: 'A step-by-step guide to implementing digital twin technology in manufacturing environments',
      step: [
        { '@type': 'HowToStep', name: 'Audit your existing infrastructure', text: 'Assess current SCADA systems, sensors, and data flows to identify integration points.' },
        { '@type': 'HowToStep', name: 'Scan your facility', text: 'Create a high-fidelity 3D model of your manufacturing floor using LiDAR and photogrammetry.' },
        { '@type': 'HowToStep', name: 'Connect data sources', text: 'Integrate SCADA, IoT sensors, and ERP data into the digital twin platform.' },
        { '@type': 'HowToStep', name: 'Build operational dashboards', text: 'Create visualisations that overlay live data onto the 3D model for real-time monitoring.' },
        { '@type': 'HowToStep', name: 'Train and iterate', text: 'Train operations teams, gather feedback, and continuously refine the digital twin.' },
      ],
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Resources', item: 'https://beyex.com/resources/digital-twins-manufacturing' },
        { '@type': 'ListItem', position: 3, name: 'Digital Twins in Manufacturing', item: 'https://beyex.com/resources/digital-twins-manufacturing' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="The Complete Guide to Digital Twins in Manufacturing"
      subtitle="How to combine SCADA data, AI analytics, and 3D spatial models to build a digital twin of your manufacturing operation."
      author="Beyex Team"
      lastUpdated="March 2026"
      breadcrumbs={[
        { label: 'Resources' },
        { label: 'Digital Twins in Manufacturing' },
      ]}
      seoProps={{
        title: 'The Complete Guide to Digital Twins in Manufacturing',
        description: 'Comprehensive guide to implementing digital twins in manufacturing. Covers SCADA integration, AI analytics, ROI calculations, and a step-by-step implementation roadmap.',
        canonicalUrl: 'https://beyex.com/resources/digital-twins-manufacturing',
        ogType: 'article',
        schema,
      }}
    >
      {/* What Is a Digital Twin */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What Is a Digital Twin in Manufacturing?</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A digital twin in manufacturing is a real-time virtual representation of a physical production environment. It goes beyond a 3D model — it connects to live data from sensors, SCADA systems, and enterprise software to mirror the actual state of the factory floor.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The concept is straightforward: if you can see a machine on the factory floor, you should be able to see its digital counterpart on a screen — complete with its current status, performance metrics, maintenance history, and predicted future behaviour.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For manufacturing operations, this creates opportunities that simply do not exist with traditional monitoring systems. Instead of looking at gauges, charts, and spreadsheets in isolation, operators and managers interact with a spatial model that shows them the factory as it actually is, right now.
        </p>
      </ContentSection>

      {/* SCADA and AI */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">SCADA and AI: The Data Foundation</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Most modern manufacturing facilities already have SCADA infrastructure monitoring key processes. These systems collect vast amounts of data — temperatures, pressures, flow rates, motor speeds, vibration levels, and fault codes — but present it in ways that require significant expertise to interpret.
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">SCADA Integration</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A digital twin takes SCADA data and maps it onto a 3D model of the facility. Instead of viewing a process variable as a number in a table, operators see it in context — attached to the specific piece of equipment generating it, surrounded by related assets, and colour-coded to indicate status.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          This spatial context reduces the cognitive load on operators. Anomalies that might be missed in a table of hundreds of data points become immediately visible when a single machine in the 3D model turns red.
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">AI-Powered Analytics</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          When AI models are applied to the data flowing into a digital twin, the system moves from monitoring to prediction. Machine learning algorithms can:
        </p>
        <CheckList
          items={[
            'Detect anomalies that precede equipment failure, enabling predictive maintenance',
            'Optimise production schedules by simulating different scenarios in the digital twin',
            'Identify energy waste patterns by correlating consumption with production output',
            'Predict quality issues by analysing upstream process variables',
          ]}
        />
      </ContentSection>

      {/* Virtual Operations and Maintenance */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Virtual Operations and Maintenance</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          One of the highest-value applications of digital twins in manufacturing is virtual operations and maintenance (O&M). This covers several use cases:
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">Remote Monitoring</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Operations managers can monitor multiple facilities from a central location. The digital twin provides the spatial awareness that traditional dashboards lack — you can virtually walk through the plant, checking on different areas and drilling into equipment status.
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">Maintenance Planning</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Maintenance teams can plan interventions using the digital twin to understand access routes, identify nearby assets that may need to be isolated, and assess the space available for equipment and personnel. This reduces planning time and improves safety.
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">Training and Onboarding</h3>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          New operators can familiarise themselves with the facility layout, equipment locations, and standard operating procedures using the digital twin before stepping onto the factory floor. This accelerates onboarding and reduces the risk of errors during the learning period.
        </p>
      </ContentSection>

      {/* Live Tour */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Step Inside a Real Capture</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-6">
          This is the Brewhouse, a former industrial building captured by Beyex. Walk through it to see the level of spatial detail a 3D scan provides — the foundation layer of any digital twin.
        </p>
        <LazyTourEmbed tour={TOURS.brewhouse} />
      </ContentSection>

      {/* Implementation Roadmap */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Implementation Roadmap</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Implementing a digital twin in a manufacturing environment is a phased process. Rushing to a fully connected, AI-powered twin without the foundations in place leads to disappointment. Here is a practical roadmap:
        </p>

        <ProcessStep number={1} title="Audit and Planning (2-4 weeks)">
          <CheckList
            items={[
              'Map existing SCADA infrastructure and data availability',
              'Identify the highest-value use cases for your operation',
              'Define success metrics and ROI targets',
              'Select a pilot area (one production line or area, not the entire facility)',
            ]}
          />
        </ProcessStep>

        <ProcessStep number={2} title="3D Scanning (1-3 days per area)">
          <CheckList
            items={[
              'Scan the pilot area using LiDAR and photogrammetry',
              'Capture as-built conditions, including equipment, piping, and cable routing',
              'Document equipment identifiers for SCADA integration',
            ]}
          />
        </ProcessStep>

        <ProcessStep number={3} title="Digital Twin Build (2-4 weeks)">
          <CheckList
            items={[
              'Process scan data into a navigable 3D model',
              'Integrate SCADA data feeds',
              'Build initial dashboards and visualisations',
              'Test with operations team and gather feedback',
            ]}
          />
        </ProcessStep>

        <ProcessStep number={4} title="Expansion and AI Integration (ongoing)">
          <CheckList
            items={[
              'Extend the digital twin to additional production areas',
              'Add predictive maintenance models',
              'Integrate with ERP and MES systems',
              'Develop custom analytics for your specific processes',
            ]}
          />
        </ProcessStep>
      </ContentSection>

      {/* ROI Considerations */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">ROI Considerations</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The return on investment from a manufacturing digital twin typically comes from several sources:
        </p>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            }
            title="Reduced unplanned downtime"
          >
            Predictive maintenance can reduce unplanned downtime by 30-50%, which for many operations translates to hundreds of thousands of pounds per year.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
              </svg>
            }
            title="Energy savings"
          >
            Identifying and eliminating energy waste typically delivers 5-15% savings on energy costs.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.049.58.025 1.193-.14 1.743" />
              </svg>
            }
            title="Faster maintenance"
          >
            Better planning and spatial context reduces maintenance duration by 10-25%.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
              </svg>
            }
            title="Improved safety"
          >
            Fewer on-site inspections and better pre-planning reduce incident rates.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
              </svg>
            }
            title="Training efficiency"
          >
            Faster onboarding and reduced training travel costs.
          </FeatureCard>
        </div>

        <Callout variant="blue" title="Typical Payback Period">
          For a mid-sized manufacturing operation, the payback period for a digital twin implementation is typically 6-18 months, depending on the scope and the value of the use cases addressed.
        </Callout>
      </ContentSection>

      {/* Getting Started */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Getting Started</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The most effective approach is to start small, prove value, and expand. Choose a single production line or area where you have a clear pain point — whether that is unplanned downtime, quality issues, or training challenges — and build a focused digital twin to address it.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Contact us to discuss your manufacturing environment and how a digital twin could deliver value for your operation.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

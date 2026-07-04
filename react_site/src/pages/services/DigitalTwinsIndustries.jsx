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

export default function DigitalTwinsIndustries() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: 'Digital Twins for Industrial Facilities',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-05-01',
      dateModified: '2026-05-01',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'Service',
      serviceType: 'Industrial Digital Twins',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description: 'Operational digital twins for factories, plants, and industrial facilities combining 3D spatial models with SCADA integration and AI analytics.',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/digital-twins-industries' },
        { '@type': 'ListItem', position: 3, name: 'Digital Twins for Industries', item: 'https://beyex.com/services/digital-twins-industries' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="Digital Twins for Industrial Facilities"
      subtitle="How 3D spatial models, SCADA integration, and AI analytics create operational digital twins for factories, plants, and industrial operations."
      author="Beyex Team"
      lastUpdated="May 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Digital Twins for Industries' },
      ]}
      seoProps={{
        title: 'Digital Twins for Industrial Facilities',
        description: 'Operational digital twins for industrial facilities — combining high-fidelity 3D models with SCADA data, IoT sensors, and AI analytics for predictive maintenance and production optimisation.',
        canonicalUrl: 'https://beyex.com/services/digital-twins-industries',
        ogType: 'article',
        schema,
      }}
    >
      {/* What Is an Industrial Digital Twin */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What Is an Industrial Digital Twin</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          An industrial digital twin is a high-fidelity virtual replica of a physical facility — a factory floor, processing plant, warehouse, or production line — that mirrors the real-world asset in near real time. It combines spatially accurate 3D geometry with live operational data drawn from SCADA systems, IoT sensor networks, and enterprise platforms such as ERP and MES.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The distinction between a digital twin and a conventional 3D model is fundamental. A 3D model is static: it represents the facility as it was at the moment of capture. A digital twin is connected and alive. It ingests telemetry — temperatures, pressures, vibration frequencies, energy draw, production counts — and maps that data onto the spatial model so that operators see not just where equipment sits, but how it is performing right now.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          This convergence of spatial and operational data turns a visualisation into a decision-support system. Facility managers can navigate the 3D model, click on a compressor, and see its current temperature, vibration signature, maintenance history, and predicted remaining useful life — all without leaving their desk or opening a separate dashboard.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For multi-site operations, the value compounds. A central engineering team can oversee plants across the country through a unified digital twin interface, comparing performance metrics site by site and identifying which facilities need attention before problems escalate.
        </p>
      </ContentSection>

      {/* SCADA and IoT Integration */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">SCADA and IoT Integration</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Most industrial facilities already collect vast quantities of sensor data through SCADA and distributed control systems. The challenge is not data scarcity — it is context. A SCADA alarm telling you that pump P-4012 has exceeded its vibration threshold is useful, but it requires the operator to know where P-4012 is located, what it serves, and what upstream or downstream equipment might be affected.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A digital twin solves this by anchoring every data point to a spatial location in the 3D model. Sensor readings are not rows in a spreadsheet; they are colour-coded overlays on the actual equipment. An operator navigating the model can see at a glance which zones are running hot, which conveyors are drawing abnormal power, and which areas have triggered alerts — all within the spatial context of the facility layout.
        </p>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">Key Monitoring Capabilities</h3>
        <CheckList
          items={[
            'Temperature monitoring across equipment, zones, and environmental conditions',
            'Vibration analysis for rotating machinery, bearings, and structural components',
            'Energy consumption tracking at machine, line, and facility level',
            'Fault detection and alerting with spatial localisation in the 3D model',
          ]}
        />
      </ContentSection>

      {/* AI-Powered Analytics */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">AI-Powered Analytics</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Once a digital twin is receiving live data, it becomes a platform for machine learning models that can detect patterns no human operator would spot. AI transforms the twin from a monitoring tool into a predictive and prescriptive system — one that not only reports what is happening but anticipates what will happen next and recommends action.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            }
            title="Predictive Maintenance"
          >
            Machine learning models trained on historical failure data can forecast when a component is likely to degrade beyond acceptable limits. Maintenance shifts from calendar-based schedules to condition-based interventions, reducing both unplanned downtime and unnecessary servicing.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
              </svg>
            }
            title="Energy Optimisation"
          >
            AI analyses consumption patterns across shifts, seasons, and production loads to identify waste. It can recommend optimal scheduling of energy-intensive processes, flag equipment drawing more power than expected, and model the financial impact of efficiency improvements.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            }
            title="Quality Control"
          >
            By correlating environmental conditions, machine parameters, and defect rates, AI models can identify the root causes of quality issues. When a batch starts trending out of specification, the system can alert operators and highlight which variables have shifted.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
              </svg>
            }
            title="Safety Monitoring"
          >
            AI can monitor confined space conditions, detect unusual personnel movement patterns, and flag potential hazards before they become incidents. Combined with the spatial model, safety teams can visualise risk zones and plan evacuations with full awareness of facility layout.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* AI Video Generation */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">AI Video Generation</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          An emerging capability within digital twin platforms is AI-generated video. Rather than requiring every stakeholder to navigate a 3D model — which demands a degree of spatial literacy and technical confidence — AI can produce scripted video walkthroughs that present the facility in a linear, accessible format.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          These generated videos serve multiple purposes. Training departments can produce induction walkthroughs that guide new staff through safety-critical areas, highlighting equipment, exit routes, and hazard zones without scheduling physical tours. Operations directors preparing board presentations can generate polished fly-throughs that communicate facility status, expansion plans, or maintenance backlogs to non-technical audiences. Remote inspection teams can receive AI-curated video summaries that focus on areas flagged by the monitoring system, saving hours of manual navigation.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The technology is still maturing, but the trajectory is clear. As generative AI models improve their understanding of 3D environments, the quality and utility of these video outputs will increase — making digital twins accessible to a far broader audience within the organisation.
        </p>

        <Callout title="Bridging the Accessibility Gap" variant="blue">
          AI-generated video walkthroughs enable stakeholders who are not comfortable navigating 3D models to experience the facility through familiar video format.
        </Callout>
      </ContentSection>

      {/* Case Study: Padocare */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Case Study: Padocare</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Padocare is a UK-based cloud software company operating in the healthcare staffing and digital social care records space. Their platform centres on a proprietary 42 Factor AI Matching System that analyses 42 distinct data points — including staff compliance status, DBS checks, travel times, personal preferences, and fatigue indicators — to auto-match carers to healthcare shifts within 30 seconds.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Beyex captured Padocare's operational facility in high-fidelity 3D, documenting the workspace where this technology-driven staffing operation is managed. The scan produced a navigable digital model that Padocare uses for stakeholder presentations, onboarding new team members, and demonstrating their operational environment to healthcare partners and commissioners.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          This project illustrates an important point: digital capture is not limited to heavy industry. Any organisation whose physical environment is integral to its operations — whether that is a factory floor, a logistics hub, or a technology company's control centre — benefits from having a precise, navigable record of its space. The 3D model becomes a communication tool, a training asset, and a baseline for future facility planning.
        </p>
      </ContentSection>

      {/* Live Tour */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Step Inside a Real Capture</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-6">
          This is the Padocare facility from the case study above, captured by Beyex. Navigate the space yourself to see the spatial foundation on which an operational digital twin is built.
        </p>
        <LazyTourEmbed tour={TOURS.padocare} />
      </ContentSection>

      {/* Implementation Roadmap */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Implementation Roadmap</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Deploying an industrial digital twin is a phased process. Rushing to integrate every data source from day one introduces unnecessary complexity. A staged approach delivers value at each step while building toward full operational integration.
        </p>
        <div className="mt-8">
          <ProcessStep number={1} title="Facility Audit and Data Mapping">
            We survey the facility to understand its physical layout, equipment inventory, and existing data infrastructure. This includes cataloguing SCADA tags, IoT sensor locations, and enterprise system APIs to determine what data is available and how it can be ingested.
          </ProcessStep>

          <ProcessStep number={2} title="3D Scanning with LiDAR and Photogrammetry">
            High-resolution LiDAR scanning captures millimetre-accurate geometry of the facility, while photogrammetry adds photorealistic texture. The result is a spatially precise 3D model that serves as the foundation for all subsequent data overlays.
          </ProcessStep>

          <ProcessStep number={3} title="SCADA and IoT Data Integration">
            Sensor data feeds are mapped onto the 3D model, connecting each data point to its physical location. This stage involves configuring data pipelines, establishing refresh rates, and defining alert thresholds in collaboration with the facility's engineering team.
          </ProcessStep>

          <ProcessStep number={4} title="Dashboard and Visualisation Build">
            Interactive dashboards are layered onto the digital twin, providing role-specific views for operators, maintenance teams, and management. Visualisations include heat maps, trend charts, alert panels, and equipment status indicators.
          </ProcessStep>

          <ProcessStep number={5} title="Training and Continuous Refinement">
            Staff are trained on the platform, and the digital twin enters a continuous improvement cycle. As the facility evolves — new equipment, layout changes, additional sensors — the model is updated to maintain accuracy.
          </ProcessStep>
        </div>
      </ContentSection>

      {/* Getting Started */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Getting Started</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Whether you operate a single production line or a network of industrial facilities, a digital twin can transform how you monitor, maintain, and optimise your operations. The starting point is a conversation about your facility's data landscape and operational priorities.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For further reading on how digital twins apply to specific sectors, see our guides on{' '}
          <a href="/resources/digital-twins-manufacturing" className="text-apple-blue-600 hover:text-apple-blue-700 underline">
            digital twins in manufacturing
          </a>{' '}
          and{' '}
          <a href="/services/digital-twins-solar-energy" className="text-apple-blue-600 hover:text-apple-blue-700 underline">
            digital twins for solar energy
          </a>.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

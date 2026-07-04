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

export default function DigitalTwinsSolarEnergy() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: 'How Digital Twins Transform Solar Energy Operations',
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
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/digital-twins-solar-energy' },
        { '@type': 'ListItem', position: 3, name: 'Digital Twins for Solar Energy', item: 'https://beyex.com/services/digital-twins-solar-energy' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="How Digital Twins Transform Solar Energy Operations"
      subtitle="From predictive maintenance to energy yield optimisation, digital twin technology is reshaping how solar farms operate and scale."
      author="Beyex Team"
      lastUpdated="March 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Digital Twins for Solar Energy' },
      ]}
      seoProps={{
        title: 'How Digital Twins Transform Solar Energy Operations',
        description: 'Learn how digital twin technology optimises solar farm performance through SCADA integration, predictive maintenance, and remote 3D inspections.',
        canonicalUrl: 'https://beyex.com/services/digital-twins-solar-energy',
        ogType: 'article',
        schema,
      }}
    >
      {/* What Is a Digital Twin */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">What Is a Digital Twin in Solar Energy?</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A digital twin is a virtual replica of a physical asset — in this case, a solar farm or installation — that mirrors its real-world counterpart in real time. It combines 3D spatial data with operational data from SCADA systems, weather sensors, and inverter telemetry to create a living model of the plant.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Unlike a static 3D model, a digital twin is dynamic. It updates as conditions change, making it a decision-support tool rather than just a visualisation. Operators can see which panels are underperforming, identify soiling patterns, track degradation curves, and plan maintenance routes — all from a screen.
        </p>
      </ContentSection>

      {/* SCADA Integration */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">SCADA Integration for Predictive Maintenance</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          SCADA (Supervisory Control and Data Acquisition) systems already monitor solar farms for faults, power output, and environmental conditions. A digital twin layers this data onto a spatial model, adding context that raw numbers cannot provide.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For example, an inverter fault alert in a SCADA dashboard tells you something is wrong. A digital twin shows you exactly where that inverter sits in the plant, which string it serves, which panels are affected, and whether there is a pattern — such as recurring faults in a section exposed to prevailing winds carrying debris.
        </p>

        <Callout title="Why Spatial Context Matters" variant="blue">
          By anchoring SCADA data to a 3D model, operators gain spatial context that significantly reduces cognitive load. Instead of cross-referencing spreadsheets and schematics, teams can visually navigate to the exact location of an issue and understand its relationship to surrounding equipment in seconds.
        </Callout>

        <h3 className="text-xl font-semibold text-apple-gray-900 mb-4">Predictive Maintenance Benefits</h3>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            }
            title="Reduced Downtime"
          >
            Identify degrading components before they fail, allowing scheduled replacements during low-irradiance periods.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
              </svg>
            }
            title="Optimised Crew Dispatch"
          >
            Maintenance teams receive precise locations and visual context, reducing time spent locating issues on sprawling sites.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            }
            title="Historical Trend Analysis"
          >
            Overlay historical performance data to spot degradation trends and forecast when panels will drop below economic viability.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Energy Yield Optimisation */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Energy Yield Optimisation</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Digital twins enable solar operators to simulate scenarios that would be impractical or expensive to test physically. By combining irradiance modelling, shading analysis, and panel tilt data within the digital twin, operators can:
        </p>
        <CheckList
          items={[
            'Identify panels affected by seasonal shading from nearby structures or vegetation',
            'Model the impact of adding new rows or reconfiguring existing layouts',
            'Compare actual vs. theoretical yield at the string level to pinpoint underperformance',
            'Test cleaning schedules by correlating soiling data with output drops',
          ]}
        />
        <p className="text-apple-gray-700 leading-relaxed mb-4 mt-6">
          The result is a data-driven approach to maximising the financial return of every panel in the plant.
        </p>
      </ContentSection>

      {/* Remote Inspections */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Remote Inspections via 3D Tours</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Solar farms are often in remote locations. Sending inspection teams to a site in rural Spain, the Scottish Highlands, or sub-Saharan Africa involves significant travel time and cost. A 3D virtual tour of the plant allows remote inspections that are far more effective than reviewing photographs or drone footage.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          With a digital twin, an engineer in London can navigate the plant, zoom into specific panels, check mounting hardware, and review the condition of cable runs and junction boxes. When combined with drone-captured thermal imagery overlaid on the 3D model, it becomes possible to spot hotspots and cell-level defects without ever visiting the site.
        </p>
      </ContentSection>

      {/* Live Tour */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Step Inside a Real Capture</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-6">
          This is a real Beyex digital twin capture — the Padocare operational facility. The same scanning process produces the navigable 3D models used for remote inspections of energy sites.
        </p>
        <LazyTourEmbed tour={TOURS.padocare} />
      </ContentSection>

      {/* Use Cases Across the Solar Lifecycle */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Use Cases Across the Solar Lifecycle</h2>

        <ProcessStep number={1} title="Pre-Construction">
          Digital twins help developers visualise proposed layouts in the actual terrain, assess shading impact from nearby structures, and present realistic plans to investors and planning authorities.
        </ProcessStep>

        <ProcessStep number={2} title="Construction and Commissioning">
          During build-out, regular 3D scans create a progress record and an as-built model. This as-built twin becomes the baseline for all future monitoring, ensuring the plant is documented exactly as constructed — not as designed.
        </ProcessStep>

        <ProcessStep number={3} title="Operations and Maintenance">
          The operational phase is where digital twins deliver the highest ROI. Real-time performance monitoring, fault localisation, and maintenance planning are all enhanced when operators can work with a spatial model of the plant rather than spreadsheets and schematics.
        </ProcessStep>

        <ProcessStep number={4} title="Repowering and End of Life">
          When panels reach the end of their economic life, the digital twin provides the data needed to assess repowering options — which sections to replace first, what the expected yield improvement will be, and how to phase the work to minimise output loss.
        </ProcessStep>
      </ContentSection>

      {/* Getting Started */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Getting Started</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Whether you operate a rooftop installation or a utility-scale solar farm, digital twin technology can improve your operations. The process starts with a 3D scan of your site, which we then enhance with your SCADA and performance data to create a living model of your plant.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Contact us to discuss how a digital twin could work for your solar assets.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  FeatureCard,
  Callout,
  CheckList,
  ProcessStep,
  ContentSection,
} from '../../components/ui/ContentElements';

export default function VirtualToursEducation() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Virtual Tours for Educational Institutions',
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
      '@type': 'Service',
      serviceType: '3D Virtual Tours for Education',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description: 'Immersive 3D virtual campus tours for schools, colleges, and universities',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-education' },
        { '@type': 'ListItem', position: 3, name: 'Virtual Tours for Education', item: 'https://beyex.com/services/virtual-tours-education' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Virtual Tours for Educational Institutions"
      subtitle="Help prospective students explore your campus from anywhere in the world with immersive, interactive 3D virtual tours."
      author="Beyex Team"
      lastUpdated="March 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Virtual Tours for Education' },
      ]}
      seoProps={{
        title: '3D Virtual Tours for Educational Institutions',
        description: 'Immersive 3D virtual campus tours for schools, colleges, and universities. Boost admissions with interactive online open days and accessible campus experiences.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-education',
        ogType: 'article',
        schema,
      }}
    >
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Campuses Need Virtual Tours</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Choosing a school, college, or university is one of the most important decisions a student and their family will make. Yet geographical distance, travel costs, and scheduling conflicts mean many prospective students never set foot on campus before accepting an offer. A 3D virtual tour removes that barrier entirely.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Instead of relying on flat photographs or pre-recorded video walkthroughs, an interactive 3D tour lets visitors navigate the campus at their own pace. They can explore lecture halls, libraries, student accommodation, sports facilities, and common areas — all from a browser on any device.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For international students, this is transformative. A student in Lagos, Mumbai, or Sao Paulo can walk through a university in Newcastle with the same spatial awareness as someone standing in the building. The result is more confident decision-making and higher conversion from enquiry to enrolment.
        </p>

        <Callout title="Key Insight" variant="blue">
          Virtual tours are especially powerful for international student recruitment. Prospective students who cannot visit in person gain the spatial understanding they need to commit to an institution thousands of miles from home, reducing drop-off between offer and enrolment.
        </Callout>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">How We Capture Educational Spaces</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Our process is designed to be minimally disruptive to campus operations. We use professional-grade 3D scanning equipment that captures spaces quickly and accurately.
        </p>
        <h3 className="text-xl font-semibold mb-3">The Process</h3>
        <ProcessStep number={1} title="Site survey and planning">
          We visit your campus to identify key areas to scan, plan the route, and schedule around teaching hours.
        </ProcessStep>
        <ProcessStep number={2} title="3D scanning">
          Our technicians scan each space using LiDAR and photogrammetry. A typical lecture hall takes 15-20 minutes; an entire campus building takes 2-4 hours.
        </ProcessStep>
        <ProcessStep number={3} title="Processing and stitching">
          We process the raw scans into a seamless, navigable 3D model. This typically takes 3-5 business days.
        </ProcessStep>
        <ProcessStep number={4} title="Review and refinement">
          You review the tour, request any adjustments, and approve the final version.
        </ProcessStep>
        <ProcessStep number={5} title="Deployment">
          We provide an embed code you can place on your website, prospectus landing pages, or UCAS profile. No ongoing fees.
        </ProcessStep>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Benefits for Educational Institutions</h2>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-3.14 1.346L9.606 10.92a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
              </svg>
            }
            title="Increase Enrolment"
          >
            Universities that offer virtual campus tours report higher engagement from prospective students. When students can explore facilities before applying, they feel more connected to the institution. This is especially impactful for clearing and unconditional offer holders who need reassurance.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clipRule="evenodd" />
              </svg>
            }
            title="Remote Open Days"
          >
            Physical open days are expensive to run and limited by capacity. A 3D virtual tour extends your open day to 365 days a year, reaching students who cannot attend in person. Combine the virtual tour with live Q&A sessions for a hybrid experience that scales without additional venue costs.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 10a2 2 0 114 0 2 2 0 01-4 0zm2-6a6 6 0 00-4.472 10.035l.217-.13a4 4 0 014.51 0l.217.13A6 6 0 0010 4z" clipRule="evenodd" />
              </svg>
            }
            title="Accessibility"
          >
            Virtual tours provide an accessible way for prospective students with mobility challenges to explore your campus. They can assess accessibility features like ramps, lifts, and accessible rooms before visiting in person, reducing anxiety and improving inclusivity.
          </FeatureCard>

          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clipRule="evenodd" />
              </svg>
            }
            title="Global Reach"
          >
            With international student recruitment becoming increasingly competitive, a 3D tour gives your institution a tangible edge. Agents and partners can share the tour link directly with candidates, reducing reliance on printed materials and in-country events.
          </FeatureCard>
        </div>
      </ContentSection>

      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Integration with Your Website</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Our virtual tours integrate seamlessly with any website. We provide a simple embed code that works with WordPress, custom CMS platforms, and university web systems. The tour loads asynchronously, so it does not slow down your page.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          You can also embed the tour on specific programme pages, accommodation listings, or virtual open day portals. Each embed can be customised with your branding, starting position, and guided tour highlights.
        </p>
      </ContentSection>

      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Spaces We Commonly Scan</h2>
        <CheckList
          columns={2}
          items={[
            'Lecture theatres and seminar rooms',
            'Libraries and study spaces',
            'Student union and social areas',
            'Sports halls and fitness centres',
            'Student accommodation and halls of residence',
            'Laboratories and specialist facilities',
            'Campus grounds and outdoor spaces',
            'Reception areas and administrative buildings',
          ]}
        />
      </ContentSection>
    </ContentPageLayout>
  );
}

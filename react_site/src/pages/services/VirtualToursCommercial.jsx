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

export default function VirtualToursCommercial() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Virtual Tours for Commercial Venues',
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
      serviceType: '3D Virtual Tours for Commercial Venues',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description: 'Immersive 3D virtual tours for retail spaces, hotels, event venues, and commercial properties',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-commercial' },
        { '@type': 'ListItem', position: 3, name: 'Virtual Tours for Commercial Venues', item: 'https://beyex.com/services/virtual-tours-commercial' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Virtual Tours for Commercial Venues"
      subtitle="Drive footfall, boost bookings, and showcase your space with immersive 3D virtual tours for retail, restaurants, and commercial venues."
      author="Beyex Team"
      lastUpdated="March 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Virtual Tours for Commercial Venues' },
      ]}
      seoProps={{
        title: '3D Virtual Tours for Commercial Venues',
        description: 'Immersive 3D virtual tours for retail, hotels, event spaces, and commercial venues. Drive footfall and bookings with interactive online experiences.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-commercial',
        ogType: 'article',
        schema,
      }}
    >
      {/* Why Commercial Venues Need Virtual Tours */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Commercial Venues Need Virtual Tours</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The decision to visit a physical space — whether it is a shopping centre, hotel, restaurant, or event venue — starts online. Potential customers browse websites, read reviews, and look at photos before committing their time and money. A 3D virtual tour bridges the gap between online discovery and physical visit by giving people a real sense of the space before they arrive.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Flat photographs, no matter how professional, cannot convey spatial relationships. A customer looking at a hotel room photo cannot tell how far the bathroom is from the bed, whether the wardrobe is large enough, or how natural light enters the room at different times of day. A 3D virtual tour answers all of these questions.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For venue operators, this translates directly into business outcomes: more confident bookings, fewer disappointed visitors, and a competitive edge over venues that rely on traditional photography alone.
        </p>
      </ContentSection>

      {/* Retail and Shopping Centres */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Retail and Shopping Centres</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Retail spaces face growing competition from online shopping. A 3D virtual tour offers a way to bring the in-store experience online, combining the convenience of digital browsing with the spatial richness of physical shopping.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
              </svg>
            }
            title="Driving Footfall"
          >
            When potential visitors can explore a shopping centre virtually, they discover stores and amenities they did not know existed. This discovery drives visits that might not have happened otherwise. A family planning a weekend outing can virtually walk the centre, identify the shops they want to visit, and plan their route — making the trip more appealing and productive.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
              </svg>
            }
            title="Tenant Marketing"
          >
            For shopping centre operators, virtual tours are a powerful tool for attracting new tenants. Prospective retailers can explore available units, assess footfall patterns from neighbouring stores, and understand the centre's layout without scheduling a physical viewing. This accelerates leasing decisions and broadens the pool of potential tenants.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Cross-link to Hospitality */}
      <ContentSection>
        <Callout title="Looking for Hotels & Hospitality?" variant="blue">
          We have a dedicated page covering 3D virtual tours for hotels, serviced apartments, conference spaces, and wedding venues. <a href="/services/virtual-tours-hospitality" className="underline font-medium">View our hospitality solutions →</a>
        </Callout>
      </ContentSection>

      {/* Event Venues and Hybrid Experiences */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Event Venues and Hybrid Experiences</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The rise of hybrid events — combining in-person and virtual attendance — has created new opportunities for venue operators. A 3D virtual tour can serve as the foundation for hybrid event experiences.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
            }
            title="Pre-event Exploration"
          >
            Attendees can familiarise themselves with the venue layout before arriving, reducing confusion and improving the event experience.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
              </svg>
            }
            title="Virtual Exhibition Halls"
          >
            Trade show organisers can offer virtual booths alongside physical ones, extending reach to attendees who cannot travel.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
              </svg>
            }
            title="Post-event Archives"
          >
            Capture the event space in its configured state as a permanent record, useful for sponsors, exhibitors, and future event planning.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Accessibility Benefits */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Accessibility Benefits</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Virtual tours provide significant accessibility advantages for commercial venues:
        </p>
        <Callout title="Inclusive by Design" variant="blue">
          <CheckList
            items={[
              'Visitors with mobility challenges can assess accessibility features before visiting',
              'People with sensory sensitivities can preview the space to prepare for their visit',
              'International visitors can explore the venue despite language or travel barriers',
              'Elderly visitors or those with health conditions can plan their route to minimise fatigue',
            ]}
          />
        </Callout>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          By offering a virtual tour, you demonstrate a commitment to inclusive customer service that resonates with a growing segment of the market.
        </p>
      </ContentSection>

      {/* How It Works */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">How It Works</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Our process for commercial venues is designed around minimal disruption to your operations:
        </p>
        <div className="mt-8">
          <ProcessStep number={1} title="Consultation">
            We visit your venue, discuss your goals, and identify the spaces to scan.
          </ProcessStep>
          <ProcessStep number={2} title="Scanning">
            We schedule the scan during quiet hours (early morning, closed days, or between events). A typical restaurant takes 1-2 hours; a large hotel or shopping centre takes 1-2 days.
          </ProcessStep>
          <ProcessStep number={3} title="Processing">
            We build your interactive 3D tour within 3-5 business days.
          </ProcessStep>
          <ProcessStep number={4} title="Delivery">
            You receive an embed code for your website and a shareable link for marketing channels. Hosting is included complimentary for six months, and remains free of charge for clients with an active service agreement.
          </ProcessStep>
        </div>
      </ContentSection>

      {/* Commercial Spaces We Work With */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Commercial Spaces We Work With</h2>
        <CheckList
          columns={2}
          items={[
            'Shopping centres and retail stores',
            'Restaurants, bars, and cafés',
            'Gyms, spas, and wellness centres',
            'Coworking spaces and office buildings',
            'Showrooms and trade counters',
            'Commercial property listings',
          ]}
        />
      </ContentSection>

      {/* Live Tour */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Step Inside a Real Capture</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-6">
          This is the Brewhouse, a commercial venue captured by Beyex. Walk through the space room by room — this is exactly what your customers would see embedded on your own website.
        </p>
        <LazyTourEmbed tour={TOURS.brewhouse} />
      </ContentSection>
    </ContentPageLayout>
  );
}

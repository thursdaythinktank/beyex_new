import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  FeatureCard,
  CheckList,
  ProcessStep,
  Callout,
  ContentSection,
} from '../../components/ui/ContentElements';

export default function VirtualToursHospitality() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Virtual Tours for Hotels & Hospitality',
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
      serviceType: '3D Virtual Tours for Hospitality',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description: 'Immersive 3D virtual tours for hotels, serviced apartments, and event venues to increase direct bookings and reduce pre-visit inspections',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-hospitality' },
        { '@type': 'ListItem', position: 3, name: 'Hotels & Hospitality', item: 'https://beyex.com/services/virtual-tours-hospitality' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Virtual Tours for Hotels & Hospitality"
      subtitle="How immersive virtual tours help hotels, serviced apartments, and event venues increase direct bookings and reduce pre-visit site inspections."
      author="Beyex Team"
      lastUpdated="May 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Hotels & Hospitality' },
      ]}
      seoProps={{
        title: '3D Virtual Tours for Hotels & Hospitality',
        description: 'How immersive virtual tours help hotels, serviced apartments, and event venues increase direct bookings and reduce pre-visit site inspections.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-hospitality',
        ogType: 'article',
        schema,
      }}
    >
      {/* Why Virtual Tours for Hospitality */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Virtual Tours for Hospitality</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Hospitality has been one of the earliest adopters of 3D virtual tour technology, and with good reason. Hotels, serviced apartments, and event venues sell an experience that is difficult to convey through flat photographs alone. A guest choosing between two similarly priced hotels in an unfamiliar city has very little to go on besides star ratings and a handful of images — and those images are often shot with wide-angle lenses that distort the true sense of a room.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          There is a well-documented confidence gap in online hotel bookings. Guests worry about room sizes, layouts, and whether the property matches its marketing materials. This anxiety is particularly acute for international travellers who cannot visit beforehand and must commit to a booking based entirely on what they find online. A 3D virtual tour closes that gap by letting prospective guests walk through the property at their own pace, exploring rooms, communal areas, and facilities in genuine spatial detail.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For operators, the commercial case is straightforward. Properties that offer virtual tours tend to see longer website dwell times, higher direct booking rates, and fewer post-arrival complaints. When a guest has already explored the room they are booking, expectations are set accurately before they arrive.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Beyond individual bookings, virtual tours serve as a versatile marketing asset. They can be embedded on booking platforms, shared in email campaigns, and used by sales teams during event enquiries — replacing the need for multiple site visits with a single, always-available digital walkthrough.
        </p>
      </ContentSection>

      {/* Room and Suite Showcasing */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Room and Suite Showcasing</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Room selection is one of the most anxiety-inducing parts of booking a hotel. Guests want to know exactly what they are paying for — the layout, the amount of natural light, how much wardrobe space is available, and whether the bathroom is a proper en-suite or a cramped corner shower. Traditional photography rarely answers these questions honestly, particularly when wide-angle lenses make small rooms appear far larger than they are.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          A 3D virtual tour lets guests explore each room category in genuine spatial detail. They can move through the standard double, the executive suite, and the family room at their own pace, comparing layouts and proportions before making a decision. This transparency builds trust and reduces the friction that causes guests to abandon a booking mid-process.
        </p>
        <CheckList
          items={[
            'Reduce room-type complaints by setting accurate expectations before arrival',
            'Increase upsells to premium rooms when guests can see the genuine difference in space and amenities',
            'Provide 24/7 viewing access for international guests browsing across time zones',
            'Reduce front-desk queries about room features, layouts, and accessibility',
          ]}
        />
      </ContentSection>

      {/* Conference and Event Spaces */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Conference and Event Spaces</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Event planners are methodical buyers. Before committing to a venue, they need to understand capacity, ceiling heights, natural light, AV infrastructure, and access routes for equipment. Traditionally, this means scheduling one or more site visits — each requiring co-ordination between the planner, the venue sales team, and often the client. A 3D virtual tour with built-in measurement tools compresses this process significantly, letting planners assess a space remotely and share it directly with their clients.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
              </svg>
            }
            title="Wedding Venues"
          >
            Couples researching wedding venues often create a shortlist based on online presence alone. A virtual tour lets both partners explore the ceremony space, reception area, and grounds together — even if one is overseas. This immediately elevates a venue above competitors relying solely on photo galleries.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
              </svg>
            }
            title="Corporate Conferences"
          >
            Corporate clients booking conference space need to visualise table layouts, stage positioning, and breakout areas. A virtual tour with measurement tools lets them plan logistics remotely, reducing the number of pre-event site visits required.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0 1 16.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 0 1-7.54 0" />
              </svg>
            }
            title="Awards Ceremonies"
          >
            Awards dinner organisers can assess stage sightlines, table spacing, and guest flow through the venue. Sharing the virtual tour with sponsors and speakers ahead of the event helps everyone prepare and reduces day-of confusion.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
              </svg>
            }
            title="Exhibition Halls"
          >
            Exhibition organisers can use virtual tours to market stand positions to exhibitors, showing exactly where each stand sits in relation to entrances, catering areas, and competitor stands. This transparency accelerates bookings and reduces disputes over placement.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Guest Confidence and Booking Conversion */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Guest Confidence and Booking Conversion</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          One of the most significant commercial benefits of virtual tours in hospitality is the shift from third-party bookings to direct bookings. Online travel agencies (OTAs) charge commissions that typically range from 15% to 25% per booking. Hotels that can drive guests to book directly — through their own website — retain substantially more revenue per room night.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Virtual tours contribute to this shift by giving your own website something that OTA listings cannot easily replicate: a rich, immersive experience that keeps prospective guests on your site for longer. When a guest spends several minutes exploring your property through a 3D tour, they develop a familiarity and confidence that makes them more likely to book there and then, rather than returning to an aggregator to compare alternatives.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          This effect is particularly pronounced for properties that serve international travellers, business guests booking conference facilities, and couples researching wedding venues. In each case, the stakes are high enough that guests want genuine reassurance about the space — and a virtual tour provides that reassurance far more effectively than static imagery.
        </p>
        <Callout title="Direct Booking Advantage" variant="blue">
          Properties that embed 3D virtual tours on their direct booking pages consistently report longer average session durations and higher conversion rates compared to pages using photography alone. The more time a guest spends exploring your space, the more invested they become in booking it.
        </Callout>
      </ContentSection>

      {/* Our Hospitality Projects */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Our Hospitality Projects</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          We have delivered 3D virtual tours for a range of hospitality properties across the North East, including Blackwell Grange Hotel, Crowne Plaza Hotel, and Week2Week serviced apartments. Each project presented different requirements — from showcasing multiple room categories and conference suites to capturing the lived-in feel of a serviced apartment that guests will treat as a home away from home.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Our implementation process is designed around minimal disruption to your operations. We work around guest schedules, scan during quiet periods, and deliver a finished tour that integrates directly with your existing website and booking platform.
        </p>
        <div className="mt-8">
          <ProcessStep number={1} title="Site Survey">
            We visit your property to understand the spaces you want to capture, discuss your priorities, and plan the scanning schedule around your operational needs.
          </ProcessStep>
          <ProcessStep number={2} title="3D Scanning">
            Our team scans the property using Matterport technology, typically during early mornings or quieter periods. A standard hotel with 6-8 room types plus communal areas takes approximately one full day.
          </ProcessStep>
          <ProcessStep number={3} title="Processing and Hosting">
            We process the raw scans into a polished, interactive 3D tour within 3-5 business days. Hosting is included complimentary for six months, and remains free of charge for clients with an active service agreement.
          </ProcessStep>
          <ProcessStep number={4} title="Integration with Booking Platform">
            You receive embed codes and shareable links ready for your website, booking engine, and marketing channels. We provide guidance on optimal placement to maximise engagement and conversion.
          </ProcessStep>
        </div>
      </ContentSection>

      {/* Getting Started */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Getting Started</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          If you manage a hotel, serviced apartment, or event venue and want to explore how a 3D virtual tour could work for your property, we would be happy to talk through your options. Every property is different, and we tailor our approach to match your specific goals — whether that is increasing direct bookings, reducing site visits for event planners, or simply giving your online presence an edge over the competition. Get in touch for a free, no-obligation consultation.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

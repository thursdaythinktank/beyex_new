import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  FeatureCard,
  CheckList,
  ProcessStep,
  Callout,
  ContentSection,
} from '../../components/ui/ContentElements';

export default function VirtualToursTourism() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: '3D Virtual Tours for Tourism & Attractions',
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
      serviceType: '3D Virtual Tours for Tourism',
      provider: { '@type': 'Organization', name: 'Beyex Ltd' },
      areaServed: 'GB',
      description: 'Immersive 3D virtual tours for tourism destinations, heritage sites, and visitor attractions',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Services', item: 'https://beyex.com/services/virtual-tours-tourism' },
        { '@type': 'ListItem', position: 3, name: 'Tourism & Attractions', item: 'https://beyex.com/services/virtual-tours-tourism' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="3D Virtual Tours for Tourism & Attractions"
      subtitle="How virtual tours help tourism destinations, heritage sites, and visitor attractions reach a global audience and drive real-world visits."
      author="Beyex Team"
      lastUpdated="May 2026"
      breadcrumbs={[
        { label: 'Services' },
        { label: 'Tourism & Attractions' },
      ]}
      seoProps={{
        title: '3D Virtual Tours for Tourism & Attractions',
        description: 'Immersive 3D virtual tours for tourism destinations, heritage sites, and visitor attractions. Reach a global audience and drive real-world visits.',
        canonicalUrl: 'https://beyex.com/services/virtual-tours-tourism',
        ogType: 'article',
        schema,
      }}
    >
      {/* Why Virtual Tours for Tourism */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Why Virtual Tours for Tourism</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Nearly every trip begins with a screen. Travellers scroll through destination websites, watch videos, and compare options long before they pack a bag. A 3D virtual tour lets potential visitors walk through a destination from their living room, building the kind of emotional connection that static photographs struggle to achieve. When someone has already explored a place virtually, the leap from curiosity to booking becomes far shorter.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          The "try before you fly" effect is particularly powerful for tourism. A family weighing up whether a heritage site is worth a two-hour drive can see for themselves in minutes. An overseas visitor deciding between three cities can explore key attractions in each and make a more confident choice. The virtual tour does not replace the visit — it makes the visit more likely.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Accessibility matters here too. Visitors with limited mobility can preview routes, identify step-free access points, and plan their visit around their needs. Older travellers or those with health conditions gain confidence knowing exactly what to expect when they arrive.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          There is also the question of seasonality. Many attractions draw crowds for a few months each year and then fall quiet. A virtual tour keeps a destination visible and engaging year-round, giving tourism boards and site operators a tool to promote off-season visits and maintain interest between peak periods.
        </p>
      </ContentSection>

      {/* Heritage Sites and Museums */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Heritage Sites and Museums</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Cultural heritage is, by its nature, rooted in place. A medieval cathedral, a Roman villa, or a Victorian industrial site cannot be moved to where the audience is. 3D virtual tours solve this by bringing the audience to the site — digitally, instantly, and without the wear and tear that physical footfall inevitably causes.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          For museums, the benefits extend beyond simple remote viewing. A well-annotated virtual tour can layer in contextual information that a physical visit might miss: historical notes, audio narration, close-up views of artefacts behind glass, and connections between objects in different galleries.
        </p>
        <CheckList
          items={[
            'Remote access for researchers and academics who cannot travel to the site',
            'Virtual school trips that bring curriculum-linked heritage into the classroom',
            'Preservation documentation that captures the current state of fragile or at-risk structures',
            'Multilingual tour potential, allowing international visitors to explore in their own language',
          ]}
        />
      </ContentSection>

      {/* Visitor Attractions and Experiences */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Visitor Attractions and Experiences</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          From grand landmarks to intimate gardens, visitor attractions compete for attention in a crowded marketplace. A 3D virtual tour gives each venue a way to stand out online, offering prospective visitors something far more compelling than a photo carousel or a promotional video.
        </p>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21" />
              </svg>
            }
            title="Landmarks & Monuments"
          >
            Historic buildings, castles, and monuments benefit enormously from virtual tours. Visitors can explore rooms that are closed for conservation, view architectural details from angles not possible in person, and revisit the site after their trip to spot things they missed.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
              </svg>
            }
            title="Botanical Gardens"
          >
            Gardens change with the seasons, and a virtual tour can capture them at their finest. Annotated tours can identify plant species, explain garden design principles, and guide visitors along recommended routes — useful both as a planning tool and a standalone digital experience.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.58-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
              </svg>
            }
            title="Adventure Experiences"
          >
            Zip lines, climbing walls, escape rooms, and activity centres can use virtual tours to show visitors exactly what awaits them. For experiences that involve an element of physical challenge, a preview helps manage expectations and reduces no-shows from nervous first-timers.
          </FeatureCard>
          <FeatureCard
            icon={
              <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
              </svg>
            }
            title="Visitor Centres"
          >
            Visitor centres and interpretation hubs are often the first point of contact for a destination. A virtual tour of the centre itself helps visitors understand what resources are available, plan their wider trip, and engage with interactive exhibits before or after their visit.
          </FeatureCard>
        </div>
      </ContentSection>

      {/* Destination Marketing */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Destination Marketing</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Tourism boards and destination marketing organisations (DMOs) spend significant budgets on campaigns designed to bring visitors to their region. A 3D virtual tour adds a tangible, interactive asset to these efforts — something a traveller can engage with for minutes rather than glancing at for seconds.
        </p>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Virtual tours integrate naturally with destination websites, social media campaigns, and travel platform listings. They give travel journalists and influencers ready-made content to share, and they perform well in search results because visitors spend longer on pages that feature them.
        </p>
        <Callout title="The Role of Virtual Previews in Trip Planning" variant="blue">
          Research consistently shows that travellers who interact with immersive content are more likely to follow through with a booking. A virtual tour transforms passive browsing into active exploration, shifting the visitor from "that looks nice" to "I can picture myself there." For DMOs, this is the difference between awareness and action.
        </Callout>
      </ContentSection>

      {/* Implementation for Tourism */}
      <ContentSection>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Implementation for Tourism</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Tourism sites present unique scanning challenges — outdoor spaces, mixed lighting, large areas, and often restricted access windows. Our process is designed to handle all of these.
        </p>
        <div className="mt-8">
          <ProcessStep number={1} title="Site Assessment & Access Planning">
            We visit the site to understand its layout, identify scanning priorities, and coordinate access. For heritage sites, this includes discussions with conservation teams about sensitive areas and any restrictions on equipment.
          </ProcessStep>
          <ProcessStep number={2} title="Multi-area 3D Scanning">
            We scan the site systematically, working through indoor and outdoor areas. Large sites may require multiple visits, timed to capture the best natural light and avoid peak visitor hours.
          </ProcessStep>
          <ProcessStep number={3} title="Tour Processing & Annotation">
            The raw scan data is assembled into a seamless walkthrough. We add information points, navigation aids, and any contextual content you provide — historical notes, wayfinding labels, or links to related resources.
          </ProcessStep>
          <ProcessStep number={4} title="Integration with Tourism Platforms">
            The finished tour is delivered as an embeddable asset for your website, along with shareable links for social media and travel platforms. We can also provide formats suitable for integration with visitor apps and kiosk displays.
          </ProcessStep>
        </div>
      </ContentSection>

      {/* Getting Started */}
      <ContentSection shaded>
        <h2 className="text-3xl font-semibold text-apple-gray-900 mb-6">Getting Started</h2>
        <p className="text-apple-gray-700 leading-relaxed mb-4">
          Whether you manage a single heritage property or a portfolio of attractions across a region, we can tailor a virtual tour solution to fit your site, your audience, and your budget. Get in touch for a no-obligation conversation about how 3D virtual tours can work for your destination.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

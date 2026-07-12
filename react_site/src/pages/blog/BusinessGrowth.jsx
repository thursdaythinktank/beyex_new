import { Link } from 'react-router-dom';
import { ContentPageLayout } from '../../components/ContentPageLayout';
import {
  ContentSection,
  Lead,
  SectionHeading,
  PullQuote,
  StatBand,
  CheckList,
  Callout,
} from '../../components/ui/ContentElements';

const faqs = [
  {
    q: 'How long does it take to create a 3D tour?',
    a: 'The capture session takes only a few hours, and your finished tour can be live on your website and online profiles shortly after.',
  },
  {
    q: 'Is a 3D virtual tour affordable for a small business?',
    a: 'Yes. A one-off capture session provides a permanent digital asset you can embed on your website, sync with your Google Business Profile, and share on social media. For most businesses the cost is modest next to the return of standing out and bringing in new foot traffic.',
  },
  {
    q: 'Can a 3D tour be used for more than marketing?',
    a: 'Yes. Because it captures your layout with high accuracy, you can use it to plan floor layout changes, brief designers or contractors remotely, and train new employees before their first shift.',
  },
];

export default function BusinessGrowth() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'BlogPosting',
      headline: 'How 3D Digital Tours Help Businesses Grow',
      image: 'https://beyex.com/business-growth-3d-tour.webp',
      author: { '@type': 'Organization', name: 'Beyex Ltd' },
      publisher: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
        logo: { '@type': 'ImageObject', url: 'https://beyex.com/logo.png' },
      },
      datePublished: '2026-07-12',
      dateModified: '2026-07-12',
      mainEntityOfPage: 'https://beyex.com/blog/3d-tours-help-businesses-grow',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Blog', item: 'https://beyex.com/blog' },
        { '@type': 'ListItem', position: 3, name: 'How 3D digital tours help businesses grow', item: 'https://beyex.com/blog/3d-tours-help-businesses-grow' },
      ],
    },
    {
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: faqs.map((f) => ({
        '@type': 'Question',
        name: f.q,
        acceptedAnswer: { '@type': 'Answer', text: f.a },
      })),
    },
  ];

  return (
    <ContentPageLayout
      title="How 3D Digital Tours Help Businesses Grow"
      subtitle="For a local shop, café, gym, salon, or restaurant, your first online impression now does the work your window display used to. Here is how a 3D virtual tour turns online searchers into real foot traffic."
      author="Beyex Team"
      lastUpdated="July 2026"
      breadcrumbs={[{ label: 'Blog', href: '/blog' }, { label: 'How 3D tours help businesses grow' }]}
      seoProps={{
        title: 'How 3D Digital Tours Help Businesses Grow',
        description:
          'How a 3D virtual tour helps local businesses build trust, attract the right customers, and drive foot traffic — plus practical uses beyond marketing.',
        canonicalUrl: 'https://beyex.com/blog/3d-tours-help-businesses-grow',
        ogType: 'article',
        ogImage: 'https://beyex.com/business-growth-3d-tour.webp',
        schema,
      }}
      leadFormSector="Business enquiry"
      ctaTitle="See what a 3D tour of your space could look like"
      ctaText="Beyex turns physical spaces into immersive 3D virtual tours that help businesses grow. Get in touch today and we'll show you what's possible — no obligation."
      faqs={faqs}
    >
      <ContentSection>
        <figure className="mb-10">
          <img
            src="/business-growth-3d-tour.webp"
            alt="A tablet on a café table showing an interactive 3D virtual tour of a boutique shop, with a holographic 3D floor plan and navigation nodes displayed above it"
            width="1024"
            height="576"
            loading="eager"
            decoding="async"
            className="w-full rounded-3xl shadow-xl shadow-apple-gray-900/10 ring-1 ring-apple-gray-900/5"
          />
          <figcaption className="mt-3 text-sm text-apple-gray-500 text-center">
            A 3D virtual tour lets customers step inside and explore your space online — before they ever visit.
          </figcaption>
        </figure>

        <Lead>
          Most customers decide whether to visit your business long before they walk through the
          door. They look you up online, glance at a few photos, and form an impression in seconds.
        </Lead>

        <p className="mt-6 text-lg text-apple-gray-700 leading-relaxed">
          For a local shop, café, gym, salon, or restaurant, that first online impression is now
          doing the work your window display used to do. This is where a 3D digital tour changes
          everything. Instead of a handful of flat photos, a virtual tour lets potential customers
          step inside your space online and explore it dynamically as if they were standing there —
          a simple, highly effective, and affordable way to stand out, build trust, and drive
          physical foot traffic.
        </p>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Visibility">Customers choose what they can see</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          People are far more likely to visit a business they feel they already know. A 3D tour
          removes the uncertainty. A customer can see the layout of your café, the atmosphere of your
          restaurant, the equipment in your gym, or the layout of your salon before committing to a
          visit.
        </p>

        <StatBand
          stats={[
            { value: '94%', label: 'more likely to see a listing with a virtual tour as reputable' },
            { value: '2×', label: 'as likely to generate customer interest or bookings' },
          ]}
        />
        <p className="text-sm text-apple-gray-500 -mt-4 mb-6">Source: Google Street View study, 2015.</p>

        <p className="text-lg text-apple-gray-700 leading-relaxed">
          A virtual tour takes engagement a step further than traditional photography because it
          shows the entire space transparently, rather than just the most flattering corners.
        </p>
      </ContentSection>

      <PullQuote cite="Available 24/7, on every device.">
        Your storefront keeps opening hours. Your 3D tour doesn&rsquo;t.
      </PullQuote>

      <ContentSection shaded>
        <SectionHeading eyebrow="Always on">It works around the clock</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          Your physical shop has opening hours, but your online presence does not. A 3D tour is
          available 24/7 on any device. Someone deciding where to eat on a Friday night or comparing
          local gyms after work can explore your space the exact moment they are interested. You are
          effectively running a digital open house that never closes.
        </p>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Trust">It builds trust and attracts the right customers</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          A virtual tour sets clear, realistic expectations. Customers arrive already knowing what
          your space looks like, leading to fewer disappointments and more confident, ready-to-buy
          visitors. For businesses that rely on bookings — such as event venues, boutique hotels, and
          restaurants — this leads to higher quality enquiries and fewer cancelled appointments.
        </p>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Reach">It helps you reach beyond your physical location</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          Physical businesses are no longer just competing with the shop next door. Customers,
          tourists, and event planners searching online may be coming from miles away. A 3D tour lets
          someone who has never visited your town experience your space beforehand, which is highly
          valuable for destination marketing and group bookings.
        </p>
      </ContentSection>

      <ContentSection shaded>
        <SectionHeading eyebrow="Beyond marketing">The benefits go beyond marketing</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed mb-6">
          A 3D tour of your space is useful long after a customer has viewed it. Because it captures
          your layout with high accuracy, you can put the same digital twin to work:
        </p>
        <CheckList
          items={[
            'Plan floor layout changes or interior redesigns.',
            'Brief designers or contractors remotely, saving site-visit fees.',
            'Train new employees by walking them through the space before their first shift.',
          ]}
        />
        <p className="text-lg text-apple-gray-700 leading-relaxed mt-6">
          For a busy business owner, this translates to real time and money saved.
        </p>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Cost">It is more affordable than most owners expect</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          Many small business owners assume interactive tour technology is only for major
          corporations or luxury real estate. It isn&rsquo;t. A one-off capture session provides a
          permanent, versatile digital asset you can embed on your website, sync with your Google
          Business Profile, and share on social media. For most businesses, the cost is modest next
          to the return of standing out and bringing in new foot traffic.
        </p>
        <Callout title="What does a tour actually cost?" variant="blue">
          See our{' '}
          <Link to="/pricing" className="underline hover:no-underline font-medium">pricing page</Link>{' '}
          for clear price bands, or read{' '}
          <Link to="/blog/3d-virtual-tour-cost-uk" className="underline hover:no-underline font-medium">
            how much a 3D virtual tour costs in the UK
          </Link>
          .
        </Callout>
      </ContentSection>

      <ContentSection>
        <SectionHeading eyebrow="Getting started">Getting started is straightforward</SectionHeading>
        <p className="text-lg text-apple-gray-700 leading-relaxed">
          Turning your space into an interactive 3D tour is straightforward. The capture process
          takes only a few hours, and your finished tour can be live on your website and online
          profiles shortly after. From there, it works quietly in the background, converting
          searchers into customers. If you run a business and want to see what a 3D tour of your
          space could look like,{' '}
          <Link to="/contact" className="text-apple-blue-600 hover:underline font-medium">get in touch with us</Link>{' '}
          today and we&rsquo;ll show you what is possible.
        </p>
      </ContentSection>
    </ContentPageLayout>
  );
}

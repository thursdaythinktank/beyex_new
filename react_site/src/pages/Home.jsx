import { lazy, Suspense } from 'react';
import { Navigation } from '../components/Navigation';
import { Hero } from '../components/Hero';
import { HomeScanResolve } from '../components/HomeScanResolve';
import { Footer } from '../components/Footer';
import { SEOHead } from '../components/SEOHead';
import { StaticBackground } from '../components/StaticBackground';
import { HeroGutterField } from '../components/HeroGutterField';

// Below-the-fold sections — code-split so they don't weigh down the initial
// bundle that gates the LCP hero. At prerender time puppeteer waits for network
// idle, so these load and are captured into the static HTML.
const EvidenceWall = lazy(() => import('../components/EvidenceWall').then((m) => ({ default: m.EvidenceWall })));
const ProofBySector = lazy(() => import('../components/ProofBySector').then((m) => ({ default: m.ProofBySector })));
const ProcessFlow = lazy(() => import('../components/ProcessFlow').then((m) => ({ default: m.ProcessFlow })));
const GetStarted = lazy(() => import('../components/GetStarted').then((m) => ({ default: m.GetStarted })));

/**
 * Home page — static background + drifting gutter point-cloud
 */
export default function Home() {
  const homeSchema = [
    {
      '@context': 'https://schema.org',
      '@type': 'WebSite',
      name: 'Beyex',
      url: 'https://beyex.com',
      description: 'Immersive 3D virtual tours and digital twins for any space',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'Service',
      serviceType: '3D Virtual Tour Creation',
      provider: {
        '@type': 'Organization',
        name: 'Beyex Ltd',
      },
      areaServed: 'GB',
      description: 'Professional 3D virtual tours and digital twins for properties, venues, and commercial spaces',
      offers: {
        '@type': 'AggregateOffer',
        priceCurrency: 'GBP',
        lowPrice: '111',
        highPrice: '1111',
      },
    },
  ];

  return (
    <div className="min-h-screen">
      <SEOHead
        title="Beyex — Immersive 3D Virtual Tours & Digital Twins"
        description="Step inside any space, from anywhere. Beyex creates immersive 3D virtual tours and digital twins for properties, venues, and commercial spaces across the UK."
        canonicalUrl="https://beyex.com/"
        schema={homeSchema}
      />

      {/* Background layer — clean static base + drifting point-cloud gutters */}
      <StaticBackground />
      <HeroGutterField />

      {/* Content is always mounted — never unmounted/remounted */}
      <div className="relative z-10">
        <a href="#main-content" className="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-4 focus:py-2 focus:bg-white focus:text-apple-gray-900 focus:rounded-lg focus:shadow-lg">Skip to content</a>
        <Navigation />
        <main id="main-content">
          <Hero />
          <Suspense fallback={<div className="min-h-screen" />}>
            {/* Evidence Wall: every published capture, filterable (#experiences) */}
            <EvidenceWall />
            {/* Scan Resolve set-piece — lazy-loads three.js only on capable devices when scrolled into view */}
            <HomeScanResolve />
            {/* Proof by Sector: case-anchored rows + dark industries band (#sectors) */}
            <ProofBySector />
            <ProcessFlow />
            <GetStarted />
          </Suspense>
        </main>
        <Footer />
      </div>
    </div>
  );
}

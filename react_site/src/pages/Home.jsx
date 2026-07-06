import { Navigation } from '../components/Navigation';
import { Hero } from '../components/Hero';
import { EvidenceWall } from '../components/EvidenceWall';
import { HomeScanResolve } from '../components/HomeScanResolve';
import { ProofBySector } from '../components/ProofBySector';
import { ProcessFlow } from '../components/ProcessFlow';
import { GetStarted } from '../components/GetStarted';
import { Footer } from '../components/Footer';
import { SEOHead } from '../components/SEOHead';
import { StaticBackground } from '../components/StaticBackground';
import { HeroGutterField } from '../components/HeroGutterField';

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
        <Navigation />
        <main>
          <Hero />
          {/* Evidence Wall: every published capture, filterable (#experiences) */}
          <EvidenceWall />
          {/* Scan Resolve set-piece — lazy-loads three.js only on capable devices when scrolled into view */}
          <HomeScanResolve />
          {/* Proof by Sector: case-anchored rows + dark industries band (#sectors) */}
          <ProofBySector />
          <ProcessFlow />
          <GetStarted />
        </main>
        <Footer />
      </div>
    </div>
  );
}

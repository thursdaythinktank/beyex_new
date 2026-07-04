import { lazy, Suspense, useState, useEffect } from 'react';
import { Navigation } from '../components/Navigation';
import { Hero } from '../components/Hero';
import { EvidenceWall } from '../components/EvidenceWall';
import { ProofBySector } from '../components/ProofBySector';
import { ProcessFlow } from '../components/ProcessFlow';
import { GetStarted } from '../components/GetStarted';
import { Footer } from '../components/Footer';
import { SEOHead } from '../components/SEOHead';
import { StaticBackground } from '../components/StaticBackground';
import { useWebGLCapability } from '../hooks/useWebGLCapability';

// Lazy-load only the WebGL background layer (not the whole wrapper)
const WebGLBackground = lazy(() => import('../components/WebGLBackground'));

/**
 * Home page with WebGL volumetric experience
 * Content is always mounted; only the background layer swaps between static and WebGL
 */
export default function Home() {
  const { checked, shouldUseFallback } = useWebGLCapability();
  const [loadWebGL, setLoadWebGL] = useState(false);

  // Only load WebGL after capability check confirms support, and after idle
  useEffect(() => {
    if (!checked || shouldUseFallback) return;

    if ('requestIdleCallback' in window) {
      const id = window.requestIdleCallback(() => setLoadWebGL(true), { timeout: 3000 });
      return () => window.cancelIdleCallback(id);
    } else {
      const timer = setTimeout(() => setLoadWebGL(true), 1000);
      return () => clearTimeout(timer);
    }
  }, [checked, shouldUseFallback]);

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

      {/* Background layer — static fallback or WebGL */}
      {loadWebGL ? (
        <Suspense fallback={<StaticBackground />}>
          <WebGLBackground />
        </Suspense>
      ) : (
        <StaticBackground />
      )}

      {/* Content is always mounted — never unmounted/remounted */}
      <div className="relative z-10">
        <Navigation />
        <main>
          <Hero />
          {/* Evidence Wall: every published capture, filterable (#experiences) */}
          <EvidenceWall />
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

import { Helmet } from 'react-helmet-async';

/**
 * Reusable SEO head component for per-page meta tags, Open Graph, and JSON-LD schema
 */
const DEFAULT_DESCRIPTION =
  'Step inside any space, from anywhere. Beyex creates immersive 3D virtual tours and digital twins for properties, venues, and commercial spaces across the UK.';

export function SEOHead({
  title,
  description = DEFAULT_DESCRIPTION,
  canonicalUrl,
  ogImage = 'https://beyex.com/logo.png',
  ogType = 'website',
  schema,
  noindex = false,
}) {
  const fullTitle = title ? `${title} | Beyex` : 'Beyex — Immersive 3D Virtual Tours & Digital Twins';

  return (
    <Helmet>
      <title>{fullTitle}</title>
      <meta name="description" content={description} />
      {canonicalUrl && <link rel="canonical" href={canonicalUrl} />}
      {noindex && <meta name="robots" content="noindex, nofollow" />}

      {/* Open Graph */}
      <meta property="og:title" content={fullTitle} />
      <meta property="og:description" content={description} />
      <meta property="og:image" content={ogImage} />
      {canonicalUrl && <meta property="og:url" content={canonicalUrl} />}
      <meta property="og:type" content={ogType} />
      <meta property="og:site_name" content="Beyex" />

      {/* Twitter Card */}
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content={fullTitle} />
      <meta name="twitter:description" content={description} />
      <meta name="twitter:image" content={ogImage} />

      {/* JSON-LD Structured Data */}
      {schema && (
        <script type="application/ld+json">
          {JSON.stringify(Array.isArray(schema) ? schema : [schema])}
        </script>
      )}
    </Helmet>
  );
}

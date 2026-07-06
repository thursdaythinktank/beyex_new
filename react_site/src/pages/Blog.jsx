import { Link } from 'react-router-dom';
import { ContentPageLayout } from '../components/ContentPageLayout';
import { ContentSection } from '../components/ui/ContentElements';
import { blogPosts } from '../config/blog';

export default function Blog() {
  const schema = [
    {
      '@context': 'https://schema.org',
      '@type': 'Blog',
      name: 'Beyex Blog',
      url: 'https://beyex.com/blog',
      description: 'Guides and insights on 3D virtual tours and digital twins for UK businesses.',
    },
    {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: [
        { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://beyex.com/' },
        { '@type': 'ListItem', position: 2, name: 'Blog', item: 'https://beyex.com/blog' },
      ],
    },
  ];

  return (
    <ContentPageLayout
      title="Blog"
      subtitle="Guides and insights on 3D virtual tours and digital twins for UK businesses."
      author="Beyex Team"
      lastUpdated="June 2026"
      breadcrumbs={[{ label: 'Blog' }]}
      seoProps={{
        title: 'Blog — 3D Virtual Tours & Digital Twins',
        description:
          'Guides and insights on 3D virtual tours and digital twins for UK businesses — pricing, sector use cases, and how to choose a provider.',
        canonicalUrl: 'https://beyex.com/blog',
        ogType: 'website',
        schema,
      }}
    >
      <ContentSection>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {blogPosts.map((post) => (
            <Link
              key={post.slug}
              to={post.path}
              className="block p-6 rounded-2xl border border-apple-gray-100 hover:border-apple-gray-200 hover:shadow-md transition-all group"
            >
              <p className="text-xs uppercase tracking-wide text-apple-gray-400 mb-2">{post.dateLabel}</p>
              <h2 className="text-xl font-semibold text-apple-gray-900 group-hover:text-apple-blue-500 transition-colors mb-2">
                {post.title}
              </h2>
              <p className="text-sm text-apple-gray-600 leading-relaxed">{post.excerpt}</p>
              <span className="inline-block mt-4 text-sm font-medium text-apple-blue-600">Read more →</span>
            </Link>
          ))}
        </div>
      </ContentSection>
    </ContentPageLayout>
  );
}

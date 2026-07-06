/**
 * Client testimonials / social-proof section.
 *
 * Intentionally renders nothing until real, approved client quotes are supplied
 * via the `items` prop — we do not publish placeholder or fabricated reviews.
 * Wire it into Home or a landing page once quotes + permission are collected, e.g.:
 *   <Testimonials items={[{ quote: '…', name: '…', role: '…', company: '…' }]} />
 */
export function Testimonials({ items = [], heading = 'What our clients say' }) {
  if (!items.length) return null;

  return (
    <section className="py-24">
      <div className="max-w-7xl mx-auto px-6">
        <h2 className="text-4xl sm:text-5xl font-semibold text-apple-gray-900 text-center mb-12">
          {heading}
        </h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {items.map((t, i) => (
            <figure key={i} className="p-6 rounded-2xl border border-apple-gray-100 bg-white">
              <blockquote className="text-apple-gray-700 leading-relaxed">“{t.quote}”</blockquote>
              <figcaption className="mt-4 text-sm">
                <span className="font-semibold text-apple-gray-900">{t.name}</span>
                {(t.role || t.company) && (
                  <span className="block text-apple-gray-500">
                    {[t.role, t.company].filter(Boolean).join(', ')}
                  </span>
                )}
              </figcaption>
            </figure>
          ))}
        </div>
      </div>
    </section>
  );
}

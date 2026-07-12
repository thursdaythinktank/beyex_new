/**
 * Reusable styled elements for content/article pages
 * Matches the visual language of Pricing, Contact, and Home pages
 */

const CheckIcon = () => (
  // Explicit width/height keep the icon at its intended size even before the
  // deferred stylesheet applies (avoids a FOUC where a class-only SVG balloons
  // to its default intrinsic size).
  <svg width="20" height="20" className="w-5 h-5 text-apple-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
    <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
  </svg>
);

/**
 * Feature card with optional icon, title, and description
 * Use in 2-col grids to replace plain bullet lists
 */
export function FeatureCard({ icon, title, children }) {
  return (
    <div className="p-6 rounded-xl border border-apple-gray-100 bg-white hover:shadow-md hover:border-apple-gray-200 transition-all">
      {icon && (
        <div className="w-10 h-10 rounded-lg bg-apple-blue-50 flex items-center justify-center mb-4">
          <span className="text-apple-blue-600">{icon}</span>
        </div>
      )}
      {title && <h4 className="font-semibold text-apple-gray-900 mb-2">{title}</h4>}
      <div className="text-apple-gray-600 text-sm leading-relaxed">{children}</div>
    </div>
  );
}

/**
 * Large stat/metric card for results sections
 */
export function StatCard({ value, label }) {
  return (
    <div className="p-6 rounded-xl bg-apple-gray-50 text-center">
      <p className="text-3xl font-bold text-apple-blue-600 mb-2">{value}</p>
      <p className="text-sm text-apple-gray-700">{label}</p>
    </div>
  );
}

/**
 * Highlighted callout box for key takeaways
 */
export function Callout({ title, children, variant = 'blue' }) {
  const styles = {
    blue: 'bg-apple-blue-50 border-apple-blue-200 text-apple-blue-900',
    gray: 'bg-apple-gray-50 border-apple-gray-200 text-apple-gray-900',
  };

  return (
    <div className={`my-8 p-6 rounded-2xl border ${styles[variant]}`}>
      {title && <h4 className="font-semibold mb-2">{title}</h4>}
      <div className="text-sm leading-relaxed opacity-90">{children}</div>
    </div>
  );
}

/**
 * Styled checklist with blue checkmark icons
 * Replaces plain <ul> lists
 */
export function CheckList({ items, columns = 1 }) {
  return (
    <ul className={`space-y-3 ${columns === 2 ? 'grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 space-y-0' : ''}`}>
      {items.map((item, i) => (
        <li key={i} className="flex items-start gap-3">
          <CheckIcon />
          <span className="text-apple-gray-700 text-sm leading-relaxed">{item}</span>
        </li>
      ))}
    </ul>
  );
}

/**
 * Numbered process step
 * Use for ordered workflows and implementation roadmaps
 */
export function ProcessStep({ number, title, children }) {
  return (
    <div className="flex gap-4">
      <div className="flex-shrink-0 w-8 h-8 rounded-full bg-apple-blue-600 text-white text-sm font-semibold flex items-center justify-center">
        {number}
      </div>
      <div className="flex-1 pb-8">
        <h4 className="font-semibold text-apple-gray-900 mb-2">{title}</h4>
        <div className="text-apple-gray-600 text-sm leading-relaxed">{children}</div>
      </div>
    </div>
  );
}

/**
 * Section with alternating background
 */
export function ContentSection({ children, shaded = false, className = '' }) {
  return (
    <section className={`mb-12 ${shaded ? 'bg-apple-gray-50 -mx-6 px-6 py-10 rounded-2xl sm:-mx-10 sm:px-10' : ''} ${className}`}>
      {children}
    </section>
  );
}

/**
 * Large intro/lede paragraph — sets a bigger, calmer opening than body copy.
 */
export function Lead({ children }) {
  return (
    <p className="text-xl sm:text-2xl leading-relaxed text-apple-gray-700 font-light">
      {children}
    </p>
  );
}

/**
 * Section heading with a colored eyebrow label and accent rule.
 * Adds hierarchy and rhythm so long articles do not read as one flat wall.
 */
export function SectionHeading({ eyebrow, children }) {
  return (
    <div className="mb-6">
      {eyebrow && (
        <p className="text-xs font-semibold uppercase tracking-[0.18em] text-apple-blue-600 mb-3">
          {eyebrow}
        </p>
      )}
      <h2 className="text-3xl sm:text-[2rem] font-semibold text-apple-gray-900 leading-tight tracking-tight">
        {children}
      </h2>
      <div className="mt-4 h-1 w-12 rounded-full bg-gradient-to-r from-apple-blue-500 to-apple-blue-400" />
    </div>
  );
}

/**
 * Editorial pull quote — lifts a punchy line out of the body copy.
 */
export function PullQuote({ children, cite }) {
  return (
    <figure className="my-12 relative pl-6 sm:pl-8 border-l-4 border-apple-blue-500">
      <span aria-hidden="true" className="absolute -top-4 left-4 text-6xl leading-none text-apple-blue-100 font-serif select-none">&ldquo;</span>
      <blockquote className="relative text-2xl sm:text-3xl font-medium leading-snug text-apple-gray-900">
        {children}
      </blockquote>
      {cite && <figcaption className="mt-3 text-sm text-apple-gray-500">{cite}</figcaption>}
    </figure>
  );
}

/**
 * Bold, colored statistic band — high-contrast break from body copy.
 * Pass an array of { value, label }.
 */
export function StatBand({ stats }) {
  return (
    <div className="my-10 grid grid-cols-1 sm:grid-cols-2 gap-px rounded-3xl overflow-hidden shadow-lg shadow-apple-blue-500/10">
      {stats.map((s, i) => (
        <div
          key={i}
          className={`p-8 text-white ${i % 2 === 0 ? 'bg-apple-blue-600' : 'bg-apple-blue-500'}`}
        >
          <p className="text-5xl font-bold tracking-tight">{s.value}</p>
          <p className="mt-3 text-sm leading-relaxed text-blue-50/90">{s.label}</p>
        </div>
      ))}
    </div>
  );
}

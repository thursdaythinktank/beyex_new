/**
 * Reusable styled elements for content/article pages
 * Matches the visual language of Pricing, Contact, and Home pages
 */

const CheckIcon = () => (
  <svg className="w-5 h-5 text-apple-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
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
    <section className={`mb-12 ${shaded ? 'bg-apple-gray-50 -mx-6 px-6 py-10 rounded-2xl' : ''} ${className}`}>
      {children}
    </section>
  );
}

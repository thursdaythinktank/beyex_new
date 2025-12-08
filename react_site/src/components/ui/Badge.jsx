/**
 * Small, pill-shaped label badge
 * Used for category tags and labels
 */
export function Badge({ children, className = '' }) {
  return (
    <span className={`inline-flex items-center px-3 py-1 text-sm font-medium text-apple-gray-600 bg-apple-gray-100 rounded-full ${className}`}>
      {children}
    </span>
  );
}

import { useState, useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { servicePages } from '../config/services';

/**
 * Navigation dropdown for the main nav (desktop hover/click).
 * Defaults to the Services menu, but accepts a custom label + items so it can
 * also render the "Use Cases" (Blog/Resources) menu.
 */
export function ServicesMenu({ label = 'Services', items = servicePages, tone = 'light' }) {
  const [open, setOpen] = useState(false);
  const ref = useRef(null);

  useEffect(() => {
    const onClickOutside = (e) => {
      if (ref.current && !ref.current.contains(e.target)) setOpen(false);
    };
    document.addEventListener('mousedown', onClickOutside);
    return () => document.removeEventListener('mousedown', onClickOutside);
  }, []);

  const triggerColor =
    tone === 'light'
      ? 'text-apple-gray-600 hover:text-apple-gray-900'
      : 'text-apple-gray-600 hover:text-apple-gray-900';

  return (
    <div
      ref={ref}
      className="relative"
      onMouseEnter={() => setOpen(true)}
      onMouseLeave={() => setOpen(false)}
    >
      <button
        type="button"
        onClick={() => setOpen((v) => !v)}
        className={`flex items-center gap-1 text-base transition-colors ${triggerColor}`}
        aria-expanded={open}
        aria-haspopup="true"
      >
        {label}
        <svg
          className={`w-4 h-4 transition-transform ${open ? 'rotate-180' : ''}`}
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          strokeWidth={2}
        >
          <path strokeLinecap="round" strokeLinejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      {open && (
        <div className="absolute left-0 top-full pt-2 w-64">
          <div className="bg-white rounded-xl shadow-xl border border-apple-gray-100 py-2">
            {items.map((page) => (
              <Link
                key={page.path}
                to={page.path}
                className="block px-4 py-2.5 text-sm text-apple-gray-700 hover:bg-apple-gray-50 hover:text-apple-gray-900 transition-colors"
                onClick={() => setOpen(false)}
              >
                {page.label}
              </Link>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}

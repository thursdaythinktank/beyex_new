/**
 * Service / sector pages, used by the Services nav dropdown, footer, and sitemap.
 * Keep in sync with the routes declared in App.jsx.
 */
export const servicePages = [
  { label: 'Real Estate', path: '/services/virtual-tours-real-estate' },
  { label: 'Commercial & Retail', path: '/services/virtual-tours-commercial' },
  { label: 'Hospitality', path: '/services/virtual-tours-hospitality' },
  { label: 'Construction', path: '/services/virtual-tours-construction' },
  { label: 'Tourism & Heritage', path: '/services/virtual-tours-tourism' },
  { label: 'Education', path: '/services/virtual-tours-education' },
  { label: 'Manufacturing', path: '/services/digital-twins-manufacturing' },
  { label: 'Industries', path: '/services/digital-twins-industries' },
  { label: 'Solar & Energy', path: '/services/digital-twins-solar-energy' },
];

/**
 * Single merged nav dropdown ("Use Cases") — all sector/service pages plus
 * featured case studies.
 */
export const menuPages = [
  ...servicePages,
  { label: 'AI Video for Ship Maintenance', path: '/case-studies/ai-video-ship-maintenance' },
];

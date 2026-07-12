/**
 * Tours manifest — the single source of truth for every Matterport capture.
 *
 * Rule: a Matterport ID appears in exactly ONE homepage section. Reusing the
 * same tour under different captions reads as a thin portfolio.
 *
 * Current homepage assignment:
 *   Hero            → brewhouse
 *   SectorShowcase  → blackwellGrange, residential, dosaKitchen
 *   RecentProjects  → crownePlaza, week2week, padocare
 */

const matterport = (id) => `https://my.matterport.com/show/?m=${id}`;

export const TOURS = {
  brewhouse: {
    name: 'Brewhouse',
    sector: 'Commercial Venue',
    matterportId: 'eStYzywQFMG',
    url: matterport('eStYzywQFMG'),
    image: '/brewhouse-card.webp',
    imageSm: '/brewhouse-card-sm.webp',
  },
  residential: {
    name: 'Residential Home',
    sector: 'Real Estate',
    matterportId: 'eMkANY4WhdJ',
    url: matterport('eMkANY4WhdJ'),
    image: '/home-card.webp',
  },
  dosaKitchen: {
    name: 'Dosa Kitchen',
    sector: 'Restaurants & Retail',
    matterportId: '8jrsKsP2cyY',
    url: matterport('8jrsKsP2cyY'),
    image: '/dosakitchen-card.webp',
  },
  blackwellGrange: {
    name: 'Blackwell Grange',
    sector: 'Hospitality',
    matterportId: 'bav7aPMSaUb',
    url: matterport('bav7aPMSaUb'),
    image: '/blackwell-grange-card.webp',
  },
  crownePlaza: {
    name: 'Crowne Plaza Hotel',
    sector: 'Hospitality',
    matterportId: 'mFCax5W9jRC',
    url: matterport('mFCax5W9jRC'),
    image: '/crowne-plaza-card.webp',
  },
  week2week: {
    name: 'Week2Week Serviced Apartments',
    sector: 'Hospitality',
    matterportId: 'z5PMXpHT98k',
    url: matterport('z5PMXpHT98k'),
    image: '/week2week-card.webp',
    // 480px variant for the small (~342px) EvidenceWall grid; full image is
    // still served on larger usages (case-study LazyTourEmbed) via srcset.
    imageSm: '/week2week-card-sm.webp',
  },
  padocare: {
    name: 'Padocare — 42 Factor AI',
    sector: 'Healthcare Tech',
    matterportId: 'KZtJ9Buye4f',
    url: matterport('KZtJ9Buye4f'),
    image: '/padocare-card.webp',
  },
};

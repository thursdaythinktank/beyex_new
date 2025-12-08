# Beyex React Site Migration Plan

## Executive Summary

This document outlines the plan to combine the existing WordPress site and SPA into a modern React-based site.

### Current State Analysis

**1. WordPress Site (`wp_site_data/`)**
- Standard WordPress installation with core files
- Theme: "Unikon" (custom theme) + default WordPress themes (twentytwentythree, twentytwentyfour, twentytwentyfive)
- Key Plugins:
  - Elementor (page builder)
  - Advanced Custom Fields Pro (ACF)
  - Contact Form 7 (forms)
  - LiteSpeed Cache (performance)
  - Hostinger plugins (hosting-specific)
  - Unikon Core (theme functionality)
  - One Click Demo Import
  - Kirki (theme customization framework)
- Database: MySQL (u867043172_beyex)
- Status: Under construction placeholder page

**2. SPA Site (`spa/`)**
- Single-page application with modern, polished design
- Self-contained HTML/CSS/JS (no build process detected)
- Features:
  - Marketing site for 3D virtual tour services
  - Responsive design with mobile support
  - Five main sectors: Real Estate, Venues, Restaurants, Academia, AEC
  - Matterport tour embeds
  - Contact form (client-side only)
  - FAQ section with expandable details
  - Modern gradient design with dark theme
  - Sticky navigation
  - Statistics showcase
  - Benefit cards and use-case sections

**3. Technology Stack Comparison**

| Aspect | WordPress Site | SPA | Recommended React Site |
|--------|---------------|-----|----------------------|
| Frontend | PHP templates + jQuery | Vanilla HTML/CSS/JS | React 18+ with TypeScript |
| Styling | Theme CSS + Elementor | Inline CSS | Tailwind CSS or styled-components |
| Build | None (PHP) | None | Vite or Next.js |
| Routing | WordPress | Hash/scroll links | React Router |
| Forms | Contact Form 7 | Client-side JS | React Hook Form + API |
| CMS | WordPress Admin | None | Headless CMS or static content |
| Hosting | PHP/MySQL | Static files | Vercel/Netlify/Cloudflare Pages |

---

## Recommended Architecture

### Option A: Static React Site with Headless CMS (Recommended)

**Stack:**
- **Framework:** Next.js 14+ (App Router)
- **Language:** TypeScript
- **Styling:** Tailwind CSS
- **CMS:** Headless WordPress (use existing WP as backend) OR Contentful/Sanity
- **Forms:** React Hook Form + API routes
- **Deployment:** Vercel or Netlify
- **Analytics:** Google Analytics 4 or Plausible

**Pros:**
- Best performance (static generation)
- SEO optimized with Next.js
- Easy deployment and scaling
- Keep WordPress content if needed
- Modern DX (Developer Experience)

**Cons:**
- Requires content migration
- More complex initial setup

### Option B: Pure React SPA with Static Content

**Stack:**
- **Framework:** Vite + React 18
- **Language:** TypeScript
- **Styling:** Tailwind CSS
- **Routing:** React Router
- **Forms:** React Hook Form + serverless functions
- **Deployment:** Cloudflare Pages or Netlify

**Pros:**
- Simpler architecture
- Fast development
- Lower hosting costs
- No backend dependency

**Cons:**
- SEO requires additional work (React Helmet)
- Content updates require code changes

---

## Migration Strategy

### Phase 1: Foundation Setup (Week 1)

1. **Initialize React Project**
   ```bash
   # Create Next.js project in new_site/
   npx create-next-app@latest . --typescript --tailwind --app --no-src-dir

   # Or for Vite:
   npm create vite@latest . -- --template react-ts
   npm install
   ```

2. **Set up Project Structure**
   ```
   new_site/
   ├── app/                    # Next.js App Router (Option A)
   │   ├── layout.tsx
   │   ├── page.tsx
   │   ├── real-estate/
   │   ├── venues/
   │   ├── restaurants/
   │   ├── academia/
   │   ├── aec/
   │   └── api/
   ├── components/
   │   ├── ui/                # Reusable UI components
   │   ├── sections/          # Page sections
   │   ├── layout/            # Layout components
   │   └── forms/
   ├── lib/                   # Utilities and configs
   ├── public/
   │   └── assets/
   ├── styles/
   └── types/
   ```

3. **Install Core Dependencies**
   ```bash
   npm install react-hook-form zod @hookform/resolvers
   npm install framer-motion # for animations
   npm install lucide-react # for icons
   npm install next-themes # for dark mode support
   ```

### Phase 2: Content Migration (Week 1-2)

1. **Extract WordPress Content**
   - Export posts, pages, media from WordPress
   - Identify custom fields (ACF) and their structure
   - Export Elementor page designs as reference
   - Document WordPress menu structure

2. **Migrate SPA Content**
   - Convert HTML sections to React components
   - Extract color scheme and design tokens
   - Port CSS to Tailwind utility classes
   - Create component library from SPA design

3. **Create Content Structure**
   - Define TypeScript types for all content
   - Create JSON/Markdown files for static content
   - Set up content schema (if using headless CMS)

### Phase 3: Component Development (Week 2-3)

**Priority Order:**

1. **Core Layout Components**
   - `Header.tsx` - Navigation with sticky behavior
   - `Footer.tsx` - Contact info and CTA
   - `Layout.tsx` - Page wrapper

2. **UI Components** (from SPA design)
   - `Button.tsx` - Primary/Secondary variants
   - `Card.tsx` - Reusable card component
   - `Badge.tsx` - Pills and badges
   - `Stat.tsx` - Statistics display
   - `BenefitCard.tsx` - Icon + text cards
   - `MatterportEmbed.tsx` - 3D tour iframe wrapper
   - `FAQ.tsx` - Expandable details component

3. **Section Components**
   - `Hero.tsx` - Homepage hero with CTA
   - `WhySection.tsx` - Benefits grid
   - `SectorSection.tsx` - Reusable sector template
   - `DemoSection.tsx` - Contact form section
   - `StatsSection.tsx` - Statistics showcase

4. **Form Components**
   - `ContactForm.tsx` - Main contact form
   - `FormField.tsx` - Reusable input wrapper
   - Form validation with Zod schemas

### Phase 4: Page Implementation (Week 3-4)

1. **Home Page** (`/`)
   - Hero section with embedded tour
   - Why use 3D tours
   - Statistics
   - Sector overview cards
   - CTA sections

2. **Sector Pages**
   - `/real-estate` - Real estate focus
   - `/venues` - Venues & events
   - `/restaurants` - Dining spaces
   - `/academia` - Educational institutions
   - `/aec` - Architecture, Engineering, Construction

3. **Utility Pages**
   - `/contact` - Contact form
   - `/faq` - Frequently asked questions
   - `/privacy` - Privacy policy
   - `/terms` - Terms of service
   - `/404` - Custom error page

### Phase 5: Integration & Features (Week 4-5)

1. **Form Backend**
   - Set up API routes for form submission
   - Integrate email service (SendGrid, Resend, or AWS SES)
   - Add form validation and sanitization
   - Implement spam protection (reCAPTCHA or Turnstile)

2. **Analytics & Tracking**
   - Google Analytics 4 setup
   - Conversion tracking for form submissions
   - Tour interaction tracking

3. **SEO Optimization**
   - Meta tags for all pages
   - Open Graph tags for social sharing
   - Structured data (JSON-LD) for organization
   - XML sitemap generation
   - robots.txt configuration

4. **Performance**
   - Image optimization (Next.js Image or sharp)
   - Code splitting
   - Lazy loading for tour embeds
   - Caching strategy

### Phase 6: Testing & QA (Week 5-6)

1. **Functional Testing**
   - All navigation links work
   - Forms submit correctly
   - Tour embeds load properly
   - Responsive design on all breakpoints

2. **Cross-browser Testing**
   - Chrome, Firefox, Safari, Edge
   - Mobile Safari, Chrome Mobile

3. **Performance Testing**
   - Lighthouse scores (aim for 90+ on all metrics)
   - Core Web Vitals optimization
   - Mobile performance

4. **Accessibility Testing**
   - WCAG 2.1 AA compliance
   - Keyboard navigation
   - Screen reader testing

### Phase 7: Deployment (Week 6)

1. **Pre-deployment**
   - Environment variables setup
   - Domain configuration
   - SSL certificate setup

2. **Deployment Options**
   - **Vercel** (recommended for Next.js)
     - Connect GitHub repo
     - Auto-deploy on push
     - Preview deployments for PRs

   - **Netlify** (good for static sites)
     - Similar CI/CD workflow
     - Built-in form handling

   - **Cloudflare Pages** (fast global CDN)
     - Excellent performance
     - DDoS protection

3. **Post-deployment**
   - Monitor analytics
   - Test all functionality on production
   - Set up uptime monitoring

---

## Content Preservation Strategy

### From WordPress Site

**What to Migrate:**
- Any custom posts or pages (if site has content beyond placeholder)
- Media library (images, videos)
- Contact form configurations
- Custom fields structure (ACF)
- Menu structure
- SEO settings (if configured)

**What to Retire:**
- WordPress core files
- PHP templates
- WordPress-specific plugins
- Database (after content export)
- Old themes

### From SPA Site

**What to Preserve:**
- Complete design system (colors, typography, spacing)
- Layout structure
- Content copy (all text)
- Matterport embed codes
- Statistics and data points
- FAQ content
- Form field structure

**What to Modernize:**
- Inline styles → Tailwind classes
- Vanilla JS → React state management
- Static HTML → Dynamic components
- Client-side form → Server-validated forms

---

## Design System Translation

### Color Tokens (from SPA)

```typescript
// tailwind.config.ts
export default {
  theme: {
    extend: {
      colors: {
        bg: '#0b0e14',         // deep slate
        card: '#111522',       // card base
        muted: '#8fa3bf',      // secondary text
        text: '#e6eefc',       // main text
        brand: '#63b3ff',      // primary
        'brand-2': '#7ff0c6',  // accent gradient
      },
      borderRadius: {
        'beyex': '20px',       // custom radius
      },
      boxShadow: {
        'beyex': '0 10px 30px rgba(0,0,0,.35)',
      },
    },
  },
};
```

### Typography

- Primary Font: system-ui stack
- Base Size: 16px
- Line Height: 1.6
- Heading Scale: Clamp-based fluid typography

### Spacing & Layout

- Container max-width: 1180px
- Section padding: 58px vertical
- Grid gaps: 20px standard
- Card padding: 18px

---

## Component Mapping

| SPA Element | React Component | Props |
|-------------|----------------|-------|
| `.pill` | `<Badge variant="success">` | children, variant |
| `.btn` | `<Button variant="primary\|secondary">` | children, variant, onClick |
| `.card` | `<Card>` | children, className |
| `.stat` | `<StatCard>` | value, label |
| `.benefit` | `<BenefitCard>` | icon, title, description |
| `.embed` | `<MatterportEmbed>` | src, title |
| `details.faq-item` | `<FAQ>` | question, answer |
| `.hero-grid` | `<HeroSection>` | title, description, cta, embed |
| `.use-card` | `<UseCaseCard>` | title, benefits |

---

## API Endpoints

### POST /api/contact

**Request Body:**
```typescript
{
  name: string;
  email: string;
  sector: 'Real Estate' | 'Venue & Events' | 'Restaurants & Cafés' | 'Academic & Training' | 'AEC' | 'Other';
  message: string;
}
```

**Response:**
```typescript
{
  success: boolean;
  message: string;
  error?: string;
}
```

### GET /api/tours (optional - for dynamic tour management)

**Response:**
```typescript
{
  tours: Array<{
    id: string;
    title: string;
    sector: string;
    embedUrl: string;
    description?: string;
  }>;
}
```

---

## SEO Strategy

### Meta Tags Template

```typescript
export const siteConfig = {
  name: 'Beyex',
  title: 'Beyex • Turn Physical Spaces Into Digital Sales Machines',
  description: 'Beyex creates immersive 3D virtual tours that help real estate, venues, restaurants, academia and AEC sell faster, book quicker, and engage 24/7.',
  url: 'https://beyex.com',
  ogImage: '/og-image.jpg',
  keywords: [
    '3D virtual tours',
    'Matterport tours',
    'real estate marketing',
    'virtual walkthroughs',
    '360 tours',
    'digital twin',
    'immersive tours',
  ],
};
```

### Structured Data (JSON-LD)

```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Beyex",
  "url": "https://beyex.com",
  "logo": "https://beyex.com/logo.png",
  "description": "3D virtual tour services for real estate, venues, restaurants, academia and AEC",
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "Sales",
    "email": "contact@beyex.com"
  },
  "service": {
    "@type": "Service",
    "serviceType": "3D Virtual Tours",
    "provider": {
      "@type": "Organization",
      "name": "Beyex"
    }
  }
}
```

---

## Risk Mitigation

### Potential Issues & Solutions

1. **WordPress Content Lock-in**
   - **Risk:** Valuable content trapped in WordPress database
   - **Solution:** Export all content before migration, use WP REST API if keeping as headless CMS

2. **Form Functionality Loss**
   - **Risk:** Contact forms stop working post-migration
   - **Solution:** Implement robust form backend with testing before go-live

3. **SEO Ranking Drop**
   - **Risk:** URL structure changes hurt search rankings
   - **Solution:** Implement 301 redirects, maintain URL structure where possible

4. **Tour Embed Issues**
   - **Risk:** Matterport embeds break or perform poorly
   - **Solution:** Test embed code in React environment, implement lazy loading

5. **Design Consistency**
   - **Risk:** React implementation doesn't match SPA design quality
   - **Solution:** Use SPA as pixel-perfect reference, component-by-component review

---

## Success Metrics

### Performance Targets

- Lighthouse Performance: > 90
- First Contentful Paint: < 1.5s
- Largest Contentful Paint: < 2.5s
- Cumulative Layout Shift: < 0.1
- Time to Interactive: < 3.5s

### Business Metrics

- Form submission rate: Track conversions
- Tour engagement: Track embed interactions
- Page load speed: Monitor with analytics
- Mobile traffic: Ensure responsive design works

### Technical Metrics

- Build time: < 2 minutes
- Bundle size: < 300KB (initial JS)
- Test coverage: > 80%
- Zero console errors

---

## Timeline Summary

| Phase | Duration | Deliverables |
|-------|----------|-------------|
| 1. Foundation | 1 week | Project setup, dependencies installed |
| 2. Content Migration | 1-2 weeks | Content extracted and structured |
| 3. Components | 1-2 weeks | All UI components built |
| 4. Pages | 1 week | All pages implemented |
| 5. Integration | 1 week | Forms, analytics, SEO complete |
| 6. Testing | 1 week | Full QA and fixes |
| 7. Deployment | 1 week | Live production site |
| **Total** | **6-8 weeks** | Fully functional React site |

---

## Next Steps

### Immediate Actions

1. **Choose Architecture** - Decide between Option A (Next.js + Headless) or Option B (Vite + Static)
2. **Initialize Project** - Run `create-next-app` or `create-vite` in `new_site/`
3. **Extract Content** - Document all WordPress content and export if needed
4. **Set up Git** - Version control for the new project
5. **Create Component Library** - Start with core UI components from SPA design

### Questions to Answer

1. Do you want to keep WordPress as a headless CMS, or go fully static?
2. What email service should be used for form submissions?
3. Is there any dynamic content that needs a backend?
4. What's the priority: fastest deployment or most flexible architecture?
5. Are there any WordPress custom post types or taxonomies to migrate?

---

## Recommended Tech Stack (Final)

```json
{
  "framework": "Next.js 14+ (App Router)",
  "language": "TypeScript",
  "styling": "Tailwind CSS",
  "forms": "React Hook Form + Zod",
  "animations": "Framer Motion",
  "icons": "Lucide React",
  "deployment": "Vercel",
  "cms": "Headless WordPress (optional) or Static Content",
  "analytics": "Google Analytics 4",
  "email": "Resend or SendGrid",
  "monitoring": "Vercel Analytics + Sentry"
}
```

---

## Appendix: File Structure Reference

```
new_site/
├── .env.local                 # Environment variables
├── .gitignore
├── next.config.js
├── package.json
├── tailwind.config.ts
├── tsconfig.json
├── app/
│   ├── layout.tsx            # Root layout
│   ├── page.tsx              # Homepage
│   ├── globals.css           # Global styles
│   ├── real-estate/
│   │   └── page.tsx
│   ├── venues/
│   │   └── page.tsx
│   ├── restaurants/
│   │   └── page.tsx
│   ├── academia/
│   │   └── page.tsx
│   ├── aec/
│   │   └── page.tsx
│   ├── faq/
│   │   └── page.tsx
│   ├── contact/
│   │   └── page.tsx
│   └── api/
│       └── contact/
│           └── route.ts
├── components/
│   ├── ui/
│   │   ├── button.tsx
│   │   ├── card.tsx
│   │   ├── badge.tsx
│   │   └── input.tsx
│   ├── layout/
│   │   ├── header.tsx
│   │   ├── footer.tsx
│   │   └── navigation.tsx
│   ├── sections/
│   │   ├── hero.tsx
│   │   ├── why-section.tsx
│   │   ├── sector-section.tsx
│   │   ├── demo-section.tsx
│   │   └── faq-section.tsx
│   └── forms/
│       ├── contact-form.tsx
│       └── form-field.tsx
├── lib/
│   ├── utils.ts              # Utility functions
│   ├── validations.ts        # Zod schemas
│   └── constants.ts          # App constants
├── types/
│   └── index.ts              # TypeScript types
├── public/
│   ├── favicon.ico
│   ├── og-image.jpg
│   └── assets/
│       └── images/
└── content/                   # Static content (optional)
    ├── sectors.json
    ├── faqs.json
    └── tours.json
```

---

## Conclusion

This migration plan provides a comprehensive roadmap to transform the current WordPress + SPA setup into a modern, performant React application. The recommended approach is Next.js 14+ with TypeScript and Tailwind CSS, which offers the best balance of performance, SEO, and developer experience.

The SPA design is excellent and should be preserved as closely as possible in the React implementation. The WordPress site appears to be a placeholder, so content migration will be minimal unless there's a database with unpublished content.

**Recommended First Step:** Initialize a Next.js project in the `new_site/` directory and begin building the core components from the SPA design.

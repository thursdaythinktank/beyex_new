# Trinity Consulting Report — Action Plan for beyex.com

> Source: *Trinity Consulting — Strategic Growth Recommendations for Beyex Ltd* (12 May 2026). Primary research n=21 survey + competitor benchmarking. This doc maps the report's findings to the **current** state of the site and turns them into a prioritised action plan. It is the review artifact: website work is built only on approved items.

## How to read this
- **Type** — `WEBSITE` (implementable in this React/Vite app) vs `OFF-SITE` (a business action: accounts, ads, reviews, grants, legal).
- **Priority** — `P1` (do first / high impact), `P2` (medium), `P3` (later / content).
- **Status** — `DONE` (already shipped), `GAP` (missing), `PARTIAL` (exists but incomplete), `OBSOLETE` (report advice superseded by our infra).

---

## 1. Executive view
The report's core thesis: Beyex's barrier to growth is **not product or pricing** (both competitive) but **visibility, credibility, and digital infrastructure**, in a UK virtual-tour market growing ~20% CAGR. That thesis is sound. However, the report describes the site as it was in early-mid 2026, and the site has since moved on considerably.

### Already addressed since the report (credit where due)
| Report criticism | Current state |
|---|---|
| "DNS makes site intermittently inaccessible" | **DONE** — site is live on AWS + Cloudflare + Let's Encrypt (HTTPS, HTTP→HTTPS redirect, auto-renew). |
| "No sector pages" | **DONE** — 6 service pages (Commercial, Hospitality, Tourism, Education, Industries, Solar/Energy). |
| "Pricing invisible online" | **DONE** — `/pricing` with tiered pricing + a live quote calculator (`GetStarted.jsx`) that emails an instant estimate. |
| "No sales funnel" | **PARTIAL→DONE** — quote form + Calendly booking + Resend email + Calendly webhook. |
| "No SEO / sitemap" | **DONE** — per-page meta/canonical/OG (`SEOHead`), JSON-LD (Organization, Service, LocalBusiness, Breadcrumb, FAQ), `sitemap.xml`, `robots.txt`. |
| "No compliance pages" | **DONE** — privacy, terms, cookies pages. |

### Superseded by our infrastructure
- **Hosting migration GoDaddy → ScalaHosting (£11.08/mo): OBSOLETE.** We run on AWS + Cloudflare + Let's Encrypt with daily-equivalent resilience and a clean origin. Do **not** action the host migration. The one surviving concern is **domain reputation / web-filtering categorisation** (report's "89% of orgs use web filtering" point) — keep the Cisco Umbrella recategorisation check as an off-site task.

---

## 2. Gap matrix (findings → actions)

### A. Website structure & information architecture
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| Services "buried / mislabeled as Resources", no nav dropdown | Service pages reachable **only** via home `SectorGrid`; no Services menu | Add a **Services dropdown** to `Navigation.jsx`; ensure consistent labeling | WEBSITE | P1 |
| No About page | **GAP** | Build `/about` (founder 20+ yrs construction, mission, Chamber of Commerce, trust) | WEBSITE | P1 |
| Floating WhatsApp/Calendly + CTA only on home | Floating CTAs not on inner pages | Show floating contact + a sticky header CTA on **all** pages | WEBSITE | P2 |

### B. Conversion — service pages are NOT landing pages (biggest gap)
The report mandates **campaign-grade sector landing pages** (5–15% conversion vs 2–3% generic). Our 6 service pages are well-written **descriptive** pages sharing one template (`ContentPageLayout.jsx`) with: no on-page lead form, **no embedded demo tour** (ironic for a tour company), no testimonials/stats, one generic bottom CTA ("Ready to create your digital twin?").
| Action | Type | Pri |
|---|---|---|
| Add **on-page lead form** to each service page (adapt `GetStarted`, pre-fill `sector`) instead of linking to home `#get-started` | WEBSITE | P1 |
| **Embed a sector-relevant Matterport demo** on each page (reuse `ui/TourEmbed`) | WEBSITE | P1 |
| Add **quantified social proof / testimonials** + **sector pricing callout** + **benefit-driven sector CTA** + **mid-page CTA** + **per-sector FAQ** (with FAQ schema) | WEBSITE | P2 |
| Add **Real Estate** (currently folds into Commercial) and **Construction/Architecture** (Building Safety Act "Golden Thread") dedicated pages | WEBSITE | P2 |
| Decide whether to promote **Manufacturing** from `/resources/` to a `/services/` page | WEBSITE | P3 |

### C. SEO / search visibility
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| Poor keyword targeting per sector | Good base SEO; H1s decent | Tighten title/meta/H1 to report's sector keyword lists (below) | WEBSITE | P2 |
| Incomplete structured data | Service schema lacks `offers`/`areaServed`; no `AggregateRating`, no `VideoObject`, no FAQ on service pages | Enrich schema; add FAQ schema on landing pages; `VideoObject` for demos; `AggregateRating` once reviews exist | WEBSITE | P2 |
| No blog / content hierarchy | 2 isolated articles only | Build blog index + template; 2 posts/mo, 500–800 words; internal links blog→landing→form | WEBSITE | P3 |
| No Google Business Profile / citations | n/a | Create GBP + directory citations | OFF-SITE | P1 |

**Sector keyword targets (from report):** Real Estate — "virtual tour for estate agents", "reduce wasted viewings", "Rightmove virtual tour". Retail/Commercial — "3D virtual showroom", "virtual tour for commercial property". Hospitality — "virtual tour for hotels", "increase direct hotel bookings", "reduce OTA commission". Construction — "3D scanning for construction", "digital twin construction", "BIM 3D scanning", "as-built 3D model".

### D. Trust & credibility
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| Zero reviews / testimonials / case studies on site | 3 embedded tours + 1 case study; no testimonials/reviews | Build testimonials component + reviews widget slot (Google/SociableKIT) | WEBSITE | P1 |
| No Google/Trustpilot reviews exist | n/a | Gather reviews via post-project email; create Trustpilot | OFF-SITE | P1 |
| No competitor comparison | n/a | Add comparison table (vs Matterport: one-time + **tour ownership** vs subscription) | WEBSITE | P3 |

Competitor benchmark: Venue View 59 reviews @5/5; 360 View 66 @4.9/5; Photoplan 60 @4.7/5; Apollo3D 22 @5/5.

### E. Funnel / CRM / analytics
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| No website analytics | **GAP** — cookie policy even *claims* GA + Clarity, but no code | Add GA4 (+ optional Clarity), consent-gated | WEBSITE | P1 |
| No conversion tracking for ads | n/a | Meta Pixel + LinkedIn Insight Tag, consent-gated | WEBSITE | P2 |
| No email nurture | n/a | Mailchimp 5-touch sequence (Days 0/3/7/12/16) | OFF-SITE | P2 |
| No CRM | n/a | HubSpot Starter pipeline (New→Contacted→Call→Quote→Win/Loss) | OFF-SITE | P2 |
| No newsletter / lead magnet | **GAP** | Footer newsletter + gated lead-gen brochure download | WEBSITE | P3 |

### F. Pricing & hosting terms
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| 6 months free hosting vs 12-month industry standard | Pricing page says "6 months hosting" | Change to **12 months** in copy + client offer | WEBSITE + OFF-SITE | P2 |
| Pricing competitive but invisible | Now visible | — | DONE | — |

### G. Legal / compliance
| Finding | Current state | Action | Type | Pri |
|---|---|---|---|---|
| UK GDPR — image capture (vehicle number plates → DVLA, faces) | Privacy page exists | Add image-capture privacy note; document a manual blur/redact check | WEBSITE + OFF-SITE | P2 |
| DMCCA 2024 — "virtual defurnishing"/edits may be misleading | Not addressed | Add a tour-accuracy / no-misleading-edit disclaimer; build a pre-delivery audit checklist | WEBSITE + OFF-SITE | P2 |

### H. Strategic focus & funding
| Finding | Action | Type | Pri |
|---|---|---|---|
| Sectors served without prioritisation | Prioritise report's 4: Property/Real Estate, Hospitality, Retail/Commercial, Construction (reflected in landing pages above) | WEBSITE+OFF-SITE | P2 |
| No funding applications | Apply to the 7 schemes (Section 5) | OFF-SITE | P2 |

---

## 3. Landing-page transformation spec (per sector)
Each sector landing page should render, top to bottom:
1. **Hero** — sector-specific headline + value prop (e.g. "3D Virtual Tours for Estate Agents — cut wasted viewings"), primary CTA.
2. **Sector pain + stats** — 2–3 quantified pain points the sector feels.
3. **Embedded demo tour** — a relevant Matterport scan (reuse `ui/TourEmbed`).
4. **How it works** — scan takes ~2–4 hrs, non-disruptive; what the client receives; how fast it goes live (addresses survey's process uncertainty).
5. **Proof** — 1–2 testimonials / named projects + quantified outcome.
6. **Pricing callout** — sector-relevant tier reference (link to `/pricing`).
7. **Ownership reassurance** — client owns the tour (survey: 62% rate ownership essential) — contrast with Matterport subscription.
8. **FAQ** — sector-specific (+ FAQ schema).
9. **On-page lead form** — adapted `GetStarted`, `sector` pre-filled → `/api/contact`.
Implement by extending `ContentPageLayout.jsx` with optional demo-embed + form slots so all 6 (+2 new) pages gain these without per-page duplication.

---

## 4. Survey-driven messaging guide (Section 4.4, n=21)
- **38% cite ROI uncertainty — the #1 barrier.** Lead every sector page with outcomes/ROI, not features.
- **24% cite cost.** Keep pricing transparent (already done) + the instant quote.
- **62% consider full tour ownership essential.** Make ownership a headline selling point vs Matterport.
- **62% will pay £0–50/yr hosting; 71% expect troubleshooting; 62% expect updates.** State after-sales support + the (now 12-month) hosting clearly.
- **Scan is "only 2–4 hours, non-disruptive."** Use this to defuse operational concern.
- Awareness gap: 29% "not at all familiar" → educational blog content earns its place.

---

## 5. Off-site checklist (business actions — not code)
- [ ] **Domain reputation**: submit Cisco Umbrella / web-filter recategorisation for `beyex.com` (hosting migration itself is OBSOLETE — we're on AWS/Cloudflare).
- [ ] **Google Business Profile** + Apple Business Connect + citations (Yell, FreeIndex, 192, Central Index, North East Growth Hub / Chamber).
- [ ] **Gather Google reviews** via post-project email; create **Trustpilot** profile.
- [ ] **Mailchimp** 5-touch nurture (Days 0/3/7/12/16).
- [ ] **HubSpot Starter** CRM pipeline (New→Contacted→Discovery Call→Quote→Win/Loss).
- [ ] **LinkedIn** Campaign Manager + Lead Gen forms (SMEs 10–249 in target sectors) + organic content + Thought-Leader Ads.
- [ ] **Meta** Business Suite + reels (1080×1080, captioned).
- [ ] **Funding (7 schemes):** SWEF Enterprise (≤£2,800) · Kings Trust Start-Up (£5k grant + ≤£25k loan) · Scaling Up / Millennium Awards (≤£18k) · North East Business Fund · North of Tyne / HITS (50%) · Green Seed (£25–50k) · Green New Deal (£200k–£2m). Client-enabling: North East Tourism Support (£10–50k). Carbon-saving positioning via carbonFootprint.com.
- [ ] **Legal:** documented UK GDPR data-handling policy + manual number-plate/face check; DMCCA 2024 pre-delivery tour-audit checklist; legal review of T&Cs.
- [ ] **Assets:** Canva lead-gen brochure (4–5 pp, no pricing); 1–2 quantified case studies; change client offer to **12-month** hosting.

---

## 6. Recommended website build order (Deliverable 2)
1. **Tier 1 (P1):** GA4 + cookie-consent banner (consent-gates analytics/Calendly/Matterport); Services nav dropdown + floating CTA on all pages; About page.
2. **Tier 2 (P1–P2):** transform service pages into landing pages (form + demo + proof + FAQ + sector CTA); add Real Estate + Construction pages.
3. **Tier 3 (P3):** blog index + seed posts; newsletter + brochure download; Meta/LinkedIn tracking; schema enrichment; competitor table; legal disclaimers.

## 7. Required inputs before building
- **GA4 Measurement ID** (and Microsoft Clarity ID if we keep that claim in the cookie policy).
- **Sector pages to add**: confirm Real Estate + Construction (+ promote Manufacturing to a service page?).
- **About page**: founder/team bio + photo.
- **Testimonials**: text + permission to name clients (Crowne Plaza, Week2Week, Blackwell Grange, Padocare seen in code); which Matterport tour URL to embed per sector.
- **Newsletter**: Mailchimp (API key) or Resend-only for now.
- **Hosting term**: confirm changing "6 months" → "12 months" on `/pricing`.

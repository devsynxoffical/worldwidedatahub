# SEO Strategy and Implementation Plan (refined)

**Website:** https://worldwidedatahub.com/ · **Duration:** initial 3 months (24 Nov 2026 – 23 Feb 2027) · **Version:** v2, 24 Nov 2026

**Objective:** improve Google rankings, increase organic traffic, generate qualified leads and
increase product sales from organic search.

Status markers: ✅ done · 🔄 in progress · ⏳ waiting on approval or access · ⬜ not started

---

## 1. Project overview

WorldWideDataHub.com is a WordPress + WooCommerce shop selling business, consumer, mobile-number
and niche contact databases by country. About 1,000 product URLs are in the sitemap.

**Starting point (Google Search Console, 27 Oct – 21 Nov 2026)**

| Metric | Value |
|---|---|
| Clicks | 130 (about 5/day) |
| Impressions | 7,402 |
| CTR | 1.8% |
| Average position | ~42 (page 4–5) |
| Trend | Impressions fell from ~330/day to ~200/day; position slipped from 37 to 43 |
| Products with any impressions | ~250 of 991 |
| Largest markets | US (2,707 impressions, position 49) and UK (877, position 63). Most clicks come from Pakistan, Iraq, India and Malaysia, mostly on mobile |

**What the data changes about the original plan**

1. **Start with pages that are already close to the top.** Searches like "russia companies
   database" (position 9), "saudi arabia mobile number list" (2), "qatar mobile number list"
   (2.5), "afghanistan phone number list" (5) and "iraq database" (10) rank well but get almost no
   clicks. Better titles and content can win traffic within weeks.
2. **Head terms are a 6–12 month goal.** "business email database", "uk email database" and
   similar rank 50–85. Months 1–2 should not depend on them.
3. **Duplicate products are the main technical problem.** Many countries have 2–3 product URLs
   for the same data, and they compete with each other.
4. **Searchers often add "list", "free", "pdf" or "mobile number".** Titles and content should
   match those words and offer the free sample.

**How changes are made:** theme code is version-controlled in git and deploys automatically to the
server over FTPS when merged to `main`. Page and product text lives in the WordPress database and
needs wp-admin or WordPress REST API access.

## 2. Website audit and initial analysis

| Check | Status | Notes |
|---|---|---|
| Site structure and navigation | 🔄 | Home → category → product. Country hub pages (`/[country]-email-list/`) were added in Week 1 |
| Full crawl (Screaming Frog) | ⏳ | Needs live-site access, or a crawl export from the owner |
| Indexing and crawling | 🔄 | Thin archives noindexed ✅. Each sitemap shows 1 error in Search Console |
| Titles and meta descriptions | 🔄 | 15 priority pages rewritten ✅. Remaining pages need the crawl |
| Headings (H1–H3) | ✅ | H1 on homepage, archive and product pages; footer heading order fixed |
| Duplicate, missing and thin content | 🔄 | 13 duplicate product groups merged ✅, ~30 more proposed ⏳. Product descriptions use the same template text |
| Broken links and 404s | 🔄 | 2 product 404s fixed ✅. Full check needs the crawl |
| URLs and canonicals | 🔄 | Sorted and filtered shop URLs noindexed ✅ |
| XML sitemap and robots.txt | 🔄 | Noindexed URLs excluded from the sitemap ✅. Sitemap error still to fix |
| Mobile and Core Web Vitals | ⬜ | Bootstrap, Font Awesome and fonts load from external servers and block rendering; chat and analytics scripts sit in `<head>` |
| Images and alt text | 🔄 | Logo, header and homepage alt text ✅. Product images still to do |
| Internal linking | ⬜ | Needs the crawl |
| Rankings and traffic | ✅ | Baseline in section 1 |
| Data consistency | ⬜ | Product text says "updated April 2025"; badges and titles say 2026. The owner must confirm which is correct |
| Analytics | ⬜ | GA4 is hard-coded **and** the GTM, GA and Site Kit plugins are installed, so visits may be counted twice |

**Deliverable:** audit report in `docs/audit/`, delivered at the end of Week 3.

## 3. Keyword research and competitor analysis

**Targets by tier, ordered by how quickly they can win:**

| Tier | When | Keyword type | Examples (current position) | Target URL |
|---|---|---|---|---|
| 1 | Month 1 | Country + "database", "list" or "mobile number list", already in the top 20 | russia companies database (9), saudi arabia mobile number list (2), qatar mobile number list (2.5), afghanistan phone number list (5), iraq database (10), yemen company database (10) | Existing product page |
| 2 | Month 2 | Country + "business email list", positions 15–50 | france (16), netherlands (19), germany (29), new zealand (28), hong kong (43), singapore (42), uk (37) | Country hub + main product |
| 3 | Month 2–3 | Niche lists | forex traders email list (22), mortgage brokers email database (34), iphone users database (14), church database (35) | Product page |
| 4 | Month 3+ | Head terms from the original plan | business email database, b2b email database, buy business email list, consumer email database, mobile number database, company contact database | Category pages, homepage, links |
| Info | Month 2–3 | Questions | what is a b2b email database, how to verify business emails, business vs consumer email list | Blog |

**Country priority** (impressions and buyer value): USA, UK, Canada, Australia, UAE, Saudi
Arabia, Germany, France, Netherlands, Singapore, then the existing Tier 1 countries (Russia, Iraq,
Afghanistan, Qatar, Pakistan, Yemen).

**Competitor analysis:** identify the 5–8 domains that rank in the top 10 for Tier 2 and Tier 4
terms. Then compare their page types, content depth, FAQs, schema and backlinks to find gaps.

**Deliverable:** `docs/keyword-map.csv` (keyword, intent, volume, current position, one target URL)
plus a competitor summary. One keyword maps to one URL, so our own pages never compete.

## 4. Technical SEO optimization

| Task | Status |
|---|---|
| noindex on thin archives, payment and thank-you pages; excluded from sitemap | ✅ |
| Redirect map: consolidated posts, hubs, 13 duplicate product groups, junk pages | ✅ |
| Outdated and conflicting robots meta tags removed from `<head>` | ✅ |
| noindex on sorted and filtered shop URLs (`?orderby`, `?filter_*`, `?min_price`, `?add-to-cart`) | ✅ |
| Brand added to Product schema | ✅ |
| Merge ~30 remaining duplicate product groups (`docs/duplicate-merge-proposal.md`) | ⏳ owner approval |
| Fix sitemap error; resubmit sitemaps | ⬜ Week 3 |
| Fix 404s and redirect chains found in the crawl | ⏳ crawl |
| Breadcrumb, Organization and WebSite schema (check what Yoast already outputs, add only what's missing) | ⬜ Week 4 |
| FAQ schema on product and hub pages | ⬜ Month 2 |
| Speed: self-host Bootstrap, Font Awesome and fonts; defer chat (Olark), Clarity and Facebook Pixel; image sizes; lighter homepage | ⬜ Week 4 |
| One analytics setup, with conversion events (purchase, sample request, lead form) | ⬜ Week 3 |
| Pagination and filter indexing review | 🔄 |
| HTTPS and the www / non-www redirect | ⏳ crawl |
| Security: database passwords in `wp-config.php` are committed to git; keep the repo private and rotate them | ⬜ owner |

## 5. On-page SEO optimization

**Homepage** (Month 2): H1 ✅. Still to do: title and meta targeting "B2B email lists and business
databases by country", a short intro paragraph, links to the top 10 country hubs and the 5
categories, a 5-question FAQ with FAQ schema, and image alt text.

**Category pages** (Month 2): Business Email Data, Consumer Email Data, Special Database, Whois
Database, Mobile Number Databases. Each gets a unique title and meta, a 150–250 word intro above the
products, an FAQ, and links to related hubs. Note: the European consumer and South American
business categories already get 94–134 impressions at positions 55–73.

**Product and country pages:**
- **Priority 15 (Month 1–2):** Russia companies, Russia business email, Iraq, Afghanistan, Qatar
  mobile, Saudi Arabia, the WhatsApp page, Germany, Netherlands, France, Yemen, Pakistan, Forex,
  Mortgage brokers, UAE consumer.
  - Titles and meta ✅
  - Still to do: unique description (what's in the file, field list, record count only if the
    owner confirms it, update date, use cases, delivery), 4–6 FAQs, links to the hub and related
    products.
- **Next 5:** USA, UK, Canada, Australia, Singapore.
- **The other ~970 products:** improve the shared template rather than writing each by hand. Add
  a short per-country intro and FAQ block built from real product data: country, data type, fields,
  update date. Real product data keeps the pages from looking like thin doorway pages.
- **Fields list:** moved from the product page to checkout at the owner's request ✅. Keep the
  content details in the description text.

## 6. Content marketing and blog SEO

Four articles per month from Month 2. Each targets one keyword and links to two or more commercial
pages.

| # | Title | Target keyword | Links to |
|---|---|---|---|
| 1 | What Is a B2B Email Database and How Does It Work? | b2b email database | Business category, USA and UK hubs |
| 2 | Business Email List vs Consumer Email List: Key Differences | business vs consumer email list | Both categories |
| 3 | How to Verify Business Email Addresses Before a Campaign | how to verify business email addresses | Products (data quality) |
| 4 | What Information Is Included in a Company Database? | company database fields | Top products |
| 5 | How to Evaluate the Quality of a B2B Contact Database | b2b data quality | Hubs |
| 6 | Free vs Paid Business Email Lists: What You Actually Get | free business email list | Free sample pages (matches "free" and "pdf" searches) |
| 7 | Buying a Mobile Number List for SMS Marketing: Rules by Country | mobile number list | Qatar, Saudi and WhatsApp pages |
| 8 | GDPR, PECR and CAN-SPAM: Responsible B2B Email Marketing | gdpr b2b email marketing | About and trust pages |

Also: update or merge old blog posts. Week 1 already redirected 14 UAE and Saudi posts that weren't
indexed. Add Article schema with author and dates. Use only claims we can support with evidence.

## 7. Internal linking optimization

Target structure: **Home → Category → Country hub → Products**, plus **Blog → Hub or Product**.
- Breadcrumbs on product and hub pages.
- "Other [Country] databases" links on each product page.
- Each hub links to every product for its country; each product links back to its hub.
- Fix orphan pages found in the crawl.
- Descriptive link text ("Germany business email list", never "click here").

## 8. Off-page SEO and link building (Month 3, then ongoing)

- **Audit:** current backlinks and toxic links. Needs Ahrefs or Semrush; Windsor.ai can connect
  either.
- **Targets:** 20–30 relevant directories and B2B data marketplaces, 4–6 guest articles on B2B
  marketing and sales sites, and partnerships with CRM and email-tool blogs.
- **Avoid:** paid link networks, PBNs and mass directory blasts. This industry is already under
  Google spam scrutiny.
- Track new and lost referring domains each month.

## 9. AEO and GEO optimization

- Question-and-answer FAQs on the priority 15 pages, hubs and categories, with FAQ schema.
- Clear one-sentence answers at the top of blog posts.
- Organization schema with the same name, address, phone, email and social profiles everywhere.
- An About page that clearly describes the company: when it started, where it is based, how the
  data is sourced, contact details.
- Consistent business details on Google Business Profile, LinkedIn and directories.

## 10. Website trust and conversion optimization

| Task | Status |
|---|---|
| Payments working: PayPal is restricted, so checkout is Stripe card only for now; Google Pay and Apple Pay buttons removed | ✅ (owner to confirm with a test order) |
| Lead and sample form stored in wp-admin | ✅ |
| One correct "updated" date across product text, badges and titles | ⏳ owner |
| About page: company details, data sourcing, verification process | ⬜ owner provides the facts |
| Visible refund policy, privacy policy and lawful-use note on consumer and WhatsApp products | ⬜ |
| Genuine testimonials and reviews only | ⬜ owner provides |
| Clear calls to action: "Get a free sample" next to "Add to cart" | 🔄 |

Compliance: consumer and WhatsApp databases carry legal risk under GDPR, UK GDPR, PECR and
CAN-SPAM. Pages should explain lawful use and opt-out handling, and not promote cold-messaging EU or
UK consumers.

## 11. Tracking and reporting

| Tool | Status |
|---|---|
| Google Search Console | ✅ through Windsor.ai (trial: last 30 days only) |
| GA4 | ⏳ connect it to Windsor.ai; remove duplicate tracking |
| Screaming Frog and PageSpeed | ⏳ live-site access |
| Ahrefs or Semrush | ⬜ optional |

**Targets for the end of Month 3**

| KPI | Baseline | Target |
|---|---|---|
| Clicks per 28 days | ~140 | 400+ |
| CTR | 1.8% | 3.5%+ |
| Priority 15 pages in the top 5 | ~3 | 10 |
| Tier 2 "[country] business email list" keywords in the top 20 | 2 | 8 |
| Duplicate product groups | ~30 | 0 |
| Organic sample requests and orders | not tracked | tracked monthly |

Reports: a short weekly update, a full monthly report, and the git commit history as the change log.

## 12. Execution timeline

| Week | Focus | Work |
|---|---|---|
| 1 (18–23 Nov) ✅ | Foundation | Deploy pipeline, noindex rules, redirects, hubs, headings, lead form |
| 2 (24–30 Nov) 🔄 | Quick wins | Priority 15 titles and meta ✅, filter noindex ✅, Product schema ✅, refined plan ✅, duplicate list ⏳ |
| 3 (1–7 Dec) | Audit | Crawl, 404s, redirect chains, sitemap error, analytics clean-up, duplicate merges, audit report |
| 4 (8–14 Dec) | Technical | Breadcrumb and Organization schema, speed work, keyword map, competitor list |
| 5–6 | On-page | Priority 15 content and FAQs, homepage, product template upgrade |
| 7–8 | On-page and content | 5 category pages, 8 country hubs, blog posts 1–4 |
| 9–10 | Authority | Directories and marketplaces, guest posts, About and trust pages |
| 11–12 | Growth and review | Blog posts 5–8, next 5 product pages, AEO and GEO, Month 3 report, next-phase roadmap |

## 13. Expected deliverables

| # | Deliverable | Status |
|---|---|---|
| 1 | SEO audit report | 🔄 Week 3 |
| 2 | Keyword map and competitor analysis | ⬜ Week 4 |
| 3 | Technical fixes | 🔄 |
| 4 | Homepage optimization | 🔄 (H1 done) |
| 5 | Category page optimization | ⬜ Month 2 |
| 6 | 15–20 priority pages | 🔄 (titles and meta done) |
| 7 | Internal linking | ⬜ |
| 8 | 8 blog articles | ⬜ Months 2–3 |
| 9 | Schema markup | 🔄 (Product brand done) |
| 10 | Backlink campaign | ⬜ Month 3 |
| 11 | AEO and GEO | ⬜ |
| 12 | GA4 and Search Console tracking | 🔄 |
| 13 | Monthly reports | ⬜ first one on 23 Dec |
| 14 | Next-phase roadmap | ⬜ Month 3 |

## 14. Final strategy

**Quick wins and technical clean-up (in parallel) → Audit → Keyword map → On-page (priority pages,
then hubs, then categories, then template) → Content and internal links → Authority → AEO/GEO →
Measure and repeat.**

The change from the original sequence: pages that already rank in the top 20 get optimized first,
alongside the technical work, instead of waiting until Month 2. They can produce traffic within
weeks while the slower work (head terms, links) builds up.

## What we need from the owner

1. Approve the duplicate merge list (`docs/duplicate-merge-proposal.md`).
2. The correct data update date (April 2025 or 2026).
3. Live-site access for crawling: add worldwidedatahub.com to the environment's allowed sites, or
   upload a Screaming Frog export.
4. A WordPress Application Password, so I can edit product and page text through the API.
5. Company facts for the About and trust pages: data sources, record counts, refund terms, real
   testimonials.
6. Optional: connect GA4 to Windsor.ai, and upgrade Windsor.ai for more than 30 days of history.

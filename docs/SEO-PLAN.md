# WorldWide DataHub: SEO Plan (refined)

Site: https://worldwidedatahub.com/ · Duration: 3 months (from 24 Nov 2026) · Owner: shehryarkashif

This builds on the original 14-section plan. It keeps the same structure and goals and adds:
a measured baseline, priorities ranked by Search Console data, a week-by-week schedule, who does
what, the access each task needs, and targets.

---

## 1. Baseline (Google Search Console, 27 Oct – 21 Nov 2026)

| Metric | Value |
|---|---|
| Clicks | 130 (about 5/day) |
| Impressions | 7,402 |
| CTR | 1.8% |
| Average position | ~42 |
| Trend | Impressions down from ~330/day to ~200/day; position slipped from 37 to 43 |
| Product sitemap | 991 URLs submitted; only ~250 products got any impressions |
| Top markets | US desktop 2,707 impressions (position 49), UK 877 (position 63). Most clicks come from Pakistan, Iraq, India and Malaysia on mobile |

Data comes through Windsor.ai, whose trial is limited to 30 days. A 3-month baseline needs a
Windsor.ai upgrade or a direct export from Search Console.

### What the data changes about the original plan

1. **Head terms are out of reach for now.** "business email database", "uk email database",
   "consumer email list" and similar rank between 50 and 85. Targeting them first would take
   months to show results.
2. **Long-tail country terms are already close to the top.** Examples: "russia companies database"
   (position 9), "afghanistan phone number list" (5), "saudi arabia mobile number list" (2),
   "qatar mobile number list" (2.5), "iraq database" (10). These rank in the top 10 but get almost
   no clicks, so better titles, descriptions and on-page content can win traffic within weeks.
   **They are the Month 1 priority.**
3. **Duplicate products are the main technical problem.** Many countries have 2–3 product URLs
   for the same database (for example `-companies-database`, `-company-database`,
   `-company-database-2`). They compete with each other in Google. Week 1 merged 13 groups;
   about 30 remain.
4. **Many searches contain "free", "pdf" or "list".** Titles should lead with "list" wording and
   offer the free sample that the site already provides.

## 2. Already completed (Week 1, 18–24 Nov)

- Theme deploys automatically from git to the server over FTPS (GitHub Actions, push to `main`).
- noindex and sitemap exclusion for tag, author, search, date and Uncategorized archives, plus
  payment and thank-you pages.
- Permanent redirect map: UAE and Saudi post clusters into hub pages, competing pages merged into
  `/[country]-email-list/` hubs, 13 duplicate product groups merged, junk pages redirected.
- Homepage H1; real H1s on archive and product pages; excerpts instead of full posts on listing
  pages; alt text; lighter homepage carousels.
- Lead form (`[wwdh_lead_form]`) with leads stored in wp-admin; landing-page template with FAQ
  schema.
- IndexNow key; Google "preferred source" badge; "Updated 2026" badges.
- 24 Nov: outdated robots-related meta tags removed from `<head>`.

## 3. Priorities, ranked by expected impact

| # | Work | Why | Effort |
|---|---|---|---|
| P1 | New titles and descriptions for 15 pages in or near the top 10 | Rankings exist but CTR is close to 0 | Low (code) |
| P2 | Merge the remaining ~30 duplicate product groups | Rankings are split between URLs | Low (code, owner approves the list) |
| P3 | Unique content and FAQs on those 15 pages | Moves them from positions 6–10 into the top 3 | Medium |
| P4 | Country hub pages linking to their products | Builds topical authority for "[country] email list" searches | Medium |
| P5 | Structured data: Product with brand, Breadcrumb, Organization, FAQ, Article | Richer search results; supports AEO/GEO | Low–medium |
| P6 | Speed: self-hosted CSS and fonts, deferred chat and analytics scripts | Core Web Vitals | Medium |
| P7 | Trust pages: About, data sourcing, privacy, refund policy | Conversions and E-E-A-T; this is a sensitive industry | Medium (owner supplies facts) |
| P8 | Blog: 8 articles | Informational traffic and internal links | Ongoing |
| P9 | Links: directories, data marketplaces, guest posts | Authority for the head terms in Months 3–6 | Ongoing |

## 4. Technical SEO additions to the original section 4

- **Duplicates:** keep one URL per country and data type, and redirect the others to it. The kept
  URL is whichever has the best Search Console position or the most clicks.
- **Filtered and sorted shop URLs** (`?orderby=`, `?filter_*`, `?min_price=`, `?add-to-cart=`):
  noindex, follow.
- **One analytics setup:** GA4 is hard-coded in `header.php`, and the GTM, GA and Site Kit
  plugins are also installed. Visits may be counted twice. Keep one setup and track lead-form
  submissions, sample requests and purchases as conversions.
- **Sitemaps:** each sitemap shows 1 error in Search Console. Find and fix it, then resubmit.
- **Titles in code:** priority page titles are set in `inc/wwdh-seo.php`, which takes priority
  over Yoast. When a page is in that map, edit its title there, not in Yoast.
- **Security (not SEO):** `wp-config.php` files with database passwords are committed to git.
  Keep the repo private and rotate the passwords if it was ever shared.

## 5. Keyword targeting (refined)

| Tier | Keyword type | Example | Target URL |
|---|---|---|---|
| 1 (Month 1) | Country + list/database, already top 20 | russia companies database, qatar mobile number list, iraq database, afghanistan phone number list | Existing product page |
| 2 (Month 2) | Country + business email list, top 20–50 | germany business email list (29), netherlands business email list (19), france business email list (16), new zealand business email list (28) | Country hub page plus product |
| 3 (Month 2–3) | Niche lists | forex traders email list, mortgage brokers email database, iphone users database | Product page |
| 4 (Month 3+) | Head terms | business email database, b2b email database, uk email database | Category page, homepage, links |
| Informational | Questions | what is a b2b email database, how to verify business emails | Blog |

Each keyword gets one target URL. A keyword-to-URL map will be kept in `docs/keyword-map.csv`
so two pages never compete for the same keyword.

## 6. Three-month schedule

### Month 1: technical foundation and quick wins
- **Week 2 (24–30 Nov):** P1 titles and descriptions for 15 pages · noindex on filtered shop URLs ·
  brand added to Product schema · duplicate merge list sent for approval.
- **Week 3:** apply the approved duplicate merges · full crawl (needs live-site access) · fix
  404s, redirect chains and the sitemap errors · analytics clean-up.
- **Week 4:** Breadcrumb, Organization and FAQ schema · speed work (P6) · keyword map v1 ·
  competitor list.

### Month 2: on-page and content
- Homepage: title, intro copy, FAQ section, links to hubs.
- Category pages (Business Email, Consumer Email, Special, Whois, Mobile): unique intro text,
  FAQs, titles.
- 15–20 product pages: unique descriptions, FAQs and related links, starting with the P1 pages.
- Country hubs for the top 8 countries by impressions.
- 4 blog articles.

### Month 3: authority and growth
- Link building: 20–30 quality directories and data marketplaces, plus 4–6 guest posts.
- AEO/GEO: question-based FAQs, consistent business details (NAP) across platforms, an About page
  with entity details.
- 4 more blog articles; conversion tracking review; month-3 report and next-phase roadmap.

## 7. Who does what

| Task | Done by | Needs |
|---|---|---|
| Theme code: titles, schema, redirects, speed, templates | Claude, via git (deploy on merge to `main`) | Approval for merges |
| Page and product text in WordPress (database) | Claude via WordPress REST API, or owner | WordPress Application Password |
| Crawl, live checks, PageSpeed | Claude | Network access to worldwidedatahub.com (not enabled) |
| Search Console data | Claude via Windsor.ai | Connected. 30-day limit on trial |
| Facts: data sources, record counts, update dates, refund terms, testimonials | Owner | n/a |
| Competitor and backlink data | Claude | Ahrefs or Semrush access (optional; Windsor.ai supports both) |
| Link outreach and directory accounts | Owner or Claude drafts | Business email account |

## 8. Targets for the end of Month 3 (indicative)

| KPI | Baseline | Target |
|---|---|---|
| Clicks per 28 days | ~140 | 400+ |
| CTR | 1.8% | 3.5%+ |
| Priority pages in the top 5 | ~3 | 10 of 15 |
| Duplicate product URLs live | ~30 groups | 0 |
| Organic leads and sample requests | Not tracked | Tracked and reported monthly |

## 9. Content and compliance rules

- Only make claims the business can show evidence for. Record counts, accuracy percentages and
  "verified" claims need owner confirmation before they are published.
- Consumer and WhatsApp databases carry legal risk under GDPR, UK GDPR, PECR and CAN-SPAM.
  Their pages should explain lawful use and opt-out handling, and avoid targeting EU/UK consumers
  without a legal basis.
- No fake reviews, testimonials or AI-padded filler. Every page should answer what the buyer
  actually needs to know.

## 10. Reporting

- Weekly: changes deployed, plus Search Console clicks, impressions, CTR and position for the
  priority pages.
- Monthly: the full report from the original plan (section 11).
- Change log: every deploy is a git commit explaining what changed and why.

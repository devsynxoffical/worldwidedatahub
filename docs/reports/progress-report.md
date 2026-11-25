# WorldWide DataHub SEO: progress report

**Period:** 18 Nov – 25 Nov 2026 · **Plan:** 3 months (24 Nov 2026 – 23 Feb 2027) · **Now:** Day 3 of 92
**Site:** https://worldwidedatahub.com/ · **Change log:** every item below is a git commit in
`devsynxoffical/worldwidedatahub` and deploys automatically to the server over FTPS.

---

## Summary

| | |
|---|---|
| Deploys to the live site | 23 automatic deploys (28 commits in total). All successful except the very first on 18 Nov, which was fixed and re-deployed 5 minutes later |
| Pages with new Google titles and descriptions | 15 priority pages + homepage + 4 main categories + all regional sub-categories |
| Pages with a new FAQ section | 14 priority products + homepage |
| URLs consolidated with 301 redirects | 50 live, plus 31 more duplicate groups proposed and awaiting approval |
| Documents delivered | Refined SEO plan, keyword map (503 keywords), competitor analysis, duplicate merge proposal, this report |
| Baseline (Search Console, 27 Oct – 21 Nov) | 130 clicks · 7,402 impressions · 1.8% CTR · average position ~42 |

**Measuring results:** Google's data runs 2–3 days behind, and the first changes went live on 24 Nov.
The first measurable check is **27–28 Nov**. Clicks usually start to rise 1–3 weeks after title
changes, and rankings within 4–8 weeks.

---

## Groundwork (before the plan start date), 18–23 Nov

| Date | Work | Why |
|---|---|---|
| 18 Nov | Automatic deploy pipeline (GitHub → FTPS → server); Search Console verification tag; product title as H1; alt text on logo and icons; error logs blocked from public access | A safe, repeatable way to ship changes, plus basic on-page fixes |
| 18 Nov | Removed an old Google verification file from the site root | Clean-up |
| 19 Nov | Lead capture form (leads saved in wp-admin and emailed); "Data Landing Page" template with automatic FAQ schema | Capture sample requests; a template for country landing pages |
| 19 Nov | noindex for thin pages (tag, author, search, date, Uncategorized, payment and thank-you pages) and kept them out of the sitemap; first permanent redirect map; browser caching | Stops low-value pages from diluting the site in Google |
| 19 Nov | IndexNow key (Bing and others) | Faster indexing of changes |
| 20 Nov | Country hub URLs in the form `/[country]-email-list/`; competing pages merged into hubs (USA, Canada, Singapore, UAE, Saudi); homepage H1 | One strong page per country instead of several weak ones |
| 20 Nov | Real H1s on archive pages, excerpts instead of full posts on listing pages, lighter homepage carousels, alt text, dead placeholder removed, real estate post redirected | Fewer duplicate-content and heading problems; speed |
| 21 Nov | Google "Preferred sources" badge in the footer and after blog posts | Brand preference in Google |
| 23 Nov | "Updated" badges set to 2026; % OFF badges removed; automatic cache clear after each deploy | Fresher signals; visitors always get the latest version |
| 23 Nov | 2 product 404s fixed; 13 duplicate product groups merged (18 URLs redirected) | Recovers lost pages; stops products competing with each other |

## Day 1: 24 Nov 2026

| Work | Detail | Status |
|---|---|---|
| Header clean-up | Removed about 10 outdated meta tags, including a `googlebot index,follow` tag that contradicted noindex | ✅ Live |
| Priority titles and descriptions | New Google titles and descriptions for 15 pages that rank around positions 2–30 with almost no clicks (Russia ×2, Iraq, Afghanistan, Qatar, Saudi, WhatsApp, Germany, Netherlands, France, Yemen, Pakistan, Forex, Mortgage brokers, UAE consumer) | ✅ Live |
| Shop filter pages | noindex on `?orderby`, `?filter_*`, `?min_price`, `?add-to-cart` URLs | ✅ Live |
| Product schema | Brand "WorldWide DataHub" added | ✅ Live |
| Refined SEO plan | `docs/SEO-PLAN.md`, in the owner's 14-section structure with data, status and timeline | ✅ |
| Duplicate merge proposal | 30 more duplicate product groups, with Search Console evidence | ⏳ Owner approval |
| Fields list moved | From every product page to a "What's included in your data file" box at checkout | ✅ Live (owner request) |
| Payments | PayPal account restricted by PayPal (PAYEE_ACCOUNT_RESTRICTED). Checkout set to Stripe cards only; PayPal, Google Pay and Apple Pay buttons removed | ✅ Live (owner request) |
| Keyword map | `docs/keyword-map.csv`: 503 keywords with tier, intent, ranking page, target page, hub, competing URLs and action. 108 quick wins, 96 keywords where several of our pages compete | ✅ |
| Product FAQ | 5-question FAQ with FAQ schema on 14 priority products (fields, sample, delivery, live price, lawful use) | ✅ Live |
| Speed | Olark chat and Microsoft Clarity load after the page, on first interaction or after 4 seconds | ✅ Live |

## Day 2: 24 Nov 2026 (second batch)

| Work | Detail | Status |
|---|---|---|
| Breadcrumbs | Home › Category › Product links above every product title | ✅ Live |
| Same-country links | "More [Country] databases" on every country product (up to 8 sister products, plus a hub link for 8 countries); never links to redirected duplicates | ✅ Live |
| Record-count FAQ | New question using the record count the page already shows | ✅ Live |
| Self-hosted CSS | Bootstrap 4.4.1 and Font Awesome 4.7.0 served from the site instead of an outside CDN (identical file, verified by checksum) | ✅ Live |
| Merge proposal | Added `/saudi-arabia-companies-email-list/` (competes with the Saudi hub and product) | ⏳ Owner approval |

## Day 3: 25 Nov 2026

| Work | Detail | Status |
|---|---|---|
| Homepage | New title "B2B Email Lists & Business Databases \| WorldWide DataHub" and description; 6-question FAQ with FAQ schema; outdated "2025 Latest Whois" heading fixed; alt text on 3 images | ✅ Live |
| Category pages | Title, description and intro text for Business Email Data, Consumer Email Data, Special Databases and Whois Database, plus every regional sub-category (for example "European Business Email Lists & Company Databases"). Consumer and Whois pages include a lawful-use note | ✅ Live |
| Competitor analysis | `docs/competitors.md`: LeadsBlue, CompanyData, BoldData, Ampliz, Apollo, Cognism and marketplaces, with what to copy and what to avoid | ✅ |
| Progress report | This document | ✅ |

---

## Plan status

| Plan section | Status |
|---|---|
| 2 Audit | 🔄 Search Console baseline done; full crawl blocked (no live-site access) |
| 3 Keywords and competitors | ✅ Keyword map v1, ✅ competitor analysis v1 |
| 4 Technical | 🔄 noindex, redirects, filter URLs, schema, speed part 1 and 2 done; sitemap error and 404 crawl blocked |
| 5 On-page | 🔄 15 priority titles, 14 product FAQs, homepage, categories done; product description rewrites need WordPress access |
| 6 Content (blog) | ⬜ Starts in Month 2 |
| 7 Internal links | 🔄 Breadcrumbs and same-country links done |
| 8 Links | ⬜ Month 3 |
| 9 AEO and GEO | 🔄 FAQ and FAQ schema on 15 pages |
| 10 Trust and conversion | 🔄 Payments fixed (Stripe), lead form; About page needs owner facts |
| 11 Tracking | 🔄 Search Console through Windsor.ai (30-day trial limit) |

## Waiting on the owner

| # | Needed | Unblocks |
|---|---|---|
| 1 | Approval of `docs/duplicate-merge-proposal.md` (31 groups) | Merging ~45 duplicate URLs; fixes 96 keywords where our pages compete |
| 2 | The correct data update date: April 2025 or 2026? | Consistent "updated" claims in badges, titles and FAQ |
| 3 | WordPress Application Password | Rewriting product descriptions; editing pages through the API |
| 4 | Live-site access for this environment, or a Screaming Frog export | Crawl audit: 404s, redirect chains, sitemap error, orphan pages |
| 5 | Test order through Stripe | Confirms payments work end to end |
| 6 | Company facts: data sources, refund terms, real testimonials | About and trust pages |

## Next (Day 4 onward)
- 27–28 Nov: first Search Console check on the 15 retitled pages.
- Self-host Google Fonts (speed part 3); defer non-critical theme JavaScript.
- Organization schema check; product image alt text across the shop.
- On approval: the duplicate merges, then hub content for the top 8 countries.

# Duplicate product merges: proposal for approval (round 2)

Status: **waiting for owner approval**. Nothing below is live yet.

Source: Google Search Console, 27 Oct – 21 Nov 2026. Positions are averages, and "Impr." means
impressions. Week 1 already merged 13 groups.

How the URL to keep was chosen: most clicks, then most impressions, then best position, then the
URL without `-2`. The other URLs get a permanent (301) redirect to it.

**Please check:** is each pair really the same database? If one is a different product (for
example a smaller or cheaper list), say so and that row will be left out.

| # | Keep | Pos. / Impr. | Redirect to it | Pos. / Impr. |
|---|---|---|---|---|
| 1 | /product/germany-company-database/ | 22.6 / 139 | /product/germany-companies-database/ | 75.6 / 73 |
| 2 | /product/netherlands-companies-database/ | 30.2 / 110 | /product/netherlands-companies-database-2/ * | 51.7 / 35 |
| 3 | /product/switzerland-companies-database/ | 69.8 / 39 | /product/switzerland-companies-database-2/ | 78.5 / 107 |
| 4 | /product/new-zealand-companies-database/ | 37.9 / 57 | /product/new-zealand-company-database/, /product/new-zealand-company-database-2/ | 32.2 / 24, 47.4 / 28 |
| 5 | /product/south-africa-companies-database/ | 21.3 / 9 | /product/south-africa-company-database/, /product/south-africa-company-database-2/ | 47.2 / 6, 28.6 / 10 |
| 6 | /product/singapore-company-database/ | 43.4 / 52 | /product/singapore-companies-database/ | 82.2 / 16 |
| 7 | /product/united-kingdom-company-database-2/ | 59.9 / 336 | /product/united-kingdom-company-database/ | 50.9 / 48 |
| 8 | /product/spain-company-database-2-2/ | 21.2 / 25 | /product/spain-companies-database/ | 75.7 / 23 |
| 9 | /product/hungary-companies-database/ | 54.6 / 34 | /product/hungary-companies-database-2/ | 42.4 / 14 |
| 10 | /product/albania-companies-database/ | 24.5 / 49 | /product/albania-company-database/ | 15.2 / 5 |
| 11 | /product/argentina-companies-database/ | 53.1 / 38 | /product/argentina-company-database/ | 68.9 / 9 |
| 12 | /product/austria-company-database-2/ | 38.9 / 29 | /product/austria-companies-database/ | 66.8 / 10 |
| 13 | /product/bahrain-companies-database/ | 52.0 / 29 | /product/bahrain-company-database/ | 23.5 / 4 |
| 14 | /product/iraq-companies-database/ | 10.2 / 118 (13 clicks) | /product/iraq-company-database/ | 7.5 / 2 |
| 15 | /product/afghanistan-companies-database/ | 6.0 / 100 | /product/afghanistan-company-database/ | 15.4 / 5 |
| 16 | /product/yemen-company-database/ | 10.2 / 28 (6 clicks) | /product/yemen-companies-database/ | 15.3 / 3 |
| 17 | /product/pakistan-companies-database/ | 13.3 / 41 | /product/pakistan-company-database/ | 24.4 / 12 |
| 18 | /product/egypt-companies-database/ | 23.7 / 21 | /product/egypt-company-database/ | 34.3 / 4 |
| 19 | /product/jordan-companies-database/ | 40.9 / 39 | /product/jordan-company-database/ | 60.5 / 8 |
| 20 | /product/kenya-companies-database/ | 57.4 / 21 | /product/kenya-company-database/ | 34.0 / 1 |
| 21 | /product/indonesia-companies-database/ | 49.9 / 33 | /product/indonesia-company-database/ | 38.5 / 6 |
| 22 | /product/portugal-company-database-2/ | 38.2 / 22 | /product/portugal-companies-database/ | 49.5 / 20 |
| 23 | /product/poland-companies-database/ | 50.4 / 13 | /product/poland-company-database-2/ | 38.9 / 8 |
| 24 | /product/romania-company-database/ | 41.7 / 12 | /product/romania-companies-database/ | 44.6 / 10 |
| 25 | /product/greece-company-database-2/ | 31.3 / 9 | /product/greece-companies-database/ | 49.1 / 9 |
| 26 | /product/turkey-companies-database/ | 57.0 / 32 | /product/turkey-company-database/ | 62.0 / 1 |
| 27 | /product/denmark-companies-database/ | 27.0 / 13 | /product/denmark-company-database/ | 47.6 / 9 |
| 28 | /product/ethiopia-company-database/ | 32.4 / 7 | /product/ethiopia-companies-database/ | 48.0 / 2 |
| 29 | /product/iran-companies-database/ | 48.5 / 13 | /product/iran-company-database/ | 8.0 / 1 |
| 30 | /product/kuwait-companies-database/ | 42.6 / 12 | /product/kuwait-company-database/ | 37.0 / 1 |
| 31 | /saudi-arabia-email-list/ (hub) | n/a | /saudi-arabia-companies-email-list/ (page, competes with the Saudi hub and product) | 6–37 / ~25 per week |

\* Row 2: Week 1 redirects the two Netherlands Antilles URLs to
`netherlands-companies-database-2`. Those entries will be updated to point straight at
`netherlands-companies-database`, so there is no redirect chain.

Smaller groups to check in the full crawl (each URL had fewer than 10 impressions): Benin, Bhutan,
Burkina Faso, Burundi, Cambodia, Czech Republic, Iceland, Lebanon, Macau, Macedonia, Maldives,
Malta, Monaco, Nigeria, Tanzania, Brunei.

**After merging:** in WordPress, move each redirected product to Draft so it drops out of the shop
listings and the sitemap. The redirect keeps working for Google and for old links.

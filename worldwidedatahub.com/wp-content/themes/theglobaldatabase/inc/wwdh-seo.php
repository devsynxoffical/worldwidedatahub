<?php
/**
 * WWDH SEO rules: noindex thin archives, keep them out of the sitemap,
 * and 301-redirect consolidated URLs. Every entry is logged in the
 * project change log with its reason.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Year shown on all 'Updated' badges (homepage cards, shop cards, product pages). */
if ( ! defined( 'WWDH_DATA_YEAR' ) ) {
	define( 'WWDH_DATA_YEAR', '2026' );
}

/* Pages that must not be indexed (payment helpers, thank-you pages). */
function wwdh_noindex_page_ids() {
	return array( 2692, 2693, 2694, 1807, 3149 );
}

function wwdh_should_noindex() {
	if ( is_tag() || is_tax( 'product_tag' ) || is_author() || is_search() || is_date() ) {
		return true;
	}
	if ( is_category( 'uncategorized' ) || is_tax( 'product_cat', 'uncategorized' ) ) {
		return true;
	}
	if ( is_page( wwdh_noindex_page_ids() ) ) {
		return true;
	}
	if ( wwdh_is_filtered_shop_url() ) {
		return true;
	}
	return false;
}

/* Sorted / filtered / add-to-cart shop URLs: duplicate listings, keep out of the index. */
function wwdh_is_filtered_shop_url() {
	if ( empty( $_GET ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return false;
	}
	foreach ( array_keys( $_GET ) as $key ) { // phpcs:ignore WordPress.Security.NonceVerification
		$key = strtolower( (string) $key );
		if ( in_array( $key, array( 'orderby', 'min_price', 'max_price', 'rating_filter', 'add-to-cart', 'product_view', 'per_page' ), true )
			|| 0 === strpos( $key, 'filter_' ) || 0 === strpos( $key, 'query_type_' ) ) {
			return true;
		}
	}
	return false;
}

/* Yoast robots meta */
add_filter( 'wpseo_robots', function ( $robots ) {
	return wwdh_should_noindex() ? 'noindex, follow' : $robots;
} );
add_filter( 'wpseo_robots_array', function ( $robots ) {
	if ( wwdh_should_noindex() ) {
		$robots['index']  = 'noindex';
		$robots['follow'] = 'follow';
	}
	return $robots;
} );

/* Keep the same URLs out of the XML sitemap */
add_filter( 'wpseo_sitemap_exclude_taxonomy', function ( $excluded, $taxonomy ) {
	return in_array( $taxonomy, array( 'post_tag', 'product_tag' ), true ) ? true : $excluded;
}, 10, 2 );
add_filter( 'wpseo_sitemap_exclude_author', function () {
	return array();
} );
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', function ( $ids ) {
	return array_merge( (array) $ids, wwdh_noindex_page_ids() );
} );

/* 301 redirect map: old path => new path */
function wwdh_redirect_map() {
	return array(
		// UAE cluster (posts were not indexed by Google) -> UAE hub page.
		'/uae-companies-database/'                 => '/uae-email-list/',
		'/latest-uae-companies-database-for-2024/' => '/uae-email-list/',
		'/buy-uae-companies-database-for-marketing/' => '/uae-email-list/',
		'/business-directory-of-uae/'              => '/uae-email-list/',
		'/free-uae-business-directory/'            => '/uae-email-list/',
		'/uae-email-and-mobile-number-database/'   => '/uae-email-list/',
		'/verified-uae-email-list/'                => '/uae-email-list/',
		'/uae-targeted-email-list/'                => '/uae-email-list/',
		'/dubai-companies-database/'               => '/uae-email-list/',
		'/dubai-company-email-database/'           => '/uae-email-list/',
		'/gulf-business-directory/'                => '/uae-email-list/',
		// Saudi cluster -> Saudi hub page.
		'/saudi-arabia-targeted-email-list/'       => '/saudi-arabia-email-list/',
		'/buy-saudi-arabia-business-database-for-marketing/' => '/saudi-arabia-email-list/',
		// 19 Nov hub URLs moved to the plan's URL format (20 Nov).
		'/germany-business-email-list/'      => '/germany-email-list/',
		'/netherlands-business-email-list/'  => '/netherlands-email-list/',
		'/france-business-email-list/'       => '/france-email-list/',
		'/uae-business-email-list/'          => '/uae-email-list/',
		'/saudi-arabia-business-email-list/' => '/saudi-arabia-email-list/',
		// Cannibalising pages merged into country hubs.
		'/buy-usa-email-list/'               => '/usa-email-list/',
		'/canada-business-email-database/'   => '/canada-email-list/',
		'/canada-business-email-list/'       => '/canada-email-list/',
		'/singapore-companies-database/'     => '/singapore-email-list/',
		// Duplicate product merges (23 Nov, owner approved).
		'/product/china-email-database/' => '/product/china-companies-database-2/',
		'/product/china-companies-database/' => '/product/china-companies-database-2/',
		'/product/costa-rica-company-database/' => '/product/costa-rica-company-database-2/',
		'/product/croatia-company-database-2/' => '/product/croatia-company-database/',
		'/product/cyprus-company-database-2-2/' => '/product/cyprus-company-database/',
		'/product/cyprus-companies-database/' => '/product/cyprus-company-database/',
		'/product/estonia-company-database-2/' => '/product/estonia-companies-database/',
		'/product/finland-companies-database/' => '/product/finland-company-database-2/',
		'/product/finland-company-database/' => '/product/finland-company-database-2/',
		'/product/macedonia-company-database-2/' => '/product/macedonia-company-database/',
		'/product/netherlands-antilles-company-database/' => '/product/netherlands-companies-database-2/',
		'/product/netherlands-antilles-business-email-database/' => '/product/netherlands-companies-database-2/',
		'/product/puerto-rico-company-database-2/' => '/product/puerto-rico-company-database/',
		'/product/serbia-company-database/' => '/product/serbia-company-database-2/',
		'/product/spain-company-database/' => '/product/spain-company-database-2-2/',
		'/product/ukraine-company-database-2/' => '/product/ukraine-company-database/',
		'/product/united-kingdom-company-database/' => '/product/united-kingdom-company-database-2/',
		'/product/united-kingdom-companies-database/' => '/product/united-kingdom-company-database-2/',
		'/product/uk-companies-database/' => '/product/united-kingdom-company-database-2/',
		// 404 fixes (23 Nov): scheduled duplicate + trashed product.
		'/product/saudi-arabia-company-database-2/' => '/product/saudi-arabia-companies-database/',
		'/product/saudi-arabia-consumer-email-database/' => '/saudi-arabia-email-list/',
		// Industry page consolidation.
		'/real-estate-email-database-global-developers/' => '/real-estate-email-list/',
		// Duplicate "(Copy)" products -> original products.
		'/product/sao-tome-and-principe-company-database-mobile-numbers-email-list-copy/' => '/product/sao-tome-and-principe-company-database/',
		'/product/switzerland-company-database-mobile-numbers-email-list-copy/'   => '/product/switzerland-companies-database/',
		'/product/switzerland-company-database-mobile-numbers-email-list-copy-2/' => '/product/switzerland-companies-database/',
		'/product/uzbekistan-companies-database-list-including-updated-names-mobile-numbers-company-name-email-address-and-more-copy/' => '/product/uzbekistan-company-database/',
		// Junk pages that were set to draft.
		'/hello-world/' => '/blog/',
		'/brizy-1926/'  => '/',
	);
}

add_action( 'template_redirect', function () {
	if ( is_admin() ) {
		return;
	}
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/', PHP_URL_PATH ); // phpcs:ignore
	if ( ! $path ) {
		return;
	}
	$path = trailingslashit( strtolower( $path ) );
	$map  = wwdh_redirect_map();
	if ( isset( $map[ $path ] ) ) {
		wp_safe_redirect( home_url( $map[ $path ] ), 301, 'WWDH' );
		exit;
	}
}, 1 );

/* IndexNow key file (Bing etc.) served at /{key}.txt without a root file. */
add_action( 'init', function () {
	$key  = '9c340550dc224f03b33dad0bd9da36dd';
	$path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : ''; // phpcs:ignore
	if ( '/' . $key . '.txt' === $path ) {
		header( 'Content-Type: text/plain; charset=utf-8' );
		echo $key; // phpcs:ignore
		exit;
	}
}, 0 );

/* Archive headings without the 'Category:' / 'Tag:' / 'Author:' prefix. */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

/* Google "Preferred sources" badge: plain link to Google's preference page. */
function wwdh_preferred_source_badge( $extra_class = '' ) {
	$url = 'https://www.google.com/preferences/source?q=worldwidedatahub.com';
	$g   = '<svg class="wwdh-gps-g" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true" focusable="false"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.6l6.8-6.8C35.8 2.4 30.3 0 24 0 14.6 0 6.6 5.4 2.7 13.3l7.9 6.1C12.5 13.7 17.8 9.5 24 9.5z"/><path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.4c-.5 2.9-2.2 5.3-4.6 6.9l7.4 5.8c4.3-4 6.9-9.9 6.9-17.2z"/><path fill="#FBBC05" d="M10.6 28.6c-.5-1.4-.8-3-.8-4.6s.3-3.2.8-4.6l-7.9-6.1C1 16.6 0 20.2 0 24s1 7.4 2.7 10.7l7.9-6.1z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.4-5.8c-2.1 1.4-4.8 2.3-8.5 2.3-6.2 0-11.5-4.2-13.4-9.9l-7.9 6.1C6.6 42.6 14.6 48 24 48z"/></svg>';
	return '<a class="wwdh-gps ' . esc_attr( $extra_class ) . '" href="' . esc_url( $url ) . '" target="_blank" rel="noopener">'
		. '<span class="wwdh-gps-icon">' . $g . '</span><span>Make WorldWide DataHub a preferred source on Google</span></a>';
}

add_action( 'wp_head', function () {
	echo '<style>.wwdh-gps{display:inline-flex;max-width:100%;box-sizing:border-box;align-items:center;gap:10px;background:#1a73e8;color:#fff!important;font:600 14px/1.3 Muli,Arial,sans-serif;padding:9px 16px 9px 9px;border-radius:6px;text-decoration:none!important;box-shadow:0 1px 3px rgba(0,0,0,.25);transition:background .15s}.wwdh-gps:hover,.wwdh-gps:focus{background:#1765cc;color:#fff!important}.wwdh-gps-icon{background:#fff;border-radius:4px;width:26px;height:26px;display:inline-flex;align-items:center;justify-content:center;flex:0 0 26px}.wwdh-gps-wrap{margin-top:18px}.wwdh-gps-post{margin:32px 0 8px;padding:18px;border:1px solid #dadce0;border-radius:8px;background:#f8f9fa}.wwdh-gps-post p{margin:0 0 12px;color:#3c4043}</style>' . "\n";
} );

/* End of every blog post. */
add_filter( 'the_content', function ( $content ) {
	if ( is_singular( 'post' ) && in_the_loop() && is_main_query() ) {
		$content .= '<div class="wwdh-gps-post"><p>Found this useful? Add WorldWide DataHub as a preferred source on Google to see more of our guides in your search results.</p>'
			. wwdh_preferred_source_badge() . '</div>';
	}
	return $content;
}, 99 );

/*
 * Clear WP Fastest Cache once after each theme deploy, so visitors never see
 * stale cached pages. Bump WWDH_CACHE_VER when a deploy changes page output.
 */
if ( ! defined( 'WWDH_CACHE_VER' ) ) {
	define( 'WWDH_CACHE_VER', '2026-11-28-single-jquery' );
}
add_action( 'init', function () {
	if ( get_option( 'wwdh_cache_ver' ) === WWDH_CACHE_VER ) {
		return;
	}
	update_option( 'wwdh_cache_ver', WWDH_CACHE_VER, false );
	if ( function_exists( 'wpfc_clear_all_cache' ) ) {
		wpfc_clear_all_cache( true );
	} else {
		do_action( 'wpfc_clear_all_cache', true );
	}
}, 99 );

/* Keep the 'Uncategorized' product category (term 15) out of the sitemap. */
add_filter( 'wpseo_exclude_from_sitemap_by_term_ids', function ( $ids ) {
	return array_merge( (array) $ids, array( 15 ) );
} );

/*
 * Priority page titles and meta descriptions (SEO plan P1, 24 Nov 2026).
 * Chosen from Search Console: pages ranking ~2-30 with high impressions and
 * near-zero CTR. These override Yoast for the listed URLs only, so edit them
 * here, not in the Yoast box. {Y} is replaced with WWDH_DATA_YEAR.
 * Claims are limited to what the site offers: company names, emails,
 * phone/mobile numbers, and a free sample (Request sample form).
 */
function wwdh_priority_meta_map() {
	return array(
		'/product/russia-companies-database/' => array(
			'Russia Companies Database {Y} – Company Emails & Phones',
			'Russia companies database with company names, business emails and phone numbers for B2B marketing. Updated {Y}. Request a free sample before you buy.',
		),
		'/product/russia-business-email-database/' => array(
			'Russia Business Email List {Y} – B2B Email Database',
			'Russia business email list for B2B outreach: company names, business email addresses and phone numbers. Updated {Y}. Request a free sample list.',
		),
		'/product/iraq-companies-database/' => array(
			'Iraq Companies Database {Y} – Business Emails & Phones',
			'Iraq business database with company names, email addresses and mobile numbers for B2B marketing. Updated {Y}. Request a free sample of the Iraq list.',
		),
		'/product/afghanistan-companies-database/' => array(
			'Afghanistan Companies Database {Y} – Phone & Email List',
			'Afghanistan company database with business phone numbers, mobile numbers, emails and company names. Updated {Y}. Request a free sample list.',
		),
		'/product/qatar-mobile-numbers-database/' => array(
			'Qatar Mobile Number List {Y} – Business Phone Database',
			'Qatar mobile number list with business contacts, company names and emails for SMS and telemarketing campaigns. Updated {Y}. Request a free sample first.',
		),
		'/product/saudi-arabia-companies-database/' => array(
			'Saudi Arabia Companies Database {Y} – Mobile & Email List',
			'Saudi Arabia business database with company names, mobile numbers and email addresses. Updated {Y}. Request a free sample of the Saudi mobile number list.',
		),
		'/whatsapp-mobile-number-database-free-download/' => array(
			'WhatsApp Mobile Number Database – Free Sample Download',
			'Download a free sample of our WhatsApp mobile number database, then order the full list for your marketing campaigns. Updated {Y}.',
		),
		'/product/germany-company-database/' => array(
			'Germany Business Email List {Y} – Company Database',
			'Germany business email list with company names, emails and phone numbers for B2B marketing. Updated {Y}. Request a free sample of the German database.',
		),
		'/product/netherlands-companies-database/' => array(
			'Netherlands Business Email List {Y} – Company Database',
			'Netherlands business email list with Dutch company names, emails and phone numbers for B2B campaigns. Updated {Y}. Request a free sample before you buy.',
		),
		'/product/france-companies-database/' => array(
			'France Business Email List {Y} – Company Database',
			'France business email list with French company names, email addresses and phone numbers for B2B marketing. Updated {Y}. Request a free sample list.',
		),
		'/product/yemen-company-database/' => array(
			'Yemen Company Database {Y} – Business Phone & Email List',
			'Yemen company database with business names, phone numbers, mobile numbers and emails. Updated {Y}. Request a free sample of the Yemen business list.',
		),
		'/product/pakistan-companies-database/' => array(
			'Pakistan Companies Database {Y} – Mobile & Email List',
			'Pakistan companies database with company names, mobile numbers and business emails for B2B marketing. Updated {Y}. Request a free sample before you buy.',
		),
		'/product/forex-trading-database/' => array(
			'Forex Traders Email List {Y} – Forex Trading Database',
			'Forex traders email list for brokers and trading platforms: trader contacts with emails and phone numbers. Updated {Y}. Request a free sample list.',
		),
		'/product/mortgage-brokers-database/' => array(
			'Mortgage Brokers Email Database {Y} – Broker Contact List',
			'Mortgage brokers email database with broker contacts, emails and phone numbers for B2B outreach. Updated {Y}. Request a free sample before you buy.',
		),
		'/product/united-arab-consumer-email-database/' => array(
			'UAE Consumer Email List {Y} – Consumer Email Database',
			'UAE consumer email list for marketing campaigns in Dubai, Abu Dhabi and across the Emirates. Updated {Y}. Request a free sample of the UAE email database.',
		),
	);
}

function wwdh_priority_meta( $index ) {
	if ( is_admin() || ! ( is_singular() || is_front_page() ) ) {
		return null;
	}
	$path = wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/', PHP_URL_PATH ); // phpcs:ignore
	$path = trailingslashit( strtolower( (string) $path ) );
	$map  = wwdh_priority_meta_map();
	if ( ! isset( $map[ $path ][ $index ] ) ) {
		return null;
	}
	return str_replace( '{Y}', WWDH_DATA_YEAR, $map[ $path ][ $index ] );
}

foreach ( array( 'wpseo_title', 'wpseo_opengraph_title', 'wpseo_twitter_title' ) as $wwdh_hook ) {
	add_filter( $wwdh_hook, function ( $value ) {
		$v = wwdh_priority_meta( 0 );
		return null === $v ? $value : $v;
	}, 20 );
}
foreach ( array( 'wpseo_metadesc', 'wpseo_opengraph_desc', 'wpseo_twitter_description' ) as $wwdh_hook ) {
	add_filter( $wwdh_hook, function ( $value ) {
		$v = wwdh_priority_meta( 1 );
		return null === $v ? $value : $v;
	}, 20 );
}
unset( $wwdh_hook );

/* Product structured data: add brand (WooCommerce core outputs the rest). */
add_filter( 'woocommerce_structured_data_product', function ( $markup ) {
	if ( is_array( $markup ) && empty( $markup['brand'] ) ) {
		$markup['brand'] = array(
			'@type' => 'Brand',
			'name'  => 'WorldWide DataHub',
		);
	}
	return $markup;
} );

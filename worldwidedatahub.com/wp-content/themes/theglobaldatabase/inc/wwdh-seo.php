<?php
/**
 * WWDH SEO rules: noindex thin archives, keep them out of the sitemap,
 * and 301-redirect consolidated URLs. Every entry is logged in the
 * project change log with its reason.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Pages that must not be indexed (payment helpers, thank-you pages). */
function wwdh_noindex_page_ids() {
	return array( 2692, 2693, 2694, 1807, 3149 );
}

function wwdh_should_noindex() {
	if ( is_tag() || is_tax( 'product_tag' ) || is_author() || is_search() || is_date() ) {
		return true;
	}
	if ( is_category( 'uncategorized' ) ) {
		return true;
	}
	if ( is_page( wwdh_noindex_page_ids() ) ) {
		return true;
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
	echo '<style>.wwdh-gps{display:inline-flex;align-items:center;gap:10px;background:#1a73e8;color:#fff!important;font:600 14px/1.3 Muli,Arial,sans-serif;padding:9px 16px 9px 9px;border-radius:6px;text-decoration:none!important;box-shadow:0 1px 3px rgba(0,0,0,.25);transition:background .15s}.wwdh-gps:hover,.wwdh-gps:focus{background:#1765cc;color:#fff!important}.wwdh-gps-icon{background:#fff;border-radius:4px;width:26px;height:26px;display:inline-flex;align-items:center;justify-content:center;flex:0 0 26px}.wwdh-gps-wrap{margin-top:18px}.wwdh-gps-post{margin:32px 0 8px;padding:18px;border:1px solid #dadce0;border-radius:8px;background:#f8f9fa}.wwdh-gps-post p{margin:0 0 12px;color:#3c4043}</style>' . "\n";
} );

/* End of every blog post. */
add_filter( 'the_content', function ( $content ) {
	if ( is_singular( 'post' ) && in_the_loop() && is_main_query() ) {
		$content .= '<div class="wwdh-gps-post"><p>Found this useful? Add WorldWide DataHub as a preferred source on Google to see more of our guides in your search results.</p>'
			. wwdh_preferred_source_badge() . '</div>';
	}
	return $content;
}, 99 );

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

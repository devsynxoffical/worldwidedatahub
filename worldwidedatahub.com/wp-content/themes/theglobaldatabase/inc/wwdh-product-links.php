<?php
/**
 * Product page internal links (SEO plan section 7).
 *
 * 1. Visible breadcrumb above the product title: Home > Category > Product.
 *    Links only; Yoast already outputs BreadcrumbList structured data, so no
 *    second breadcrumb schema is added here.
 * 2. "More {Country} databases" block under the FAQ / description: links to
 *    the other live products for the same country and to the country hub
 *    page where one exists. URLs in the 301 redirect map are skipped, so the
 *    block never links to a merged duplicate.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Country hub pages (targets of the Week 1 consolidation redirects). */
function wwdh_country_hubs() {
	return array(
		'usa'           => '/usa-email-list/',
		'united states' => '/usa-email-list/',
		'canada'        => '/canada-email-list/',
		'france'        => '/france-email-list/',
		'germany'       => '/germany-email-list/',
		'netherlands'   => '/netherlands-email-list/',
		'saudi arabia'  => '/saudi-arabia-email-list/',
		'singapore'     => '/singapore-email-list/',
		'uae'           => '/uae-email-list/',
		'united arab'   => '/uae-email-list/',
	);
}

/* "Germany Company Database: ..." -> "Germany"; "Forex Trading Database" -> '' (not a country). */
function wwdh_product_country( $title ) {
	$title = trim( wp_strip_all_tags( (string) $title ) );
	if ( ! preg_match( '/^(.+?)\s+(?:Companies|Company|Business|Consumers?|Mobile|Email|E-mail|Trademark|Database|Cellphone|Phone|Fax|Whois|B2B|Directory)\b/iu', $title, $m ) ) {
		return '';
	}
	$country = trim( $m[1] );
	$words   = preg_split( '/\s+/', $country );
	$generic = array( 'forex', 'trading', 'mortgage', 'brokers', 'doctors', 'church', 'iphone', 'loan', 'stock', 'boat', 'facebook', 'comic', 'dentist', 'refinance', 'cellphone' );
	if ( count( $words ) > 4 || in_array( strtolower( $words[0] ), $generic, true ) ) {
		return '';
	}
	return $country;
}

function wwdh_redirected_paths() {
	return function_exists( 'wwdh_redirect_map' ) ? array_keys( wwdh_redirect_map() ) : array();
}

/* Other published products whose title starts with the same country. Cached 12h. */
function wwdh_same_country_products( $country, $exclude_id ) {
	global $wpdb;
	$key = 'wwdh_cty_' . md5( strtolower( $country ) . WWDH_CACHE_VER );
	$ids = get_transient( $key );
	if ( false === $ids ) {
		$like = $wpdb->esc_like( $country ) . ' %';
		$ids  = $wpdb->get_col( $wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status = 'publish' AND post_title LIKE %s ORDER BY menu_order ASC, post_title ASC LIMIT 20",
			$like
		) );
		set_transient( $key, $ids, 12 * HOUR_IN_SECONDS );
	}
	$skip = wwdh_redirected_paths();
	$out  = array();
	foreach ( (array) $ids as $id ) {
		$id = (int) $id;
		if ( $id === (int) $exclude_id ) {
			continue;
		}
		$url  = get_permalink( $id );
		$path = trailingslashit( strtolower( (string) wp_parse_url( $url, PHP_URL_PATH ) ) );
		if ( in_array( $path, $skip, true ) ) {
			continue;
		}
		$out[] = array( 'url' => $url, 'title' => get_the_title( $id ) );
		if ( count( $out ) >= 8 ) {
			break;
		}
	}
	return $out;
}

/* Deepest product category, skipping Uncategorized. Prefers Yoast primary category. */
function wwdh_product_primary_cat( $product_id ) {
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		$primary = ( new WPSEO_Primary_Term( 'product_cat', $product_id ) )->get_primary_term();
		if ( $primary ) {
			$term = get_term( (int) $primary, 'product_cat' );
			if ( $term && ! is_wp_error( $term ) && 'uncategorized' !== $term->slug ) {
				return $term;
			}
		}
	}
	$terms = get_the_terms( $product_id, 'product_cat' );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return null;
	}
	$best = null;
	$best_depth = -1;
	foreach ( $terms as $t ) {
		if ( 'uncategorized' === $t->slug ) {
			continue;
		}
		$depth = count( get_ancestors( $t->term_id, 'product_cat' ) );
		if ( $depth > $best_depth ) {
			$best = $t;
			$best_depth = $depth;
		}
	}
	return $best;
}

/* 1. Visible breadcrumb */
add_action( 'woocommerce_single_product_summary', function () {
	global $product;
	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	$crumbs = array( array( home_url( '/' ), 'Home' ) );
	$cat    = wwdh_product_primary_cat( $product->get_id() );
	if ( $cat ) {
		foreach ( array_reverse( get_ancestors( $cat->term_id, 'product_cat' ) ) as $anc_id ) {
			$anc = get_term( $anc_id, 'product_cat' );
			if ( $anc && ! is_wp_error( $anc ) ) {
				$crumbs[] = array( get_term_link( $anc ), $anc->name );
			}
		}
		$crumbs[] = array( get_term_link( $cat ), $cat->name );
	}
	echo '<nav class="wwdh-crumbs" aria-label="Breadcrumb"><ol>';
	foreach ( $crumbs as $c ) {
		if ( is_wp_error( $c[0] ) ) {
			continue;
		}
		echo '<li><a href="' . esc_url( $c[0] ) . '">' . esc_html( $c[1] ) . '</a></li>';
	}
	echo '<li aria-current="page">' . esc_html( wp_strip_all_tags( $product->get_name() ) ) . '</li></ol></nav>';
}, 1 );

/* 2. More {Country} databases */
add_action( 'woocommerce_after_single_product_summary', function () {
	global $product;
	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	$country = wwdh_product_country( $product->get_name() );
	if ( '' === $country ) {
		return;
	}
	$items = wwdh_same_country_products( $country, $product->get_id() );
	$hub   = '';
	foreach ( wwdh_country_hubs() as $needle => $path ) {
		if ( 0 === stripos( $country, $needle ) ) {
			$hub = home_url( $path );
			break;
		}
	}
	if ( empty( $items ) && '' === $hub ) {
		return;
	}
	$label = preg_match( '/^united arab/i', $country ) ? 'UAE' : $country;
	echo '<section class="wwdh-more"><h2>More ' . esc_html( $label ) . ' databases</h2>';
	if ( $items ) {
		echo '<ul>';
		foreach ( $items as $it ) {
			echo '<li><a href="' . esc_url( $it['url'] ) . '">' . esc_html( wp_strip_all_tags( $it['title'] ) ) . '</a></li>';
		}
		echo '</ul>';
	}
	if ( $hub ) {
		echo '<p class="wwdh-more-hub"><a href="' . esc_url( $hub ) . '">See all ' . esc_html( $label ) . ' email lists and business databases &rarr;</a></p>';
	}
	echo '</section>';
}, 13 );

add_action( 'wp_head', function () {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}
	echo '<style>.wwdh-crumbs{margin:0 0 10px;font-size:13px}'
		. '.wwdh-crumbs ol{list-style:none;margin:0;padding:0;display:flex;flex-wrap:wrap;gap:4px}'
		. '.wwdh-crumbs li{color:#666}.wwdh-crumbs li+li:before{content:"\203A";margin:0 6px 0 2px;color:#999}'
		. '.wwdh-crumbs a{color:#fc6543;text-decoration:none}.wwdh-crumbs a:hover{text-decoration:underline}'
		. '.wwdh-more{max-width:900px;margin:8px auto 32px;padding:0 15px}'
		. '.wwdh-more h2{font-size:22px;margin:0 0 12px;color:#0b1a3a}'
		. '.wwdh-more ul{list-style:none;margin:0;padding:0;display:grid;grid-template-columns:1fr;gap:8px}'
		. '.wwdh-more li a{display:block;padding:10px 14px;border:1px solid #e5e7eb;border-radius:8px;color:#0b1a3a;text-decoration:none;background:#fff}'
		. '.wwdh-more li a:hover{border-color:#fc6543;color:#fc6543}'
		. '.wwdh-more-hub{margin:12px 0 0}.wwdh-more-hub a{color:#fc6543;font-weight:600}'
		. '@media(min-width:768px){.wwdh-more ul{grid-template-columns:1fr 1fr}}</style>' . "\n";
}, 99 );

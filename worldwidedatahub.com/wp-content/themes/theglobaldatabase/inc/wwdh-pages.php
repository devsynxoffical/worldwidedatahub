<?php
/**
 * Homepage and product category page SEO (SEO plan section 5, Day 3).
 *
 * - Homepage: title + meta description, and an FAQ section with FAQPage
 *   schema (rendered by wwdh_home_faq() from home-new-template.php).
 * - Main product categories and their regional sub-categories: title, meta
 *   description and a short intro above the product grid. The intro only
 *   shows when the category has no description of its own in wp-admin, so
 *   anything the owner writes there always wins.
 *
 * Copy states only what the site offers: country-wise business, consumer,
 * Whois and special databases; the field list; free sample; instant email
 * delivery. No record counts, accuracy or update-date claims.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---------- Homepage ---------- */

function wwdh_home_meta() {
	return array(
		'B2B Email Lists & Business Databases | WorldWide DataHub',
		'Country-wise B2B email lists, company databases, consumer email lists and mobile number databases. Instant download after payment. Request a free sample.',
	);
}

function wwdh_home_faq_items() {
	$fields = function_exists( 'wwdh_data_fields' ) ? implode( ', ', wwdh_data_fields() ) : 'business name, email and phone number';
	$sample = esc_url( site_url( 'contact-us' ) );
	return array(
		array(
			'What is a B2B email list?',
			'A B2B email list is a database of business contacts, such as company names, business email addresses and phone numbers, that companies use for sales prospecting and marketing to other businesses.',
		),
		array(
			'Which countries do your databases cover?',
			'We offer country-wise business and company databases, consumer email lists and Whois data for countries across Europe, Asia, the Middle East, Africa, North and South America and Oceania. Browse the categories below or search for a country.',
		),
		array(
			'What information is included in a database?',
			'Records include the following fields where available: ' . esc_html( $fields ) . '. Each product page shows the record count for that database.',
		),
		array(
			'Can I get a free sample before buying?',
			'Yes. Click <strong>Request sample</strong> on any product page or use our <a href="' . $sample . '">contact form</a>, and we will send you sample records so you can check the data first.',
		),
		array(
			'How is the data delivered?',
			'Delivery is instant. After your card payment is confirmed you receive a download link for the file by email.',
		),
		array(
			'Can I use these lists for email marketing?',
			'Yes, for lawful marketing. You are responsible for following the rules where you send messages, such as GDPR and PECR in Europe and the UK or CAN-SPAM in the US: identify yourself and include an easy opt-out in every message.',
		),
	);
}

/* Called from home-new-template.php, just above the footer section. */
function wwdh_home_faq() {
	$items = wwdh_home_faq_items();
	echo '<section class="wwdh-home-faq bg-grey"><div class="container"><h2 class="text-center">Frequently asked questions</h2>';
	foreach ( $items as $i => $qa ) {
		echo '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . esc_html( $qa[0] ) . '</summary><div class="wwdh-faq-a">' . wp_kses_post( $qa[1] ) . '</div></details>';
	}
	echo '</div></section>';
	$schema = array( '@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array() );
	foreach ( $items as $qa ) {
		$schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $qa[0],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $qa[1] ) ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}

/* ---------- Product categories ---------- */

/*
 * slug => [title, meta description, intro HTML]. Sub-categories of
 * global-business-data / global-consumer-data use the regional template below.
 */
function wwdh_category_copy() {
	return array(
		'global-business-data'  => array(
			'Business Email Lists & Company Databases by Country',
			'Country-wise business email lists and company databases with company names, emails, phone numbers and addresses. Instant download. Request a free sample.',
			'<p>Find a business email list or company database for the country you sell to. Each database lists companies with contact details such as business name, email address, phone number, address and website, so your sales and marketing team can start outreach straight away.</p>'
			. '<p>Choose a region below, then open a country to see its record count and price. Every database can be checked with a free sample before you buy, and the file is delivered instantly by email after payment. Popular countries: <a href="' . esc_url( home_url( '/usa-email-list/' ) ) . '">USA</a>, <a href="' . esc_url( home_url( '/germany-email-list/' ) ) . '">Germany</a>, <a href="' . esc_url( home_url( '/france-email-list/' ) ) . '">France</a>, <a href="' . esc_url( home_url( '/uae-email-list/' ) ) . '">UAE</a>, <a href="' . esc_url( home_url( '/saudi-arabia-email-list/' ) ) . '">Saudi Arabia</a>.</p>',
		),
		'global-consumer-data'  => array(
			'Consumer Email Lists by Country | WorldWide DataHub',
			'Country-wise consumer email lists for B2C marketing campaigns. Instant download after payment. Request a free sample before you buy.',
			'<p>Our consumer email lists are organised by country and region for B2C campaigns. Open a country to see the record count and price, and request a free sample to check the data before you buy.</p>'
			. '<p><strong>Use consumer data lawfully.</strong> Rules for marketing to individuals are stricter than for businesses. In the EU and UK (GDPR and PECR) you generally need consent before emailing consumers; in the US, CAN-SPAM requires clear sender details and an opt-out. Check the rules for each country you target.</p>',
		),
		'special-database'      => array(
			'Special Databases: Industry & Niche Contact Lists',
			'Industry and niche contact databases such as forex traders, mortgage brokers, doctors and investors. Instant download. Request a free sample.',
			'<p>Special databases are contact lists built around an industry, profession or interest rather than a single country, for example forex traders, mortgage brokers, doctors, stock investors and boat owners. Open a database to see its fields, record count and price.</p>'
			. '<p>Every list can be checked with a free sample before you buy, and the file is delivered instantly by email after payment.</p>',
		),
		'whois-database'        => array(
			'Whois Database by Country | Domain Registration Data',
			'Country-wise Whois databases of registered domains and their public registration details. Instant download after payment. Request a free sample.',
			'<p>Whois databases list registered domain names by country together with the public registration details published for them. They are used for market research, lead generation and finding new websites in a market.</p>'
			. '<p>Open a country to see what is included and the price, and request a free sample before you buy. Use Whois contact data in line with the privacy rules of the country concerned.</p>',
		),
	);
}

function wwdh_regional_copy( $term ) {
	if ( ! $term || empty( $term->parent ) ) {
		return null;
	}
	$parent = get_term( (int) $term->parent, 'product_cat' );
	if ( ! $parent || is_wp_error( $parent ) ) {
		return null;
	}
	$region = trim( preg_replace( '/\s*(Business|Consumer)\s*Data\s*$/i', '', $term->name ) );
	if ( 'global-business-data' === $parent->slug ) {
		return array(
			$region . ' Business Email Lists & Company Databases',
			$region . ' business email lists and company databases by country, with company names, emails and phone numbers. Instant download. Free sample.',
			'<p>Business email lists and company databases for countries in ' . esc_html( $region ) . '. Open a country to see the record count, fields and price, and request a free sample before you buy. Files are delivered instantly by email after payment.</p>'
			. '<p>Looking for another region? See all <a href="' . esc_url( get_term_link( $parent ) ) . '">business databases by country</a>.</p>',
		);
	}
	if ( 'global-consumer-data' === $parent->slug ) {
		return array(
			$region . ' Consumer Email Lists by Country',
			$region . ' consumer email lists by country for B2C campaigns. Instant download after payment. Request a free sample before you buy.',
			'<p>Consumer email lists for countries in ' . esc_html( $region ) . '. Open a country to see the record count and price, and request a free sample first. Follow the consumer marketing rules of each country you target.</p>'
			. '<p>See all <a href="' . esc_url( get_term_link( $parent ) ) . '">consumer email lists by country</a>.</p>',
		);
	}
	return null;
}

function wwdh_current_category_copy() {
	if ( ! function_exists( 'is_product_category' ) || ! is_product_category() ) {
		return null;
	}
	$term = get_queried_object();
	if ( ! $term || empty( $term->slug ) ) {
		return null;
	}
	$copy = wwdh_category_copy();
	if ( isset( $copy[ $term->slug ] ) ) {
		return $copy[ $term->slug ];
	}
	return wwdh_regional_copy( $term );
}

/* Titles and descriptions (homepage + categories). Priority 20 = after Yoast defaults. */
foreach ( array( 'wpseo_title', 'wpseo_opengraph_title', 'wpseo_twitter_title' ) as $wwdh_hook ) {
	add_filter( $wwdh_hook, function ( $value ) {
		if ( is_front_page() ) {
			return wwdh_home_meta()[0];
		}
		$c = wwdh_current_category_copy();
		return ( $c && ! is_paged() ) ? $c[0] : $value;
	}, 20 );
}
foreach ( array( 'wpseo_metadesc', 'wpseo_opengraph_desc', 'wpseo_twitter_description' ) as $wwdh_hook ) {
	add_filter( $wwdh_hook, function ( $value ) {
		if ( is_front_page() ) {
			return wwdh_home_meta()[1];
		}
		$c = wwdh_current_category_copy();
		return ( $c && ! is_paged() ) ? $c[1] : $value;
	}, 20 );
}
unset( $wwdh_hook );

/* Intro above the product grid (page 1 only, and only if wp-admin has no description). */
add_action( 'woocommerce_archive_description', function () {
	if ( is_paged() ) {
		return;
	}
	$c = wwdh_current_category_copy();
	if ( ! $c ) {
		return;
	}
	$term = get_queried_object();
	if ( '' !== trim( wp_strip_all_tags( (string) term_description( $term->term_id, 'product_cat' ) ) ) ) {
		return;
	}
	echo '<div class="wwdh-cat-intro">' . wp_kses_post( $c[2] ) . '</div>';
}, 20 );

add_action( 'wp_head', function () {
	$is_cat = function_exists( 'is_product_category' ) && is_product_category();
	if ( ! is_front_page() && ! $is_cat ) {
		return;
	}
	echo '<style>'
		. '.wwdh-cat-intro{max-width:900px;margin:0 auto;color:#444;line-height:1.7;font-size:15px}'
		. '.wwdh-cat-intro p{margin:0 0 12px}.wwdh-cat-intro a{color:#fc6543;font-weight:600}'
		. '.wwdh-home-faq{padding:40px 0 30px}.wwdh-home-faq .container{max-width:900px}'
		. '.wwdh-home-faq h2{font-size:26px;margin:0 0 18px;color:#0b1a3a}'
		. '.wwdh-home-faq details{border:1px solid #e5e7eb;border-radius:8px;margin:0 0 10px;background:#fff}'
		. '.wwdh-home-faq summary{cursor:pointer;padding:14px 44px 14px 16px;font-weight:600;color:#0b1a3a;list-style:none;position:relative}'
		. '.wwdh-home-faq summary::-webkit-details-marker{display:none}'
		. '.wwdh-home-faq summary:after{content:"+";position:absolute;right:16px;top:50%;transform:translateY(-50%);font-size:20px;color:#fc6543}'
		. '.wwdh-home-faq details[open] summary:after{content:"\2212"}'
		. '.wwdh-home-faq .wwdh-faq-a{padding:0 16px 14px;color:#444;line-height:1.6}.wwdh-home-faq .wwdh-faq-a a{color:#fc6543}'
		. '</style>' . "\n";
}, 99 );

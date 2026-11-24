<?php
/**
 * Product FAQ block + FAQPage structured data (SEO plan, Month 1).
 *
 * Shown under the product description on the priority product pages only
 * (wwdh_faq_product_paths), so the same text is not repeated on ~1,000
 * products. Every answer uses facts the site already states or real product
 * data: the field list, the free sample, instant download by email, and the
 * live WooCommerce price. No record counts, accuracy figures or update dates
 * are claimed here until the owner confirms them.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Priority product pages (keep in sync with docs/keyword-map.csv tier 1). */
function wwdh_faq_product_paths() {
	return array(
		'/product/russia-companies-database/',
		'/product/russia-business-email-database/',
		'/product/iraq-companies-database/',
		'/product/afghanistan-companies-database/',
		'/product/qatar-mobile-numbers-database/',
		'/product/saudi-arabia-companies-database/',
		'/product/germany-company-database/',
		'/product/netherlands-companies-database/',
		'/product/france-companies-database/',
		'/product/yemen-company-database/',
		'/product/pakistan-companies-database/',
		'/product/forex-trading-database/',
		'/product/mortgage-brokers-database/',
		'/product/united-arab-consumer-email-database/',
	);
}

function wwdh_faq_applies( $product ) {
	if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
		return false;
	}
	$path = trailingslashit( strtolower( (string) wp_parse_url( get_permalink( $product->get_id() ), PHP_URL_PATH ) ) );
	return in_array( $path, wwdh_faq_product_paths(), true );
}

/* "Bermuda Companies Database: Mobile Numbers & Email List" -> "Bermuda Companies Database" */
function wwdh_faq_short_name( $product ) {
	$name = wp_strip_all_tags( $product->get_name() );
	$name = trim( preg_replace( '/\s*[:\-–|(].*$/u', '', $name ) );
	return '' !== $name ? $name : wp_strip_all_tags( $product->get_name() );
}

/* Returns array of [question, answer_html]. */
function wwdh_faq_items( $product ) {
	$short  = wwdh_faq_short_name( $product );
	$fields = function_exists( 'wwdh_data_fields' ) ? wwdh_data_fields() : array( 'Business Name', 'Email ID', 'Phone No.' );
	$sample = esc_url( site_url( 'contact-us' ) );

	$items   = array();
	$items[] = array(
		'What information is included in the ' . $short . '?',
		'Each record includes the following fields where available: ' . esc_html( implode( ', ', $fields ) ) . '.',
	);
	$items[] = array(
		'Can I get a free sample of the ' . $short . ' before buying?',
		'Yes. Click <strong>Request sample</strong> on this page or use our <a href="' . $sample . '">contact form</a>, and we will send you sample records so you can check the data before you buy.',
	);
	$items[] = array(
		'How will I receive the ' . $short . ' after payment?',
		'Delivery is instant. After your payment is confirmed you receive a download link for the file by email.',
	);

	$price = (float) $product->get_price();
	if ( $price > 0 && function_exists( 'get_woocommerce_currency' ) ) {
		$items[] = array(
			'How much does the ' . $short . ' cost?',
			'The ' . esc_html( $short ) . ' costs ' . esc_html( html_entity_decode( get_woocommerce_currency_symbol(), ENT_QUOTES, 'UTF-8' ) . number_format( $price, 2 ) ) . ' (' . esc_html( get_woocommerce_currency() ) . ') as a one-time purchase. Add it to your cart and pay securely by card at checkout.',
		);
	}

	$items[] = array(
		'Can I use this data for email and SMS marketing?',
		'Yes, for lawful business-to-business marketing. You are responsible for following the rules that apply where you send messages, such as GDPR and PECR in Europe and the UK or CAN-SPAM in the US. Identify yourself clearly and include an easy opt-out in every message.',
	);
	return $items;
}

add_action( 'woocommerce_after_single_product_summary', function () {
	global $product;
	if ( ! wwdh_faq_applies( $product ) ) {
		return;
	}
	$items = wwdh_faq_items( $product );

	echo '<section class="wwdh-faq" aria-labelledby="wwdh-faq-title"><h2 id="wwdh-faq-title">Frequently asked questions</h2>';
	foreach ( $items as $i => $qa ) {
		echo '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . esc_html( $qa[0] ) . '</summary><div class="wwdh-faq-a">' . wp_kses_post( $qa[1] ) . '</div></details>';
	}
	echo '</section>';

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => array(),
	);
	foreach ( $items as $qa ) {
		$schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $qa[0],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $qa[1] ),
			),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
}, 12 );

add_action( 'wp_head', function () {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}
	echo '<style>.wwdh-faq{max-width:900px;margin:32px auto 24px;padding:0 15px}'
		. '.wwdh-faq h2{font-size:24px;margin:0 0 14px;color:#0b1a3a}'
		. '.wwdh-faq details{border:1px solid #e5e7eb;border-radius:8px;margin:0 0 10px;background:#fff}'
		. '.wwdh-faq summary{cursor:pointer;padding:14px 44px 14px 16px;font-weight:600;color:#0b1a3a;list-style:none;position:relative}'
		. '.wwdh-faq summary::-webkit-details-marker{display:none}'
		. '.wwdh-faq summary:after{content:"+";position:absolute;right:16px;top:50%;transform:translateY(-50%);font-size:20px;color:#fc6543}'
		. '.wwdh-faq details[open] summary:after{content:"\2212"}'
		. '.wwdh-faq-a{padding:0 16px 14px;color:#444;line-height:1.6}'
		. '.wwdh-faq-a a{color:#fc6543}</style>' . "\n";
}, 99 );

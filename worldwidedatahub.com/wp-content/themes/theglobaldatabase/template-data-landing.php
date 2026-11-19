<?php
/**
 * Template Name: Data Landing Page
 * Template Post Type: page
 *
 * Full-width SEO landing page. Sections are written in the page content
 * using lp-* classes (see css/landing.css). FAQ items written as
 * <details class="lp-faq-item"><summary>Q</summary><div class="lp-faq-a">A</div></details>
 * are output as FAQPage structured data automatically.
 *
 * @package theglobaldatabase
 */

get_header();

while ( have_posts() ) :
	the_post();
	// Section HTML is hand-built; stop wpautop from inserting <p>/<br> into it.
	$wwdh_autop = has_filter( 'the_content', 'wpautop' );
	if ( $wwdh_autop ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	$wwdh_content = apply_filters( 'the_content', get_the_content() );
	if ( $wwdh_autop ) {
		add_filter( 'the_content', 'wpautop', $wwdh_autop );
	}
	?>
	<main id="primary" class="site-main lp-page">
		<?php echo $wwdh_content; // phpcs:ignore WordPress.Security.EscapeOutput -- post content filtered by the_content. ?>
	</main>
	<?php
	// FAQPage schema from the FAQ section.
	if ( preg_match_all( '#<details[^>]*class="[^"]*lp-faq-item[^"]*"[^>]*>\s*<summary[^>]*>(.*?)</summary>\s*<div[^>]*class="[^"]*lp-faq-a[^"]*"[^>]*>(.*?)</div>\s*</details>#s', $wwdh_content, $m, PREG_SET_ORDER ) ) {
		$faq = array();
		foreach ( $m as $row ) {
			$faq[] = array(
				'@type'          => 'Question',
				'name'           => trim( wp_strip_all_tags( $row[1] ) ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => trim( wp_strip_all_tags( $row[2] ) ),
				),
			);
		}
		echo '<script type="application/ld+json">' . wp_json_encode( array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $faq,
		), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
	}
endwhile;

get_footer();

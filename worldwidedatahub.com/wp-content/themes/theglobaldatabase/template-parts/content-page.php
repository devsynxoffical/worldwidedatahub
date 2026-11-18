<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theglobaldatabase
 */

?>






<section class="block-padd">
	<div class="container">
		


	<?php theglobaldatabase_post_thumbnail(); ?>

	<!-- <div class=""> -->
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theglobaldatabase' ),
				'after'  => '</div>',
			)
		);
		?>
	<!-- </div> -->
	<!-- .entry-content -->



	</div>
</section>
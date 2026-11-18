<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package theglobaldatabase
 */

get_header();
?>
 <section class="page-not-found-wraper bg-grey">
    <div class="container">
      <div class="row">

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'theglobaldatabase' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'theglobaldatabase' ); ?></p>	
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div>
</div>
</section>
<?php
get_footer();

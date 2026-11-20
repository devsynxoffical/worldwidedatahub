<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theglobaldatabase
 */

get_header();
?>
<div class="banner-with-breadcumb" style="background-image:url('<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/inner-banner1.jpeg');">
  <div class="bwb-overlay"></div>
  <div class="container">
    <div class="banner-title">
      <h1> <?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?> </h1>
      <ul>
        <li> <a href="<?php echo esc_url( site_url() ); ?>"> Home </a> </li>
        <li> <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"> Blog </a>  </li>
      </ul>
    </div>    
  </div>
</div>

<div class="blog-sec">
	<div class="container">
 		<div class="row">	
 		<?php if ( have_posts() ) : ?>
 			<?php
 			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
 		?>
 			<div class="col-sm-6 col-xs-12">
				<div class="about-sipport relative">
					<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
				</div>
			</div>
		<?php
			endwhile;
			the_posts_navigation();
			else:
				get_template_part( 'template-parts/content', 'none' );
		 endif; ?>           
		</div> 	 
	</div>
</div>

<?php
get_footer();

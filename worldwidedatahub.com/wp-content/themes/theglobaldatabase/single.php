<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theglobaldatabase
 */

get_header();
?>
<!-- <div class="banner-with-breadcumb" style="background-image:url('<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/inner-banner1.jpeg');"> -->
<div class="banner-with-breadcumb" >
  <div class="bwb-overlay"></div>
  <div class="container">
    <div class="banner-title">
      <h2> Blog </h2>
      <ul>
        <li> <a href="<?php echo site_url(); ?>"> Home </a> </li>
        <li> <a href="#"> Blog </a>  </li>
      </ul>
    </div>    
  </div>
</div>


<div class="container">
<div class="row">
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="inner_main_inner">
	<div id="primary" class="content-area">
		<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'theglobaldatabase' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'theglobaldatabase' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	</div>
	</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="blog-sidebar">
		<?php if ( is_active_sidebar( 'main-sidebar' ) ) { ?>
		   
		        <?php dynamic_sidebar('main-sidebar'); ?>
		   
		<?php } ?>
		</div>
	</div>

</div>
</div>

<?php

get_footer();

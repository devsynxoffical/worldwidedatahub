
<?php
/**
 * Template part for displaying page content in page.php
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
			<?php the_title( '<h1>', '</h1>' ); ?>
			<ul>
				<li> <a href=""> Home </a> </li>
				<li> <a href=""> <?php echo the_title(); ?></a> </li>
			</ul>
		</div>		
	</div>
</div>




<section class="block-padd">
	<div class="container">
		


	<?php theglobaldatabase_post_thumbnail(); ?>

	<!-- <div class=""> -->
		<?php
		the_content(); ?>



	</div>
</section>
<?php

get_footer();
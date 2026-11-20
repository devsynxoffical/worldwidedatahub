<?php
/**
 * Template Name: Blog
 */
get_header(); ?>


<!-- <div class="banner-with-breadcumb" style="background-image:url('<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/inner-banner1.jpeg');"> -->
<div class="banner-with-breadcumb" >
  <div class="bwb-overlay"></div>
  <div class="container">
    <div class="banner-title">
      <h1> Blog </h1>
      <ul>
        <li> <a href="<?php echo site_url(); ?>"> Home </a> </li>
        <li> <a href=""> Blog </a>  </li>
      </ul>
    </div>    
  </div>
</div>

<div class="blog-sec">
	<div class="container">
 		<div class="row">	
 		<?php 
 		$args = array(
 			'post_type' => 'post',
 			'post_per_page' => -1,
 			'post_status' => 'publish',
 			'orderby'=>'id',
 			'order'=>'DESC',
 			'category_name' => 'blog',
 			);
 		$posts = new WP_Query($args);

 		if($posts->have_posts()):
 			while($posts->have_posts()): $posts->the_post();
 		$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
 		?>
 			<div class="col-sm-6 col-xs-12">
				<div class="about-sipport relative">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" class="img-responsive aboutimg"></a>	
					<div class="about-support-info">
						<a href="<?php the_permalink(); ?>"><h2 class="h3"><?php the_title(); ?></h2></a>
						<p class="blog-post-meta">by <span class="author author"><a href="#" title="Posts by" rel="author"><?php echo get_author_name(); ?></a></span> | <span class="published"><?php echo get_the_date(); ?></span> | <a href="<?php echo get_category_link(38); ?>" rel="category tag"><?php echo get_cat_name(38); ?></a> | <?php echo get_comments_number() ?> Comments</p>
						<p class="p16"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 30 ) ); ?></p>
					</div>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_postdata(); ?>	           
		</div> 	 
	</div>
</div>




<?php get_footer(); ?>





<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theglobaldatabase
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				theglobaldatabase_posted_on();
				theglobaldatabase_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	 <?php if ( has_post_thumbnail() ) : ?><img src="<?php the_post_thumbnail_url( is_singular() ? 'full' : 'medium_large' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="100%" <?php echo is_singular() ? '' : 'loading="lazy"'; ?>><?php endif; ?> 

	<div class="entry-content">
		<?php if ( ! is_singular() ) : ?>
		<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 40 ) ); ?></p>
		<p><a class="read-more" href="<?php the_permalink(); ?>">Read more<span class="screen-reader-text"> about <?php the_title(); ?></span> &rarr;</a></p>
		<?php else : ?>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'theglobaldatabase' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theglobaldatabase' ),
				'after'  => '</div>',
			)
		);
		?>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php theglobaldatabase_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

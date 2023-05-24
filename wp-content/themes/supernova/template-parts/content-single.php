<?php
/**
 * Template part for displaying single posts.
 *
 * @package supernova
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sup-single'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php do_action( 'sup_after_title' ); ?>
	</header><!-- .entry-header -->

	<?php sup_create_ad_spot('above_single_post'); ?>

	<div class="entry-content clearfix">
		<?php if( get_theme_mod('sup_featured_image_on_posts', true ) ) sup_thumbnail('large'); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supernova' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php sup_create_ad_spot('below_single_post'); ?>

	<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="entry-footer entry-meta clearfix">
		<?php sup_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-## -->


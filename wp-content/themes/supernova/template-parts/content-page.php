<?php
/**
 * The template used for displaying page content in page.php
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
		<?php sup_thumbnail('large'); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supernova' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'supernova' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->


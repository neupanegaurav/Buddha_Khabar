<?php
/**
 * Template part for displaying posts.
 *
 * @package supernova
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sup-listing'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php sup_thumbnail( 'thumbnail', sprintf( '<figure class="sup-post-thumb" ><a href="%s">' , get_permalink() ) , '</a></figure>' ); ?>
		<div class="sup-post-content">
			<?php sup_content(); ?>
		</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supernova' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( 'post' == get_post_type() ) : ?>
	<footer class="entry-footer entry-meta clearfix">
		<?php sup_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-## -->

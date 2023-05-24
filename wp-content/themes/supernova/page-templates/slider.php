<?php
/**
 * Template Name: Slider
 *
 * Used for showing full width tempalte
 *
 * @package supernova
 */

get_header(); ?>

	<div id="primary" class="<?php sup_primary_classes(); ?>">

		<?php do_action( 'sup_primary_start' ); ?>

		<main id="main" class="sup-site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package supernova
 */

get_header(); ?>

	<div id="primary" class="<?php sup_primary_classes(); ?>">

		<?php do_action( 'sup_primary_start' ); ?>

		<main id="main" class="sup-site-main" role="main">

			<?php do_action( 'sup_main_start' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( ( comments_open() || get_comments_number() ) && get_theme_mod( 'sup_page_comments' , true ) ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package supernova
 */

get_header(); ?>

	<div id="primary" class="<?php sup_primary_classes(); ?>">

		<?php do_action( 'sup_primary_start' ); ?>

		<main id="main" class="sup-site-main" role="main">

		<?php do_action( 'sup_main_start' ); ?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php sup_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

			<?php do_action( 'sup_main_end' ); ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

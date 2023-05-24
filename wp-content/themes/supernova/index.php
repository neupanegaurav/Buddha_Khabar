<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package supernova
 */

get_header(); ?>

	<?php do_action( 'sup_before_primary' );  ?>

	<div id="primary" class="<?php sup_primary_classes(); ?>">

		<?php do_action( 'sup_primary_start' ); //Slider and Tabs are hooked here in inc/hooks.php ?>

		<main id="main" class="sup-site-main clearfix" role="main">

		<?php do_action( 'sup_main_start' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div id="sup-main-posts" class="sup-main-posts sup-ajax-posts">

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

				<footer class='sup-posts-footer sup-ajax-posts-footer sup-pagination-left clearfix'>
					<?php sup_pagination(); ?>
					<?php sup_loadmore_button( 'sup-load-main' ); ?>
				</footer>
			</div> <!-- sup-main-posts -->

			<?php sup_ajax_posts(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

			<?php do_action( 'sup_main_end' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

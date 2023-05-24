<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package supernova
 */

get_header(); ?>

	<div id="primary" class="<?php sup_primary_classes(); ?>">
		<main id="main" class="sup-site-main" role="main">

			<?php do_action( 'sup_main_start' ); ?>

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'supernova' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'supernova' ); ?></p>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

				<?php do_action( 'sup_main_end' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

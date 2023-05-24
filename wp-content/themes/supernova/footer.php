<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package supernova
 */
?>
	</div><!-- #content -->

	<?php do_action( 'sup_before_footer' ); ?>

	<footer id="colophon" class="sup-site-footer" role="contentinfo">
			<?php if ( is_active_sidebar( 'footer-widgets' ) ){ ?>
			<div class="sup-footer-widgets row clearfix">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</div>
			<?php } ?>
			<div class="sup-site-info row clearfix">
				<div class="sup-footer-left large-6 medium-6 small-12 column">
					<?php echo sup_copyright_text(); ?>
					<span class="sep"> | </span>
					<a href="<?php echo esc_url( __( 'http://supernovathemes.com/', 'supernova' ) ); ?>" target="_blank" >Supernova Themes</a>
				</div>
				<div class="sup-footer-right large-6 medium-6 small-12 column">
					<?php sup_social_icons(); ?>
				</div><!-- .sup-site-info -->
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

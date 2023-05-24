<?php
/**
 *  Used for showing the slider
 *  @package supernova
 */

$default_slides = array(
	array(
			'thumbnail_src' => SUPERNOVA_IMG_URI . '/1.jpg',
			'attachment_id' => false,
			'post_id'       => false,
			'title'         => "Hello World",
			'excerpt'       => "This is a demo slider, it will disappear when you set your own slides..."
		),
	array(
			'thumbnail_src' => SUPERNOVA_IMG_URI . '/2.jpg',
			'attachment_id' => false,
			'post_id'       => false,
			'title'         => "Color Schemes",
			'excerpt'       => "You would need to go to your themes customizer setting and start adding slides..."
	),

);
$slides = get_theme_mod( 'sup_slides' , $default_slides );

if( ! empty($slides) && ( is_home() || is_front_page() || is_page_template( 'page-templates/slider.php' ) ) ) : ?>

<div class="sup-slider-wrapper clearfix">
	<div id="sup-slider" class="sup-slider slick-slider clearfix">

		<?php foreach( $slides as $slide ) :
			$link = get_permalink( absint(sup_isset( $slide, 'post_id' )) );
		 ?>
		<div class="sup-slide slick-slide">
			<?php
				if( sup_isset( $slide, 'attachment_id' ) ){
					echo wp_get_attachment_image( absint( $slide['attachment_id'] ), 'full' );
				}
				elseif( sup_isset( $slide, 'thumbnail_src' ) ){
					printf( "<img src='%s' alt='%s'>", esc_url( $slide['thumbnail_src'] ), esc_attr( sup_isset( $slide, 'title' ) ) );
				}
			 ?>

			<?php if( sup_isset( $slide, 'title' ) || sup_isset( $slide, 'excerpt' ) ){ ?>
			<div class="sup-slide-content">
				<?php if( sup_isset( $slide, 'title' ) ) {
					printf( '<h2 class="slide-title" ><a href="%s">%s</a></h2>' , esc_url( $link ), esc_html($slide['title']) );
				} ?>
				<?php if( sup_isset( $slide, 'excerpt' ) ){
					$sidebar_excerpt = sup_trim_characters( wp_strip_all_tags( $slide['excerpt']), 80, '..' );
					printf( '<p class="slide-excerpt" data-sidebar-excerpt="%s"><a href="%s">%s</a></p>', esc_attr( $sidebar_excerpt ), esc_url( $link ) , esc_html( $slide['excerpt'] ) );
				} ?>
			</div>
			<?php } ?>

		</div>
		<?php endforeach; ?>
	</div>
	<div class="sup-cycle-pager clearfix"></div>

	<?php if( count($slides) ) { ?>
	<div class="sup-prev sup-slider-nav"></div>
	<div class="sup-next sup-slider-nav"></div>
	<?php } ?>

	<?php do_action( 'sup_slider_end' ); ?>

</div> <!-- #sup-slider -->

<?php endif; ?>

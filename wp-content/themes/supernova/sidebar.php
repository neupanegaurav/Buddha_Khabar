<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package supernova
 */



if ( get_theme_mod( 'sup_sidebar_position' ) === 'no_sidebar' ) return;

?>

<aside id="secondary" class="<?php sup_sidebar_classes(); ?>" role="complementary">
	<?php if( ! dynamic_sidebar( 'sidebar-widgets' ) ){

		$args = array(
				'before_widget' => '<div class="widget widget-sidebar large-12 medium-6 small-6 column %1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title widget-title-sidebar">',
				'after_title'   => '</h3>'
			);

		the_widget( 'sup_tabber', array(
										'title'        => '' ,
										'number'       => 5,
										'show_thumb'   => 1,
										'comment_date' => 1,
										'tab_one'      => 1,
										'tab_two'      => 2,
										'tab_three'    => 3,
									) , $args );

		the_widget( 'WP_Widget_Pages', false, $args );

		the_widget( 'WP_Widget_Calendar', false , $args );

		the_widget( 'WP_Widget_Recent_Comments', false , $args );


	} ?>
</aside><!-- #secondary -->

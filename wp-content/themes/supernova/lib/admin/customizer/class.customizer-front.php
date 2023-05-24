<?php
/**
 * Handles frontend
 */

class Sup_Customizer_Front
{

	public function __construct()
	{
		add_action( 'wp_head' , array( $this , 'custom_css' ), 200 );
	}

	public static function get_palettes()
	{
		$palettes = apply_filters( 'sup_color_palettes', array(
						'db9f0e' => array( '#db9f0e' ),
						'e64e4b' => array( '#e64e4b' ),
						'348CB3' => array( '#348CB3' ),
						'ba89b6' => array( '#ba89b6' ),
						'9DB102' => array( '#9DB102' ),
						'6B4A30' => array( '#6B4A30' ),
						'7d0e0a' => array( '#7d0e0a' ),
						'FFDC00' => array( '#FFDC00' ),
						'4B4B4D' => array( '#4B4B4D' ),
					));

		return $palettes;
	}

	public static function get_background_selectors()
	{
		$background_selectors = apply_filters( 'sup_background_selectors' , array(
			'.sup-cycle-pager .cycle-pager-active',
			'.sup-mobile-navigation .sup-icon-menu:hover',
			'.sup-mobile-navigation .sup-icon-list-bullet:hover',
			'.widget_categories .cat-item a:hover'
		));

		return $background_selectors;
	}

	public static function get_color_selectors()
	{
		$selectors = apply_filters( 'sup_skin_selectors' , array(
			'a',
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover',
			'.sup-menu-container a',
			'.sup-left-menu li.current_page_ancestor:after',
			'.sup-left-menu .sub-menu a:hover',
			'.sup-left-menu .children a:hover',
			'.sup-main-nav .current_page_item > a',
			'.sup-main-nav .current-menu-item > a',
			'.sup-main-nav .current_page_ancestor > a',
			'.sup-main-nav li:hover > a',
			'.sup-main-nav li:focus > a',
			'.sup-main-nav li:hover:after',
			'.sup-main-nav li.current_page_item:after',
			'.sup-main-nav li.current-menu-item:after',
			'.sup-main-nav li.current_page_ancestor:after',
			'.sup-left-menu .current_page_item > a',
			'.sup-left-menu .current-menu-item > a',
			'.sup-left-menu .current_page_ancestor > a',
			'.sup-left-menu li:hover > a',
			'.sup-left-menu li:focus > a',
			'.sup-left-menu li:hover:after',
			'.sup-left-menu li.current_page_item:after',
			'.sup-left-menu li.current-menu-item:after',
			'.sup-left-menu li.current_page_ancestor:after',
			'.sup-mobile-navigation .sup-icon-menu:hover',
			'.sup-mobile-navigation .sup-icon-list-bullet:hover',
			'.sup-mobile-cat-nav:hover',
			'.sup-mobile-cat-nav:focus',
			'.entry-meta .sup-meta-item:hover',
			'.entry-meta .cat-links a:hover',
			'.sup-tags a:hover',
			'.sup-pagination .current',
			'.sup-breacrumbs-list a',
			'.sup-thumb-link',
			'.widget li a:hover',
			'.widget_calendar #today',
		));

		return $selectors;

	}

	public function create_skin()
	{
		sup_generate_css( $this->get_color_selectors() , 'color', 'sup_theme_skin' , '#' );
		sup_generate_css( $this->get_background_selectors() , 'background', 'sup_theme_skin' , '#' );

		$palettes = self::get_palettes();
 		$selected_palettes = get_theme_mod( 'sup_theme_skin' );

 		if( $selected_palettes && isset( $palettes[$selected_palettes] ) ){
			$slide_bg = SUPERNOVA_IMG_URI . "/skins/slider-{$selected_palettes}.png";
			$menu_bg  = SUPERNOVA_IMG_URI . "/skins/line-{$selected_palettes}.png";
 			echo ".sup-slide-content{background-image : url({$slide_bg})}";
 			echo ".sup-main-nav-row .row-container:after{background-image : url({$menu_bg})}";
 		}

 		//Font Family
 		$sup_font_families =  sup_font_families();
 		$body_font_family = get_theme_mod( 'sup_body_font_family', 0 );
 		$body_font_family = isset( $sup_font_families[$body_font_family] ) ?  $sup_font_families[$body_font_family] : false;

 		echo "body{ font-family : {$body_font_family} }";
	}

	/**
	 * Generates all css
	 * @return css output
	 */
	public function custom_css()
	{
		$custom_css = get_theme_mod( 'sup_custom_css' );

		echo "<!-- Supernova Custom CSS --><style>";
			$this->create_skin();
			echo "/*** Theme Skin Ends ***/";
			echo $custom_css;
		echo "</style>";
	}

}

new Sup_Customizer_Front();

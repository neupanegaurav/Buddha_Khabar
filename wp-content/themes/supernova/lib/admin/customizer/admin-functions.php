<?php

/**
 * Contains Custom functions for Customizer.
 */


/**
 * Retrives an array of all post ids and its title.
 */
if( ! function_exists( 'sup_posts_array' ) )
{
	function sup_posts_array()
	{
		$args = array(
			'posts_per_page' => 90,
			'offset'         => 0,
			'post_type'      => 'post',
			'post_status'    => 'publish'
		);

		$query = new WP_Query( apply_filters( 'sup_customizer_list_posts', $args ) );

		$posts = $query->posts;

		$pages_array = array( 0 => __( '---Select Post---' , 'supernova' ) );

		if( is_array($posts) ){
			foreach ($posts as $post ) {
				$pages_array[$post->ID] = $post->post_title;
			}
		}

		return $pages_array;

	}
}

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 *
 * @uses get_theme_mod()
 * @param string $selector CSS selector
 * @param string/array $property The name of the CSS *property* to modify
 * @param string/array $mod_name The name of the 'theme_mod' option to fetch
 * @param string/array $prefix Optional. Anything that needs to be output before the CSS property
 * @param string/array $postfix Optional. Anything that needs to be output after the CSS property
 * @return string Returns a single line of CSS with selectors and a property.
 * @since supernova 2.0
 */

if( ! function_exists( 'sup_generate_css' ) )
{
	function sup_generate_css( $selector, $property, $mod_name, $prefix = '', $postfix = '', $default = false, $echo = true )
	{
      $return = '';

      $selector = is_array( $selector) ? join( ',' , $selector ) : $selector;

		if( is_array( $property ) && is_array($mod_name) ){
			$return .= $selector . '{';
			foreach ($property as $key => $property ) {
				$mod = is_array( $default ) ? get_theme_mod($mod_name[$key], $default[$key]) : get_theme_mod($mod_name[$key], $default) ;
				$this_prefix  = is_array($prefix)  ? $prefix[$key]  : $prefix;
				$this_postfix = is_array($postfix) ? $postfix[$key] : $postfix;
				$return .= ( isset($mod) && ! empty( $mod ) ) ?
						   sprintf( '%s:%s;', $property , $this_prefix.$mod.$this_postfix ) :
						   false;
			}
			$return .= "}";
		}
		else
		{
			$mod = get_theme_mod($mod_name, $default );
			   $return = ( isset($mod) && ! empty( $mod ) ) ?
			   			  sprintf('%s { %s:%s; }', $selector, $property, $prefix.$mod.$postfix) :
			   			  false;
		}

		if( $echo ){
			echo $return;
		}
  		else{
  			return $return;
  		}
	}
}


if( ! function_exists( 'sup_sanitize_choices' ) )
{
	/**
	 * Used for sanitizing radio or select options in customizer
	 * @param  mixed $input  user input
	 * @param  mixed $setting choices provied to the user.
	 * @return mixed  output after sanitization
	 */
	function sup_sanitize_choices( $input, $setting ) {
	  global $wp_customize;

	  $control = $wp_customize->get_control( $setting->id );

	  if ( array_key_exists( $input, $control->choices ) ) {
	    return $input;
	  } else {
	    return $setting->default;
	  }
	}
}

if( ! function_exists( 'sup_sanitize_checkboxes' ) )
{
	/**
	 * Sanitizes checkbox for customizer
	 * @return int either 1 or 0
	 */
	function sup_sanitize_checkboxes( $input ){
		if ( $input == 1 ) {
		      return 1;
		  } else {
		      return '';
		  }
	}
}

if( ! function_exists( 'sup_allow_all' ) )
{
	function sup_allow_all( $input ){
		return $input;
	}
}

if( ! function_exists( 'sup_get_image_sizes' ) )
{
	function sup_get_image_sizes( $size = '' )
	{
		global $_wp_additional_image_sizes;

       $sizes = array();
       $get_intermediate_image_sizes = get_intermediate_image_sizes();

       // Create the full array with sizes and crop info
       if( $get_intermediate_image_sizes ){
       		foreach( $get_intermediate_image_sizes as $_size ) {

       		        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

       		                $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
       		                $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
       		                $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

       		        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

       		                $sizes[ $_size ] = array(
       		                        'width' => $_wp_additional_image_sizes[ $_size ]['width'],
       		                        'height' => $_wp_additional_image_sizes[ $_size ]['height'],
       		                        'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
       		                );

       		        }

       		}
       }

       // Get only 1 size if found
       if ( $size ) {

               if( isset( $sizes[ $size ] ) ) {
                       return $sizes[ $size ];
               } else {
                       return false;
               }

       }

       return $sizes;
	}
}

if( ! function_exists( 'sup_get_image_size' ) )
{
	function sup_get_image_size()
	{
		$sizes = array( 'thumbnail', 'medium', 'large', 'full' );
		$image_size_array = array();

		foreach ($sizes as $size )
		{
			$sup_image_sizes = sup_get_image_sizes( $size );
			$dimenstions = isset( $sup_image_sizes['width'] ) && isset( $sup_image_sizes['height'] ) ? '(' . $sup_image_sizes['width'] . 'x' . $sup_image_sizes['height'] . ')' : false;
			$image_size_array[$size] = "{$size} {$dimenstions}";
		}

		return $image_size_array;
	}
}



<?php
/**
 *  Contains custom functions used for the theme
 *  @package supernova
 */

if( ! function_exists( 'sup_mod' ) ) {

	function sup_mod( $key , $default = false )
	{
		$sup_mod = get_theme_mod('sup_mod' );

		$saved_value = isset($sup_mod[$key]) ? $sup_mod[$key] : $default;

		if( in_array( $key , $keys_to_be_escaped ) ){
			$saved_value = esc_html( $saved_value ); //As suggested by kevinhaig
		}

		//Rest will be escaped at the point where we output the data.
		return $saved_value;
	}
}

/**
 * Adds Foundation classes to #primary seciton of all templates
 * @return string classes
 */

if( ! function_exists( 'sup_primary_classes' ) )
{
	function sup_primary_classes( $more_classes = false, $override_foundation_classes = false )
	{
		$sidebar_postion = get_theme_mod( 'sup_sidebar_position' );

		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-8 medium-12 small-12 column';

		if( $sidebar_postion === 'left' ){
			$foundation_classes .= 	' sup-right';
		}
		else if( $sidebar_postion === 'no_sidebar' ){
			$foundation_classes = 'large-12 medium-12 small-12 column';
		}

		echo apply_filters( 'sup_primary_classes' , "sup-primary {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes );
	}
}

/**
 * Adds Foundation classes to #primary seciton of all templates
 * @return string classes
 */

if( ! function_exists( 'sup_sidebar_classes' ) )
{
	function sup_sidebar_classes( $more_classes = false, $override_foundation_classes = false )
	{
		//Override will be useful in page-templates
		$sidebar_postion = get_theme_mod( 'sup_sidebar_position' );
		$foundation_classes = $override_foundation_classes ? $override_foundation_classes : 'large-4 medium-12 small-12 column';
		$foundation_classes .= $sidebar_postion == 'left' ? ' sup-left' : false;

		echo apply_filters( 'sup_sidebar_classes' , "sup-secondary widget-area {$foundation_classes} {$more_classes} clearfix" , $more_classes, $foundation_classes );
	}
}

if( ! function_exists( 'sup_header_classes' ) )
{
	function sup_header_classes()
	{
		$logo_title_placement = get_theme_mod( 'sup_site_identity_placement' , 'left' );
		$ad_spots = get_theme_mod( 'sup_ad_spots' );
		$classes  = '';
		$classes  .= "sup-logo-placement-{$logo_title_placement}";
		$classes  .= isset( $ad_spots['header'] ) && $ad_spots['header'] ? ' sup-has-header-ad' : false;

		echo apply_filters( 'sup_logo_title_placement_classes' , $classes );
	}
}



if( ! function_exists( 'sup_main_font_url' ) )
{
	/**
	 * Returns the main font url of the theme, we are returning it from a function to handle two things
	 * one is to handle the http problems and the other is so that we can also load it to post editor.
	 * @return string font url
	 */
	function sup_main_font_url()
	{
		/**
		 * Use font url without http://, we do this because google font without https have
		 * problem loading on websites with https.
		 * @var font_url
		 */
		$font_url = 'fonts.googleapis.com/css?family=PT+Sans+Narrow:700,400';

		return ( substr( site_url(), 0, 8 ) == 'https://') ? 'https://' . $font_url : 'http://' . $font_url;
	}
}

if( ! function_exists( 'sup_copyright_text' ) )
{
	function sup_copyright_text()
	{
		global $supernova;
		$theme_uri = $supernova->AuthorURI;

		$default = sprintf( esc_html__( '%1$s ', 'supernova' ), 'Supernova' );

		$copyright_text = get_theme_mod( 'sup_copyright_text' , $default );

		return $copyright_text;
	}
}

if( ! function_exists( 'sup_site_branding' ) )
{
	function sup_site_branding()
	{
		$site_title   = get_bloginfo( 'name' );
		$site_logo    = get_theme_mod( 'sup_logo' );
		$hide_tagline = get_theme_mod( 'sup_display_header_text' );
		$title_class  = $site_logo ? ' screen-reader-text' : false;
		$desc_class   = $hide_tagline ? false : ' screen-reader-text';

		if( $site_logo ){
			printf( '<a class="logo-link" href="%s" rel="home"><img src="%s" alt="%s" ></a>' , esc_url( home_url( '/' ) )  , esc_url( $site_logo ), __( 'Logo' , 'supernova' ) );
		}

		if ( is_front_page() && is_home() ){ ?>
			<h1 class="sup-site-title<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h1>
		<?php } else { ?>
			<h2 class="sup-site-title<?php echo $title_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h2>
		<?php }

		?>

		<p class="sup-site-description<?php echo $desc_class; ?>"><?php bloginfo( 'description' ); ?></p>

		<?php
	}
}

if( ! function_exists( 'sup_pagination' ) )
{
	function sup_pagination()
	{
		echo "<nav class='sup-pagination' >";
			echo paginate_links();
		echo "</nav>";
	}
}

if( ! function_exists( 'sup_loadmore_button' ) )
{
	function sup_loadmore_button( $class )
	{
		if( ! is_home() ) return;
		echo sprintf( '<button class="'. $class .' sup-loadmore"><img width="30" height="30" class="sup-loader" src="%s"><span class="sup-text" >%s</span></button>' , SUPERNOVA_IMG_URI . '/loader.gif' ,  __( 'Load More' , 'supernova' ) );
		wp_nonce_field( "sup-loadmore-{$class}-432432" );
	}
}

if( ! function_exists( 'sup_readmore_text' ) )
{
	function sup_readmore_text()
	{
	  	global $post;
		return sprintf( '<a class="sup-readmore" href="%s">%s</a>' , get_permalink($post->ID) , __( 'Read More' , 'supernova' ) );
	}
}

add_filter('excerpt_more', 'sup_readmore_text');


if( ! function_exists( 'sup_content' ) )
{
	function sup_content()
	{
		$show_full = get_theme_mod( 'sup_content_or_excerpt' , 'excerpt' ) === 'full' ? true : false ;

		if( $show_full ){
			the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'supernova' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}
		else
		{
			the_excerpt();
		}

	}
}

/*
 * Gets thumbnail for posts and listings
 * Should be called where post id is available.
 * @since Supernova 1.4.2
 */

if( ! function_exists('sup_thumbnail') )
{
	function sup_thumbnail( $size = 'thumbnail' , $before = false , $after = false, $show_attachment = false )
	{
		global $post;

	    $size = $size ? $size : 'thumbnail';

	    $extra_classes = "";

	    //if it is not lising.
	    if( is_single() || is_page() ){
	    	$extra_classes .= 'sup-single-page-featured';
	    }
	    else{ // if its listing.
	    	$size = get_theme_mod( 'sup_list_thumbnail_width' , 'thumbnail' );
	    	$show_full = get_theme_mod( 'sup_content_or_excerpt' , 'excerpt' ) === 'full' ? true : false ;
	    	if( $show_full ) return ;
	    }

	    $attr = array( 'class' => "attachment-{$size} sup-featured-image {$extra_classes}" );

	    if ( has_post_thumbnail() ) {
	    	echo $before;
	        	the_post_thumbnail( $size , $attr );
	        echo $after;
	    }
	    else
	    {
	        $attachments = get_children( array(
				'post_parent'    => get_the_ID(),
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => 'ASC',
				'orderby'        => 'menu_order ID',
				'numberposts'    => 1
	            )
	        );

	        $is_individual_post = is_single() || is_page();

	        if( ! empty( $attachments ) )
	        {
		        if( $show_attachment || ! $is_individual_post )
		        {
        			foreach ( $attachments as $thumb_id => $attachment ) {
        				echo $before;
        			    	echo wp_get_attachment_image($thumb_id, $size, false, $attr );
        			    echo $after;
        			}
        		}
	        }

	    }

	} //function ends
}

if( ! function_exists( 'sup_isset' ) )
{
	function sup_isset( $array, $key )
	{
		return isset( $array[$key] ) && trim( $array[$key] ) ? $array[$key] : false;
	}
}

if( ! function_exists( 'sup_ajax_posts' ) )
{
	function sup_ajax_posts()
	{
		$posts = apply_filters( 'sup_ajax_post_containers', array( 'popular' , 'recommended' ) );

		foreach( $posts as $post ) :  ?>

			<div id="sup-<?php echo $post ?>-posts" class="sup-<?php echo $post ?>-posts sup-ajax-posts sup-first-view">
				<?php //posts will be loaded here through javascript. ?>
				<footer class="sup-<?php echo $post ?>-posts-footer sup-ajax-posts-footer clearfix" >
					<?php sup_loadmore_button( "sup-load-{$post}" ); ?>
				</footer>
			</div>

		<?php endforeach;
	}
}

if( ! function_exists('sup_checked') )
{
	function sup_checked($id, $value ){
	    if($id == $value ){
	      return  'checked="checked"';
	    }else{
	        return false;
	    }
	}
}

if( ! function_exists( 'sup_generate_css' ) )
{
	function sup_generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $default = false, $echo = true )
	{
		      $return = '';

		      $selector = is_array( $selector) ? join( ',' , $selector ) : $selector;

				if( is_array( $style ) && is_array($mod_name) ){
					$return .= $selector . '{';
					foreach ($style as $key => $property ) {
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
					   			  sprintf('%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix) :
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

if( ! function_exists( 'sup_font_families' ) )
{
	function sup_font_families()
	{
		return array(
                        'Georgia, serif',
                        '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
                        '\'Times New Roman\', Times, serif',
                        'Arial, Helvetica, sans-serif',
                        '\'Arial Black\', Gadget, sans-serif',
                        '\'Comic Sans MS\', cursive, sans-serif',
                        'Impact, Charcoal, sans-serif',
                        '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        '\'Trebuchet MS\', Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif',
                        '\'Courier New\', Courier, monospace',
                        '\'Lucida Console\', Monaco, monospace'
                    );
	}
}


if( ! function_exists( 'sup_social_icons' ) )
{
	function sup_social_icons()
	{
		$social_icons = get_theme_mod( 'sup_social_icons' );

		if( ! empty( $social_icons ) ){
			echo "<ul class='sup-social-icons' >";
				foreach ( $social_icons as $icon => $url ) {
					$social_url = esc_url( $url );
					echo "<li><a class='sup-social-icon sup-icon-{$icon}' href='{$social_url}' target='_blank' title='{$icon}'></a></li>";
				}
			echo "</ul>";
		}
	}
}

if( ! function_exists( 'sup_create_ad_spot' ) )
{
	function sup_create_ad_spot( $position , $add_row = false )
	{
		$ad_spots = get_theme_mod( 'sup_ad_spots' );

		if( empty( $ad_spots ) ) return;

		$ad_code = isset( $ad_spots[$position] ) && $ad_spots[$position] ? trim($ad_spots[$position]) : false;

		if( ! $ad_code ) return;

		ob_start();

		if( $add_row ) echo "<div class='row sup-ad-spot-row' >";
			echo "<div class='sup-ad-spot sup-ad-spot-{$position}' ><div class='inner-wrapper' >{$ad_code}</div></div>";
		if( $add_row ) echo "</div>";
	}
}



if( ! function_exists( 'sup_trim_characters' ) )
{
	function sup_trim_characters( $text, $length, $ending = '...' )
	{
		//don't cut if too short
	    if( strlen( $text ) < $length + 10 ) return $text;

	    //find next space after desired length
	    $break_pos = strpos( $text, ' ', $length );

	    return substr($text, 0, $break_pos) . $ending;
	}
}

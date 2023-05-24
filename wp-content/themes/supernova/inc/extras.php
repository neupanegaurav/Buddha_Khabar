<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package supernova
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sup_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;

}
add_filter( 'body_class', 'sup_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function sup_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'supernova' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'sup_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function sup_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'sup_render_title' );
endif;


/*
* Updates post counts from each post
* @param $postID
* Returns NULL.
*/
if( !function_exists('sup_count_post_views') )
{
	function sup_count_post_views()
	{
		$post_id = get_the_ID();

		if( ! is_single() || ! $post_id ) return;

	    $key = 'supernova_post_views_count';
	    $count = get_post_meta( $post_id, $key, true );

	    if( $count == '' ){
	        $count = 0;
	        delete_post_meta( $post_id, $key );
	        add_post_meta( $post_id, $key, '0');
	    }else{
	        $count++;
	        update_post_meta( $post_id, $key, $count );
	    }
	}
}
add_action( 'wp_head' , 'sup_count_post_views' );

//To keep the count accurate
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

if( ! function_exists( 'sup_breadcrumb' ) )
{
	function sup_breadcrumb()
	{
		echo '<nav class="sup-breacrumbs" >';

	    if ( function_exists('yoast_breadcrumb') )
	    {
	    	yoast_breadcrumb('<p id="sup-breacrumbs-list">','</p>');
	    	return;
	    }

    	echo '<ul class="sup-breacrumbs-list" >';

		    if ( ! is_home() )
		    {
		        printf( '<li><a href="%s">%s</a></li>' , home_url() , __( 'Home' , 'supernova' ) );

		        if ( is_category() || is_single() )
		        {
		            echo '<li>';

		            the_category(' </li><li> ');

		            if (is_single()) {
		                the_title( "</li><li>", '</li>' );
		            }

		        }
		        elseif (is_page())
		        {
	            	the_title( '<li>' , '</li>' );
		        }
		    }
		    elseif ( is_tag() )
		    {
		    	single_tag_title();
		    }
		    elseif ( is_author() )
		    {
		    	 printf( "<li>%s</li>" , __('Author Archive', 'supernova') );
	    	}
		    elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) )
		    {
		    	printf( "<li>%s</li>" , __('Blog Archive', 'supernova') );
		    }
		    elseif ( is_search() )
		    {
		    	printf( "<li>%s</li>" , __('Search Archive', 'supernova') );
		    }

	    echo '</ul>';
	    echo '</nav>';

	}
}

if( ! function_exists( 'sup_font_resizer' ) )
{
	function sup_font_resizer()
	{
		?>
			<div class="sup-font-resizer">
				<a href="#" class="sup-minus" data-type="minus" title="<?php _e( 'Decrease Font Size' , 'supernova' ); ?>">[A-]</a>
				<a href="#" class="sup-plus" data-type="plus" title="<?php _e( 'Increase Font Size' , 'supernova' ); ?>">[A+]</a>
			</div>
		<?php
	}
}

if( ! function_exists( 'sup_author_profile' ) )
{
	function sup_author_profile()
	{
		if( ! get_theme_mod( 'sup_post_author' , true ) ) return;
		$avatar = get_avatar( get_the_author_meta('email'), '100' );
		?>
		<div class="sup-author-profile clearfix">
			<?php if( $avatar ) : ?>
			<figure class="sup-ap-avatar">
				<?php echo $avatar; ?>
			</figure>
			<?php endif; ?>
		    <div class="sup-ap-info">
		        <h3 class="sup-ap-title"><?php _e('About ', 'supernova'); the_author_posts_link(); ?></h3>
		        <p class="sup-ap-description"><?php the_author_meta('description'); ?></p>
		        <span class="sup-ap-viewall">
		        	<?php _e('View all posts by ', 'supernova'). the_author_posts_link(); ?><span class="sup-ap-icon sup-icon-right-pointer"></span>
	        	</span>
		    </div>
		</div>
		<?php
	}
}

if( ! function_exists( 'sup_post_navigation' ) )
{
	function sup_post_navigation()
	{
		if( ! get_theme_mod( 'sup_post_nav_below_posts' , true ) ) return;

		$prev_post = get_previous_post(true);
		$next_post = get_next_post(true);

		echo "<nav class='sup-post-navigation row'>";

		if ( !empty( $prev_post ) ): ?>

			<div class="sup-prev-post large-5 medium-5 small-6 column">
				<?php
				$link = get_permalink( $prev_post->ID );
				$title = get_the_title( $prev_post->ID );
				$previous = sprintf( '<span class="sup-nav-link"><span class="sup-pn-icon sup-icon-left-nav"></span> %s</span>' , __( ' Previous' , 'supernova' ) );
				$thumbnail_class = has_post_thumbnail( $prev_post->ID ) ? 'sup-pn-has-thumb' : false;
				printf( "<a class='sup-thumb-link %s' href='%s'>%s %s</a>", $thumbnail_class , $link, get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ) , $previous );
				printf( "<h4 class='sup-pn-title' ><a href='%s'>%s</a></h4>" , $link, $title );
				?>
			</div>

		<?php endif;

		if ( !empty( $next_post ) ): ?>

			<div class="sup-next-post large-5 medium-5 small-6 column">
				<?php
				$link = get_permalink( $next_post->ID );
				$title = get_the_title( $next_post->ID );
				$next = sprintf( '<span class="sup-nav-link">%s <span class="sup-pn-icon sup-icon-right-nav"></span></span>' , __( ' Next' , 'supernova' ) );
				$thumbnail_class = has_post_thumbnail( $next_post->ID ) ? 'sup-pn-has-thumb' : false;
				printf( "<a class='sup-thumb-link %s' href='%s'>%s %s</a>", $thumbnail_class , $link, get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) , $next );
				printf( "<h4 class='sup-pn-title'><a href='%s'>%s</a></h4>" , $link, $title );
				?>
			</div>

		<?php endif;

		echo "</nav>";

	}
}

if( ! function_exists( 'sup_add_back_to_top' ) )
{
	function sup_add_back_to_top()
	{
		if( get_theme_mod( 'sup_back_to_top' , true ) )
		echo '<div class="sup-back-to-top" id="sup-back-to-top"></div>';
	}
}
add_action( 'wp_footer', 'sup_add_back_to_top' );

if( ! function_exists( 'sup_custom_css' ) )
{
	function sup_custom_css()
	{
		if( is_single() || is_page() ){
			echo get_post_meta( get_the_ID(), 'post-style' , true );
		}

		//Add Script
		$header_script = get_theme_mod( 'sup_header_script' );

		if( $header_script ){
			echo "<script".">";
				echo $header_script;
			echo "</script>";
		}
	}
}

add_action( 'wp_head' , 'sup_custom_css' );


/**
 * Default length of excerpt is 55 words in WordPress
 * Changes the excerpt length
 */
if( ! function_exists( 'sup_change_excerpt_length' ) )
{
	function sup_change_excerpt_length( $length )
	{
		$excerpt_length = intval(get_theme_mod( 'sup_excerpt_length' ));

		if( $excerpt_length && $excerpt_length > 29 ){
			return $excerpt_length;
		}
		else{
			return $length;
		}

	}
}

add_filter( 'excerpt_length', 'sup_change_excerpt_length', 999 );

//Notice

function sup_admin_notice() {

    global $current_user ;

        $user_id = $current_user->ID;

        /* Check that the user hasn't already clicked to ignore the message */

    if ( ! get_user_meta($user_id, 'sup_ignore_notice') ) {

    	$is_old_user = get_option('supernova_settings');

    	if( ! empty( $is_old_user ) ){
	        echo '<div class="updated"><p>';
	        printf(__('<b>Supernova theme</b> has been rebuilt for better performance and to meet wordpress new standards. Therefore your settings have been moved to customizer. Your theme may look broken but its actually fixed now. Please save it again from customizer live preview. Sorry for any inconvenience caused. | <a href="%1$s">Hide Notice</a>', 'supernova'), '?sup_nag_ignore=0');
	        echo "</p></div>";
        }

    }

}

add_action('admin_notices', 'sup_admin_notice');

function sup_nag_ignore() {

    global $current_user;

        $user_id = $current_user->ID;

        /* If user clicks to ignore the notice, add that to their user meta */

        if ( isset($_GET['sup_nag_ignore']) && '0' == $_GET['sup_nag_ignore'] ) {

             add_user_meta($user_id, 'sup_ignore_notice', 'true', true);

    }
}

add_action('admin_init', 'sup_nag_ignore');

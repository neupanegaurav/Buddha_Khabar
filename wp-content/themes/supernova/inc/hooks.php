<?php
/**
 * Slider is added in index.php function.
 * @return null
 */

function sup_add_slider(){
	get_template_part( 'template-parts/slider' );
}
add_action( 'sup_primary_start' , 'sup_add_slider' );

/**
 * Creates tab for ajax posts
 * Shows only for blog listing on home page.
 * @return void
 */
function sup_add_tabs()
{
	if( ! is_home() ) return;

	$show_popular     = get_theme_mod( 'sup_popular_posts' , true );
	$show_recommended = get_theme_mod( 'sup_recommended_posts' , true );
	?>
	<nav class="sup-tabs clearfix">
		<ul class="sup-posts-loader-tabs">
			<li class="sup-latest-tab sup-active"><?php echo apply_filters( 'sup_latest_blogs_text' ,  __( 'Latest Blogs', 'supernova' ) ); ?></li>
			<?php if( $show_popular ) { ?>
			<li class="sup-popular-tab"><?php echo apply_filters( 'sup_popular_blogs_text' , __( 'Popular' , 'supernova' ) ); ?></li>
			<?php } ?>
			<?php if( $show_recommended ){ ?>
			<li class="sup-recommended-tab"><?php echo apply_filters( 'sup_recommended_blogs_text' , __( 'Recommended' , 'supernova' ) ); ?></li>
			<?php } ?>
			<?php do_action( 'sup_inside_tabs' ); ?>
		</ul>
		<?php do_action( 'sup_after_tabs' ); ?>
	</nav>
	<?php
}
add_action( 'sup_primary_start', 'sup_add_tabs' );

function sup_after_title()
{
	if( is_single() && get_theme_mod( 'sup_breadcrumb' , true ) ) sup_breadcrumb();
	if( get_theme_mod( 'sup_font_resizer' , true ) ) sup_font_resizer();
}
add_action( 'sup_after_title', 'sup_after_title' );

function sup_next_to_branding()
{
	sup_create_ad_spot('header');
}
add_action( 'sup_next_to_branding' , 'sup_next_to_branding' );

function sup_before_content()
{
	sup_create_ad_spot( 'below_nav', true );
}
add_action( 'sup_before_content' , 'sup_before_content' );

function sup_main_start()
{
	if( ! is_single() && ! is_page() )
	sup_create_ad_spot('above_posts');
}
add_action( 'sup_main_start' , 'sup_main_start' );

function sup_main_end()
{
	if( ! is_single() && ! is_page() )
	sup_create_ad_spot('below_posts');
}
add_action( 'sup_main_end' , 'sup_main_end' );

function sup_before_footer()
{
	sup_create_ad_spot( 'above_footer', true );
}
add_action( 'sup_before_footer' , 'sup_before_footer' );


function sup_load_pro()
{
	$file = SUPERNOVA_TEMP_DIR . '/pro/pro.php';

	if ( file_exists($file) )
	{
		define( 'SUPERNOVA_PRO', true );
	    require_once $file;
	}
}
add_action( 'sup_after' , 'sup_load_pro' );

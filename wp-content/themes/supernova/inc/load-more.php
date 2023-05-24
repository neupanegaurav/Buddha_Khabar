<?php
/**
 * @package supernova
 */

/**
* Handles Load More functionality
*/
class Supernova_Loadmore
{

	public function __construct()
	{
		add_action( 'wp_ajax_sup_loadmore_posts' , array( $this , 'loadmore_posts' ) );
		add_action( 'wp_ajax_nopriv_sup_loadmore_posts' , array( $this , 'loadmore_posts' ) );
	}

	public function load( $args )
	{
		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			get_template_part( 'template-parts/content' );

		endwhile;
		else :
			echo "<p class='sup-error'>" . apply_filters( "sup_noposts_error" , __( 'Sorry there are no posts available.' , 'supernova' ) ) . "</p>" ;
		endif;

		wp_reset_postdata();

		$posts = ob_get_contents();

		ob_end_clean();

		return $posts;
	}

	public function get_latest_posts( $offset , $posts_per_page )
	{
		$args = apply_filters( 'sup_latest_posts_args' , array(
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => true,
						'post_status'         => 'publish',
						'orderby'             => 'date',
						'offset'              => $offset,
					), $offset );

		return $this->load( $args );
	}

	public function get_popular_posts( $offset, $posts_per_page )
	{
		$dependency = get_theme_mod( 'sup_popular_posts_dependency', 'actual-count' );

		$args = array(
		                'posts_per_page'      => $posts_per_page,
		                'offset'              => $offset,
		                'ignore_sticky_posts' => true,
		                'post_status'         => 'publish',
		            );

		if( $dependency === 'number-of-comments' )
		{
			$args['orderby'] = "comment_count";
		}
		else if( $dependency === 'let-me-select' ){
			$args['orderby']    = "modified";
			$args['meta_key']   = "supernova-popular-post";
			$args['meta_value'] = 1;
		}
		else{
			$args['orderby']  = "meta_value_num";
			$args['meta_key'] = "supernova_post_views_count";
		}

		return $this->load( apply_filters( 'sup_popular_posts_args' , $args, $offset ) );
	}

	public function get_recommeded_posts( $offset, $posts_per_page )
	{

		$args = apply_filters( 'sup_recommended_posts_args' , array(
		                'posts_per_page'      => $posts_per_page,
		                'offset'              => $offset,
		                'ignore_sticky_posts' => true,
		                'post_status'         => 'publish',
		                'orderby'             => 'modified',
		                'meta_key'            => 'supernova-recommended-post',
		                'meta_value'          => 1
		            ), $offset );

		return $this->load( $args );
	}

	public function loadmore_posts()
	{
		$load_count     = isset( $_POST[ 'load_count' ] ) ? intval( wp_unslash( $_POST[ 'load_count' ] ) ) : 0;
		$load_type      = isset( $_POST['load_type'] ) ? sanitize_text_field( wp_unslash( $_POST['load_type'] ) ) : false;
		$posts_per_page = get_option( 'posts_per_page' );
		$offset         = $load_count == 1 ? $posts_per_page * $load_count + 1 : $posts_per_page * $load_count;
		$markup         = '';

		if ( 'main' === $load_type ) {
			$markup = $this->get_latest_posts( $offset , $posts_per_page );
		} elseif ( 'popular' === $load_type ) {
			$markup = $this->get_popular_posts( $offset , $posts_per_page );
		} elseif ( 'recommended' === $load_type ) {
			$markup = $this->get_recommeded_posts( $offset , $posts_per_page );
		}

		wp_send_json( array( 'markup' => $markup, 'load_type' => $load_type ) );
	}

}

new Supernova_Loadmore();

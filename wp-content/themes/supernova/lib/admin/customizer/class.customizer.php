<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Supernova 2.0
 */

class Sup_Customizer{

	public function __construct()
	{
		// Setup the Theme Customizer settings and controls...
		add_action( 'customize_register' , array( $this , 'register' ) );

		// Enqueue live preview javascript in Theme Customizer admin screen
		add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );

    add_action( 'customize_controls_enqueue_scripts', array( $this , 'load_customizer_controls_scripts' )  );

    add_action( 'wp_ajax_sup_pull_posts_data' , array( $this, 'pull_posts_data' ) );

	}

   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    *
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @since Supernova 1.0
    */
   public static function register ( $wp_customize )
   {

      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

      $wp_customize->remove_control( 'display_header_text' );
      $wp_customize->remove_control( 'background_color' );
      $wp_customize->remove_control( 'header_image' );
      $wp_customize->remove_control( 'header_textcolor' );

   }

   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    *
    * Used by hook: 'customize_preview_init'
    *
    * @see add_action('customize_preview_init',$func)
    * @since Supernova 2.0
    */
   public static function live_preview() {

      // Use some random number To avoid caching during development
      wp_enqueue_script(
           'sup-themecustomizer', // Give the script a unique ID
           SUPERNOVA_CUSTOMIZER_JS . '/customizer-live-preview.js',
           array(  'jquery' ,'customize-preview' ), // Define dependencies
           '', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );
   }

   public function load_customizer_controls_scripts()
   {
      wp_enqueue_script(
           'sup-customizer-control-scripts', // Give the script a unique ID
           SUPERNOVA_CUSTOMIZER_JS . '/customizer-control.js',
           array(  'jquery' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );

   }

   public function get_post_thumbnail()
   {
        $thumbnail_data = array();
        $attachment_id  = '';
        $thumbnail_src  = '';
        $size           = "medium";

        if ( has_post_thumbnail() ) {
              $attachment_id = get_post_thumbnail_id();
              $thumbnail_data = wp_get_attachment_image_src( $attachment_id, $size );
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

            if( ! empty( $attachments ) )
            {
                foreach ( $attachments as $thumb_id => $attachment ) {
                    $thumbnail_data = wp_get_attachment_image_src( $thumb_id, $size );
                    $attachment_id = $thumb_id;
                }
            }
        }

        $thumbnail_src = isset( $thumbnail_data[0] ) ? $thumbnail_data[0] : '';

        return array( 'thumbnail_src' => $thumbnail_src , 'attachment_id' => $attachment_id );
   }

   public function pull_posts_data()
   {
      $post_id = isset($_REQUEST['post_id']) ? $_REQUEST['post_id'] : false;

      if( ! $post_id ) return;

      $data = array(
                    'src'           => '' ,
                    'title'         => '' ,
                    'excerpt'       => '' ,
                    'attachment_id' => ''
      );

      $args = array( 'post__in' => array( $post_id ) );

      $query = new WP_Query( $args );

      if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

        $thumbnail = $this->get_post_thumbnail();

        $data['thumbnail_src'] = $thumbnail['thumbnail_src'];
        $data['title']         = get_the_title();
        $data['excerpt']       = get_the_excerpt() ? wp_trim_words( get_the_excerpt() , 20, '...' ) : '';
        $data['attachment_id'] = $thumbnail['attachment_id'] ? $thumbnail['attachment_id'] : '';

      endwhile; endif; wp_reset_postdata();

      die( json_encode( $data ) );
   }

}

new Sup_Customizer();

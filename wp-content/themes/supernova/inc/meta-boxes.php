<?php

/**
* Creates Metaboxes for theme
*/
class Sup_Metaboxes
{

    function __construct()
    {
        add_action( 'add_meta_boxes', array( $this , 'sup_custom_meta' ) );
        add_action( 'save_post', array( $this , 'sup_meta_save' ) );
        add_action( 'add_meta_boxes', array( $this , 'sup_postoptions_custom_meta' ) );
        add_action( 'save_post', array( $this , 'sup_postoption_meta_save' ) );
    }

    public function sup_custom_meta()
    {
        add_meta_box( 'sup_meta', __('Write CSS for this post', 'supernova'), array( $this , 'sup_meta_callback' ), 'post', 'normal','high' );
        add_meta_box( 'sup_meta', __('Write CSS for this page', 'supernova'), array( $this , 'sup_meta_callback' ), 'page', 'normal','high' );
    }

    public function sup_meta_callback( $post ) {
        //To verify the input and for security
        wp_nonce_field( basename( __FILE__ ), 'sup_nonce' );
        $sup_style_meta = get_post_meta( $post->ID );
        ?>
        <p>
            <label for="post-style" class="supernova-row-title"><?php _e('Dont forget to wrap in <b>STYLE</b> tag', 'supernova') ?></label><br>
            <textarea rows="5" style="width:95%;" name="post-style" /><?php if(isset($sup_style_meta['post-style'][0])){echo $sup_style_meta['post-style'][0];} ?></textarea>
        </p>
        <?php
    }

    public function sup_meta_save( $post_id )
    {
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'sup_nonce' ] ) && wp_verify_nonce( $_POST[ 'sup_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        if( isset( $_POST[ 'post-style' ] ) ) {
            update_post_meta( $post_id, 'post-style', $_POST[ 'post-style' ] );
        }
    }

    /***************************************/
        /*Poplular & Recommended posts*/
    /***************************************/

    public function sup_postoptions_custom_meta()
    {
        add_meta_box( 'sup_meta_posts', __('List this post under', 'supernova'), array( $this , 'sup_postoptions_meta_callback' ), 'post', 'side','core' );
    }

    public function sup_postoptions_meta_callback( $post )
    {
        //To verify the input and for security
        wp_nonce_field( basename( __FILE__ ), 'sup_postoptions_nonce' );
        $sup_post_meta = get_post_meta( $post->ID );

        ?>
        <p>
            <input type="checkbox" name="supernova-recommended-post" id="supernova-recommended-post" value="1" <?php if(isset($sup_post_meta['supernova-recommended-post'][0]) && $sup_post_meta['supernova-recommended-post'][0] == 1 ){echo "checked=checked"; } ?> >
            <label for="supernova-recommended-post" ><?php _e('Recommended Posts', 'supernova') ?></label>
        </p>
        <p>
            <input type="checkbox" name="supernova-popular-post" id="supernova-popular-post" value="1" <?php if(isset($sup_post_meta['supernova-popular-post'][0]) && $sup_post_meta['supernova-popular-post'][0] == 1 ){echo "checked=checked"; } ?> >
            <label for="supernova-popular-post" ><?php _e('Popular Posts', 'supernova') ?></label>
        </p>

        <?php
    }

    public function sup_postoption_meta_save( $post_id )
    {
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'sup_postoptions_nonce' ] ) && wp_verify_nonce( $_POST[ 'sup_postoptions_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) return;

        if( isset( $_POST[ 'supernova-recommended-post' ] ) && $_POST[ 'supernova-recommended-post' ] == '1' )
        {
            update_post_meta( $post_id, 'supernova-recommended-post', '1' );
        }
        else{
            update_post_meta( $post_id, 'supernova-recommended-post', '0' );
        }

        if(isset( $_POST[ 'supernova-popular-post' ]) && $_POST[ 'supernova-popular-post' ] == '1'){
            update_post_meta( $post_id, 'supernova-popular-post', '1' );
        }
        else{
            update_post_meta( $post_id, 'supernova-popular-post', '0' );
        }
    }


}

new Sup_Metaboxes();

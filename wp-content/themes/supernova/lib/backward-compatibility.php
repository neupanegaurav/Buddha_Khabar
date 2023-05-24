<?php

/**
 * Contains functions of previous version.
 * Emtpy functions are kept here so it doesnt throw fatal error
 * if in case somebody is using any of these functions in their child theme.
 * We will remove this later.
 */

/*==============================
          Old Functions
===============================*/

if( ! function_exists( 'supernova_comment' ) ){
  function supernova_comment($comment, $args, $depth) {}
}
if( ! function_exists( 'supernova_widgets_setup' ) ){
  function supernova_widgets_setup(){}
}
if( ! function_exists( 'supernova_theme_setup' ) ){
  function supernova_theme_setup(){}
}
if( ! function_exists( 'supernova_new_excerpt_more' ) ){
  function supernova_new_excerpt_more($more) {}
}
if( ! function_exists( 'supernova_loadmore_main' ) ){
  function supernova_loadmore_main( $paged, $showmore_text){}
}
if( ! function_exists( 'supernova_popular_loadmore' ) ){
  function supernova_popular_loadmore( $offset){}
}
if( ! function_exists( 'supernova_rec_loadmore' ) ){
  function supernova_rec_loadmore( $offset, $showmore_text ){}
}
if( ! function_exists( 'supernova_add_options' ) ){
  function supernova_add_options(){}
}
if( ! function_exists( 'supernova_register_settings' ) ){
  function supernova_register_settings(){}
}
if( ! function_exists( 'supernova_page' ) ){
  function supernova_page(){}
}
if( ! function_exists( 'supernova_validate_settings' ) ){
  function supernova_validate_settings($input){}
}
if( ! function_exists( 'supernova_on_activation' ) ){
  function supernova_on_activation(){}
}
if( ! function_exists( 'supernova_on_updation' ) ){
  function supernova_on_updation(){}
}
if( ! function_exists( 'supernova_admin_menu' ) ){
  function supernova_admin_menu($admin_bar){}
}
if( ! function_exists( 'supernova_header_logopos' ) ){
  function supernova_header_logopos(){}
}
if( ! function_exists( 'supernova_handle_background_save' ) ){
  function supernova_handle_background_save(){}
}
if( ! function_exists( 'supernova_file_status_check' ) ){
  function supernova_file_status_check(){}
}
if( ! function_exists( 'supernova_handle_header_save' ) ){
  function supernova_handle_header_save(){}
}
if( ! function_exists( 'supernova_temp_user_css' ) ){
  function supernova_temp_user_css(){}
}
if( ! function_exists( 'supernova_user_css' ) ){
  function supernova_user_css(){}
}
if( ! function_exists( 'supernova_aop_helper_message' ) ){
  function supernova_aop_helper_message($message, $rowclass = false,  $outclass = false, $innerclass = false ){}
}
if( ! function_exists( 'supernova_aop_image_uploader' ) ){
  function supernova_aop_image_uploader( $width, $name, $label_name, $desc ){}
}
if( ! function_exists( 'supernova_aop_checkbox_switch' ) ){
  function supernova_aop_checkbox_switch( $width, $name, $label_name, $desc, $image_url = false ){}
}
if( ! function_exists( 'supernova_aop_range_slider' ) ){
  function supernova_aop_range_slider( $width, $name, $label_name, $desc, $image_url, $i, $default){}
}
if( ! function_exists( 'supernova_aop_image_radio' ) ){
  function supernova_aop_image_radio( $width, $name, $label_name, $desc, $image_url, $radio_images, $radio_classes){}
}
if( ! function_exists( 'supernova_aop_radio' ) ){
  function supernova_aop_radio( $width, $name, $label_name, $desc, $image_url, $labels, $classes = false){}
}
if( ! function_exists( 'supernova_aop_color_scheme' ) ){
  function supernova_aop_color_scheme( $width, $name, $label_name, $desc, $image_url , $bg_colors){}
}
if( ! function_exists( 'supernova_aop_textarea' ) ){
  function supernova_aop_textarea( $width, $name, $label_name, $desc, $image_url = false){}
}
if( ! function_exists( 'supernova_aop_select_sortable' ) ){
  function supernova_aop_select_sortable( $width, $name, $label_name, $desc, $image_url, $default){}
}
if( ! function_exists( 'supernova_aop_select' ) ){
  function supernova_aop_select( $width, $name, $label_name, $desc, $image_url, $select_options, $placeholder = false){}
}
if( ! function_exists( 'supernova_aop_color_picker' ) ){
  function supernova_aop_color_picker( $width, $name, $label_name, $desc, $image_url = false){}
}
if( ! function_exists( 'supernova_aop_slider_field' ) ){
  function supernova_aop_slider_field( $width, $name_page, $name_thumb, $label_name, $desc, $image_url, $placeholder){}
}
if( ! function_exists( 'supernova_aop_link_field' ) ){
  function supernova_aop_link_field( $width, $name, $label_name, $desc, $image_url , $placeholder){}
}
if( ! function_exists( 'supernova_aop_input_text' ) ){
  function supernova_aop_input_text( $width, $name, $label_name, $desc, $image_url , $placeholder){}
}
if( ! function_exists( 'supernova_aop_support' ) ){
  function supernova_aop_support(){}
}
if( ! function_exists( 'supernova_admin_page_setup' ) ){
  function supernova_admin_page_setup($pagename, $width = false , $i = false, $is_submenu = false){}
}
if( ! function_exists( 'supernova_wp_title' ) ){
  function supernova_wp_title( $title, $sep ) {}
}
if( ! function_exists( 'supernova_render_title' ) ){
  function supernova_render_title() {}
}
if( ! function_exists( 'supernova_wp_favicon' ) ){
  function supernova_wp_favicon(){}
}
if( ! function_exists( 'supernova_header_style' ) ){
  function supernova_header_style(){}
}
if( ! function_exists( 'supernova_admin_header_style' ) ){
  function supernova_admin_header_style() {}
}
if( ! function_exists( 'supernova_admin_header_image' ) ){
  function supernova_admin_header_image() {}
}
if( ! function_exists( 'supernova_back_to_top' ) ){
  function supernova_back_to_top(){}
}
if( ! function_exists( 'supernova_post_title' ) ){
  function supernova_post_title($title) {}
}
if( ! function_exists( 'supernova_breadcrumb' ) ){
  function supernova_breadcrumb() {}
}
if( ! function_exists( 'supernova_dashboard_widgets' ) ){
  function supernova_dashboard_widgets(){}
}
if( ! function_exists( 'supernova_dashboard_widgets_custom' ) ){
  function supernova_dashboard_widgets_custom() {}
}
if( ! function_exists( 'supernova_copyright_custom_date' ) ){
  function supernova_copyright_custom_date() {}
}
if( ! function_exists( 'supernova_count_post_views' ) ){
  function supernova_count_post_views($postID) {}
}
if( ! function_exists( 'supernova_google_analytics' ) ){
  function supernova_google_analytics(){}
}
if( ! function_exists( 'supernova_single_post_css' ) ){
  function supernova_single_post_css(){}
}
if( ! function_exists( 'supernova_writer' ) ){
  function supernova_writer(){}
}
if( ! function_exists( 'supernova_tell_slider_image_size' ) ){
  function supernova_tell_slider_image_size(){}
}
if( ! function_exists( 'supernova_get_image_size' ) ){
  function supernova_get_image_size(){}
}
if( ! function_exists( 'supernova_custom_image_options' ) ){
  function supernova_custom_image_options(){}
}
if( ! function_exists( 'supernova_save_header_options' ) ){
  function supernova_save_header_options(){}
}
if( ! function_exists( 'supernova_excerpt_length' ) ){
  function supernova_excerpt_length( $length ) {}
}
if( ! function_exists( 'supernova_checked_check' ) ){
  function supernova_checked_check($id, $value_to_check, $default = false){}
}
if( ! function_exists( 'supernova_font_url' ) ){
  function supernova_font_url(){}
}
if( ! function_exists( 'supernova_options' ) ){
  function supernova_options( $option ){}
}
if( ! function_exists( 'supernova_page_list' ) ){
  function supernova_page_list($supernova_page_type, $supernova_pagelist_settings, $selected_option){}
}
if( ! function_exists( 'supernova_chopper' ) ){
  function supernova_chopper($string, $limit){}
}
if( ! function_exists( 'supernova_range_slider_settings' ) ){
  function supernova_range_slider_settings($slider_class, $result_class, $hidden_id, $slider_bar_value, $slider_default, $min_value, $max_value){}
}
if( ! function_exists( 'supernova_version_notice' ) ){
  function supernova_version_notice(){}
}
if( ! function_exists( 'supernova_thumbnail' ) ){
  function supernova_thumbnail($post_id = false){}
}
if( ! function_exists( 'supernova_get_attachment_image' ) ){
  function supernova_get_attachment_image($post_id = false){}
}
if( ! function_exists( 'supernova_thumbnail_widget' ) ){
  function supernova_thumbnail_widget($post_id){}
}
if( ! function_exists( 'supernova_title_image' ) ){
  function supernova_title_image(){}
}
if( ! function_exists( 'supernova_display_ad' ) ){
  function supernova_display_ad($id){}
}
if( ! function_exists( 'supernova_ajax_main_button' ) ){
  function supernova_ajax_main_button(){}
}
if( ! function_exists( 'supernova_ajax_tabs' ) ){
  function supernova_ajax_tabs(){}
}
if( ! function_exists( 'supernova_footer_text' ) ){
  function supernova_footer_text(){}
}
if( ! function_exists( 'supernova_content' ) ){
  function supernova_content(){}
}
if( ! function_exists( 'supernova_category_navigation' ) ){
  function supernova_category_navigation(){}
}
if( ! function_exists( 'supernova_update_massage' ) ){
  function supernova_update_massage(){}
}
if( ! function_exists( 'supernova_get_excerpt_by_id' ) ){
  function supernova_get_excerpt_by_id($post_id, $excerpt_length){}
}
if( ! function_exists( 'supernova_tabber_posts' ) ){
  function supernova_tabber_posts($type, $posts_per_page, $show_thumb, $comment_date){}
}
if( ! function_exists( 'supernova_get_selected_tabber' ) ){
  function supernova_get_selected_tabber($id){}
}
if( ! function_exists( 'supernova_checked' ) ){
  function supernova_checked($id, $value ){}
}
if( ! function_exists( 'supernova_ifnotset' ) ){
  function supernova_ifnotset($variable, $else){}
}
if( ! function_exists( 'supernova_get_comments_popup_link' ) ){
  function supernova_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {}
}
if( ! function_exists( 'supernova_get_comments_number_str' ) ){
  function supernova_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {}
}
if( ! function_exists( 'supernova_pagination' ) ){
  function supernova_pagination($pages = '', $range = 2){}
}
if( ! function_exists( 'supernova_count_posts_with_comments' ) ){
  function supernova_count_posts_with_comments(){}
}
if( ! function_exists( 'supernova_count_posts_by_metakey' ) ){
  function supernova_count_posts_by_metakey($meta_key, $meta_value=NULL){}
}
if( ! function_exists( 'supernova_ajax_posts_content' ) ){
  function supernova_ajax_posts_content($post_ids, $outer_class, $inner_class){           }
}
if( ! function_exists( 'supernova_get_specific_post_ids' ) ){
  function supernova_get_specific_post_ids($posts_per_page, $offset, $orderby, $meta_key, $meta_value){}
}
if( ! function_exists( 'supernova_load_main_posts' ) ){
  function supernova_load_main_posts(){}
}
if( ! function_exists( 'supernova_get_popular_posts' ) ){
  function supernova_get_popular_posts(){}
}
if( ! function_exists( 'supernova_get_recommended_posts' ) ){
  function supernova_get_recommended_posts(){}
}
if( ! function_exists( 'supernova_get_sticky_postsids' ) ){
  function supernova_get_sticky_postsids($posts_per_page, $offset, $orderby){}
}
if( ! function_exists( 'supernova_slider_postids' ) ){
  function supernova_slider_postids(){}
}
if( ! function_exists( 'supernova_next_to_logo_items' ) ){
  function supernova_next_to_logo_items(){}
}
if( ! function_exists( 'supernova_header_widget' ) ){
  function supernova_header_widget(){}
}
if( ! function_exists( 'supernova_below_nav_items' ) ){
  function supernova_below_nav_items(){}
}
if( ! function_exists( 'supernova_above_post_items' ) ){
  function supernova_above_post_items(){}
}
if( ! function_exists( 'supernova_below_posts_ad' ) ){
  function supernova_below_posts_ad(){}
}
if( ! function_exists( 'supernova_above_footer_items' ) ){
  function supernova_above_footer_items(){}
}
if( ! function_exists( 'supernova_above_single_posts_items' ) ){
  function supernova_above_single_posts_items(){}
}
if( ! function_exists( 'supernova_below_single_posts_items' ) ){
  function supernova_below_single_posts_items(){}
}
if( ! function_exists( 'supernova_footer_navigation' ) ){
  function supernova_footer_navigation(){}
}
if( ! function_exists( 'supernova_footer_social' ) ){
  function supernova_footer_social(){}
}
if( ! function_exists( 'supernova_meta_content' ) ){
  function supernova_meta_content(){}
}
if( ! function_exists( 'supernova_custom_meta' ) ){
  function supernova_custom_meta() {        }
}
if( ! function_exists( 'supernova_meta_callback' ) ){
  function supernova_meta_callback( $post ) {}
}
if( ! function_exists( 'supernova_meta_save' ) ){
  function supernova_meta_save( $post_id ) {}
}
if( ! function_exists( 'supernova_postoptions_custom_meta' ) ){
  function supernova_postoptions_custom_meta() {        }
}
if( ! function_exists( 'supernova_postoptions_meta_callback' ) ){
  function supernova_postoptions_meta_callback( $post ) {}
}
if( ! function_exists( 'supernova_postoption_meta_save' ) ){
  function supernova_postoption_meta_save( $post_id ) {}
}
if( ! function_exists( 'supernova_tabber' ) ){
  function supernova_tabber(){}
}
if( ! function_exists( 'supernova_recent_posts' ) ){
  function supernova_recent_posts(){}
}
if( ! function_exists( 'supernova_recent_posts' ) ){
  function supernova_recent_posts(){}
}


/*==============================
          Old Classes
===============================*/

if( ! class_exists( 'supernova_admin_enqueue' ) ){
   class supernova_admin_enqueue {
        public function __construct(){}
        public function supernova_admin_styles(){}
        public function supernova_admin_scripts(){}
    }
}

if( ! class_exists( 'supernova_front_enqueue' ) ){
  class supernova_front_enqueue{
    public function __construct(){}
      public function supernova_front_css_enqueue(){}
      public function supernova_load_fonts() {}
      public function supernova_front_script_enqueue(){}
      public function supernova_wp_head(){}
  }
}
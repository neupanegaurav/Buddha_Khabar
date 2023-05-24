<?php
/**
 * Contains Customizer Settings
 */

if ( ! class_exists( 'Nova' ) ) return;

/**
 * Add the configuration.
 * This way all the fields using the 'supernova' ID
 * will inherit these options
 */
Nova::add_config( 'supernova', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/*
|--------------------------------------------------------------------------
| Site Identity
|--------------------------------------------------------------------------
*/

	//Upload logo
	Nova::add_field( 'supernova', array(
		'settings'    => 'sup_logo',
		'label'       => esc_attr__( 'Upload Logo', 'supernova' ),
		'section'     => 'title_tagline',
		'type'        => 'upload',
	));

	//Logo Placement
	Nova::add_field( 'supernova', array(
		'settings' => 'sup_site_identity_placement',
		'label'    => esc_attr__( 'Logo/Title Placement', 'supernova' ),
		'section'  => 'title_tagline',
		'type'     => 'radio-buttonset',
		'default'  => 'left',
		'choices'  => array(
			'left'   => __('Left', 'supernova'),
			'center' => __('Center', 'supernova'),
			'right'  => __('right', 'supernova'),
		),
	));

	//Logo Placement
	Nova::add_field( 'supernova', array(
		'settings' => 'sup_display_header_text',
		'label'    => esc_attr__( 'Display Header Text', 'supernova' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
		'default'  => true,
	));


/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
*/
	Nova::add_section( 'layout', array(
		'title'      => esc_attr__( 'Layout', 'supernova' ),
		'priority'   => 35,
		'capability' => 'edit_theme_options',
	) );


	Nova::add_field( 'supernova', array(
		'type'        => 'radio-image',
		'settings'    => 'sup_sidebar_position',
		'label'       => '',
		'description' => esc_attr__( 'Choose Sidebar Position.', 'supernova' ),
		'section'     => 'layout',
		'default'     => 'right',
		'choices'     => array(
			'left'       => SUPERNOVA_IMG_URI . '/sidebar-left.png',
			'right'      => SUPERNOVA_IMG_URI . '/sidebar-right.png',
			'no_sidebar' => SUPERNOVA_IMG_URI . '/no-sidebar.png',
		),
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'slider',
		'settings'    => 'sup_layout_width',
		'label'       => esc_attr__( 'Layout Width', 'supernova' ),
		'description' => esc_attr__( 'Change the width of the website in pixel.', 'supernova' ),
		'section'     => 'layout',
		'default'     => '1100',
		'output'      => array(
			array(
				'element'  => '.row, .row-container',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.row, .row-container',
				'property' => 'max-width',
				'units'    => 'px',
				'function' => 'css',
			),
		),
		'choices'      => array(
			'min'  => 900,
			'max'  => 1400,
			'step' => 1,
		)
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'slider',
		'settings'    => 'sup_header_padding_top',
		'label'       => esc_attr__( 'Header Padding Top', 'supernova' ),
		'description' => esc_attr__( 'Change the header paddding in pixel.', 'supernova' ),
		'section'     => 'layout',
		'default'     => '40',
		'output'      => array(
			array(
				'element'  => '.sup-site-header',
				'property' => 'padding-top',
				'units'    => 'px',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.sup-site-header',
				'property' => 'padding-top',
				'units'    => 'px',
				'function' => 'css',
			),
		),
		'choices'      => array(
			'min'  => 10,
			'max'  => 150,
			'step' => 1,
		)
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'slider',
		'settings'    => 'sup_header_padding_bottom',
		'label'       => esc_attr__( 'Header Padding Bottom', 'supernova' ),
		'description' => esc_attr__( 'Change the header paddding in pixel.', 'supernova' ),
		'section'     => 'layout',
		'default'     => '40',
		'output'      => array(
			array(
				'element'  => '.sup-site-header',
				'property' => 'padding-bottom',
				'units'    => 'px',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.sup-site-header',
				'property' => 'padding-bottom',
				'units'    => 'px',
				'function' => 'css',
			),
		),
		'choices'      => array(
			'min'  => 10,
			'max'  => 150,
			'step' => 1,
		)
	) );


/*
|--------------------------------------------------------------------------
| Typography
|--------------------------------------------------------------------------
*/

	Nova::add_section( 'sup_typography_section', array(
		'title'      => esc_attr__( 'Typography', 'supernova' ),
		'priority'   => 36,
		'capability' => 'edit_theme_options',
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'select',
		'settings'    => 'sup_body_font_family',
		'label'       => esc_attr__( 'Body Font', 'supernova' ),
		'description' => esc_attr__( 'Would be applied to the content', 'supernova' ),
		'section'     => 'sup_typography_section',
		'default'     => 0,
		'choices'     => sup_font_families(),
	) );

	Nova::add_field( 'supernova', array(
			'type'        => 'slider',
			'settings'    => 'sup_font_size',
			'label'       => esc_attr__( 'Body Font Size', 'supernova' ),
			'description' => esc_attr__( 'Change the font size of the overall website.', 'supernova' ),
			'section'     => 'sup_typography_section',
			'default'     => '16',
			'output'      => array(
				array(
					'element'  => 'html',
					'property' => 'font-size',
					'units'    => 'px',
				),
			),
			'transport'    => 'postMessage',
			'js_vars'      => array(
				array(
					'element'  => 'html',
					'property' => 'font-size',
					'units'    => 'px',
					'function' => 'css',
				),
			),
			'choices'      => array(
				'min'  => 10,
				'max'  => 20,
				'step' => 1,
			)
		) );

/*
|--------------------------------------------------------------------------
| Slider Options
|--------------------------------------------------------------------------
*/

	/*If you change this section name here also change it in js file */
	Nova::add_section( 'slider_options_section', array(
		'title'      => esc_attr__( 'Slider Options', 'supernova' ),
		'priority'   => 37,
		'capability' => 'edit_theme_options',
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Add Slides', 'supernova' ),
		'section'     => 'slider_options_section',
		'button_label' => __( 'Add New Slide' , 'supernova' ),
		'description' => __( 'Slider may not look the same as you see in the preview.' , 'supernova' ),
		'settings'    => 'sup_slides',
		'fields' => array(
			'thumbnail_src' => array(
				'type'  => 'thumbnail_src',
				'label' => esc_attr__( '', 'supernova' ),
			),
			'attachment_id' => array(
				'type'  => 'sup_uploader',
				'label' => esc_attr__( '', 'supernova' ),
			),
			'post_id' => array(
				'type'    => 'select',
				'label'   => esc_attr__( 'Select Post (Optional)', 'supernova' ),
				'choices' => sup_posts_array()
			),
			'title' => array(
				'type'  => 'text',
				'label' => esc_attr__( 'Title', 'supernova' ),
			),
			'excerpt' => array(
				'type'  => 'textarea',
				'label' => esc_attr__( 'Excerpt', 'supernova' ),
			),
		)
	) );

/*
|--------------------------------------------------------------------------
| Display
|--------------------------------------------------------------------------
*/

	Nova::add_panel( 'sup_display_panel', array(
	    'title'       => __( 'Display', 'supernova' ),
	    'priority'   => 38,
	    'capability' => 'edit_theme_options',
	) );

	/*==============================
          Display Navigation
	===============================*/

	Nova::add_section( 'display_nav_section', array(
		'title'      => esc_attr__( 'Display Navigation', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_display_panel',
	) );

	//Top Most Navigation
	Nova::add_field( 'supernova', array(
		'section'  => 'display_nav_section',
		'settings' => 'sup_display_top_most_nav',
		'label'    => esc_attr__( 'Top Most Navigation', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Categories Navigation
	Nova::add_field( 'supernova', array(
		'section'  => 'display_nav_section',
		'settings' => 'sup_display_categories_nav',
		'label'    => esc_attr__( 'Categories Navigation', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Main Navigation
	Nova::add_field( 'supernova', array(
		'section'  => 'display_nav_section',
		'settings' => 'sup_display_main_nav',
		'label'    => esc_attr__( 'Main Navigation', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Main Navigation Search Bar
	Nova::add_field( 'supernova', array(
		'section'  => 'display_nav_section',
		'settings' => 'sup_main_nav_search_bar',
		'label'    => esc_attr__( 'Main Navigation Search', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Sticky Navigation
	Nova::add_field( 'supernova', array(
		'section'  => 'display_nav_section',
		'settings' => 'sup_sticky_nav',
		'label'    => esc_attr__( 'Keep Navigation Sticky', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	/*==============================
	         Capitalization
	===============================*/

	Nova::add_section( 'capitalization_section', array(
		'title'      => esc_attr__( 'Capitalization', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_display_panel',
	) );

	//Navigation Capitalization
	Nova::add_field( 'supernova', array(
		'section'  => 'capitalization_section',
		'settings' => 'sup_nav_capitalization',
		'label'    => esc_attr__( 'Navigation Capitalization', 'supernova' ),
		'type'     => 'select',
		'default'  => 'uppercase',
		'output'   => array(
			array(
				'element'  => '.sup-top-most, .sup-main-nav',
				'property' => 'text-transform',
				'units'    => '',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.sup-top-most, .sup-main-nav',
				'property' => 'text-transform',
				'units'    => '',
				'function' => 'css',
			),
		),

		'choices' => array(
				'uppercase'  => __( 'Uppercase' , 'supernova' ),
				'lowercase'  => __( 'Lowercase' , 'supernova' ),
				'capitalize' => __( 'Capitalize' , 'supernova' ),
				'none'       => __( 'None' , 'supernova' )
			)
	) );

	//Sidebar Capitalization
	Nova::add_field( 'supernova', array(
		'section'  => 'capitalization_section',
		'settings' => 'sup_sidebar_capitalization',
		'label'    => esc_attr__( 'Sidebar Capitalization', 'supernova' ),
		'type'     => 'select',
		'default'  => 'uppercase',
		'output'   => array(
			array(
				'element'  => '.widget-title',
				'property' => 'text-transform',
				'units'    => '',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => '.widget-title',
				'property' => 'text-transform',
				'units'    => '',
				'function' => 'css',
			),
		),

		'choices' => array(
				'uppercase'  => __( 'Uppercase' , 'supernova' ),
				'lowercase'  => __( 'Lowercase' , 'supernova' ),
				'capitalize' => __( 'Capitalize' , 'supernova' ),
				'none'       => __( 'None' , 'supernova' )
			)
	) );

	//Heading Capitalization
	Nova::add_field( 'supernova', array(
		'section'  => 'capitalization_section',
		'settings' => 'sup_heading_capitalization',
		'label'    => esc_attr__( 'Heading Capitalization', 'supernova' ),
		'type'     => 'select',
		'default'  => 'uppercase',
		'output'   => array(
			array(
				'element'  => 'h1,h2,h3,h4,h5,h6',
				'property' => 'text-transform',
				'units'    => '',
			),
		),
		'transport'    => 'postMessage',
		'js_vars'      => array(
			array(
				'element'  => 'h1,h2,h3,h4,h5,h6',
				'property' => 'text-transform',
				'units'    => '',
				'function' => 'css',
			),
		),

		'choices' => array(
				'uppercase'  => __( 'Uppercase' , 'supernova' ),
				'lowercase'  => __( 'Lowercase' , 'supernova' ),
				'capitalize' => __( 'Capitalize' , 'supernova' ),
				'none'       => __( 'None' , 'supernova' )
			)
	) );

	/*==============================
	          Posts And Pages
	===============================*/

	Nova::add_section( 'posts_and_pages_section', array(
		'title'      => esc_attr__( 'Posts And Pages', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_display_panel',
	) );

	//Post Author
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_post_author',
		'label'    => esc_attr__( 'Author Box', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Page Comments
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_page_comments',
		'label'    => esc_attr__( 'Comments on Pages', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Popular Posts
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_popular_posts',
		'label'    => esc_attr__( 'Popular Posts Tab', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Recommended Posts
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_recommended_posts',
		'label'    => esc_attr__( 'Recommended Posts Tab', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Breadcrumb
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_breadcrumb',
		'label'    => esc_attr__( 'Breadcrumb', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Font Resizer
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_font_resizer',
		'label'    => esc_attr__( 'Font Resizer', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Back To Top
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_back_to_top',
		'label'    => esc_attr__( 'Back To Top', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Featured Image on Posts
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_featured_image_on_posts',
		'label'    => esc_attr__( 'Featured image on posts', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

	//Post Navigation below posts
	Nova::add_field( 'supernova', array(
		'section'  => 'posts_and_pages_section',
		'settings' => 'sup_post_nav_below_posts',
		'label'    => esc_attr__( 'Post Navigation Below Posts', 'supernova' ),
		'type'     => 'switch',
		'default'     => true,
	) );

/*
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
*/

	Nova::add_panel( 'sup_content_panel', array(
			'title'      => __( 'Content', 'supernova' ),
			'priority'   => 39,
			'capability' => 'edit_theme_options',
	));

	/*==============================
	          Copyright Text
	===============================*/

	Nova::add_section( 'copyright_text_section', array(
		'title'      => esc_attr__( 'Copyright Text', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_content_panel',
	) );

	//Copyright Text
	Nova::add_field( 'supernova', array(
		'section'  => 'copyright_text_section',
		'settings' => 'sup_copyright_text',
		'label'    => esc_attr__( 'Copyright Text', 'supernova' ),
		'default'  => '© 2015 Supernova Themes',
		'type'     => 'text',
	) );

	/*==============================
	          Header Script
	===============================*/

	Nova::add_section( 'header_script_section', array(
		'title'      => esc_attr__( 'Header Script', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_content_panel',
	) );

	Nova::add_field( 'supernova', array(
		'section'  => 'header_script_section',
		'settings' => 'sup_header_script',
		'label'    => esc_attr__( 'Header Script', 'supernova' ),
		'type'     => 'code',
		'choices'     => array(
			'language' => 'javascript',
			'theme'    => 'none',
			'height'   => 250,
		),
	) );

	/*==============================
	          Post Settings
	===============================*/

	Nova::add_section( 'post_settings_section', array(
		'title'      => esc_attr__( 'Post Settings', 'supernova' ),
		'capability' => 'edit_theme_options',
		'panel'      => 'sup_content_panel',
	) );

	//Popular Posts Dependency
	Nova::add_field( 'supernova', array(
		'section'     => 'post_settings_section',
		'settings'    => 'sup_popular_posts_dependency',
		'label'       => esc_attr__( 'Popular Posts Dependency', 'supernova' ),
		'description' => esc_attr__( 'Popular Tab Posts will be pulled from here. If you select "Let me select" you can select the posts from post editor meta boxes.', 'supernova' ),
		'type'        => 'select',
		'default'     => 'actual-count',
		'choices'     => array(
			'actual-count'       => esc_attr__( 'Actual Count', 'supernova' ),
			'number-of-comments' => esc_attr__( 'Number of Comments', 'supernova' ),
			'let-me-select'      => esc_attr__( 'Let me select', 'supernova' ),
		),
	) );

	//Show Content
	Nova::add_field( 'supernova', array(
		'section'  => 'post_settings_section',
		'settings' => 'sup_content_or_excerpt',
		'label'    => esc_attr__( 'Show Content', 'supernova' ),
		'type'     => 'radio-buttonset',
		'default'  => 'excerpt',
		'choices'     => array(
			'excerpt'   => esc_attr__( 'Excerpt', 'supernova' ),
			'full' => esc_attr__( 'Full', 'supernova' ),
		),
	) );

	//Excerpt Length
	Nova::add_field( 'supernova', array(
		'section'     => 'post_settings_section',
		'settings'    => 'sup_excerpt_length',
		'label'       => esc_attr__( 'Excerpt Length', 'supernova' ),
		'description' => __( 'Will work only if you have excerpt selected above.' , 'supernova' ),
		'type'        => 'slider',
		'default'     => '55',
		'choices'      => array(
			'min'  => 30,
			'max'  => 500,
			'step' => 1,
		)
	) );

	//List Thumbnail Width
	Nova::add_field( 'supernova', array(
		'section'  => 'post_settings_section',
		'settings' => 'sup_list_thumbnail_width',
		'label'    => esc_attr__( 'Thumbnail Width in Listing', 'supernova' ),
		'type'     => 'select',
		'help' 	   => __( 'The thumbnail sizes can be changed from Settings > Media' , 'supernova' ),
		'default'  => 'thumbnail',
		'choices'  => sup_get_image_size()
	) );

	//Manage Meta
	Nova::add_field( 'supernova', array(
		'type'        => 'select',
		'settings'    => 'sup_manage_meta',
		'label'       => esc_attr__( 'Manage Meta', 'supernova' ),
		'default'     => array( 'author', 'date', 'comment' ),
		'section'     => 'post_settings_section',
		'multiple'    => 5,
		'choices'     => array(
			'date'       => esc_attr__( 'Date', 'supernova' ),
			'author'     => esc_attr__( 'Author', 'supernova' ),
			'comment'    => esc_attr__( 'Comment', 'supernova' ),
			'categories' => esc_attr__( 'Categories', 'supernova' ),
			'tags'       => esc_attr__( 'Tags', 'supernova' ),
		),

	) );


/*
|--------------------------------------------------------------------------
| Social Icons
|--------------------------------------------------------------------------
*/

	Nova::add_section( 'social_icons_section', array(
		'title'      => esc_attr__( 'Social Media', 'supernova' ),
		'priority'   => 40,
		'capability' => 'edit_theme_options',
	) );

	$sup_social_icons = array( 'twitter' , 'facebook' , 'google-plus' , 'linkedin' , 'tumblr' , 'pinterest' , 'flickr' , 'github' , 'vimeo' , 'dribbble' , 'skype' , 'instagram' , 'stumbleupon' , 'youtube-play' , 'rss' );

	foreach ($sup_social_icons as $icon )
	{
		Nova::add_field( 'supernova', array(
			'type'        => 'text',
			'label'       => $icon,
			'section'     => 'social_icons_section',
			'settings'    => "sup_social_icons[{$icon}]",
		) );
	}

/*
|--------------------------------------------------------------------------
| Ad Spots
|--------------------------------------------------------------------------
*/

	Nova::add_section( 'ad_spots_section', array(
		'title'      => esc_attr__( 'Ad Spots', 'supernova' ),
		'priority'   => 41,
		'capability' => 'edit_theme_options',
	) );

	$ad_spots = array(
			'header'            => esc_attr__( 'Header' , 'supernova' ),
			'below_nav'         => esc_attr__( 'Below Navigation' , 'supernova' ),
			'above_posts'       => esc_attr__( 'Above Posts' , 'supernova' ),
			'below_posts'       => esc_attr__( 'Below Post' , 'supernova' ),
			'above_single_post' => esc_attr__( 'Above Single Post' , 'supernova' ),
			'below_single_post' => esc_attr__( 'Below Single Post' , 'supernova' ),
			'above_footer'      => esc_attr__( 'Above Footer' , 'supernova' )
		);

	foreach ($ad_spots as $key => $label )
	{
		Nova::add_field( 'supernova', array(
			'section'  => 'ad_spots_section',
			'settings' => "sup_ad_spots[{$key}]",
			'label'    => $label,
			'type'     => 'code',
			'choices'     => array(
				'language' => 'javascript',
				'theme'    => 'neat',
			),
		) );
	}
/*
|--------------------------------------------------------------------------
| Custom CSS
|--------------------------------------------------------------------------
*/

	Nova::add_section( 'custom_css_section', array(
		'title'      => esc_attr__( 'Custom CSS', 'supernova' ),
		'priority'   => 42,
		'capability' => 'edit_theme_options',
	) );

	Nova::add_field( 'supernova', array(
		'type'        => 'code',
		'settings'    => 'sup_custom_css',
		'label'       => esc_attr__( 'CSS', 'supernova' ),
		'section'     => 'custom_css_section',
		'choices'     => array(
			'language' => 'css',
			'theme'    => 'monokai',
			'height'   => 850,
		),
	) );

	/*==============================
			BACKGROUND IMAGE
	===============================*/

	//Footer Background Image
	Nova::add_field( 'supernova', array(
		'type'        => 'upload',
		'settings'    => 'sup_footer_background_image',
		'label'       => esc_attr__( 'Footer Background Image', 'supernova' ),
		'section'     => 'background_image',
		'default'	  => SUPERNOVA_IMG_URI . '/black.png',
		'transport'    => 'postMessage',
		'output'      => array(
			array(
				'element'  => '.sup-site-footer',
				'property' => 'background-image',
			),
		),

	) );


	/*==============================
	         	 Colors
	===============================*/

	//Color Schemes
	Nova::add_field( '', array(
		'type'        => 'palette',
		'settings'     => 'sup_theme_skin',
		'label'       => esc_attr__( 'Theme Skin', 'supernova' ),
		'description' => esc_attr__( 'Change color scheme.', 'supernova' ),
		'section'     => 'colors',
		'default'     => 'db9f0e',
		'choices'     => Sup_Customizer_Front::get_palettes(),
	) );

	//Heading Color
	Nova::add_field( 'supernova', array(
		'type'        => 'color',
		'settings'    => 'sup_heading_color',
		'label'       => esc_attr__( 'Heading Color', 'supernova' ),
		'section'     => 'colors',
		'default'     => '#525252',
		'output'      => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'h1, h2, h3, h4, h5, h6',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	//Footer Heading Color
	Nova::add_field( 'supernova', array(
		'type'        => 'color',
		'settings'    => 'sup_footer_widget_title',
		'label'       => esc_attr__( 'Footer Heading Color', 'supernova' ),
		'section'     => 'colors',
		'default'     => '#fff',
		'output'      => array(
			array(
				'element'  => '.widget-title-footer',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.widget-title-footer',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	//Footer Color
	Nova::add_field( 'supernova', array(
		'type'        => 'color',
		'settings'    => 'sup_footer_color',
		'label'       => esc_attr__( 'Footer Color', 'supernova' ),
		'section'     => 'colors',
		'default'     => '#ccc',
		'output'      => array(
			array(
				'element'  => '.sup-site-footer',
				'property' => 'color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.sup-site-footer',
				'function' => 'css',
				'property' => 'color',
			),
		),
	) );

	//Footer Background Color
	Nova::add_field( 'supernova', array(
		'type'        => 'color',
		'settings'    => 'sup_footer_background-color',
		'label'       => esc_attr__( 'Footer Background Color', 'supernova' ),
		'description' => __( 'Background color will be visible when there is no background image. You can remove background image from "Background Image" section.' , 'supernova' ),
		'section'     => 'colors',
		'default'     => '#000',
		'output'      => array(
			array(
				'element'  => '.sup-site-footer',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => '.sup-site-footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	) );



<?php
/**
 * Rtp admin loads from here.
 * @package supernova
 */

//Enter the path where you have put the admin folder.
define( 'SUPERNOVA_ADMIN_FOLDER_PATH', '/lib/admin/' );

define( 'SUPERNOVA_ADMIN_PATH' 		, get_template_directory() . SUPERNOVA_ADMIN_FOLDER_PATH );
define( 'SUPERNOVA_ADMIN_URI' 		, get_template_directory_uri() . SUPERNOVA_ADMIN_FOLDER_PATH );
define( 'SUPERNOVA_CUSTOMIZER_PATH' , SUPERNOVA_ADMIN_PATH . 'customizer/' );
define( 'SUPERNOVA_CUSTOMIZER_JS' 	, get_template_directory_uri() . SUPERNOVA_ADMIN_FOLDER_PATH . 'customizer/js' );
define( 'SUPERNOVA_CUSTOMIZER_CSS' 	, get_template_directory_uri() . SUPERNOVA_ADMIN_FOLDER_PATH . 'customizer/css' );

//Nova Configration
add_action( 'nova/config', 'sup_theme_url' );
function sup_theme_url( $config ){
	$config['url_path'] = get_template_directory_uri() . '/lib/admin/customizer/nova/';
	return $config;
}

require_once SUPERNOVA_CUSTOMIZER_PATH . 'admin-functions.php';
require_once SUPERNOVA_CUSTOMIZER_PATH . 'class.customizer.php';
require_once SUPERNOVA_CUSTOMIZER_PATH . 'class.customizer-front.php';

require SUPERNOVA_CUSTOMIZER_PATH . 'nova/nova.php';
require SUPERNOVA_CUSTOMIZER_PATH . 'nova-settings.php';

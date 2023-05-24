<?php

/**
 * Do not allow directly accessing this file.
 */
if ( ! class_exists( 'Nova' ) ) {
	die( 'File can\'t be accessed directly' );
}
/**
 * Make sure we set the correct MIME type
 */
header( 'Content-Type: text/css' );
/**
 * Echo the styles
 */
echo Nova_Styles_Frontend::loop_controls();

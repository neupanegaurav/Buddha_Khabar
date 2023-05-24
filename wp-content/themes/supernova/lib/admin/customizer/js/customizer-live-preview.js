/**
 * Handles live preview ajax calls
 * This file is cached by wordpress customizer, so either change the version number dynamically
 * to prevent caching or hard refresh each time to make changes to this file
 */

(function($){

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.sup-site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.sup-site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.sup-site-title, .sup-site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.sup-site-title, .sup-site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	//Body Background
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			if( to ){
				$( 'body' ).css( 'background-image' , 'url(' + to + ')' );
			}
		} );
	} );

	//Footer Background
	wp.customize( 'sup_footer_background_image', function( value ) {
		value.bind( function( to ) {
			$( '.sup-site-footer' ).css( 'background-image' , 'url(' + to + ')' );
		} );
	} );

})(jQuery);


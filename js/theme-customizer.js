( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'link_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('iframe').contents().find('a').css('color',newval );
		} );
	} );
	
	wp.customize( 'body_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('iframe').contents().find( 'body' ).css('color',newval );
		} );
	} );
	
	wp.customize( 'websoln_top_bgcolor', function( value ) {
		value.bind( function( newval ) {
			$('iframe').contents().find('#topbar').css('background',newval );
		} );
	} );
	
	wp.customize( 'websoln_header_bgcolor', function( value ) {
		value.bind( function( newval ) {
			$('iframe').contents().find( '#menu_holder' ).css('background',newval );
		} );
	} );
	
	wp.customize( 'websoln_footer_bgcolor', function( value ) {
		value.bind( function( newval ) {
			$('iframe').contents().find( '#footer #foot_widget_cont' ).css('background',newval );
		} );
	} );

} )( jQuery );
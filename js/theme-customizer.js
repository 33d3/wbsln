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

} )( jQuery );
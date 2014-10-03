
jQuery( document ).ready( function(){

	sameHeightSmallPost();

});


jQuery( window ).resize(function() {

	sameHeightSmallPost();

});

/* Sets the same height */
function sameHeightSmallPost(){

	jQuery( '.small-post-area' ).height( 'auto' );

	/* small box area fix height */
	var maxHeight = 0;
	jQuery( '.small-post-area' ).each( function(){
		
		if ( jQuery( this ).height() > maxHeight ){
			maxHeight = jQuery( this ).height();
		}
		jQuery( '.small-post-area' ).height( maxHeight );
		
	});

}
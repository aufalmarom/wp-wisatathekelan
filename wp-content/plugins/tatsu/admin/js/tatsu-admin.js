(function( $ ) {
	'use strict';

	$(document).ready( function() {
		$(document).on( 'click', '#edit_with_wordpress_editor', function() {
			$('#tatsu_edited_with').val('editor');
			$('body').removeClass('edited_with_tatsu').addClass('edited_with_editor');
		});
	});

})( jQuery );

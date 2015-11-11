(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {
		$('#jsAdd').click(function(event) {
			var data = {
				'action': 'bxwp_newslide'
			};
			jQuery.post(bx_ajax_object.ajax_url, data, function(response) {
				
			});
		});
	});

})( jQuery );

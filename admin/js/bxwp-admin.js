(function( $ ) {
	'use strict';

	jQuery(document).ready(function($) {
		//ADD NEW SLIDE
		jQuery('#jsAdd').click(function(event) {
			var data = {
				'action': 'bxwp_newslide'
			};
			jQuery.post(bx_ajax_object.ajax_url, data, function(response) {
				var post_id = response;
				var html = '<li id="'+post_id+'" class="full-width">'+post_id;
				html += '<div class="edit-icons">';
				html += '<a href="javascript:;" class="js-edit-slide" title="Edit '+post_id+'" slideid="'+post_id+'">';
				html += '<span class="dashicons dashicons-edit"></span>';
				html += ' Edit</a>';
				html += '<a href="javascript:;" class="js-delete-slide" title="Delete '+post_id+'" slideid="'+post_id+'">';
				html += '<span class="dashicons dashicons-trash"></span>';
				html += ' Delete</a>';
				html += '</div>';
				html += '</li>';
				jQuery('#js-slidelist').prepend(html);
			});
		});

		// DELETE SLIDE

		jQuery("#js-slidelist").on("click", ".js-delete-slide", function(){
			var slideid = jQuery(this).attr('slideid');
			jQuery.post(bx_ajax_object.ajax_url, {'action': 'bxwp_delete_slide','slideid':slideid}, function(data, textStatus, xhr) {
				jQuery('li#'+slideid).fadeOut();
				jQuery('li#'+slideid).remove();
			});
		});
	});

})( jQuery );

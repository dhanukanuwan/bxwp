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
				html += '<form id="form'+post_id+'" class="formslide full-width">';
				html += '<div class="full-width form-row">';
				html += '<div class="col-6 column">';
				html += '<label for="slide_name" class="full-width slidelabel">Slideshow Name</label>';
				html += '<input type="text" name="slide_name" id="slide_name" class="forminput full-width" placeholder="Slideshow Name" value="'+post_id+'" />';
				html += '</div>';
				html += '<div class="col-6 column">';
				html += '<label for="slide_type" class="full-width slidelabel">Slideshow Type</label>';
				html += '<select name="slide_type" id="slide_type" class="forminput full-width">';
				html += '<option value="">Select Option</option><option value="imageslide">Image Slider</option><option value="videoslide">Video Slider</option>';
				html += '</select></div>'
				html += '</form>';
				location.reload();
				//jQuery('#js-slidelist').prepend(html);

			});
		});

		// DELETE SLIDE
		jQuery("#js-slidelist").on("click", ".js-delete-slide", function(){
			var slideid = jQuery(this).attr('slideid');
			jQuery.post(bx_ajax_object.ajax_url, {'action': 'bxwp_delete_slide','slideid':slideid}, function(data, textStatus, xhr) {
				location.reload();
				//jQuery('li#'+slideid).fadeOut();
				//jQuery('li#'+slideid).remove();
			});
		});

		//UPDATE SLIDE
		jQuery("#js-slidelist").on("click", ".publish-slide", function(){
			var slideid = jQuery(this).attr('slideid');
			var data = {
				'action': 'bxwp_update_slide',
				'slide_name':jQuery('#slide_name').val(),
				'slideid':slideid
			}
			jQuery.post(bx_ajax_object.ajax_url, data, function(response) {
			  jQuery('li#'+slideid+' .slide-title').text(response);
			});
			
		});
	});

})( jQuery );

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

		//CHECK SLIDER TYPE WHEN ADDING SLIDES TO THE SLIDER
		jQuery('#js-upload-btn').click(function(event) {
			var sliderType = jQuery('#slide_type').val();
			if(sliderType == ''){
				alert('Please select your slideshow type first');
			}
		});

		//UPDATE SLIDESHOW TYPE
		jQuery('#slide_type').change(function(event) {
			var slideshowID = jQuery(this).attr('data-slideshowid');
			var slideType = jQuery(this).val();
			var data = {
				'action': 'bxwp_update_slideshow_type',
				'slideid':slideshowID,
				'slide_type':slideType
			}
			jQuery.post(bx_ajax_object.ajax_url, data, function(response) {
				//location.reload();
			});
		});
	});

})( jQuery );

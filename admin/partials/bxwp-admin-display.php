<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://codeart.lk
 * @since      1.0.0
 *
 * @package    Bxwp
 * @subpackage Bxwp/admin/partials
 */

?>
<div class="wrap" id="bxwp-wrap">
	<div class="full-width">
		<div class="column col-8">
			<h1 class="main-title">Bxwp - Full Bxslider intergration for WordPress</h1>
			<a id="jsAdd" href="javascript:;" class="btn small-btn blue-btn mt10">Add New Slideshow</a>
			<h3 class="full-width">Active Slides</h3>
			<ul id="js-slidelist" class="slidelist full-width">
				<?php $all_slides = get_posts(array('posts_per_page' => -1, 'post_type' => 'bxslides'));
					if(!empty($all_slides)){
						foreach($all_slides as $slide) : ?>
							<?php if(empty($slide->post_title)) :
									$slide_label = $slide->ID;
								  else :
								   	$slide_label = $slide->post_title;
								  endif;
							?>
							<li id="<?php echo $slide->ID; ?>">
								<?php echo $slide_label; ?>
								<div class="edit-icons">
									<a href="javascript:;" class="js-edit-slide" title="Edit <?php echo $slide_label; ?>" slideid="<?php echo $slide->ID;?>"><span class="dashicons dashicons-edit"></span> Edit</a>
									<a href="javascript:;" class="js-delete-slide" title="Delete <?php echo $slide_label; ?>" slideid="<?php echo $slide->ID;?>"><span class="dashicons dashicons-trash"></span> Delete</a>
								</div>
							</li>
							<form id="form<?php echo $slide->ID;?>" class="formslide full-width">
								<div class="full-width form-row">
									<div class="col-6 column">
										<label for="slide_name" class="full-width slidelabel">Slide Name</label>
										<input type="text" name="slide_name" id="slide_name" class="forminput full-width" placeholder="Slide Name" />
									</div>
									<div class="col-6 column">
										<label for="slide_type" class="full-width slidelabel">Slide Type</label>
										<select name="slide_type" id="slide_type" class="forminput full-width">
											<option value="">Select Option</option>
											<option value="imageslide">Image Slider</option>
											<option value="videoslide">Video Slider</option>
										</select>
									</div>
								</div>
							</form>
						<?php endforeach;
					}
				?>
			</ul>
		</div>
	</div>
</div>



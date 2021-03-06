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
				<?php $all_slides = get_posts(array('posts_per_page' => -1, 'post_type' => 'bxslides'));
					if(!empty($all_slides)){ ?>
						<h3 class="full-width">Active Slides</h3>
							<ul id="js-slidelist" class="slidelist full-width">
								<?php foreach($all_slides as $slide) : ?>
									<?php if(empty($slide->post_title)) :
											$slide_label = $slide->ID;
										  else :
										   	$slide_label = $slide->post_title;
										  endif;
									?>
									<li id="<?php echo $slide->ID; ?>" class="full-width">
										<span class="slide-title"><?php echo $slide_label; ?></span>
										<div class="edit-icons">
											<a href="javascript:;" class="publish-slide" slideid="<?php echo $slide->ID;?>">Update</a>
											<a href="javascript:;" class="js-edit-slide" title="Edit <?php echo $slide_label; ?>" slideid="<?php echo $slide->ID;?>"><span class="dashicons dashicons-edit"></span> Edit</a>
											<a href="javascript:;" class="js-delete-slide" title="Delete <?php echo $slide_label; ?>" slideid="<?php echo $slide->ID;?>"><span class="dashicons dashicons-trash"></span> Delete</a>
										</div>
									</li>
									<form id="form<?php echo $slide->ID;?>" class="formslide full-width">
										<div class="full-width form-row">
											<div class="col-6 column">
												<label for="slide_name" class="full-width slidelabel">Slideshow Name</label>
												<input type="text" name="slide_name" id="slide_name" class="forminput full-width" placeholder="Enter Slideshow Name" <?php if(!empty($slide->post_title)){ echo 'value="'.$slide->post_title.'"';}?> />
											</div>
											<div class="col-6 column">
												<label for="slide_type" class="full-width slidelabel">Slideshow Type</label>
												<?php  $slideshow_type = get_post_meta( $slide->ID, 'bxwp_slideshow_type', true); 
													if(!empty($slideshow_type)){
														$disabled = 'disabled';
													}else{
														$disabled = '';
													}
												?>
												<select name="slide_type" id="slide_type" class="forminput full-width" data-slideshowid="<?php echo $slide->ID;?>" <?php echo $disabled;?>>
													<?php $slide_options = array('imageslide' => 'Image Slider', 'videoslide' => 'Video Slider'); ?>
													<option value="">Select Option</option>
													<?php foreach($slide_options as $key => $val) :
															if(!empty($slideshow_type) && $slideshow_type == $key) : ?>
																<option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
														<?php else : ?>
																<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
														<?php endif; endforeach; ?>
												</select>
											</div>
										</div>
										<div class="full-width form-row">
											<div class="col-6 column">
												<label class="upload-btn-label">Add Slides</label>
												<a href="javascript:;" id="js-upload-btn" class="upload-btn">
														<span class="dashicons dashicons-plus"></span>
												</a>
											</div>
										</div>
										<!-- <div class="full-width form-row">
											<div class="col-6 column">
												<?php add_thickbox(); ?>
												<div class="upld-btn-wrap">
													<label class="upload-btn-label">Add Slides</label>
													<a href="#TB_inline?width=600&height=550&inlineId=<?php //echo $slide->ID; ?>-slide-settings" id="js-upload-btn" class="upload-btn thickbox" name="Slide Settings">
														<span class="dashicons dashicons-plus"></span>
													</a>
												</div>
												<div id="<?php //echo $slide->ID; ?>-slide-settings" style="display:none;">
													<h1>test</h1>
												</div>
											</div>
										</div> -->
									</form>
								<?php endforeach; ?>
							</ul>
						<?php } ?>
		</div>
	</div>
</div>



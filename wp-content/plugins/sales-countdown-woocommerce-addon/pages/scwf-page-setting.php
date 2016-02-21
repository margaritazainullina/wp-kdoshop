<?php
global $wpdb;

//get options
$scwf_autoplay = get_option('scwf_autoplay');
$single_or_multiple = get_option('single_or_multiple');
$scwf_controls = get_option('scwf_controls');
$scwf_pagination= get_option('scwf_pagination');
$scwf_stoponhover = get_option('scwf_stoponhover');
$scwf_slide_speed = get_option('scwf_slide_speed');
$scwf_navigation_text_next = get_option('scwf_navigation_text_next');
$scwf_navigation_text_prev = get_option('scwf_navigation_text_prev');

//set options if options are null
if($single_or_multiple == ''){ $single_or_multiple= 3;}else{ $single_or_multiple = 2;}
if($scwf_controls == ''){ $scwf_controls= true;}
if($scwf_pagination == ''){ $scwf_pagination= true;}
if($scwf_slide_speed == ''){ $scwf_slide_speed= 1000;}
if($scwf_navigation_text_next == ''){ $scwf_navigation_text_next= '>';}
if($scwf_navigation_text_prev == ''){ $scwf_navigation_text_prev= '<';}

//sanitize all post values
$countdown_add_opt_submit= sanitize_text_field( $_POST['countdown_add_opt_submit'] );
if($countdown_add_opt_submit!='') { 
	$scwf_autoplay = sanitize_text_field( $_POST['scwf_autoplay'] );
	$single_or_multiple = sanitize_text_field( $_POST['single_or_multiple'] );
	$scwf_controls= sanitize_text_field( $_POST['scwf_controls'] );
	$scwf_pagination= sanitize_text_field( $_POST['scwf_pagination'] );
	$scwf_stoponhover= sanitize_text_field( $_POST['scwf_stoponhover'] );
	$scwf_slide_speed= sanitize_text_field( $_POST['scwf_slide_speed'] );
	$scwf_navigation_text_next= sanitize_text_field( $_POST['scwf_navigation_text_next'] );
	$scwf_navigation_text_prev= sanitize_text_field( $_POST['scwf_navigation_text_prev'] );
	$saved= sanitize_text_field( $_POST['saved'] );


    if(isset($scwf_autoplay) ) {
		update_option('scwf_autoplay', $scwf_autoplay);
    }
	
    if(isset($single_or_multiple) ) {
		update_option('single_or_multiple', $single_or_multiple);
    }
	
	if(isset($scwf_controls) ) {
		update_option('scwf_controls', $scwf_controls);
    }
	if(isset($scwf_pagination) ) {
		update_option('scwf_pagination', $scwf_pagination);
    }
	
	if(isset($scwf_stoponhover) ) {
		update_option('scwf_stoponhover', $scwf_stoponhover);
    }
	
	if(isset($scwf_slide_speed) ) {
		update_option('scwf_slide_speed', $scwf_slide_speed);
    }
	if(isset($scwf_navigation_text_next) ) {
		update_option('scwf_navigation_text_next', $scwf_navigation_text_next);
    }
	if(isset($scwf_navigation_text_prev) ) {
		update_option('scwf_navigation_text_prev', $scwf_navigation_text_prev);
    }
	if($saved==true) {
		
		$message='saved';
	} 
}
  
?>
  <?php
        if ( $message == 'saved' ) {
		echo ' <div class="added-success"><p><strong>Settings Saved.</strong></p></div>';
		}
   ?>
   
    <div class="wrap netgo-countdown-post-setting">
        <form method="post" id="countdownSettingForm" action="">
		<h2><?php _e('Sales Countdown Carousel Settings','');?></h2>
		<table class="form-table">
		
	    <tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_autoplay"><?php _e('Autoplay', '');?></label>
			</th>
			<td>
			<select style="width:120px" name="scwf_autoplay" id="scwf_autoplay">
			<option value='true' <?php if($scwf_autoplay == 'true') { echo "selected='selected'" ; } ?>>True</option>
			<option value='false' <?php if($scwf_autoplay == 'false') { echo "selected='selected'" ; } ?>>False</option>
		   </select>
		   <br />
		   <em><?php _e('Carousel autoplay', ''); ?></em>
			</td>
		</tr>
	    <tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_munber_of_images"><?php _e('Navigation', '');?></label>
			</th>
			<td>
			<select style="width:120px" name="scwf_controls" id="scwf_controls">
			<option value='true' <?php if($scwf_controls == 'true') { echo "selected='selected'" ; } ?>>True</option>
			<option value='false' <?php if($scwf_controls == 'false') { echo "selected='selected'" ; } ?>>False</option>
		   </select>
		   <br />
		   <em><?php _e('Show Left and Right arrow button.', ''); ?></em>
			</td>
		</tr>
	    <tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_slide_speed"><?php _e('Navigation Text','');?></label>
			</th>
			<td>
			<div class="prev-sec" style="float:left">
			<input type="text" name="scwf_navigation_text_prev" size="10" value="<?php echo $scwf_navigation_text_prev; ?>" /><br />
		    <em><?php _e('Previous Text', ''); ?></em>
			</div>
			
			<div class="next-sec" style="float:left">
			<input type="text" name="scwf_navigation_text_next" size="10" value="<?php echo $scwf_navigation_text_next; ?>" /><br />
			<em><?php _e('Next Text', ''); ?></em>
			</td>
			</div>
		</tr>
		
		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_pagination"><?php _e('Pagination','');?></label>
			</th>
			<td>
			<select style="width:120px" name="scwf_pagination" id="scwf_pagination">
			<option value='true' <?php if($scwf_pagination == 'true') { echo "selected='selected'" ; } ?>>True</option>
			<option value='false' <?php if($scwf_pagination == 'false') { echo "selected='selected'" ; } ?>>False</option>
		   </select>
		   <br />
		   <em><?php _e('Show pagination.', ''); ?></em>
			</td>
		</tr>
	    <tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_stoponhover"><?php _e('Stop on Mouse Hover', '');?></label>
			</th>
			<td>
			<select style="width:120px" name="scwf_stoponhover" id="scwf_stoponhover">
			<option value='true' <?php if($scwf_stoponhover == 'true') { echo "selected='selected'" ; } ?>>True</option>
			<option value='false' <?php if($scwf_stoponhover == 'false') { echo "selected='selected'" ; } ?>>False</option>
		   </select>
		   <br />
		   <em><?php _e('Stop carousel on mouse hover.', ''); ?></em><br />
		   <em><?php _e('It will work when "Autoplay" is set to "True".', ''); ?></em>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="scwf_slide_speed"><?php _e('Carousel Speed','');?></label>
			</th>
			<td>
			<input type="text" name="scwf_slide_speed" size="10" value="<?php echo $scwf_slide_speed; ?>" />
		   <br />
		   <em><?php _e('Carousel speed in millisecond. (Ex: 1000)', ''); ?></em>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row" style="width: 370px;">
				<label for="single_or_multiple"><?php _e('Allow 2 Products in Carousel',''); ?></label>
			</th>
			<td>
				<input type="checkbox" <?php if($single_or_multiple == 2){ echo "checked=checked";}?> name="single_or_multiple" size="10" value onclick="jQuery(this).attr('value', this.checked ? 2 : 3)" />
				<em><?php _e('( By default 3 products in carousel )',''); ?></em>
			</td>
		</tr>
		<tr>
		  <td>
		  <p class="submit">
		<input type="hidden" name="saved"  value="saved"/>
        <input type="submit" name="countdown_add_opt_submit" class="button-primary" value="Save Changes" />
		  <?php if(function_exists('wp_nonce_field')) wp_nonce_field('countdown_add_opt_submit', 'countdown_add_opt_submit'); ?>
        </p></td>
		</tr>
		</table>
		
        
       </form>
      
    </div>


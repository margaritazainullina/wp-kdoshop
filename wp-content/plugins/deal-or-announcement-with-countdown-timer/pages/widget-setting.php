<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('Deal with countdown', 'deal-or-announcement-with-countdown-timer'); ?></h2>
	<h3><?php _e('Settings', 'deal-or-announcement-with-countdown-timer'); ?></h3>
    <?php
	$deal_or_announcement_with_countdown_timer_title = get_option('deal_or_announcement_with_countdown_timer_title');
	$deal_or_announcement_with_countdown_timer_timer_color = get_option('deal_or_announcement_with_countdown_timer_timer_color');
	$deal_or_announcement_with_countdown_timer_timer_align = get_option('deal_or_announcement_with_countdown_timer_timer_align');
	$deal_or_announcement_with_countdown_timer_text_color = get_option('deal_or_announcement_with_countdown_timer_text_color');
	$deal_or_announcement_with_countdown_timer_text_align = get_option('deal_or_announcement_with_countdown_timer_text_align');
	$deal_or_announcement_with_countdown_timer_caption = get_option('deal_or_announcement_with_countdown_timer_caption');
	
	if (isset($_POST['gCount_form_submit']) && $_POST['gCount_form_submit'] == 'yes')
	{
		check_admin_referer('gCount_form_setting');
		$deal_or_announcement_with_countdown_timer_title = stripslashes($_POST['deal_or_announcement_with_countdown_timer_title']);
		$deal_or_announcement_with_countdown_timer_timer_color = stripslashes($_POST['deal_or_announcement_with_countdown_timer_timer_color']);
		$deal_or_announcement_with_countdown_timer_timer_align = stripslashes($_POST['deal_or_announcement_with_countdown_timer_timer_align']);
		$deal_or_announcement_with_countdown_timer_text_color = stripslashes($_POST['deal_or_announcement_with_countdown_timer_text_color']);
		$deal_or_announcement_with_countdown_timer_text_align = stripslashes($_POST['deal_or_announcement_with_countdown_timer_text_align']);
		$deal_or_announcement_with_countdown_timer_caption = stripslashes($_POST['deal_or_announcement_with_countdown_timer_caption']);

		update_option('deal_or_announcement_with_countdown_timer_title', $deal_or_announcement_with_countdown_timer_title );
		update_option('deal_or_announcement_with_countdown_timer_timer_color', $deal_or_announcement_with_countdown_timer_timer_color );
		update_option('deal_or_announcement_with_countdown_timer_timer_align', $deal_or_announcement_with_countdown_timer_timer_align );
		update_option('deal_or_announcement_with_countdown_timer_text_color', $deal_or_announcement_with_countdown_timer_text_color );
		update_option('deal_or_announcement_with_countdown_timer_text_align', $deal_or_announcement_with_countdown_timer_text_align );
		update_option('deal_or_announcement_with_countdown_timer_caption', $deal_or_announcement_with_countdown_timer_caption );
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'deal-or-announcement-with-countdown-timer'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo WP_deal_PLUGIN_URL; ?>/pages/gCountdownform.js"></script>
    <form name="ssg_form" method="post" action="">
      
	  <label for="tag-title"><?php _e('Enter widget title', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <input name="deal_or_announcement_with_countdown_timer_title" id="deal_or_announcement_with_countdown_timer_title" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_title; ?>" size="60" maxlength="1000" />
      <p><?php _e('Please enter your widget title.', 'deal-or-announcement-with-countdown-timer'); ?></p>
      
	  <label for="tag-title"><?php _e('Timer caption', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <input name="deal_or_announcement_with_countdown_timer_caption" id="deal_or_announcement_with_countdown_timer_caption" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_caption; ?>" size="60" maxlength="1000" />
      <p><?php _e('Please enter your timer caption.', 'deal-or-announcement-with-countdown-timer'); ?></p>

	  <label for="tag-title"><?php _e('Timer color', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <input name="deal_or_announcement_with_countdown_timer_timer_color" id="deal_or_announcement_with_countdown_timer_timer_color" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_timer_color; ?>" maxlength="7" />
      <p><?php _e('Please enter your timer color.', 'deal-or-announcement-with-countdown-timer'); ?></p>

	  <label for="tag-title"><?php _e('Text color', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <input name="deal_or_announcement_with_countdown_timer_text_color" id="deal_or_announcement_with_countdown_timer_text_color" type="text" value="<?php echo $deal_or_announcement_with_countdown_timer_text_color; ?>" maxlength="7" />
      <p><?php _e('Please enter your text color.', 'deal-or-announcement-with-countdown-timer'); ?></p>

	  <label for="tag-title"><?php _e('Timer alignment', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="deal_or_announcement_with_countdown_timer_timer_align" id="deal_or_announcement_with_countdown_timer_timer_align">
		<option value="Left" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Left') { echo 'selected="selected"' ; } ?>>Left</option>
		<option value="Right" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Right') { echo 'selected="selected"' ; } ?>>Right</option>
		<option value="Center" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Center') { echo 'selected="selected"' ; } ?>>Center</option>
		<option value="Justify" <?php if($deal_or_announcement_with_countdown_timer_timer_align=='Justify') { echo 'selected="selected"' ; } ?>>Justify</option>
	  </select>
      <p><?php _e('Please select your timer alignment.', 'deal-or-announcement-with-countdown-timer'); ?></p>

	  <label for="tag-title"><?php _e('Text alignment', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="deal_or_announcement_with_countdown_timer_text_align" id="deal_or_announcement_with_countdown_timer_text_align">
		<option value="Left" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Left') { echo 'selected="selected"' ; } ?>>Left</option>
		<option value="Right" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Right') { echo 'selected="selected"' ; } ?>>Right</option>
		<option value="Center" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Center') { echo 'selected="selected"' ; } ?>>Center</option>
		<option value="Justify" <?php if($deal_or_announcement_with_countdown_timer_text_align=='Justify') { echo 'selected="selected"' ; } ?>>Justify</option>
	  </select>
      <p><?php _e('Please select your text alignment.', 'deal-or-announcement-with-countdown-timer'); ?></p>
	   
	  <p style="padding-bottom:5px;padding-top:5px;">
		  <input name="gCountsubmit" id="gCountsubmit" class="button" value="<?php _e('Submit', 'deal-or-announcement-with-countdown-timer'); ?>" type="submit" />
		  <input name="publish" lang="publish" class="button" onclick="gCountredirect()" value="<?php _e('Cancel', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
		  <input name="Help" lang="publish" class="button" onclick="gCounthelp()" value="<?php _e('Help', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
	  </p>
	  <input name="gCount_form_submit" id="gCount_form_submit" value="yes" type="hidden" />
	  <?php wp_nonce_field('gCount_form_setting'); ?>
    </form>
  </div>
<p class="description">
	<?php _e('Check official website for more information', 'deal-or-announcement-with-countdown-timer'); ?>
	<a target="_blank" href="<?php echo WP_deal_FAV; ?>"><?php _e('click here', 'deal-or-announcement-with-countdown-timer'); ?></a>
</p>
</div>

<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$gCounterrors = array();
$gCountsuccess = '';
$gCounterror_found = FALSE;

// Preset the form fields
$form = array(
	'gCount' => '',
	'gCountdisplay' => '',
	'gCountmonth' => '',
	'gCountdate' => '',
	'gCountyear' => '',
	'gCounthour' => '',
	'gCountzoon' => '',
	'gCountid' => ''
);

// Form submitted, check the data
if (isset($_POST['gCountform_submit']) && $_POST['gCountform_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('gCountform_add');
	
	$form['gCount'] = isset($_POST['gCount']) ? $_POST['gCount'] : '';
	if ($form['gCount'] == '')
	{
		$gCounterrors[] = __('Please enter the announcement.', 'deal-or-announcement-with-countdown-timer');
		$gCounterror_found = TRUE;
	}

	$form['gCountdisplay'] = isset($_POST['gCountdisplay']) ? $_POST['gCountdisplay'] : '';
	$form['gCountmonth'] = isset($_POST['gCountmonth']) ? $_POST['gCountmonth'] : '';
	$form['gCountdate'] = isset($_POST['gCountdate']) ? $_POST['gCountdate'] : '';
	$form['gCountyear'] = isset($_POST['gCountyear']) ? $_POST['gCountyear'] : '';
	$form['gCounthour'] = isset($_POST['gCounthour']) ? $_POST['gCounthour'] : '';
	$form['gCountzoon'] = isset($_POST['gCountzoon']) ? $_POST['gCountzoon'] : '';

	//	No errors found, we can add this Group to the table
	if ($gCounterror_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".WP_G_Countdown_TABLE."`
			(`gCount`, `gCountdisplay`, `gCountmonth`, `gCountdate`, `gCountyear`, `gCounthour`, `gCountzoon`)
			VALUES(%s, %s, %s, %s, %s, %s, %s)",
			array($form['gCount'], $form['gCountdisplay'], $form['gCountmonth'], $form['gCountdate'], $form['gCountyear'], $form['gCounthour'], $form['gCountzoon'])
		);
		$wpdb->query($sql);
		
		$gCountsuccess = __('New details was successfully added.', 'deal-or-announcement-with-countdown-timer');
		
		// Reset the form fields
		$form = array(
			'gCount' => '',
			'gCountdisplay' => '',
			'gCountmonth' => '',
			'gCountdate' => '',
			'gCountyear' => '',
			'gCounthour' => '',
			'gCountzoon' => '',
			'gCountid' => ''
		);
	}
}

if ($gCounterror_found == TRUE && isset($gCounterrors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $gCounterrors[0]; ?></strong></p>
	</div>
	<?php
}
if ($gCounterror_found == FALSE && strlen($gCountsuccess) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $gCountsuccess; ?> 
		<a href="<?php echo WP_deal_ADMIN_URL; ?>"><?php _e('Click here to view the details', 'deal-or-announcement-with-countdown-timer'); ?></a></strong></p>
	  </div>
	  <?php
}
?>
<script language="JavaScript" src="<?php echo WP_deal_PLUGIN_URL; ?>/pages/gCountdownform.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('Deal with countdown', 'deal-or-announcement-with-countdown-timer'); ?></h2>
	<form name="gCountform" method="post" action="#" onsubmit="return gCountdownform()"  >
      <h3><?php _e('Add new details', 'deal-or-announcement-with-countdown-timer'); ?></h3>
      
	  <label for="tag-txt"><?php _e('Announcement', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <textarea name="gCount" id="gCount" cols="100" rows="6"></textarea>
      <p><?php _e('Please enter your announcement text.', 'deal-or-announcement-with-countdown-timer'); ?></p>
      
      <label for="tag-txt"><?php _e('Display status', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="gCountdisplay" id="gCountdisplay">
        <option value=''>Select</option>
		<option value='YES'>Yes</option>
        <option value='NO'>No</option>
      </select>
      <p><?php _e('Do you want to show this announcement?', 'deal-or-announcement-with-countdown-timer'); ?></p>
	  
	  <label for="tag-txt"><?php _e('Expiration', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="gCountmonth" id="gCountmonth">
		<option value="">--Month--</option>
		<option value='1'>January</option>
		<option value='2'>February</option>
		<option value='3'>March</option>
		<option value='4'>April</option>
		<option value='5'>May</option>
		<option value='6'>June</option>
		<option value='7'>July</option>
		<option value='8'>August</option>
		<option value='9'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
	  </select>
	  <select name="gCountdate" id="gCountdate">
		<option value="">--Date--</option>
		<?php 
		for($dd = 1; $dd <= 31; $dd++)
		{
			?><option value='<?php echo $dd?>'><?php echo $dd?></option><?php
		}
		?>
	  </select>
	  <select name="gCountyear" id="gCountyear">
		<option value="">--Year--</option>
		<?php 
		for($yy = 2013; $yy <= 2020; $yy++)
		{
			?><option value='<?php echo $yy?>' ><?php echo $yy?></option><?php
		}
		?>
	  </select>
	  <select name="gCounthour" id="gCounthour">
		<option value="">--Time--</option>
		<?php 
		for($hh=1; $hh<=12; $hh++)
		{
			?><option value='<?php echo $hh?>'><?php echo $hh?></option><?php
		}
		?>
      </select>
	  <select name="gCountzoon" id="gCountzoon">
		<option value="">--AM/PM--</option>
		<option value="AM">AM</option>
		<option value="PM">PM</option>
	  </select>
      <p><?php _e('Please select your expiration date.', 'deal-or-announcement-with-countdown-timer'); ?></p>
	  
      <input name="gCountid" id="gCountid" type="hidden" value="">
      <input type="hidden" name="gCountform_submit" value="yes"/>
      <p style="padding-top:8px;padding-bottom:8px;">
        <input name="publish" lang="publish" class="button" value="<?php _e('Submit', 'deal-or-announcement-with-countdown-timer'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button" onclick="gCountredirect()" value="<?php _e('Cancel', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
        <input name="Help" lang="publish" class="button" onclick="gCounthelp()" value="<?php _e('Help', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('gCountform_add'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'deal-or-announcement-with-countdown-timer'); ?>
	<a target="_blank" href="<?php echo WP_deal_FAV; ?>"><?php _e('click here', 'deal-or-announcement-with-countdown-timer'); ?></a>
</p>
</div>
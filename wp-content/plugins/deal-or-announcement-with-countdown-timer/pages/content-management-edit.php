<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$did = isset($_GET['did']) ? $_GET['did'] : '0';
if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }

// First check if ID exist with requested ID
$sSql = $wpdb->prepare(
	"SELECT COUNT(*) AS `count` FROM ".WP_G_Countdown_TABLE."
	WHERE `gCountid` = %d",
	array($did)
);
$result = '0';
$result = $wpdb->get_var($sSql);

if ($result != '1')
{
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'deal-or-announcement-with-countdown-timer'); ?></strong></p></div><?php
}
else
{
	$gCounterrors = array();
	$gCountsuccess = '';
	$gCounterror_found = FALSE;
	
	$sSql = $wpdb->prepare("
		SELECT *
		FROM `".WP_G_Countdown_TABLE."`
		WHERE `gCountid` = %d
		LIMIT 1
		",
		array($did)
	);
	$data = array();
	$data = $wpdb->get_row($sSql, ARRAY_A);
	
	// Preset the form fields
	$form = array(
		'gCount' => $data['gCount'],
		'gCountdisplay' => $data['gCountdisplay'],
		'gCountmonth' => $data['gCountmonth'],
		'gCountdate' => $data['gCountdate'],
		'gCountyear' => $data['gCountyear'],
		'gCounthour' => $data['gCounthour'],
		'gCountzoon' => $data['gCountzoon'],
		'gCountid' => $data['gCountid'],
	);
}
// Form submitted, check the data
if (isset($_POST['gCountform_submit']) && $_POST['gCountform_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('gCountform_edit');
	
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
		$sSql = $wpdb->prepare(
				"UPDATE `".WP_G_Countdown_TABLE."`
				SET `gCount` = %s,
				`gCountdisplay` = %s,
				`gCountmonth` = %s,
				`gCountdate` = %s,
				`gCountyear` = %s,
				`gCounthour` = %s,
				`gCountzoon` = %s
				WHERE gCountid = %d
				LIMIT 1",
				array($form['gCount'], $form['gCountdisplay'], $form['gCountmonth'], $form['gCountdate'], $form['gCountyear'], $form['gCounthour'], $form['gCountzoon'], $did)
			);
		$wpdb->query($sSql);
		
		$gCountsuccess = __('Details was successfully updated.', 'deal-or-announcement-with-countdown-timer');
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
	<form name="gCountform" method="post" action="#" onsubmit="return gCountsubmit()"  >
      <h3><?php _e('Update details', 'deal-or-announcement-with-countdown-timer'); ?></h3>
	  
	  <label for="tag-txt"><?php _e('Announcement', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <textarea name="gCount" id="gCount" cols="100" rows="6"><?php echo esc_html(stripslashes($form['gCount'])); ?></textarea>
      <p><?php _e('Please enter your announcement text.', 'deal-or-announcement-with-countdown-timer'); ?></p>
      
      <label for="tag-txt"><?php _e('Display status', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="gCountdisplay" id="gCountdisplay">
        <option value=''>Select</option>
		<option value='YES' <?php if($form['gCountdisplay']=='YES') { echo 'selected="selected"' ; } ?>>Yes</option>
        <option value='NO' <?php if($form['gCountdisplay']=='NO') { echo 'selected="selected"' ; } ?>>No</option>
      </select>
      <p><?php _e('Do you want to show this announcement?', 'deal-or-announcement-with-countdown-timer'); ?></p>
	  
	  <label for="tag-txt"><?php _e('Expiration', 'deal-or-announcement-with-countdown-timer'); ?></label>
      <select name="gCountmonth" id="gCountmonth">
		<option value="">--Month--</option>
		<option value='1' <?php if($form['gCountmonth']=='1') { echo 'selected="selected"' ; } ?>>January</option>
		<option value='2' <?php if($form['gCountmonth']=='2') { echo 'selected="selected"' ; } ?>>February</option>
		<option value='3' <?php if($form['gCountmonth']=='3') { echo 'selected="selected"' ; } ?>>March</option>
		<option value='4' <?php if($form['gCountmonth']=='4') { echo 'selected="selected"' ; } ?>>April</option>
		<option value='5' <?php if($form['gCountmonth']=='5') { echo 'selected="selected"' ; } ?>>May</option>
		<option value='6' <?php if($form['gCountmonth']=='6') { echo 'selected="selected"' ; } ?>>June</option>
		<option value='7' <?php if($form['gCountmonth']=='7') { echo 'selected="selected"' ; } ?>>July</option>
		<option value='8' <?php if($form['gCountmonth']=='8') { echo 'selected="selected"' ; } ?>>August</option>
		<option value='9' <?php if($form['gCountmonth']=='9') { echo 'selected="selected"' ; } ?>>September</option>
		<option value='10' <?php if($form['gCountmonth']=='10') { echo 'selected="selected"' ; } ?>>October</option>
		<option value='11' <?php if($form['gCountmonth']=='11') { echo 'selected="selected"' ; } ?>>November</option>
		<option value='12' <?php if($form['gCountmonth']=='12') { echo 'selected="selected"' ; } ?>>December</option>
	  </select>
	  <select name="gCountdate" id="gCountdate">
		<option value="">--Date--</option>
		<?php 
		$select = "";
		for($dd = 1; $dd <= 31; $dd++)
		{
			if($dd == $form['gCountdate'])
			{
				$select = 'selected="selected"';
			}
			?><option value="<?php echo $dd?>" <?php echo $select; ?>><?php echo $dd?></option><?php
			$select = "";
		}
		?>
	  </select>
	  <select name="gCountyear" id="gCountyear">
		<option value="">--Year--</option>
		<?php
		$select = ""; 
		for($yy = 2013; $yy <= 2020; $yy++)
		{
			if($yy == $form['gCountyear'])
			{
				$select = 'selected="selected"';
			}
			?><option value="<?php echo $yy?>" <?php echo $select; ?> ><?php echo $yy; ?></option><?php
			$select = "";
		}
		?>
	  </select>
	  <select name="gCounthour" id="gCounthour">
		<option value="">--Time--</option>
		<?php 
		$select = "";
		for($hh=1; $hh<=12; $hh++)
		{
			if($hh == $form['gCounthour'])
			{
				$select = 'selected="selected"';
			}
			?><option value="<?php echo $hh?>" <?php echo $select; ?> ><?php echo $hh; ?></option><?php
			$select = "";
		}
		?>
      </select>
	  <select name="gCountzoon" id="gCountzoon">
		<option value="">--AM/PM--</option>
		<option value="AM" <?php if($form['gCountzoon']=='AM') { echo 'selected="selected"' ; } ?>>AM</option>
		<option value="PM" <?php if($form['gCountzoon']=='PM') { echo 'selected="selected"' ; } ?>>PM</option>
	  </select>
      <p><?php _e('Please select your expiration date.', 'deal-or-announcement-with-countdown-timer'); ?></p>
	  
      <input name="gCountid" id="gCountid" type="hidden" value="">
      <input type="hidden" name="gCountform_submit" value="yes"/>
      <p style="padding-top:8px;padding-bottom:8px;">
        <input name="publish" lang="publish" class="button" value="<?php _e('Submit', 'deal-or-announcement-with-countdown-timer'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button" onclick="gCountredirect()" value="<?php _e('Cancel', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
        <input name="Help" lang="publish" class="button" onclick="gCounthelp()" value="<?php _e('Help', 'deal-or-announcement-with-countdown-timer'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('gCountform_edit'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'deal-or-announcement-with-countdown-timer'); ?>
	<a target="_blank" href="<?php echo WP_deal_FAV; ?>"><?php _e('click here', 'deal-or-announcement-with-countdown-timer'); ?></a>
</p>
</div>
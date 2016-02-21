<?php
/*
Plugin Name: Countdown
Plugin URI: http://studio.bloafer.com/wordpress-plugins/countdown/
Description: This plugin adds a shortcode [countdown] to WP allowing you to place a countdown timer on your page.
Version: 0.2
Author: Kerry James
Author URI: http://studio.bloafer.com/
*/
function countdown_shortcode_handler( $args, $content = null ){
	$dateEnd = date("Y-m-d H:i:s", strtotime("now +3 hours"));
	$theme = "default";
	$tz = false; //"America/Los_Angeles";

	if(isset($args["date"])){ $dateEnd = $args["date"]; }
	if(isset($args["theme"])){ $theme = $args["theme"]; }
	if(isset($args["timezone"])){ $tz = $args["timezone"]; }

	ob_start();
	if($tz){
		$oldtz = date_default_timezone_get();
		date_default_timezone_set($tz); // Change locale
	}
	
	$strTime = strtotime($dateEnd);
	$randID = md5(rand(9000, 10000));
?>
<link href="<?php print plugins_url('countdown/theme/' . $theme . '/style.css') ?>" type="text/css" rel="stylesheet" />
<div id="<?php print $randID ?>" class="countdown"><?php print date("l jS \of F Y h:i:s A", $strTime) ?></div>

<script>
var dateFuture = new Date(<?php print date("Y", $strTime) ?>,<?php print (date("m", $strTime)-1) ?>,<?php print date("d", $strTime) ?>,<?php print date("h", $strTime) ?>,<?php print date("i", $strTime) ?>,<?php print date("s", $strTime) ?>);

function count<?php print $randID ?>timer(){
	dateNow = new Date();
	amount = dateFuture.getTime() - dateNow.getTime()+5;
	delete dateNow;
	if(amount < 0){
		jQuery("#<?php print $randID ?> .days .number").html("0");
		jQuery("#<?php print $randID ?> .hour .number").html("0");
		jQuery("#<?php print $randID ?> .mins .number").html("0");
		jQuery("#<?php print $randID ?> .secs .number").html("0");
	}else{
		days = 0;
		hours = 0;
		mins = 0;
		secs = 0;
		amount = Math.floor(amount / 1000);
		days = Math.floor(amount / 86400);
		amount = amount % 86400;
		hours = Math.floor(amount / 3600);
		amount = amount % 3600;
		mins = Math.floor(amount / 60);
		amount = amount % 60;
		secs = Math.floor(amount);
		if(jQuery("#<?php print $randID ?> .days .number").html()!=days){
			jQuery("#<?php print $randID ?> .days .number").html(days);
		}
		if(jQuery("#<?php print $randID ?> .hour .number").html()!=hours){
			jQuery("#<?php print $randID ?> .hour .number").html(hours);
		}
		if(jQuery("#<?php print $randID ?> .mins .number").html()!=mins){
			jQuery("#<?php print $randID ?> .mins .number").html(mins);
		}
		if(jQuery("#<?php print $randID ?> .secs .number").html()!=secs){
			jQuery("#<?php print $randID ?> .secs .number").html(secs);
		}

		if(days==0){ jQuery("#<?php print $randID ?> .days").hide(); }
		
		setTimeout("count<?php print $randID ?>timer()", 1000);
	}
}
jQuery(document).ready(function(){
	var holder_stuff = '<span class="number"></span><span class="over"></span><span class="title"></span>';
	var holder_days = jQuery("<span>").addClass("days").addClass("item").html(holder_stuff);
	var holder_hour = jQuery("<span>").addClass("hour").addClass("item").html(holder_stuff);
	var holder_mins = jQuery("<span>").addClass("mins").addClass("item").html(holder_stuff);
	var holder_secs = jQuery("<span>").addClass("secs").addClass("item").html(holder_stuff);
	jQuery("#<?php print $randID ?>").html("").append(holder_days).append(holder_hour).append(holder_mins).append(holder_secs);
	count<?php print $randID ?>timer();
});
</script>
<?php
	if($tz){
		date_default_timezone_set($oldtz); // Restore current time
	}
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode('countdown', 'countdown_shortcode_handler');

function countdown_wp_enqueue_scripts(){
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'countdown_wp_enqueue_scripts');

?>

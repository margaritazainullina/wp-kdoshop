<?php
/*
Plugin Name: deal or announcement with countdown timer
Plugin URI: http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/
Description: This plugin will display your announcement with countdown timer.
Author: Gopi Ramasamy
Version: 9.0
Author URI: http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/
Donate link: http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/
Text Domain: deal-or-announcement-with-countdown-timer
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

global $wpdb, $wp_version;
define("WP_G_Countdown_TABLE", $wpdb->prefix . "gCountdown");
define('WP_deal_FAV', 'http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/');

if ( ! defined( 'WP_deal_PLUGIN_BASENAME' ) )
	define( 'WP_deal_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'WP_deal_PLUGIN_NAME' ) )
	define( 'WP_deal_PLUGIN_NAME', trim( dirname( WP_deal_PLUGIN_BASENAME ), '/' ) );

if ( ! defined( 'WP_deal_PLUGIN_DIR' ) )
	define( 'WP_deal_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WP_deal_PLUGIN_NAME );

if ( ! defined( 'WP_deal_PLUGIN_URL' ) )
	define( 'WP_deal_PLUGIN_URL', WP_PLUGIN_URL . '/' . WP_deal_PLUGIN_NAME );
	
if ( ! defined( 'WP_deal_ADMIN_URL' ) )
	define( 'WP_deal_ADMIN_URL', get_option('siteurl') . '/wp-admin/options-general.php?page=deal-with-countdown' );

function deal() 
{
	deal_or_announcement_with_countdown_timer_show();
}

function deal_or_announcement_with_countdown_timer_show() 
{
	global $wpdb;
	$data = $wpdb->get_results("select * from ".WP_G_Countdown_TABLE." where gCountdisplay='YES' ORDER BY gCountid DESC LIMIT 0 , 1");
	if ( ! empty($data) ) 
	{
		$data = $data[0];
		if ( !empty($data)) $gCountid = $data->gCountid;
		if ( !empty($data)) $gCount = stripslashes($data->gCount); 
		if ( !empty($data)) $gCountmonth = $data->gCountmonth;
		if ( !empty($data)) $gCountdate = $data->gCountdate;
		if ( !empty($data)) $gCountyear = $data->gCountyear;
		if ( !empty($data)) $gCounthour = $data->gCounthour;
		if ( !empty($data)) $gCountzoon = $data->gCountzoon;
		if ( !empty($data)) $gCountdisplay = $data->gCountdisplay;
		
		$displayformats  = "<div><span style='width:35px;display:inline-block;'>%%D%%</span><span style='width:35px;display:inline-block;'>%%H%%</span><span style='width:35px;display:inline-block;'>%%M%%</span><span style='width:35px;display:inline-block;'>%%S%%</span></div><div><span style='width:35px;display:inline-block;'>Day</span><span style='width:35px;display:inline-block;'>Hrs</span><span style='width:35px;display:inline-block;'>Min</span><span style='width:35px;display:inline-block;'>Sec</span></div>"
		
		?>
		<script language="JavaScript">
        TargetDate = "<?php echo $gCountmonth;?>/<?php echo $gCountdate;?>/<?php echo $gCountyear;?> <?php echo $gCounthour;?>:00 <?php echo $gCountzoon;?>";
        BackColor = "";
        ForeColor = "<?php echo get_option('deal_or_announcement_with_countdown_timer_timer_color')?>";
        CountActive = true;
        CountStepper = -1;
        LeadingZero = true;
		DisplayFormat = "<?php echo $displayformats;?>";
        FinishMessage = "<div style='padding:5px 0px 5px 0px;' class='over' align='center'>Time Out!</div>";
        </script>
        <div style="padding:5px 0px 0px 0px;color:<?php echo get_option('deal_or_announcement_with_countdown_timer_text_color'); ?>" align="<?php echo get_option('deal_or_announcement_with_countdown_timer_text_align'); ?>"> <?php echo $gCount; ?> </div>
        <?php if(get_option('deal_or_announcement_with_countdown_timer_caption')<>"") { ?>
        <div align="<?php echo get_option('deal_or_announcement_with_countdown_timer_timer_align'); ?>" style="padding:10px 0px 3px 0px;color:<?php echo get_option('deal_or_announcement_with_countdown_timer_timer_color')?>"><?php echo get_option('deal_or_announcement_with_countdown_timer_caption'); ?></div>
        <?php } ?>
        <div class="announcementtime" id="announcementtime" style="padding:0px 0px 10px 0px;" align="<?php echo get_option('deal_or_announcement_with_countdown_timer_timer_align'); ?>"> 
          <script language="JavaScript" src="<?php echo WP_deal_PLUGIN_URL; ?>/gCountdown.js"></script> 
        </div>
        <?php
	}
	else
	{
		echo "<div style='padding:5px 0px 5px 0px;' class='over' align='center'>No data available in announcement!</div>";
	}
}
function deal_or_announcement_with_countdown_timer_install() 
{
	global $wpdb;

	//set the messages
	if($wpdb->get_var("show tables like '". WP_G_Countdown_TABLE . "'") != WP_G_Countdown_TABLE) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". WP_G_Countdown_TABLE . "` (
			  `gCountid` int(11) NOT NULL auto_increment,
			  `gCount` text  NOT NULL,
			  `gCountmonth` int(11) NOT NULL default '0',
			  `gCountdate` int(11) NOT NULL default '0',
			  `gCountyear` int(11) NOT NULL default '0',
			  `gCounthour` int(11) NOT NULL default '0',
			  `gCountzoon` varchar(5) NOT NULL default '',
			  `gCountdisplay` varchar(5) NOT NULL default '',
  			  PRIMARY KEY  (`gCountid`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			");
			
		$sSql = "INSERT INTO `". WP_G_Countdown_TABLE . "` (`gCount` , `gCountmonth` ,`gCountdate` ,`gCountyear` ,`gCounthour` ,`gCountzoon` ,`gCountdisplay`) VALUES ";
		$sSql = $sSql . "('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', ";
		$sSql = $sSql . "'01', '01', '2018', '12', 'AM', 'YES');";
		$wpdb->query($sSql);
	}

	add_option('deal_or_announcement_with_countdown_timer_title', 'Announcement');
	add_option('deal_or_announcement_with_countdown_timer_timer_color', '#2D2D2D');
	add_option('deal_or_announcement_with_countdown_timer_timer_align', 'Center');
	add_option('deal_or_announcement_with_countdown_timer_text_color', '#DD4B39');
	add_option('deal_or_announcement_with_countdown_timer_text_align', 'Justify');
	add_option('deal_or_announcement_with_countdown_timer_caption', 'This is a limited time offer..');
}

function deal_or_announcement_with_countdown_timer_widget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo get_option('deal_or_announcement_with_countdown_timer_title');
	echo $after_title;
	deal_or_announcement_with_countdown_timer_show();
	echo $after_widget;
}

function deal_or_announcement_with_countdown_timer_control() 
{
		$deal_or_announcement_with_countdown_timer_title = get_option('deal_or_announcement_with_countdown_timer_title');
		$deal_or_announcement_with_countdown_timer_timer_color = get_option('deal_or_announcement_with_countdown_timer_timer_color');
		$deal_or_announcement_with_countdown_timer_timer_align = get_option('deal_or_announcement_with_countdown_timer_timer_align');
		$deal_or_announcement_with_countdown_timer_text_color = get_option('deal_or_announcement_with_countdown_timer_text_color');
		$deal_or_announcement_with_countdown_timer_text_align = get_option('deal_or_announcement_with_countdown_timer_text_align');
		$deal_or_announcement_with_countdown_timer_caption = get_option('deal_or_announcement_with_countdown_timer_caption');
		
		if (@$_POST['deal_or_announcement_with_countdown_timer_submit']) 
		{
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
		}
		
		echo '<p>Sidebar title text:<br><input  style="width: 325px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_title . '" name="deal_or_announcement_with_countdown_timer_title" id="deal_or_announcement_with_countdown_timer_title" /></p>';
		
		echo '<p>Count down timer title text:<br><input  style="width: 325px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_caption . '" name="deal_or_announcement_with_countdown_timer_caption" id="deal_or_announcement_with_countdown_timer_caption" /></p>';

		echo '<p>Timer color:&nbsp;<input  style="width: 100px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_timer_color . '" name="deal_or_announcement_with_countdown_timer_timer_color" id="deal_or_announcement_with_countdown_timer_timer_color" />';
		
		echo '&nbsp;&nbsp;Text color:&nbsp;<input  style="width: 100px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_text_color . '" name="deal_or_announcement_with_countdown_timer_text_color" id="deal_or_announcement_with_countdown_timer_text_color" /></p>';

		echo '<p>Timer align:&nbsp;<input  style="width: 100px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_timer_align . '" name="deal_or_announcement_with_countdown_timer_timer_align" id="deal_or_announcement_with_countdown_timer_timer_align" />';
		
		echo '&nbsp;&nbsp;Text align:&nbsp;<input  style="width: 100px;" type="text" value="';
		echo $deal_or_announcement_with_countdown_timer_text_align . '" name="deal_or_announcement_with_countdown_timer_text_align" id="deal_or_announcement_with_countdown_timer_text_align" /></p>';

		echo 'Alignment : Left / Right / Center / Justify';
		
		echo '<br><br>';

		echo '<input type="hidden" id="deal_or_announcement_with_countdown_timer_submit" name="deal_or_announcement_with_countdown_timer_submit" value="1" />';
		
}

function widget_deal_or_announcement_with_countdown_timer_management() 
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	switch($current_page)
	{
		case 'edit':
			include('pages/content-management-edit.php');
			break;
		case 'add':
			include('pages/content-management-add.php');
			break;
		case 'set':
			include('pages/widget-setting.php');
			break;
		default:
			include('pages/content-management-show.php');
			break;
	}
}

function deal_or_announcement_with_countdown_timer_widget_init() 
{
	if(function_exists('wp_register_sidebar_widget')) 	
	{
		wp_register_sidebar_widget( __('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), 
				__('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), 'deal_or_announcement_with_countdown_timer_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 	
	{
		wp_register_widget_control( __('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), 
				array( __('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), 'widgets'), 'deal_or_announcement_with_countdown_timer_control', 'width=400');
	} 
}

function deal_or_announcement_with_countdown_timer_deactivation() 
{
	// No action required
}

function deal_or_announcement_with_countdown_timer_add_to_menu() 
{
	add_options_page( __('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), __('Deal with countdown', 'deal-or-announcement-with-countdown-timer'), 
				'manage_options', 'deal-with-countdown', 'widget_deal_or_announcement_with_countdown_timer_management' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'deal_or_announcement_with_countdown_timer_add_to_menu');
}

function deal_or_announcement_with_countdown_timer_textdomain() 
{
	  load_plugin_textdomain( 'deal-or-announcement-with-countdown-timer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action('plugins_loaded', 'deal_or_announcement_with_countdown_timer_textdomain');
add_action("plugins_loaded", "deal_or_announcement_with_countdown_timer_widget_init");
register_activation_hook(__FILE__, 'deal_or_announcement_with_countdown_timer_install');
register_deactivation_hook(__FILE__, 'deal_or_announcement_with_countdown_timer_deactivation');
add_action('init', 'deal_or_announcement_with_countdown_timer_widget_init');
?>
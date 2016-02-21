<?php
/*
Plugin Name: Countdown Wpdevart 
Plugin URI: http://wpdevart.com/wordpress-countdown-plugin/
Description: WordPress Countdown plugin is an nice tool to create and insert countdown timers into your posts/pages and widgets .
Version: 1.2.3
Author: wpdevart
Author URI: http://wpdevart.com 
License: GPL3 http://www.gnu.org/licenses/gpl-3.0.html
*/
 

class wpdevart_countdown_main{
	// required variables
	
	private $wpdevart_countdown_plugin_url;
	
	private $wpdevart_countdown_plugin_path;
	
	private $wpdevart_countdown_version;
	
	public $wpdevart_countdown_options;
	
	
	function __construct(){
		
		$this->wpdevart_countdown_plugin_url  = trailingslashit( plugins_url('', __FILE__ ) );
		$this->wpdevart_countdown_plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		
		if(!class_exists('wpdevart_countdown_setting'))
			require_once($this->wpdevart_countdown_plugin_path.'includes/library.php');
		
		$this->call_base_filters();
		$this->create_admin_menu();	
		$this->wpdevart_countdown_front_end();
		
	}
	
	public function create_admin_menu(){
		
		require_once($this->wpdevart_countdown_plugin_path.'includes/admin_menu.php');
		
		$wpdevart_countdown_admin_menu = new wpdevart_countdown_admin_menu(array('menu_name' => 'Countdown','databese_parametrs'=>$this->wpdevart_countdown_options));
		
		add_action('admin_menu', array($wpdevart_countdown_admin_menu,'create_menu'));
		
	}
	
	public function wpdevart_countdown_front_end(){
		
		require_once($this->wpdevart_countdown_plugin_path.'includes/front_end.php');
		require_once($this->wpdevart_countdown_plugin_path.'includes/widget.php');

		$wpdevart_countdown_front_end = new wpdevart_countdown_front_end(array('menu_name' => 'countdown','databese_parametrs'=>$this->wpdevart_countdown_options));
		
	}
	
	public function registr_requeried_scripts(){
		wp_register_script('countdown-front-end',$this->wpdevart_countdown_plugin_url.'includes/javascript/front_end_js.js');
		wp_register_style('countdown_css',$this->wpdevart_countdown_plugin_url.'includes/style/style.css');
		wp_register_style('animated',$this->wpdevart_countdown_plugin_url.'includes/style/effects.css');
		
		// datepicker
		wp_register_script('foundation-datepicker',$this->wpdevart_countdown_plugin_url.'includes/javascript/foundation-datepicker.min.js');
		wp_register_style('foundation-datepicker',$this->wpdevart_countdown_plugin_url.'includes/style/foundation-datepicker.min.css');	
	}
	
	public function call_base_filters(){
		add_action( 'init',  array($this,'registr_requeried_scripts') );
		add_action( 'admin_head',  array($this,'include_requeried_scripts') );
	}
  	public function include_requeried_scripts(){
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
		// datepicker
		wp_enqueue_script('foundation-datepicker');
		wp_enqueue_style('foundation-datepicker');
	}

}
$wpdevart_countdown_main = new wpdevart_countdown_main();

?>
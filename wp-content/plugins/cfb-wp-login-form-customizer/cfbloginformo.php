<?php
/*
 * Plugin Name: CFB WP Login Form Customizer
 * Plugin URI: http://codefairbd.com/plugins/wp-admin
 * Description: CFB WP login form customizer is a highly recommended plugin for customize WordPress login form register form and lost form.Its easy to install and using.Please download and check this plugin features.Thanks
 * Version: 1.0
 * Author: Robin Islam
 * Author URI: http://codefairbd.com
 */
// Define Plugin Path and Directory
define('CFB_LOGIN_FORMO_DIR', plugin_dir_path(__FILE__));
define('CFB_LOGIN_FORMO_URL', plugin_dir_url(__FILE__));
// Add website url into login form logo
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
// Add webstitle title on logo hover title
function my_login_logo_url_title() {
    return  get_bloginfo( 'title' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
// Add some requires Files
require_once(CFB_LOGIN_FORMO_DIR.'/css/style.php');
require_once(CFB_LOGIN_FORMO_DIR.'/options/options.php');
// Functin for settings panel (note: Dont Try to edit this code its can be hurm your website)
function cfb_ez_get_option( $option, $section, $default = '' ) { 
    $options = get_option( $section ); 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    } 
    return $default;
}
// Add settings menu under plugin page
function cfb_loginformo_settings_page_link($links) { 
  $settings_link = '<a href="options-general.php?page=cfb_wp_login_form_customizer">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'cfb_loginformo_settings_page_link' );
// Add some add about this plugin and about pro features
function cfb_wp_login_form_customizer(){
	echo "this is demo text options page";
}
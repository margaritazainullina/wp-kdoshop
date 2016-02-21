<?php
/**
 * @package   CBX Flexible CountDown
 * @author    Codeboxr <info@wpboxr.com>
 * @license   GPL-2.0+
 * @link      http://wpboxr.com/
 * @copyright 2015 WPBoxr
 *
 * @wordpress-plugin
 * Plugin Name:         CBX Flexible CountDown
 * Plugin URI:          http://wpboxr.com/product/cbx-flexible-event-countdown-for-wordpress
 * Description:         An event countdown plugin
 * Version:             1.7.1
 * Author:              WPBoxr
 * Author URI:          http://codeboxr.com/
 * Text Domain:         codeboxr-flexible-countdown
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:         /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('CBXFCVERSION', '1.7.1');

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 *
 * - replace `class-codeboxr-flexible-countdown.php` with the name of the plugin's class file
 *
 */

require_once( plugin_dir_path( __FILE__ ) . 'public/classcodeboxrflexiblecountdown.php' );
require_once( plugin_dir_path( __FILE__ ) . 'codeboxrflexiblecountdownfunction.php' );



//add option framework class
include_once( plugin_dir_path( __FILE__ ).'includes/class.cbfc-settings.php');
require_once(plugin_dir_path( __FILE__ ).'includes/codeboxr-flexible-countdown-options.php');

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 *
 * - replace Codeboxr_Flexible_CountDown with the name of the class defined in
 *   `class-codeboxr-flexible-countdown.php`
 */
register_activation_hook( __FILE__, array( 'Codeboxr_Flexible_CountDown', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Codeboxr_Flexible_CountDown', 'deactivate' ) );

/*
 *
 *
 * - replace Codeboxr_Flexible_CountDown with the name of the class defined in
 *   `class-codeboxr-flexible-countdown.php`
 */
add_action( 'plugins_loaded', array( 'Codeboxr_Flexible_CountDown', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 *
 *
 * - replace `class-codeboxr-flexible-countdown-admin.php` with the name of the plugin's admin file
 * - replace Codeboxr_Flexible_CountDown_Admin with the name of the class defined in
 *   `class-codeboxr-flexible-countdown-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/classcodeboxrflexiblecountdownadmin.php' );
	add_action( 'plugins_loaded', array( 'Codeboxr_Flexible_CountDown_Admin', 'get_instance' ) );



}

//adding widgets
require_once( plugin_dir_path( __FILE__ ) . 'widget/cbfcwidget.php' );
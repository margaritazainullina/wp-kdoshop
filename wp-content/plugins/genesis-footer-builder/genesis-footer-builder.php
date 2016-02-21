<?php

/**
 *
 * Plugin Name: Genesis Footer Builder
 * Plugin URI: https://www.binaryturf.com/?p=17056
 * Description: Helps build a custom footer for Genesis or Genesis child-themes.
 * Version: 1.2.2
 * Author: Aniket Ashtikar
 * Author URI: https://www.binaryturf.com
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: genesis-footer-builder
 *
 */

define( 'GFB_SETTINGS_FIELD','genesis-footer-builder' );
define( 'GFB_PLUGIN_URL', plugin_dir_url(__FILE__) );
define( 'GFB_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'GFB_PLUGIN_DOMAIN', 'genesis-footer-builder' );
define( 'GFB_PLUGIN_NAME', 'Genesis Footer Builder' );

define( 'GFB_SETTINGS_VER', '1.0' );


register_activation_hook( __FILE__, 'gfb_activation' );

function gfb_activation() {
	
	if ( 'genesis' != basename( TEMPLATEPATH ) )
		gfb_deactivate_template_err();
	
	if(  !defined( 'PARENT_THEME_VERSION' ) || !version_compare( PARENT_THEME_VERSION, '2.1.0', '>=' ) )
		gfb_deactivate_version_err( '2.1.0', '3.9.2' );
	
}


/**
 *	Deactivate the plugin if Genesis is not 'active'
 *	Useful when users switch themes
 */
 
add_action( 'admin_init', 'gfb_deactivate_self_no_genesis' );

function gfb_deactivate_self_no_genesis() {
    
	if ( !function_exists( 'genesis_pre' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate plugin
		gfb_deactivate_genesis_inactive();
    }
	
}

/**
 *	Check if the parent theme Genesis is installed and activated, else deactivate
 */
 
function gfb_deactivate_template_err() {
	
	deactivate_plugins( plugin_basename( __FILE__ ) );
	
	$notice = sprintf( __( '%s requires %sGenesis Framework%s to be installed and activated. Please install Genesis as the parent theme to use Genesis Footer Builder.%sIf Genesis Framework / Genesis child theme is already installed, go to %sThemes page%s and activate it.%s&larr; Return to Plugins page%sGo to Themes page &rarr;%s', 'genesis-footer-builder' ), '<p>' . GFB_PLUGIN_NAME, '<a title="Genesis Framework" href="http://www.binaryturf.com/genesis">', '</a>', '</p><p>', '<a title="Go to Themes page" href="' . self_admin_url('themes.php') . '">', '</a>', '</p><p><a href="' . self_admin_url( 'plugins.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: left;" target="_parent">', '</a><a href="' . self_admin_url( 'themes.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: right;">','</a><span style="display: block; clear: both;"></span></p>' );
	
	wp_die( $notice );

}

/**
 *	Check the WordPress and Genesis version
 *	WordPress to be 3.9.2 and Genesis to be 2.1.0 to use the plugin, else deactivate
 */
 
function gfb_deactivate_version_err( $genesis_version = '2.1.0', $wp_version = '3.9.2' ) {
	
	deactivate_plugins( plugin_basename( __FILE__ ) );
	
	$notice = sprintf( __( '%s requires WordPress version %s and Genesis version %s or greater. Please update to the latest version and try again.%s&larr; Return to Plugins page%sGo to Themes page &rarr;%s', 'genesis-footer-builder' ), '<p>' . GFB_PLUGIN_NAME, '<strong>' . $wp_version . '</strong>', '<strong>' . $genesis_version . '</strong>', '</p><p><a href="' . self_admin_url( 'plugins.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: left;" target="_parent">', '</a><a href="' . self_admin_url( 'themes.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: right;">','</a><span style="display: block; clear: both;"></span></p>' );
	
	wp_die( $notice );

}

/**
 * Check the active theme to be Genesis
 * Deactivate the plugin, if Genesis not active
 */

function gfb_deactivate_genesis_inactive() {
	
	deactivate_plugins( plugin_basename( __FILE__ ) );
	
	$notice =  sprintf( __( '%s plugin requires %sGenesis Framework%s to be installed and activated. Please install Genesis as the parent theme to use %s.%sThe plugin will now be deactivated.%s&larr; Return to Plugins page%sGo to Themes page &rarr;%s', 'genesis-footer-builder' ), '<p>' . GFB_PLUGIN_NAME, '<a href="http://www.binaryturf.com/genesis">', '</a>', GFB_PLUGIN_NAME, '</p><p>', '</p><p><a href="' . self_admin_url( 'plugins.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: left;" target="_parent">', '</a><a href="' . self_admin_url( 'themes.php' ) . '" style="background-color: #f2f2f2; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25); display: inline-block; margin: 0 auto; padding: 10px 12px; float: right;">','</a><span style="display: block; clear: both;"></span></p>' );
	
	wp_die( $notice );
	
}


/*
 * Safe load plugin textdomain, during init for translations
 * @refer http://geertdedeckere.be/article/loading-wordpress-language-files-the-right-way
 */
add_action( 'init', 'gfb_load_textdomain' );

/**
 * Makes the plugin translation ready
 * Let's make the plugin also look in the WordPress languages directory for translations
 * Translation files should follow the syntax: genesis-footer-builder-{your-domain}
 *
 * Example: To set the plugin language to German(de_DE), you can drop in your translation files named as: genesis-footer-builder-de_DE.mo / genesis-footer-builder-de_DE.po
 */

function gfb_load_textdomain() {
	
	$domain = 'genesis-footer-builder';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	/* Users can create a directory 'genesis-footer-builder' under '../wp-content/languages/' and drop in translation files with the similar filename syntax as described above */
	load_textdomain( $domain, WP_LANG_DIR . '/genesis-footer-builder/' . $domain . '-' . $locale . '.mo' );
	
	load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) .'/languages/' );

}


/**
 *	Adding the Support and Author links to the plugin in the admin area on the plugins page
 */
 
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'gfb_add_action_links' );

function gfb_add_action_links ( $links ) {
	
	$link = array(
		'<a href="'. admin_url( 'admin.php?page=genesis-footer-builder' ) .'">Settings</a>',
		'<a href="https://wordpress.org/support/plugin/genesis-footer-builder" target="_blank">Support</a>'
	);
	
	return array_merge( $links, $link );

}


/**
 *	Include the plugin file which declares the constructor class and the plugin functions file
 * 	Registering the menu location for the footer menu. The footer menu option is enabled by default.
 *	Declaring the function that the plugin uses to filter the footer output
 */
 
add_action( 'genesis_init', 'gfb_loader', 20 );

function gfb_loader() {
	
    /** Call the upgrade routine to update the plugin and plugin settings **/
	require_once( GFB_PLUGIN_PATH . 'admin/gfb-update.php' );
	
	if ( is_admin() ) {
		
		require_once( GFB_PLUGIN_PATH . 'admin/gfb-admin.php' );
		
	}
	
	require_once( GFB_PLUGIN_PATH . 'admin/gfb-functions.php' );
	
	/** Check if the footer menu is enabled in the plugin settings page and register the menu location **/
	$gfb_menu_enabled = gfb_get_option( 'gfb_footer_menu' );
	
	if( $gfb_menu_enabled ){
		
		$gfb_menu = register_nav_menu( 'gfb_footer_menu', 'Genesis Footer Builder Menu' );
				
	}
	
	/** Hook the footer output filter used by the plugin, possibly last in the queue **/
	add_filter( 'genesis_footer_output', 'gfb_customized_footer', 12, 3 );
	
}


add_action( 'genesis_admin_menu', 'gfb_admin_menu' );

function gfb_admin_menu() {
	
	$gfb_admin = new Gfb_Admin;

}


/*
 *	Setting up the default options for the plugin
 *	A filter is made available to filter the defaults for the plugin
 */
 
function gfb_defaults() {
	
	$defaults = array(
	
		'gfb_settings_version'	=>	GFB_SETTINGS_VER,
		
		'gfb_current_date'	=>	1,				// Current year for Copyrights, 0 if unchecked
		'gfb_date_format'	=>	0,
		'gfb_date'			=>	date( 'Y' ),	// Custom year single
		'gfb_date_start'	=>	date( 'Y' ),	// Custom year duration start, current year by default
		'gfb_date_end'		=>	date( 'Y', strtotime( '+1 year' ) ),	// Custom year duration end, next year to the current by default
		
		'gfb_brand'			=>	'',				// Brand name
		'gfb_privacy'		=>	0,				// Privacy page id, 0 for none
		'gfb_disclaimer'	=>	0,				// Disclaimer page id, 0 for none
		'gfb_footer_menu'	=>	1,				// Footer menu checkbox
		
		'gfb_output'		=>	'<p>Copyright &copy; [gfb-date] &mdash; [gfb-brand] &bull; All rights reserved. &bull; [gfb-privacy-policy] &bull; [gfb-disclaimer]</p><p>[gfb-affiliate-link] &bull; [footer_wordpress_link] &bull; [footer_loginout]</p>',	// Output

		'gfb_affiliate_link'	=>	'http://my.studiopress.com/themes/genesis',
	
	);
	
	return apply_filters( 'gfb_defaults', $defaults );
	
}


/*
 *	Creating a function to retrieve the plugin settings from the database
 */
 
function gfb_get_option( $key ) {
	
	return genesis_get_option( $key, GFB_SETTINGS_FIELD );
	
}


/*
 *	Adding the date format option toggle to the available genesis toggles
 */
 
add_filter( 'genesis_toggles', 'gfb_toggles' );

function gfb_toggles( $toggles ) {
	
	$gfb_toggle = array(
	
		'gfb_current_date'	=>	array( '#genesis-footer-builder\\[gfb_current_date\\]', '#gfb-custom-date', '_unchecked' ),
		'gfb_date'			=>	array( '#genesis-footer-builder\\[gfb_date_format\\]', '#gfb-date-format-unset', '_unchecked' ),
		'gfb_date_start'	=>	array( '#genesis-footer-builder\\[gfb_date_format\\]', '#gfb-date-format-set', '_checked' ),
		'gfb_date_end'		=>	array( '#genesis-footer-builder\\[gfb_date_format\\]', '#gfb-date-format-set', '_checked' ),

	);
	
	$toggles = array_merge( $toggles, $gfb_toggle );
	
	return $toggles;
	
}
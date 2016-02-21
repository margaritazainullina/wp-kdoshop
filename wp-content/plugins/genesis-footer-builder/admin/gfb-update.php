<?php

/**
 *	
 *	Check for plugin updates and update as required.
 *	
 *	@since 1.1
 *
 */

 
/**
 *	A helper function to merge new settings with the old settings and push them into the database
 */

function gfb_update_trigger( $new = '', $setting = GFB_SETTINGS_FIELD ) {

	return update_option( $setting, wp_parse_args( $new, get_option( $setting ) ) );

}


/**
 *	Plugin version 1.1 update release.
 *	
 *	Includes additional settings in the new version
 */

function gfb_update_11() {

	//* Update settings
	gfb_update_trigger( array(
		'gfb_settings_version'  =>	'1.0',
		'gfb_affiliate_link'	=>	gfb_get_option( 'gfb_affiliate_link' ) ? gfb_get_option( 'gfb_affiliate_link' ) : 'http://my.studiopress.com/themes/genesis',
	) );

}


/**
 *	Trigger the plugin update if the version compare succeeds
 */

add_action( 'admin_init', 'gfb_safe_upgrade', 20 );

function gfb_safe_upgrade() {
	
	$version = gfb_get_option( 'gfb_settings_version' );
	
	//* Check if this is the latest version
	if ( ( $version >= GFB_SETTINGS_VER ) )
		return;
	
	//* Update the plugin to 1.1
	if ( gfb_get_option( 'gfb_settings_version' ) < '1.0' )
		gfb_update_11();

	//* Maybe, we add some notices to notify about the update, later
	do_action( 'gfb_updated' );
	
}


/*
add_filter( 'update_plugin_complete_actions', 'gfb_complete_upgrade', 10, 2 );

function gfb_complete_upgrade( array $actions, $plugin ) {

	$gfb_exists = get_plugin( 'genesis-footer-builder' );
	
	if ( 'genesis-footer-builder' !== $plugin )
		return $actions;

	return '<a href=" ' . admin_url( 'admin.php?page=genesis-footer-builder' ) . '">Click here to complete the upgrade</a>';

}
*/
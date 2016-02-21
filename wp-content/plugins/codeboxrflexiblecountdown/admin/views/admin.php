<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2015 Codeboxr
 */
?>

<div class="wrap columns-2">
	<?php
	$pro_note = '';
	//$output = '<div class="icon32 icon32_cbrp_admin icon32-cbrp-edit" id="icon32-cbrp-edit"><br></div>';
	if ( !is_plugin_active( 'codeboxrflexiblecountdownproaddon/codeboxrflexiblecountdownproaddon.php' ) ) {
		//plugin is not activated
		$pro_note = ' <a class="button" href="http://wpboxr.com/product/cbx-flexible-event-countdown-for-wordpress" target="_blank">'.__('Grab the Pro Version','codeboxrflexiblecountdown').'</a>';
	}

	?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?> <?php echo $pro_note; ?></h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content" style="position: relative;">
				<?php
				$this->cbfc_settings_api->show_navigation();
				$this->cbfc_settings_api->show_forms();
				?>
			</div>
			<div id="postbox-container-1" class="postbox-container-1">
				<?php require_once( plugin_dir_path( __FILE__ ). '../../public/views/sidebar.php' ); ?>
			</div>
		</div>
	</div>
</div>

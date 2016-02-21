<?php
class Gfb_Admin extends Genesis_Admin_Boxes {
	
	function __construct() {
		
		$page_id  = 'genesis-footer-builder';
		
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => __( 'genesis', 'genesis' ),
				'page_title' => __( 'Genesis Footer Builder', 'genesis-footer-builder' ),
				'menu_title' => __( 'Footer Builder', 'genesis-footer-builder' )
			) 
		);
		
		$page_ops = array(
			'screen_icon' => 'themes',
			'save_button_text'  => __( 'Save Settings', 'genesis' ),
			'reset_button_text' => __( 'Reset Settings', 'genesis' ),
		);
		
		$settings_field = GFB_SETTINGS_FIELD;
		
		$default_settings = gfb_defaults();
				
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );
		
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitizer_filters' ) );
		
		add_action( 'admin_print_styles', array( $this, 'styles' ) );
		
	}
	
	function help() {
		 
		$screen = get_current_screen();
		if ( $screen->id != $this->pagehook )
			return;
		
		$screen->add_help_tab( array(
		
			'id'		=> 'gfb-ht-overview',
			'title' 	=> 'Overview',
			'content'	=> '<h3>Genesis Footer Builder</h3><p>'. __( 'Genesis Footer Builder allows you to customize the site footer just as you want. You can configure the options and go with the plugin default copyright message or you can completely customize the copyright text.', 'genesis-footer-builder' ) .'</p><p>'. __( 'Genesis Footer Builder allows you to:', 'genesis-footer-builder' ) .'</p><ol><li>'. __( 'Specify custom brand name for use in the footer credits, which otherwise defaults to the site title.', 'genesis-footer-builder' ) .'</li><li>'. __( 'Specify the copyright year or duration to be included in the copyright notice. Defaults to current year.', 'genesis-footer-builder' ) .'</li><li>'. sprintf( __( 'Select and set %sPrivacy Policy%s and %sDisclaimer%s pages from the dropdown for use in the footer information.', 'genesis-footer-builder' ), '<strong>', '</strong>', '<strong>', '</strong>' ) .'</li><li>'. __( 'Set-up and display Genesis affiliate link in the footer credits text.', 'genesis-footer-builder' ) .'</li><li>'. __( 'Customize the footer credits text completely (in case the plugin\'s default credits text doesn\'t work for you).', 'genesis-footer-builder' ) .'</li><li>'. __( 'Set-up and display a footer menu on the site.', 'genesis-footer-builder' ) .'</li></ol>',
			
		) );
		
		$screen->add_help_tab( array(
		
			'id'		=> 'gfb-ht-shortcodes',
			'title'		=> 'Shortcode Reference',
			'content'	=> '<h3>'. __( 'Genesis Footer Builder &mdash; Shortcode Reference', 'genesis-footer-builder' ) .'</h3><p>'. sprintf( __( 'Genesis Footer Builder offers several shortcodes for customizing footer copyrights and credits. Here\'s the list of shortcodes available for use in %sCustom Footer Copyrights%s textarea:', 'genesis-footer-builder' ), '<strong>', '</strong>' ) .'</p><dl><dt>[gfb-brand]</dt><dd>'. sprintf( __( 'Displays the value of %sBrand Name%s setting.', 'genesis-footer-builder' ), '<em>', '</em>' ) .'</dd><dt>[gfb-date]</dt><dd>'. sprintf( __( 'Displays the value of %sCopyright Duration%s setting.', 'genesis-footer-builder' ), '<em>', '</em>' ) .'</dd><dt>[gfb-privacy-policy text="Privacy Policy"]</dt><dd>'. sprintf( __( 'Displays the selected page as set in %sPrivacy Policy page%s option. Use the %stext%s attribute to display custom text for the link to the selected page. Defaults to %sPrivacy Policy%s.', 'genesis-footer-builder' ), '<em>', '</em>', '<strong>', '</strong>', '<em>', '</em>' ) .'</dd><dt>[gfb-disclaimer text="Disclaimer"]</dt><dd>'. sprintf( __( 'Displays the selected page as set in %sDisclaimer page%s option. Use the %stext%s attribute to display custom text for the link to selected page. Defaults to %sDisclaimer%s.', 'genesis-footer-builder' ), '<em>', '</em>', '<strong>', '</strong>', '<em>', '</em>' ) .'</dd><dt>[gfb-affiliate-link]</dt><dd>'. __( 'Displays the affiliate link for Genesis as set in <em>Genesis Affiliate Link</em> option.', 'genesis-footer-builder' ) .'</dd></dl>',
			
		) );
		
		$screen->set_help_sidebar( '<h4>'. __( 'Additional Information', 'genesis-footer-builder' ) .'</h3><p><a href="https://wordpress.org/support/plugin/genesis-footer-builder">'. __( 'WordPress.Org Forums', 'genesis-footer-builder' ) .'</a></p><p><a href="https://www.binaryturf.com/forum/genesis-footer-builder">'. __( 'Support Forums', 'genesis-footer-builder' ) .'</a></p><p><a href="https://www.binaryturf.com/about/contact">'. __( 'Contact the Developer', 'genesis-footer-builder' ) .'</a></p>' );
	}
	
	/** Registering a metabox to hold all the plugin settings **/
	function metaboxes() {
		
		add_meta_box( 'gfb-footer-creds', __( 'Footer Copyright Customizer', 'genesis-footer-builder' ), array( $this, 'gfb_customizer_box' ), $this->pagehook, 'main' );
		
		add_meta_box( 'gfb-support', __( 'Help and Support', 'genesis-footer-builder' ), array( $this, 'gfb_help_support' ), $this->pagehook, 'column2' );
		
		add_meta_box( 'gfb-sb-showcase', __( 'Genesis Child Themes By Binary Turf', 'genesis-footer-builder' ), array( $this, 'gfb_themes_showcase' ), $this->pagehook, 'column2' );
		
		//add_action( $this->pagehook . '_settings_page_boxes', array( $this, 'gfb_themes_banner' ), 5 );
		add_action( 'genesis_admin_after_metaboxes', array( $this, 'gfb_themes_banner' ) );
		
	}
	
	/** Sanitizing the plugin options **/
	function sanitizer_filters() {
		
		genesis_add_option_filter( 'one_zero', $this->settings_field, array(
			'gfb_footer_menu',
			'gfb_date_format'
		));
		
		genesis_add_option_filter( 'no_html', $this->settings_field, array(
			'gfb_brand'
		));
		
		genesis_add_option_filter( 'absint', $this->settings_field, array(
			'gfb_privacy',
			'gfb_disclaimer'
		));
		
		genesis_add_option_filter( 'safe_html', $this->settings_field, array(
			'gfb_output'
		));
		
		genesis_add_option_filter( 'url', $this->settings_field, array(
			'gfb_affiliate_link'
		));
		
	}
	
	/** Enqueue plugin styles **/
	function styles() {
		
		wp_enqueue_style( 'gfb-styles', GFB_PLUGIN_URL . 'styles/gfb-styles.css' );
	
	}
	
	/** Load parent scripts as well as Genesis admin scripts **/
	function scripts() {

		parent::scripts();
		genesis_load_admin_js();
		
	}
	
	/** Sanitize the input for date field to accept only 4 digit numbers and starting with 19 or 20. **/	
	function save( $newsettings, $oldsettings ) {
		
		$newsettings['gfb_date'] 		= $this->validate_date( $newsettings['gfb_date'], $oldsettings['gfb_date'] );
		
		$newsettings['gfb_date_start'] 	= $this->validate_date( $newsettings['gfb_date_start'], $oldsettings['gfb_date_start'] );
		
		$newsettings['gfb_date_end'] 	= $this->validate_date( $newsettings['gfb_date_end'], $oldsettings['gfb_date_end'] );
		
		return $newsettings;
		
	}
	
	/** A helper function for date input validation **/
	function validate_date( $old_val, $new_val ) {
		
		if( preg_match( '/^(19|20)\d{2}$/', $old_val ) )
			return $old_val;
	
		return $new_val;
		
	}
	
	
	/** Generate the output for the metabox **/
	
	function gfb_customizer_box() {
		
		?>
		<div class="gfb-outer">
		<div class="gfb-inner gfb-brand">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Brand Name', 'genesis-footer-builder' ) ?></h4>
				<p><span class="gfb-desc"><?php _e( 'Enter brand name that will show up in footer credits. Site title is used by default.', 'genesis-footer-builder' ); ?></span></p>
				</td>
			</tr>
			<tr>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_brand' ); ?>"><?php _e( 'Brand Name: ', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<p><input type="text" name="<?php $this->field_name( 'gfb_brand' ); ?>" id="<?php $this->field_id( 'gfb_brand' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'gfb_brand' ) ); ?>" /></p>
				</td>
			</tr>
			</table>
		</div>
		
		<div class="gfb-inner gfb-duration">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Copyright Duration ', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php _e( 'Please select a custom year for copyright notice. Current year is used by default. You can also specify the from - to years by checking the from - to box below. Years valid from 19** to 20**.', 'genesis-footer-builder' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_current_date' ); ?>"><?php _e( 'Use current year?', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<p><input type="checkbox" name="<?php $this->field_name( 'gfb_current_date' ); ?>" id="<?php $this->field_id( 'gfb_current_date' ); ?>" value="1"<?php checked( $this->get_field_value( 'gfb_current_date' ) ); ?> /></p>
				</td>
				</tr>
			</table>
			<div id="gfb-custom-date">
				<div id="gfb-date-format-unset">
					<table class="gfb-layout">
					<tr>
						<td class="field-label">
						<p><label for="<?php $this->field_id( 'gfb_date' ); ?>"><?php _e( 'Enter the year: ', 'genesis-footer-builder' ); ?></label></p>
						</td>
						<td>
						<p><input type="number"  name="<?php $this->field_name( 'gfb_date' ); ?>" id="<?php $this->field_id( 'gfb_date' ); ?>" maxlength="4" size="4" value="<?php echo esc_attr( $this->get_field_value( 'gfb_date' ) ); ?>" /></p>
						</td>
					</tr>
					</table>
				</div>
			
				<div id="gfb-date-format-set">
					<table class="gfb-layout">
					<tr>
						<td class="field-label">
						<p><label for="<?php $this->field_id( 'gfb_date' ); ?>"><?php _e( 'Enter the year(s): ', 'genesis-footer-builder' ); ?></label></p>
						</td>
						<td>
						<p><input type="number" name="<?php $this->field_name( 'gfb_date_start' ); ?>" id="<?php $this->field_id( 'gfb_date_start' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'gfb_date_start' ) ); ?>" />
						&mdash;
						<input type="number" name="<?php $this->field_name( 'gfb_date_end' ); ?>" id="<?php $this->field_id( 'gfb_date_end' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'gfb_date_end' ) ); ?>" /></p>
						</td>
					</tr>
					</table>
				</div>
				
				<table class="gfb-layout">
				<tr>
					<td class="field-label">
					<p><label for="<?php $this->field_id( 'gfb_date_format' ); ?>"><?php printf( __( 'Use %sfrom - to%s format? ', 'genesis-footer-builder' ), '<em>', '</em>' ); ?></label></p>
					</td>
					<td>
					<p><input type="checkbox" name="<?php $this->field_name( 'gfb_date_format' ); ?>" id="<?php $this->field_id( 'gfb_date_format' ); ?>" value="1"<?php checked( $this->get_field_value( 'gfb_date_format' ) ); ?> /></p>
					</td>
				</tr>
				</table>
			</div>
		</div>
		
		<div class="gfb-inner gfb-privacy">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Privacy Policy Page', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php _e( 'Select a page below to be used as the Privacy Policy page in the footer information.', 'genesis-footer-builder' ); ?></p>
				</td>
			</tr>
			<tr>
				<?php 
					$invalid_pg = get_pages( array( 'post_status' => 'trash, draft, pending' ) );
				?>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_privacy' ); ?>"><?php _e( 'Select a page: ', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<p><?php wp_dropdown_pages( array( 'selected' => $this->get_field_value( 'gfb_privacy' ), 'name' => $this->get_field_name( 'gfb_privacy' ), 'exclude' => $invalid_pg, 'show_option_none' => sprintf( __( '%1$s Select %1$s', 'genesis-footer-builder' ), '&mdash;' ) ) ); ?></p>
				</td>
			</tr>
			</table>
		</div>
		
		<div class="gfb-inner gfb-disclaimer">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Disclaimer Page', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php _e( 'Select a page below to be used as the Disclaimer page in the footer information.', 'genesis-footer-builder' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_disclaimer' ); ?>"><?php _e( 'Select a page: ', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<p><?php wp_dropdown_pages( array( 'selected' => $this->get_field_value( 'gfb_disclaimer' ), 'name' => $this->get_field_name( 'gfb_disclaimer' ), 'exclude' => $invalid_pg, 'show_option_none' => __( '&mdash; Select &mdash;', 'genesis-footer-builder' ) ) ); ?></p>
				</td>
			</tr>
			</table>
		</div>
		
		<div class="gfb-inner gfb-fmenu">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Footer Menu', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php printf( __( 'With this option enabled, Genesis Footer Builder allows you to set-up a footer menu and output it in the footer. This can come handy if you want to insert some useful links like Home, About Us, Contact Us, Sitemap etc. Enable this option and save the settings. Then you can go to %sMenus page%s, create a new menu or select an existing menu and assign %s location.', 'genesis-footer-builder' ), '<a href="' . esc_url( admin_url('nav-menus.php') ) . '">', '</a>', genesis_code( 'Genesis Footer Builder Menu' ) ); ?></p>
				<p class="gfb-desc"><?php _e( '*Note: Only the first level menu-items will be displayed.', 'genesis-footer-builder' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_footer_menu' ); ?>"><?php _e( 'Register and insert Footer Menu? ', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<p><input type="checkbox" name="<?php $this->field_name( 'gfb_footer_menu' ); ?>" id="<?php $this->field_id( 'gfb_footer_menu' ); ?>" value="1"<?php checked( $this->get_field_value( 'gfb_footer_menu' ) ); ?> /></p>
				</td>
			</tr>
			</table>
		</div>
		
		<div class="gfb-inner gfb-fmenu">
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Genesis Affiliate Link', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php _e( 'Use this option to set your own Genesis affiliate link in the footer credits text.', 'genesis-footer-builder' ); ?></p>
				</td>
			</tr>
			<tr>
				<td class="field-label">
				<p><label for="<?php $this->field_id( 'gfb_affiliate_link' ) ?>"><?php _e( 'Enter the Genesis affiliate link:', 'genesis-footer-builder' ); ?></label></p>
				</td>
				<td>
				<input type="text" name="<?php $this->field_name( 'gfb_affiliate_link' ); ?>" id="<?php $this->field_id( 'gfb_affiliate_link' ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'gfb_affiliate_link' ) ); ?>" />
				</td>
			</tr>
			</table>
		</div>
		
		<div class="gfb-inner gfb-custom-copy">
			<?php
				$default_copyright = gfb_customized_footer( $this->get_field_value( 'gfb_output' ) );
			?>
			<table class="gfb-layout">
			<tr>
				<td colspan="3">
				<h4><?php _e( 'Custom Footer Copyrights', 'genesis-footer-builder' ) ?></h4>
				<p class="gfb-desc"><?php printf( __( 'You can build your own custom credits text below. This field allows you to use HTML tags, entities, Genesis footer shortcodes or any other shortcodes. Additionally, the plugin provides the following shortcodes to customize the output:%1$sDisplays the value of %7$sBrand Name%8$s option as set above.%2$sDisplays the value of %7$sCopyright Duration%8$s option as set above.%3$sDisplays the selected page as set in %7$sPrivacy Policy page%8$s option above. Text for the link can be customized using the %9$stext%10$s attribute.%4$sDisplays the selected page as set in <em>Disclaimer page</em> option above. Text for the link can be customized using the %9$stext%10$s attribute.%5$sDisplays the Genesis affiliate link as set in the %7$sGenesis Affiliate Link%8$s option above.%6$s', 'genesis-footer-builder' ), '</p><dl class="gfb-def-list"><dt>' . genesis_code( '[gfb-brand]' ) . ':</dt><dd>', '</dd><br /><dt>' . genesis_code( '[gfb-date]' ) . ':</dt><dd>', '</dd><br /><dt>' . genesis_code( '[gfb-privacy-policy text="Privacy Policy"]' ) . ':</dt><dd>', '</dd><br /><dt>' . genesis_code( '[gfb-disclaimer text="Disclaimer"]' ) . ':</dt><dd>', '</dd><br /><dt>' . genesis_code( '[gfb-affiliate-link]' ) . ':</dt><dd>', '</dd><br /></dl>', '<em>', '</em>', '<strong>', '</strong>' ); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
				<p><textarea name="<?php $this->field_name( 'gfb_output' ) ?>" id="<?php $this->field_id( 'gfb_output' ); ?>" rows="3" style="width: 100%;"><?php echo esc_textarea( $this->get_field_value( 'gfb_output' ) ); ?></textarea></p>
				</td>
			</tr>
			<?php
				$default_output = gfb_defaults();
				$default_output = $default_output['gfb_output'];
				
				$footer_output = gfb_customized_footer( $this->get_field_value( 'gfb_output' ) );
				
				if( !gfb_get_option( 'gfb_output' ) ) {
			?>
					<tr>
						<td colspan="3">
						<div class="gfb-highlight gfb-example"><?php printf( __( '%sUsage Example:%s', 'genesis-footer-builder' ), '<strong>', '</strong><div class="gfb-example">' . htmlentities( $default_output ) . '</div>' ); ?></div>
						</td>
					</tr>
			<?php
				}
				else {
			?>
					<tr>
						<td colspan="3">
						<div class="gfb-highlight"><?php printf( __( '%sPreview:%s', 'genesis-footer-builder' ), '<strong>', '</strong><br /> ' . do_shortcode( $footer_output ) ); ?></div>
						</td>
					</tr>
			<?php
				}
			?>
			</table>
		</div>
		</div>
		<?php
	}
	
	function gfb_help_support() {
		
		?>
		<div class="gfb-help-sidebar">
			<p><?php _e( 'For Genesis Footer Builder support, see:', 'genesis-footer-builder' ) ?></p>
			<!-- Yet to add link to WordPress.Org forum for our plugin -->
			<p><?php printf( __( '%sWordPress.Org Forums%s', 'genesis-footer-builder' ), '<a href="https://wordpress.org/support/plugin/genesis-footer-builder" target="_blank">', '</a>' ); ?></p>
			<p><?php printf( __( '%sContact the Developer%s', 'genesis-footer-builder' ), '<a href="https://www.binaryturf.com/?p=55" target="_blank">', '</a>' ); ?></p>
			<p class="gfb-sb-creds gfb-desc"><?php printf( __( 'Genesis plugin by %sBinaryTurf.Com%s', 'genesis-footer-builder' ), '<a title="Binary Turf" href="https://www.binaryturf.com/?p=9083" target="_blank">', '</a>' ); ?></p>
		</div>
		<?php
		
	}
	
	function gfb_themes_showcase() {
		
		?>
		<div class="gfb-showcase">
			<div class="showcase">
			<a title="Femme Flora Genesis Child Theme" href="https://www.binaryturf.com/?p=18596" target="_blank"><img src="<?php echo GFB_PLUGIN_URL; ?>admin/assets/femme-flora-showcase.png" alt="Femme Flora for Genesis" /><h4>Femme Flora Genesis Child Theme</h4></a>
			</div>
			<hr />
			<div class="showcase">
			<a title="Captivate Genesis Child Theme" href="https://www.binaryturf.com/?p=18658" target="_blank"><img src="<?php echo GFB_PLUGIN_URL; ?>admin/assets/captivate-showcase.png" alt="Captivate for Genesis" /><h4>Captivate Genesis Child Theme</h4></a>
			</div>
			<div class="clearfix"></div>
			<div class="showcase-all"><a href="https://www.binaryturf.com/?p=18594" target="_blank"><?php _e( 'View All Themes', 'genesis-footer-builder' ); ?></a></div>
		</div>
		<?php
		
	}
	
	function gfb_themes_banner() {
		
		?>
		<div class="gfb-lander-banner">
			<h3>Lander Child Theme Builder for Genesis</h3>
			<a title="Lander µFramework for Genesis" href="https://www.binaryturf.com/?p=15985" target="_blank"><img src="<?php echo GFB_PLUGIN_URL; ?>admin/assets/lander-theme-banner.png" alt="Lander µFramework for Genesis" /></a>
		</div>
		<?php
		
	}

}
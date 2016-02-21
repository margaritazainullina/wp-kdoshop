<?php
/**
 * @package   CBX_Flexible_CountDown
 * @author    WPBoxr <info@wpboxr.com>
 * @license   GPL-2.0+
 * @link      http://wpboxr.com/
 * @copyright 2015 WPBoxr
 */
?>
<?php

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-codeboxr-flexible-countdown.php`
 *

 *
 * @package Codeboxr_Flexible_CountDown_Admin
 * @author  Your Name <email@example.com>
 */
class Codeboxr_Flexible_CountDown_Admin {

    /**
     *
     * Unique identifier for your plugin.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_slug = null;

	public $shortcode_tag = 'cbfccountdown';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Hold the instance of settings api object.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected $cbfc_settings_api = null;

	/**
	 * Hold the instance of settings api object.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	//protected $cbfc_settings_api = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 * - Rename "Codeboxr_Flexible_CountDown" to the name of your initial plugin class
		 *
		 */
		$plugin = Codeboxr_Flexible_CountDown::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

        // Initialize admin settings
        add_action( 'admin_init', array( $this, 'init_cbfc_settings' ) );
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );



        // Add an action link pointing to the options page.
        /*if( is_admin() ) {
            $plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' );
            add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
        }*/

		/*
		 * Define custom functionality.
		 *
		 * Read more about actions and filters:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */

		//adding shortcode handler button for post
		add_action('admin_head', array( $this, 'admin_head') );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * - Rename "Codeboxr_Flexible_CountDown" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles($hook) {
        //if($hook = 'codeboxr-flexible-countdown') return ;
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
        if ( $screen->id == $this->plugin_screen_hook_suffix || $screen->id == 'post'  || $screen->id == 'page' ) {
			wp_enqueue_style( $this->plugin_slug .'-colorpicker', plugins_url( 'assets/css/colorpicker.css', __FILE__ ), false, '1.0' );

			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array( 'wp-color-picker' ), '1.0' );
			//wp_enqueue_style( $this->plugin_slug .'-admin-jquery-date-picker', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css', array(), CBXFCCBXFCVERSION );
			wp_enqueue_style( $this->plugin_slug .'-admin-jquery-date-picker', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', array(), '1.0' );
			//wp_enqueue_style( $this->plugin_slug .'-admin-jquery-date-picker', plugins_url( 'assets/css/jquery-ui.css', __FILE__ ), array(), Codeboxr_Flexible_CountDown::CBXFCCBXFCVERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * - Rename "Codeboxr_Flexible_CountDown" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix || $screen->id == 'post' || $screen->id == 'page' ) {

        //wp_enqueue_script( $this->plugin_slug . '-admin-script-datepicker', plugins_url( 'assets/js/mce-button-cbfccountdown.js', __FILE__ ), array( 'jquery' ), Codeboxr_Flexible_CountDown::CBXFCCBXFCVERSION );

        wp_enqueue_script( $this->plugin_slug . '-colorpicker', plugins_url( 'assets/js/colorpicker.js', __FILE__ ), array( 'jquery' ), CBXFCVERSION, true );

        wp_register_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'wp-color-picker' ), CBXFCVERSION, true );

        wp_enqueue_script( $this->plugin_slug . '-admin-script' );

        }

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'CBX Flexible Countdown (CBFC)', $this->plugin_slug ),
			__( 'CBX Countdown Settings', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
        $plugin_data = get_plugin_data( plugin_dir_path( __DIR__ ). $this->plugin_slug . '.php' ) ;
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);
	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	/*public function action_method_name() {

	}*/

	/**
	 * NOTE:     Filters are points of execution in which WordPress modifies data
	 *           before saving it or sending it to the browser.
	 *
	 *           Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	/*public function filter_method_name() {

	}*/

    /**
     * Registers settings section and fields
     */
    public function init_cbfc_settings() {
        //echo plugin_dir_path( __FILE__ );
        $cbfc_options_prefix = Codeboxr_Flexible_CountDown::$cbfc_options_prefix;

        $this->cbfc_settings_api = CodeboxrFlexibleCountdownSetting::getInstance( $this->plugin_slug );
        $sections = cbfc_get_section_setting($this->plugin_slug);
        $fields = cbfc_get_settings_field($this->plugin_slug, $cbfc_options_prefix);
        //set sections and fields
        $this->cbfc_settings_api->set_sections( $sections );
        $this->cbfc_settings_api->set_fields( $fields );

        //initialize them
        $this->cbfc_settings_api->admin_init();
    }

	/**
	 *
	 */
	public function  admin_head(){
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}

		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
            add_filter( 'mce_external_languages', array( $this ,'cbfc_tinymce_lang' ) );
            add_filter( 'mce_external_plugins', array( $this ,'cbfc_tinymce_plg' ) );
			add_filter( 'mce_buttons', array($this, 'mce_buttons' ) );
		}
	}

	/**
	 * mce_external_plugins
	 * Adds our tinymce plugin
	 * @param  array $plugin_array
	 * @return array
	 */
	public function cbfc_tinymce_plg( $plugins_arr ) {

		$shortcode_button_js          = plugins_url( 'assets/js/mce-button-cbfccountdown.js' , __FILE__ );
		$shortcode_button_js          = apply_filters('codeboxrflexiblecountdown_shortcode_js', $shortcode_button_js);
        $plugins_arr['cbfccountdown'] = $shortcode_button_js;

		return $plugins_arr;
	}

	/**
	 * mce_external_plugins
	 * Adds our tinymce plugin
	 * @param  array $plugin_array
	 * @return array
	 */
	public function cbfc_tinymce_lang( $locales ) {
        $locales[$this->shortcode_tag] = plugin_dir_path ( __DIR__ ) . 'languages/tinymcelangs.php';
		return $locales;
	}

	/**
	 * mce_buttons
	 * Adds our tinymce button
	 * @param  array $buttons
	 * @return array
	 */
	function mce_buttons( $buttons ) {
		array_push( $buttons, $this->shortcode_tag );
		return $buttons;
	}

	/**
	 * admin_enqueue_scripts
	 * Used to enqueue custom styles
	 * @return void
	 */
	function admin_enqueue_scripts(){
		wp_enqueue_style('cbfccountdown_shortcode', plugins_url( 'assets/css/mce-button-cbfccountdown.css' , __FILE__ ) );
	}



}

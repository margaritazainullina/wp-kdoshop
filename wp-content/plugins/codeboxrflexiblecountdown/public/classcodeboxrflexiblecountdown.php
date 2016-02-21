<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@wpboxr.com>
 * @license   GPL-2.0+
 * @link      http://wpboxr.com/
 * @copyright Codeboxr
 */
?>
<?php
/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-codeboxr-flexible-countdown-admin.php`
 *
 *
 *
 * @package Codeboxr_Flexible_CountDown
 * @author  Codeboxr <info@codeboxr.com>
 */
class Codeboxr_Flexible_CountDown {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const CBXFCVERSION = CBXFCVERSION;

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
	protected $plugin_slug = 'codeboxrflexiblecountdown';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Store all cpfc setting value
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected static $cbfc_optoins = null;

	/**
	 * Store all shortcode value
	 *
	 * @since    1.0.0
	 *
	 * @var      array
	 */
	protected static $cbfc_shortcode_arr = null;

    /**
     * Hold options value key prefix
     *
     * @since   1.0.0
     *
     * @var string
     */
    public static $cbfc_options_prefix = 'cbfc_countdown_';

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

        //add_action( 'wp_enqueue_scripts', array( $this,'cbfc_add__scripts' ));

        // add advanced countdown
        add_filter( 'cbfc_countdown_html', array( $this, 'cbfc_add_premium_countdown_html' ) );
        // Add style and js
        add_action( 'wp_enqueue_scripts', array( $this, 'cbfc_enqueue_style_and_script' ) );


        //add_action( 'widgets_init', array( $this, 'cbfc_enable_widget' ) );

		/* Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
        add_shortcode( 'cbfccountdown', array( $this, 'get_flexible_countdown' ) );
        add_filter( 'shortcode_atts_cbfccountdown', array( get_called_class(), 'cbfc_merge_shortcode' ), 10, 3 );
        //self::$cbfc_optoins = get_option( 'cbfc_general_settings' );
	}

    public function cbfc_enable_widget() {
        //register_widget( 'CodeboxrFlexibleCountdownWidget' );
    }

    public  function  cbfc_add__scripts(){
        $this->cbfc_enqueue_style_and_script();
    }

    /**
     * Get countdown option value
     *
     * @since   1.0.0
     *
     * @param $options_name
     *
     * @return null|option value
     */
    public static function cbfc_get_countdown_options($options_name = '', $settings_name = 'cbfc_general_settings', $arr = false ) {
        $settings = get_option($settings_name);
        if ( $arr == true ) {
            return $settings;
        } else {
            if ( isset( $settings[self::$cbfc_options_prefix . $options_name] ) ) {
                return $settings[self::$cbfc_options_prefix . $options_name];
            }
        }
        return null;
    }


    /**
     * Add this public method for getting countdown using shortcode
     *
     * @since    1.0.0
     *
     * @return mixed|void
     */
    public function get_flexible_countdown($atts) {
        //echo $date;
        $default_option_value = self::$cbfc_optoins = self::cbfc_get_countdown_options( '', 'cbfc_general_settings', true );
        $attr = shortcode_atts( array(
            'type'          => ( !empty( $default_option_value['cbfc_countdown_type'] ) ) ? $default_option_value['cbfc_countdown_type'] : 'light',
            'date'          => ( !empty( $default_option_value['cbfc_countdown_date'] ) ) ? $default_option_value['cbfc_countdown_date'] : $this->cbfc_get_default_date(),
            'hour'          => ( !empty( $default_option_value['cbfc_countdown_hour'] ) ) ? $default_option_value['cbfc_countdown_hour'] : '0',
            'minute'        => ( !empty( $default_option_value['cbfc_countdown_min'] ) ) ? $default_option_value['cbfc_countdown_min'] : '0',
            'numclr'        => ( !empty( $default_option_value['cbfc_countdown_num_color'] ) ) ? $default_option_value['cbfc_countdown_num_color'] : '#333',
            'resnumclr'     => ( !empty( $default_option_value['cbfc_countdown_res_num_color'] ) ) ? $default_option_value['cbfc_countdown_res_num_color'] : '#333',
            'numbgclr'      => ( !empty( $default_option_value['cbfc_countdown_num_bg_color'] ) ) ? $default_option_value['cbfc_countdown_num_bg_color'] : '#eaeaea',
            'textclr'       => ( !empty( $default_option_value['cbfc_countdown_text_color'] ) ) ? $default_option_value['cbfc_countdown_text_color'] : '#fff',
            'restextclr'    => ( !empty( $default_option_value['cbfc_countdown_res_text_color'] ) ) ? $default_option_value['cbfc_countdown_res_text_color'] : '#333',
            'textbgclr'     => ( !empty( $default_option_value['cbfc_countdown_text_bg_color'] ) ) ? $default_option_value['cbfc_countdown_text_bg_color'] : '#f5832b'
        ), $atts, 'cbfccountdown' );

        self::$cbfc_shortcode_arr = $attr;
        return self::cbfc_get_flexible_countdown($attr);
    }

	/**
	 *
	 * @return mixed|void
	 */
	public static function cbfc_get_flexible_countdown($atts) {
        $default_option_value = self::cbfc_get_countdown_options( '', 'cbfc_general_settings', true );
        $attr = array();
        $attr['type']           = ( !empty( $default_option_value['cbfc_countdown_type'] ) ) ? $default_option_value['cbfc_countdown_type'] : 'light';
        $attr['date']           = ( !empty( $default_option_value['cbfc_countdown_date'] ) ) ? $default_option_value['cbfc_countdown_date'] : self::cbfc_get_default_date();
        $attr['hour']           = ( !empty( $default_option_value['cbfc_countdown_hour'] ) ) ? $default_option_value['cbfc_countdown_hour'] : '0';
        $attr['minute']         = ( !empty( $default_option_value['cbfc_countdown_min'] ) ) ? $default_option_value['cbfc_countdown_min'] : '0';
        $attr['numclr']         = ( !empty( $default_option_value['cbfc_countdown_num_color'] ) ) ? $default_option_value['cbfc_countdown_num_color'] : '#333';
        $attr['resnumclr']      = ( !empty( $default_option_value['cbfc_countdown_res_num_color'] ) ) ? $default_option_value['cbfc_countdown_res_num_color'] : '#333';
        $attr['numbgclr']       = ( !empty( $default_option_value['cbfc_countdown_num_bg_color'] ) ) ? $default_option_value['cbfc_countdown_num_bg_color'] : '#eaeaea';
        $attr['textclr']        = ( !empty( $default_option_value['cbfc_countdown_text_color'] ) ) ? $default_option_value['cbfc_countdown_text_color'] : '#fff';
        $attr['restextclr']     = ( !empty( $default_option_value['cbfc_countdown_res_text_color'] ) ) ? $default_option_value['cbfc_countdown_res_text_color'] : '#333';
        $attr['textbgclr']      = ( !empty( $default_option_value['cbfc_countdown_text_bg_color'] ) ) ? $default_option_value['cbfc_countdown_text_bg_color'] : '#f5832b';

        $attr = array_merge($attr, $atts);

		$attr = apply_filters('cbfc_get_flexible_countdown_atts', $attr);

		/*echo '<pre>';
		print_r($attr);
		echo '</pre>';*/

		//cbfc_get_countdown_options

        //call a static function and pass the params $attr ,
        //from that function check the type and use if else or switch case to include necessary css or js

        // Load public-facing style sheet and JavaScript.
        self::enqueue_styles();
        self::enqueue_scripts();

        if ( $attr['type'] == 'cbfc_light' or $attr['type'] == 'light' or empty($attr['type']) ) {
            static $id_counter = 0;
            $id_counter++;
            ob_start();
            include( 'views/light-countdown.php' );
            $cbfc_default_countdown_html = ob_get_contents();
            ob_end_clean();
            return $cbfc_default_countdown_html;
        }

        if ( !isset( $ext_arr['textclr'] ) ) {
            unset( $attr['textclr'] );
        }

        return apply_filters('cbfc_countdown_html', $attr);
    }

    public static function cbfc_merge_shortcode($out, $pairs, $atts) {
        $plug_options = get_all_options_from_settings();
        return array_merge( $out, shortcode_atts( array(
            'secbclr'   => $plug_options['secbclr'],
            'minbclr'   => $plug_options['minbclr'],
            'hourbclr'  => $plug_options['hourbclr'] ,
            'daysbclr'  => $plug_options['daysbclr'],
            'bgclr'     => $plug_options['bgclr'],
            'fontclr'   => $plug_options['fontclr'],
            'kkfsize'   => $plug_options['kkfsize'],
            'kkfclr'    => $plug_options['kkfclr'],
            'kktextclr' => $plug_options['kktextclr']
        ), $atts, '' ) );
    }

    public static function cbfc_get_shortcode_attr() {
        return self::$cbfc_shortcode_arr;
    }

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

    public static function cbfc_get_text_domain() {
        return self::$instance->plugin_slug;
    }

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {

	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		/*
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        //var_dump(trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo');

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
        */
        load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/../languages' );

    }

    /**
     * @param $countdown_html
     * @return string
     */
    public function cbfc_add_premium_countdown_html($attr) {
        $attr = array_merge( get_all_options_from_settings(), $attr );
        $countdown_html = '';
        $this->cbfc_enqueue_style_and_script( $attr );
        if ( $attr['type'] == 'cbfc_circular'  or $attr['type'] == 'circular' ) {
            //return '<h1>One</h1>';
            static $id_counter = 0;
            $id_counter++;
            ob_start();
            require('includes/circular.php');
            $countdown_html = ob_get_contents();
            if ( ob_get_length() ) {
                ob_end_clean();
            }
            return $countdown_html;
        }

        if ( $attr['type'] == 'cbfc_kk'  or $attr['type'] == 'kk' ) {
            static $kk_id_counter = 0, $load_css = true;
            $kk_id_counter++;
            ob_start();
            require('includes/kk.php');
            $countdown_html = ob_get_contents();
            if ( ob_get_length() ) {
                ob_end_clean();
            }
            return $countdown_html;
        }

    }


    /**
     * enquee style and script
     */
    public function cbfc_enqueue_style_and_script($short_code_arr = '') {
        // Register Light Countdown css
        wp_register_style( self::cbfc_get_text_domain() . 'cbfc-light-style', plugins_url('assets/css/cbfc-light-countdown.css', __FILE__), '', self::CBXFCVERSION);
        wp_enqueue_style( self::cbfc_get_text_domain() . 'cbfc-light-style' );

        // Register Circular coutdown css
        wp_register_style( $this->plugin_slug . 'cbfc-circular-css', plugins_url('assets/css/cbfc-circular-countdown.css', __FILE__), '', self::CBXFCVERSION );
        // enqueue circular style
        wp_enqueue_style( $this->plugin_slug . 'cbfc-circular-css' );

        // Register Kinetic js for circular countdown
        wp_register_script( $this->plugin_slug . 'cbfc-kinetic-lib-js', plugins_url('assets/js/kinetic-v5.1.0.min.js', __FILE__), '', '5.1.0', true );
        // Register Circular countdown lib js
        wp_register_script( $this->plugin_slug . 'cbfc-circular-lib-js', plugins_url('assets/js/cbfc-circular-countdown.js', __FILE__), array( 'jquery', $this->plugin_slug . 'cbfc-kinetic-lib-js' ), '1.0.0', true );
        // Enqueue Circular Countdown lib
        wp_enqueue_script( $this->plugin_slug . 'cbfc-circular-lib-js');

        // Register KK countdown lib js
        wp_register_script( $this->plugin_slug . 'cbfc-kk-lib-js', plugins_url('assets/js/kkcountdown.min.js', __FILE__), array( 'jquery' ), '1.0.0', true );
        // Enqueue kk Countdown lib
        wp_enqueue_script( $this->plugin_slug . 'cbfc-kk-lib-js' );
        // Register Common js for calling others countdown library
        wp_register_script( $this->plugin_slug . 'cbfc-common-js', plugins_url( 'assets/js/cbfc-common-js.js', __FILE__ ), array( 'jquery', $this->plugin_slug . 'cbfc-light-js-lib', $this->plugin_slug . 'cbfc-circular-lib-js' ), self::CBXFCVERSION, true);

        $kkc_lang = array(
            'kkc_day'   => __( 'day', $this->plugin_slug ),
            'kkc_days'  => __( 'days', $this->plugin_slug ),
            'kkc_hr'    => __( 'h', $this->plugin_slug ),
            'kkc_min'   => __( 'm', $this->plugin_slug ),
            'kkc_sec'   => __( 's', $this->plugin_slug ),
        );
        wp_localize_script( $this->plugin_slug . 'cbfc-common-js', 'kkc', $kkc_lang );

        wp_enqueue_script( $this->plugin_slug . 'cbfc-common-js' );
    }

    public function add_style_for_circular_countdown() {
        wp_enqueue_style( $this->plugin_slug . 'cbfc-circular-css' );
    }

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public static function enqueue_styles() {

        wp_register_script( self::cbfc_get_text_domain() . 'cbfc-light-js-lib', plugins_url('/assets/js/jquery.light.countdown.js', __FILE__), array('jquery'), self::CBXFCVERSION, true);
        wp_register_script( self::cbfc_get_text_domain() . 'cbfc-common-js', plugins_url( '/assets/js/cbfc-common-js.js', __FILE__ ), array( 'jquery' ), self::CBXFCVERSION, true);

        wp_enqueue_script( self::cbfc_get_text_domain() . 'cbfc-light-js-lib' );
        wp_enqueue_script( self::cbfc_get_text_domain() . 'cbfc-common-js' );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public static function enqueue_scripts() {
        wp_register_script( self::cbfc_get_text_domain() . 'cbfc-light-js-lib', plugins_url('assets/js/jquery.light.countdown.js', __FILE__), array('jquery'), self::CBXFCVERSION, true);
        wp_register_script( self::cbfc_get_text_domain() . 'cbfc-common-js', plugins_url( 'assets/js/cbfc-common-js.js', __FILE__ ), array( self::cbfc_get_text_domain() . 'cbfc-light-js-lib' ), self::CBXFCVERSION, true);
        wp_enqueue_script( self::cbfc_get_text_domain() . 'cbfc-common-js' );
	}

    public static function cbfc_get_default_date() {
        $month = ( date( 'm' ) == 12 || date( 'm' ) == '12' ) ? '01' :  ( date( 'm' ) + 1 );
        $year = ( date( 'm' ) == 12 || date( 'm' ) == '12' ) ? ( date( 'Y' ) + 1 ) : date( 'Y' );
        return $date = $month .'/26/' .$year;
    }

}

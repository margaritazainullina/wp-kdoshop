<?php
    /**
    * WordPress Widget Boilerplate
    *
    * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building widgets using WordPress best practices.
    *
    * @package   CB Countdown
    * @author    Codeboxr <info@codeboxr.com>
    * @license   GPL-2.0+
    * @link      http://codeboxr.com
    * @copyright 2015 Codeboxr
     *
    * @wordpress-plugin
    * Plugin Name:         Codeboxr Flexible CountDown
    * Plugin URI:          http://codeboxr.com/
    * Description:         An event countdown plugin
    * Version:             1.6.3
    * Author:              Codeboxr
    * Author URI:          http://codeboxr.com/
    * Text Domain:         codeboxrflexiblecountdown
    * License:             GPL-2.0+
    * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
    * Domain Path:         /languages
    */
 
 // Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class CodeboxrFlexibleCountdownWidget extends WP_Widget {

    /**
     *
     * Unique identifier for your widget.
     *
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * widget file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $widget_slug = null;

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

        $this->widget_slug = cbfc_get_text_domain();
		// load plugin text domain
		add_action( 'init', array( $this, 'widget_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		parent::__construct(
            $this->widget_slug,
			__( 'Flexible Countdown', $this->widget_slug ),
			array(
				'classname'  => $this->widget_slug.'-widget',
				'description' => __( 'An event countdown for your site', $this->widget_slug )
			)
		);

		// Register admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

		// Refreshing the widget's cached output with each new post
		//add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		//add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	} // end constructor


    /**
     * Return the widget slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_widget_slug() {
        return $this->widget_slug;
    }

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {
		// Check if there is a cached output
		$cache = wp_cache_get( $this->widget_slug, 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];
		
		// go on with your widget logic, put everything into a string and …


		extract( $args, EXTR_SKIP );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Flexible Countdown', $this->widget_slug  ) : $instance['title'] );

        $title = $before_title.$title.$after_title;
		$widget_string = $before_widget;

		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );
		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;


        //var_dump($widget_string);

		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->widget_slug, $cache, 'widget' );

		print $widget_string;

	} // end widget
	
	
	public function flush_widget_cache() 
	{
    	wp_cache_delete( $this->widget_slug, 'widget' );
	}
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;


        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cbfc_countdown_style'] = strip_tags( $new_instance['cbfc_countdown_style'] );
        $instance['cbfc_date'] = strip_tags( $new_instance['cbfc_date'] );
        $instance['cbfc_hour'] = (int) strip_tags( $new_instance['cbfc_hour'] );
        $instance['cbfc_min'] = (int) strip_tags( $new_instance['cbfc_min'] );

		$instance              = apply_filters('cbxflexiblecountdownwidgetupdate', $instance, $new_instance, $old_instance);
        //$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        $this->flush_widget_cache();

        /*
        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');
        */
		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {


		$instance = wp_parse_args(
			(array) $instance
		);

        $title                    = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : '';
        $cbfc_countdown_style     = isset( $instance['cbfc_countdown_style'] ) ? strip_tags( $instance['cbfc_countdown_style'] ) : '';
        $cbfc_date     = isset( $instance['title'] ) ? strip_tags( $instance['cbfc_date'] ) : '';
        $cbfc_hour     = isset( $instance['cbfc_hour'] ) ? (int) strip_tags( $instance['cbfc_hour'] ) : '0';
        $cbfc_min      = isset( $instance['cbfc_min'] ) ? (int) strip_tags( $instance['cbfc_min'] ) : '0';

        wp_enqueue_script( 'jquery-ui-datepicker' );
		// Display the admin form
		include( plugin_dir_path(__FILE__) . 'views/admin.php' );

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function widget_textdomain() {

		load_plugin_textdomain( $this->widget_slug, false, plugin_dir_path( __FILE__ ) . 'lang/' );

	} // end widget_textdomain

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {

	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {

	} // end deactivate

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
        wp_enqueue_style( $this->widget_slug .'-admin-widget-date-picker', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', array(), '1.0.0' );
		//wp_enqueue_style( $this->widget_slug.'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array( $this->widget_slug .'-admin-widget-date-picker' ) );

	} // end register_admin_styles

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->widget_slug.'-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array('jquery', 'jquery-ui-datepicker'), '1.0.0', true );

	} // end register_admin_scripts

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		//wp_enqueue_style( $this->widget_slug.'-widget-styles', plugins_url( 'css/widget.css', __FILE__ ) );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {

		wp_enqueue_script( $this->widget_slug.'-script', plugins_url( 'js/widget.js', __FILE__ ), array('jquery') );

	} // end register_widget_scripts

} // end class


add_action( 'widgets_init', create_function( '', 'register_widget("CodeboxrFlexibleCountdownWidget");' ) );

<?php
//--------- settings class install ---------------- //

require_once (CFB_LOGIN_FORMO_DIR. '/assets/settings.php');

/**
 * installing setting api class by wedevs
 */
if ( !class_exists('cfb_login_formo_settings_API' ) ):
class cfb_login_formo_settings_API {

    private $settings_api;

    function __construct() {
        $this->settings_api = new cfb_login_formo_mother_class;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }
	
    function admin_menu() {
        add_options_page( 'CFB WP Login Form Customizer', 'CFB WP Login Form Customizer', 'delete_posts', 'cfb_wp_login_form_customizer', array($this, 'cfb_login_formo_plugin_page') );
    }
	// setings tabs
    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'cfb_login_formo_general',
                'title' => __( 'General Settings', 'text_domain' )
            ),
            array(
                'id' => 'cfb_login_formo_section',
                'title' => __( 'Login Form Section', 'text_domain' )
            ),
            array(
                'id' => 'cfb_login_formo',
                'title' => __( 'Login Form', 'text_domain' )
            ),
            array(
                'id' => 'notification',
                'title' => __( 'Notification Settings', 'text_domain' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'cfb_login_formo_general' => array(
				array(
                'name' => 'loginformo_bg_color',
                'label' => __( 'Body Background color', 'text_domain' ),
                'desc' => __( 'Pick a color for login body background.Default color is(none).', 'text_domain' ),
                'type' => 'color',
				),
				array(
                'name' => 'loginformo_bg_image',
                'label' => __( 'Body Background Image', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for body background.', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'loginformo_bg_img_repeat',
                'label' => __( 'Body Background Repeat', 'text_domain' ),
                'type' => 'radio',
				'default' => 'repeat',
                'options' => array(
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat-X',
                    'repeat-y' => 'Repeat-Y',
                    'no-repeat' => 'No-Repeat'
                )
				),
				array(
                'name' => 'loginformo_bg_img_size',
                'label' => __( 'Body Background Size', 'text_domain' ),
                'type' => 'radio',
				'default' => 'auto',
                'options' => array(
                    'auto' => 'Auto',
                    'cover' => 'Fit-To-Screen'
                )
				),
				array(
                'name' => 'loginformo_logo',
                'label' => __( 'Login Form Logo', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for login form logo.Please also use resize image best size for logo is 320px*80px.', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'nav_text_transform',
                'label' => __( 'Button Nav Text Transform', 'text_domain' ),
                'type' => 'radio',
				'default' => 'normal',
                'options' => array(
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase'
                )
				),
				array(
                'name' => 'nav_text_color',
                'label' => __( 'Buttom Nav Text Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Buttom Nav.Default color is(none).', 'text_domain' ),
                'type' => 'color',
				),			
            ),
			
			'cfb_login_formo_section' => array(
				array(
                'name' => 'form_section_border_width',
                'label' => __( 'Form Section Border Width', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'form_section_border_color',
                'label' => __( 'Form Section Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Form Section Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'form_section_border_radius',
                'label' => __( 'Form Section Border Radius', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'form_section_bg_color',
                'label' => __( 'Form Section Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Form Section Background Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'form_section_bg_img',
                'label' => __( 'Form Section Background Image', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for Form Section Background..', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'form_section_bg_repeat',
                'label' => __( 'Form Section Background Repeat', 'text_domain' ),
                'type' => 'radio',
				'default' => 'repeat',
                'options' => array(
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat-X',
                    'repeat-y' => 'Repeat-Y',
                    'no-repeat' => 'No-Repeat'
                )
				),
				array(
                'name' => 'form_section_bg_size',
                'label' => __( 'Form Section Background Size', 'text_domain' ),
                'type' => 'radio',
				'default' => 'auto',
                'options' => array(
                    'auto' => 'Auto',
                    'cover' => 'Fit-To-Screen'
                )
				),
            ),
			
			'cfb_login_formo' => array(
				array(
                'name' => 'form_border_width',
                'label' => __( 'Form Border Width', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'form_border_color',
                'label' => __( 'Form Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Form Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'form_border_radius',
                'label' => __( 'Form Border Radius', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'form_bg_color',
                'label' => __( 'Form Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Form Background Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'form_bg_img',
                'label' => __( 'Form Background Image', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for Form Background..', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'form_bg_repeat',
                'label' => __( 'Form Background Repeat', 'text_domain' ),
                'type' => 'radio',
				'default' => 'repeat',
                'options' => array(
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat-X',
                    'repeat-y' => 'Repeat-Y',
                    'no-repeat' => 'No-Repeat'
                )
				),
				array(
                'name' => 'form_bg_size',
                'label' => __( 'Form Background Size', 'text_domain' ),
                'type' => 'radio',
				'default' => 'auto',
                'options' => array(
                    'auto' => 'Auto',
                    'cover' => 'Fit-To-Screen'
                )
				),
				array(
                'name' => 'label_text_transform',
                'label' => __( 'Input Label Text Transform', 'text_domain' ),
                'type' => 'radio',
				'default' => 'normal',
                'options' => array(
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase'
                )
				),
				array(
                'name' => 'label_color',
                'label' => __( 'Input Label Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Input Label Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'input_border_width',
                'label' => __( 'Input Border Width', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'input_border_color',
                'label' => __( 'Input Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Input Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'input_border_radius',
                'label' => __( 'Input Border Radius', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'input_bg_color',
                'label' => __( 'Input Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Input Background Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'input_bg_img',
                'label' => __( 'Input Background Image', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for Input Background..', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'input_bg_repeat',
                'label' => __( 'Input Background Repeat', 'text_domain' ),
                'type' => 'radio',
				'default' => 'repeat',
                'options' => array(
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat-X',
                    'repeat-y' => 'Repeat-Y',
                    'no-repeat' => 'No-Repeat'
                )
				),
				array(
                'name' => 'input_bg_size',
                'label' => __( 'Input Background Size', 'text_domain' ),
                'type' => 'radio',
				'default' => 'auto',
                'options' => array(
                    'auto' => 'Auto',
                    'cover' => 'Fit-To-Screen'
                )
				),
				array(
                'name' => 'input_text_color',
                'label' => __( 'Input Text Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Input Text Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'btn_border_width',
                'label' => __( 'Button Border Width', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'btn_border_color',
                'label' => __( 'Button Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Button Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'btn_border_radius',
                'label' => __( 'Button Border Radius', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'btn_bg_color',
                'label' => __( 'Button Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Button Background Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'btn_text_color',
                'label' => __( 'Button Text Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Button Text Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'btn_text_transform',
                'label' => __( 'Button Text Transform', 'text_domain' ),
                'type' => 'radio',
				'default' => 'normal',
                'options' => array(
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase'
                )
				),
				array(
                'name' => 'btnh_bg_color',
                'label' => __( 'Button Hover Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Button Background Color When Hover.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'btnh_text_color',
                'label' => __( 'Button Hover Text Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Button Text Color When Hover.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),				
            ),
			
			'notification' => array(
				array(
                'name' => 'not_border_width',
                'label' => __( 'Notification Border Width', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'not_border_color',
                'label' => __( 'Notification Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Notification Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'not_border_radius',
                'label' => __( 'Notification Border Radius', 'text_domain' ),
                'desc' => __( 'Default: 0px', 'text_domain' ),
                'type' => 'number',
                'default' => '0'
				),
				array(
                'name' => 'not_error_border_color',
                'label' => __( 'Error Notification Border Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Error Notification Border Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'not_bg_color',
                'label' => __( 'Notification Background Color', 'text_domain' ),
                'desc' => __( 'Pick a color for Notification Background Color.Default color is(none).', 'text_domain' ),
                'type' => 'color'
				),
				array(
                'name' => 'not_bg_img',
                'label' => __( 'Notification Background Image', 'text_domain' ),
                'desc' => __( 'Please Put Image Link for Notification Background..', 'text_domain' ),
                'type' => 'text'
				),
				array(
                'name' => 'not_bg_repeat',
                'label' => __( 'Notification Background Repeat', 'text_domain' ),
                'type' => 'radio',
				'default' => 'repeat',
                'options' => array(
                    'repeat' => 'Repeat',
                    'repeat-x' => 'Repeat-X',
                    'repeat-y' => 'Repeat-Y',
                    'no-repeat' => 'No-Repeat'
                )
				),
				array(
                'name' => 'not_bg_size',
                'label' => __( 'Notification Background Size', 'text_domain' ),
                'type' => 'radio',
				'default' => 'auto',
                'options' => array(
                    'auto' => 'Auto',
                    'cover' => 'Fit-To-Screen'
                )
				),
            ),
        );
		return $settings_fields;
    }
	
	// warping the settings
    function cfb_login_formo_plugin_page() {
        echo '<div style="margin-top:20px;margin-right:20px;" class="cfb_adds"><a href="http://codefairbd.com"><img style="Width:100%;height:auto;" src="'.CFB_LOGIN_FORMO_URL.'/images/adds1.jpg" alt=""></a></div>';
        echo '<div class="wrap">';
			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();
		echo '</div>';
        echo '<div style="margin-top:20px;margin-right:20px;" class="cfb_adds"><a href="http://codefairbd.com"><img style="Width:100%;height:auto;" src="'.CFB_LOGIN_FORMO_URL.'/images/adds2.jpg" alt=""></a></div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }
        return $pages_options;
    }
}
endif;

$settings = new cfb_login_formo_settings_API();
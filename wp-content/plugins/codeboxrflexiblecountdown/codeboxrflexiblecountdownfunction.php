<?php
/*
* @package   Codeboxr_Flexible_CountDown
* @author    Codeboxr <info@wpboxr.com>
* @license   GPL-2.0+
* @link      http://wpboxr.com/
* @copyright Codeboxr
*/
?>
<?php


/**
 * This function is for debugging. Not to use in production
 * @param $arr (array|string)
 * @param bool $var_dump
 * @param bool $both
 */
/*function echo_pre($arr, $var_dump = false, $both = false) {
    if ( $both ) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';

        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    } else if ( $var_dump ) {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    } else {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}*/


if(!function_exists('cbfc_get_countdown_style')) {
    /**
     * @return mixed|void
     */
    function cbfc_get_countdown_style($text_domain = '') {
        return apply_filters(
            'cbfc_add_countdown_style',
            array(
                'cbfc_light' => __('Light Countdown', $text_domain)
            )
        );
    }
}


if(!function_exists('cbfc_get_section_setting')) {
    /**
     * @param $text_domain
     * @return array|mixed|void
     */
    function cbfc_get_section_setting($text_domain) {

        //var_dump($text_domain);
        $sections = array(
            array(
                'id'        => 'cbfc_general_settings',
                'title'     => __( 'General Settings', $text_domain )
            ),
        );

        $additional_sections = apply_filters('cbfc_add_sections', $sections);

        if ( is_array( $additional_sections ) ) {
            foreach( $additional_sections as $new_tab_key => $new_tab_sec ) {
                if ( $new_tab_sec['id'] == $sections[$new_tab_key]['id'] ) {
                    $sections[$new_tab_key]['title'] = $new_tab_sec['title'];
                } else {
                    array_push( $sections, $new_tab_sec );
                }
            }
        }
        return $sections;
    }
}

if(!function_exists('cbfc_get_settings_field')) {
    /**
     * @param $text_domain
     * @return array|mixed|void
     */
    function cbfc_get_settings_field($text_domain, $cbfc_options_prefix = 'cbfc_countdown_') {
        $fields = array(
            'cbfc_general_settings' => array(
                array(
                    'name'      => $cbfc_options_prefix . 'type',
                    'label'     => __( 'Choose countdown style', $text_domain ),
                    'desc'      => __( '', $text_domain ),
                    'type'      => 'select',
                    'options'   => cbfc_get_countdown_style($text_domain),
                    'default'   => 'cbfc_light'
                ),
                array(
                    'name'      => $cbfc_options_prefix . 'date',
                    'label'     => __('Launch Date', $text_domain),
                    'desc'      => __('', $text_domain),
                    'type'      => 'datepicker',
                    'default'   => ''
                ),
                array(
                    'name'      => $cbfc_options_prefix . 'hour',
                    'label'     => __('Launch Hour', $text_domain),
                    'desc'      => __('Max value is 23', $text_domain),
                    'type'      => 'number',
                    'size'      => 'hour',
                    'default'   => '0',
                    'min'       => 0,
                    'max'       => 23
                ),
                array(
                    'name'      => $cbfc_options_prefix . 'min',
                    'label'     => __('Launch Minutes', $text_domain),
                    'desc'      => __('Max value is 59', $text_domain),
                    'type'      => 'number',
                    'default'   => '0',
                    'size'      => 'minutes',
                    'min'       => 0,
                    'max'       => 59
                ),
                array(
                    'name' => $cbfc_options_prefix . 'num_color',
                    'label' => __('Count Number Color', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#333'
                ),
                array(
                    'name' => $cbfc_options_prefix . 'res_num_color',
                    'label' => __('Count Number Color (On Responsive)', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#333'
                ),
                array(
                    'name' => $cbfc_options_prefix . 'num_bg_color',
                    'label' => __('Count Number Background Color', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#eaeaea'
                ),
                array(
                    'name' => $cbfc_options_prefix . 'text_color',
                    'label' => __('Text Color', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#fff'
                ),
                array(
                    'name' => $cbfc_options_prefix . 'res_text_color',
                    'label' => __('Text Color (On Responsive)', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#333'
                ),
                array(
                    'name' => $cbfc_options_prefix . 'text_bg_color',
                    'label' => __('Text Background Color', $text_domain ),
                    'desc' => __('', $text_domain ),
                    'type' => 'colorpicker',
                    'default' => '#f5832b'
                )
            )
        );

        $additional_fields = apply_filters( 'cbfc_add_fields', $fields, $cbfc_options_prefix );

        if ( is_array( $additional_fields ) ) {
            foreach( $additional_fields as $fields_key => $field_arr ) {
                if ( array_key_exists( $fields_key, $fields ) ) {

                } else {
                    $fields[$fields_key] = $additional_fields[$fields_key];
                }
            }
        }
        return $fields;
    }
}


if ( !function_exists( 'cbfc_flexible_countdown' ) ) {
    /**
     * call this function in php file to show countdown
     *
     * @since    1.0.0
     *
     * @return mixed || countdown
     */
    function cbfc_flexible_countdown($ext_arr = array()) {
        return call_user_func( 'Codeboxr_Flexible_CountDown::cbfc_get_flexible_countdown', $ext_arr );
    }
}

if ( !function_exists( 'cbfc_get_options' ) ) {

    /**
     * Get all countdown option value from any where in theme or plugin
     *
     * @since    1.0.0
     *
     * @return mixed|option value
     */
    function cbfc_get_options($option_name = '', $section_name = 'cbfc_general_settings', $arr = false) {
        return call_user_func( 'Codeboxr_Flexible_CountDown::cbfc_get_countdown_options', $option_name, $section_name, $arr );
    }
}

if ( !function_exists( 'cbfc_get_text_domain' ) ) {
    /**
     * Get the default text domain
     *
     * @since   1.0.0
     *
     * @return mixed
     */
    function cbfc_get_text_domain() {
        return call_user_func( 'Codeboxr_Flexible_CountDown::cbfc_get_text_domain' );
    }
}

if ( !function_exists( 'cbfc_get_shortcode_attr' ) ) {
    /**
     * Get shortcode attr array
     *
     * @since   1.0.0
     *
     * @return mixed
     */
    function cbfc_get_shortcode_attr() {
        return call_user_func( 'Codeboxr_Flexible_CountDown::cbfc_get_shortcode_attr' );
    }
}


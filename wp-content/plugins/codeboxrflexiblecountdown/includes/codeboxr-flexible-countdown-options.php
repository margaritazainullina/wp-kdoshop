<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2014 Codeboxr
 */


if ( ! defined( 'WPINC' ) ) {
    die;
}


/**
 * Registers settings section and fields
 */

add_filter( 'cbfc_add_countdown_style', 'cbfc_add_premium_countdown_style' );

if ( !function_exists( 'cbfc_add_premium_countdown_style' ) ) {


    /**
     * @param $style_list
     * @return array
     */
    function cbfc_add_premium_countdown_style($style_list) {
        return array_merge($style_list,
            array(
                'cbfc_circular' => __( 'Circular Countdown', cbfc_get_text_domain() )
            ),
            array(
                'cbfc_kk'       => __( 'KK Countdown', cbfc_get_text_domain() )
            ));
        return $style_list;
    }
}



// new filter list
add_filter( 'cbfc_add_sections', 'cbfc_advanced_settings_sections' );
if ( !function_exists( 'cbfc_advanced_settings_sections' ) ) {
    /**
     * Describe advanced options
     *
     * @param $sections
     * @return mixed
     * @since 1.0.0
     */
    function cbfc_advanced_settings_sections($sections) {
        // declare advanced settings here
        return array(
            array(
                'id' => 'cbfc_circular_settings',
                'title' => __( 'Circular Countdown Settings', cbfc_get_text_domain() )
            ),

            array(
                'id' => 'cbfc_kk_settings',
                'title' => __( 'KK Countdown Settings', cbfc_get_text_domain() )
            )
        );
    }
}


add_filter( 'cbfc_add_fields', 'advanced_settings_fields', 10, 2 );
if ( !function_exists( 'advanced_settings_fields' ) ) {
    /*
     *
     *
     */

    function advanced_settings_fields($fields, $name_prefix = '')
    {
        return array(
            'cbfc_circular_settings' => array(
                array(
                    'name' => $name_prefix . 'canvas_color',
                    'label' => __('Background Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#9c9c9c'
                ),
                array(
                    'name' => $name_prefix . 'font_color',
                    'label' => __('Count Number And Text Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#ffffff'
                ),
                array(
                    'name' => $name_prefix . 'text_color',
                    'label' => __('Text Color (On Responsive)', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#333'
                ),
                array(
                    'name' => $name_prefix . 'sec_color',
                    'label' => __('Seconds Border Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#7995D5'
                ),
                array(
                    'name' => $name_prefix . 'mins_color',
                    'label' => __('Minutes Border Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#ACC742'
                ),
                array(
                    'name' => $name_prefix . 'hours_color',
                    'label' => __('Hours Border Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#ECEFCB'
                ),
                array(
                    'name' => $name_prefix . 'days_color',
                    'label' => __('Days Border Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#FF9900'
                )
            ),

            'cbfc_kk_settings' => array(
                array(
                    'name' => $name_prefix . 'countdown_font_size',
                    'label' => __('Countdown Font Size', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'text',
                    'default' => '30'
                ),
                array(
                    'name' => $name_prefix . 'countdown_color',
                    'label' => __('Countdown Number Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#3767b9'
                ),

                array(
                    'name' => $name_prefix . 'countdown_text_color',
                    'label' => __('Countdown Text Color', cbfc_get_text_domain() ),
                    'desc' => __('', cbfc_get_text_domain() ),
                    'type' => 'colorpicker',
                    'default' => '#666333'
                )
            )
        );
    }
}

if ( !function_exists( 'get_all_options_from_settings' ) ) {
    function get_all_options_from_settings() {
        $plug_options = array_merge( ( is_array( get_option( 'cbfc_circular_settings' ) ) ? get_option( 'cbfc_circular_settings' ) : array() ), ( is_array( get_option( 'cbfc_kk_settings' ) ) ? get_option( 'cbfc_kk_settings' ) : array() ) );
        $ext_default_otions['secbclr']      = ( !empty( $plug_options['cbfc_countdown_sec_color'] ) ) ? $plug_options['cbfc_countdown_sec_color'] : '#7995D5';
        $ext_default_otions['minbclr']      = ( !empty( $plug_options['cbfc_countdown_mins_color'] ) ) ? $plug_options['cbfc_countdown_mins_color'] : '#acc742';
        $ext_default_otions['hourbclr']     = ( !empty( $plug_options['cbfc_countdown_hours_color'] ) ) ? $plug_options['cbfc_countdown_hours_color'] : '#ECEFCB';
        $ext_default_otions['daysbclr']     = ( !empty( $plug_options['cbfc_countdown_days_color'] ) ) ? $plug_options['cbfc_countdown_days_color'] : '#FF9900';
        $ext_default_otions['bgclr']        = ( !empty( $plug_options['cbfc_countdown_canvas_color'] ) ) ? $plug_options['cbfc_countdown_canvas_color'] : '#9c9c9c';
        $ext_default_otions['fontclr']      = ( !empty( $plug_options['cbfc_countdown_font_color'] ) ) ? $plug_options['cbfc_countdown_font_color'] : '#fff';
        $ext_default_otions['textclr']      = ( !empty( $plug_options['cbfc_countdown_text_color'] ) ) ? $plug_options['cbfc_countdown_text_color'] : '#333';
        $ext_default_otions['kkfsize']      = ( !empty( $plug_options['cbfc_countdown_countdown_font_size'] ) ) ? $plug_options['cbfc_countdown_countdown_font_size'] : '30';
        $ext_default_otions['kkfclr']       = ( !empty( $plug_options['cbfc_countdown_countdown_color'] ) ) ? $plug_options['cbfc_countdown_countdown_color'] : '#3767b9';
        $ext_default_otions['kktextclr']    = ( !empty( $plug_options['cbfc_countdown_countdown_text_color'] ) ) ? $plug_options['cbfc_countdown_countdown_text_color'] : '#666333';
        return $ext_default_otions;
    }
}

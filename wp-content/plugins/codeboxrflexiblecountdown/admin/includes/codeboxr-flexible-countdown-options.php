<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2014 Codeboxr
 */
?>
<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}


/**
 * Registers settings section and fields
 */

if(!function_exists('cbfc_get_section_setting')) {
    /**
     * @param $text_domain
     * @return array|mixed|void
     */
    function cbfc_get_section_setting($text_domain) {
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

<?php
    /*
    Plugin Name: Profile Builder - Custom CSS Classes on fields
    Plugin URI: http://www.cozmoslabs.com/wordpress-profile-builder/
    Description: Extends the functionality of Profile Builder by adding the possibility to have custom css classes on fields
    Version: 1.0.1
    Author: cozmoslabs, Madalin Ungureanu
    Author URI: http://www.cozmoslabs.com/
    License: GPL2

    == Copyright ==
    Copyright 2015 Cozmoslabs (www.cozmoslabs.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
    */

    /*
     * Function that enqueues the necessary scripts
     *
     * @since v.1.0.0
     */
    function wppb_custom_css_classes_scripts() {
        wp_enqueue_script( 'wppb-custom-css-class-field', plugin_dir_url(__FILE__) . 'assets/js/main.js', array( 'jquery', 'wppb-manage-fields-live-change' ) );
    }
    add_action( 'admin_enqueue_scripts', 'wppb_custom_css_classes_scripts' );

    /*
     * Function that adds the numbers only checkbox on an input field.
     *
     * @since v.1.0.0
     *
     * @param array $fields - The current field properties
     *
     * @return array        - The field properties that now include the numbers only checkbox
     */
    function wppb_custom_css_classes_field( $fields ) {
        $class = array(
            'type' => 'text',
            'slug' => 'class-field',
            'title' => __( 'CSS Class', 'profilebuilder' ),
            'description' => __( "Add a class to a field. Should not contain dots(.) and for multiple classes separate by space.", 'profilebuilder' )
        );
        array_push( $fields, $class );
        return $fields;
    }
    add_filter( 'wppb_manage_fields', 'wppb_custom_css_classes_field' );

    add_filter( 'wppb_field_css_class', 'wppb_custom_css_classes_change_class', 10, 3 );
    function wppb_custom_css_classes_change_class( $class, $field, $error_var ){
        if( !empty( $field['class-field'] ) ){
            $class .= ' '.$field['class-field'];
        }
        return $class;
    }
?>
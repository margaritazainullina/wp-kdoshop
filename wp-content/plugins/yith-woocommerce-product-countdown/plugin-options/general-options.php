<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

return array(
    'general' => array(
        'ywpc_videobox'              => array(
            'name'    => __( 'Upgrade to the PREMIUM VERSION', 'yith-woocommerce-product-countdown' ),
            'type'    => 'videobox',
            'default' => array(
                'plugin_name'               => __( 'YITH WooCommerce Product Countdown', 'yith-woocommerce-product-countdown' ),
                'title_first_column'        => __( 'Discover the Advanced Features', 'yith-woocommerce-product-countdown' ),
                'description_first_column'  => __( 'Upgrade to the PREMIUM VERSION of YITH WooCommerce Product Countdown to benefit from all features!', 'yith-woocommerce-product-countdown' ),
                'video'                     => array(
                    'video_id'          => '118792418',
                    'video_image_url'   => YWPC_ASSETS_URL . '/images/yith-woocommerce-product-countdown.jpg',
                    'video_description' => __( 'YITH WooCommerce Product Countdown', 'yith-woocommerce-product-countdown' ),
                ),
                'title_second_column'       => __( 'Get Support and Pro Features', 'yith-woocommerce-product-countdown' ),
                'description_second_column' => __( 'By purchasing the premium version of the plugin, you will take advantage of the advanced features of the product and you will get one year of free updates and support through our platform available 24h/24.', 'yith-woocommerce-product-countdown' ),
                'button'                    => array(
                    'href'  => YITH_WPC()->get_premium_landing_uri(),
                    'title' => 'Get Support and Pro Features'
                )
            ),
            'id'      => 'ywpc_general_videobox'
        ),
        'ywpc_general_title'         => array(
            'name' => __( 'General Settings', 'yith-woocommerce-product-countdown' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_general_title',
        ),
        'ywpc_general_enable_plugin' => array(
            'name'    => __( 'Enable YITH WooCommerce Product Countdown', 'yith-woocommerce-product-countdown' ),
            'type'    => 'checkbox',
            'desc'    => '',
            'id'      => 'ywpc_enable_plugin',
            'default' => 'yes',
        ),
        'ywpc_general_end'           => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_general_end'
        ),
    )
);
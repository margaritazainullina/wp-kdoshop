<?php
/**
 * Plugin Name: YITH WooCommerce Product Countdown
 * Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-product-countdown/
 * Description: The right time for the right product.
 * Author: YIThemes
 * Text Domain: yith-woocommerce-product-countdown
 * Version: 1.0.8
 * Author URI: http://yithemes.com/
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( !function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function ywpc_install_free_admin_notice() {
    ?>
    <div class="error">
        <p><?php _e( 'You can\'t activate the free version of YITH WooCommerce Product Countdown while you are using the premium one.', 'yith-woocommerce-product-countdown' ); ?></p>
    </div>
    <?php
}

function ywpc_install_woocommerce_admin_notice() {
    ?>
    <div class="error">
        <p><?php _e( 'YITH WooCommerce Product Countdown is enabled but not effective. It requires WooCommerce in order to work.', 'yith-woocommerce-product-countdown' ); ?></p>
    </div>
    <?php
}

if ( !defined( 'YWPC_VERSION' ) ) {
    define( 'YWPC_VERSION', '1.0.8' );
}

if ( !defined( 'YWPC_FREE_INIT' ) ) {
    define( 'YWPC_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( !defined( 'YWPC_FILE' ) ) {
    define( 'YWPC_FILE', __FILE__ );
}

if ( !defined( 'YWPC_DIR' ) ) {
    define( 'YWPC_DIR', plugin_dir_path( __FILE__ ) );
}

if ( !defined( 'YWPC_URL' ) ) {
    define( 'YWPC_URL', plugins_url( '/', __FILE__ ) );
}

if ( !defined( 'YWPC_ASSETS_URL' ) ) {
    define( 'YWPC_ASSETS_URL', YWPC_URL . 'assets' );
}

if ( !defined( 'YWPC_TEMPLATE_PATH' ) ) {
    define( 'YWPC_TEMPLATE_PATH', YWPC_DIR . 'templates' );
}

/* Plugin Framework Version Check */
if ( !function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( YWPC_DIR . 'plugin-fw/init.php' ) ) {
    require_once( YWPC_DIR . 'plugin-fw/init.php' );
}
yit_maybe_plugin_fw_loader( YWPC_DIR );

function ywpc_free_init() {

    /* Load text domain */
    load_plugin_textdomain( 'yith-woocommerce-product-countdown', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    /* === Global YITH WooCommerce Product Countdown  === */
    YITH_WPC();

}

add_action( 'ywpc_init', 'ywpc_free_init' );

function ywpc_free_install() {

    if ( !function_exists( 'WC' ) ) {
        add_action( 'admin_notices', 'ywpc_install_woocommerce_admin_notice' );
    }
    elseif ( defined( 'YWPC_PREMIUM' ) ) {
        add_action( 'admin_notices', 'ywpc_install_free_admin_notice' );
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }
    else {
        do_action( 'ywpc_init' );
    }

}

add_action( 'plugins_loaded', 'ywpc_free_install', 11 );

/**
 * Init default plugin settings
 */
if ( !function_exists( 'yith_plugin_registration_hook' ) ) {
    require_once 'plugin-fw/yit-plugin-registration-hook.php';
}

register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

if ( !function_exists( 'YITH_WPC' ) ) {

    /**
     * Unique access to instance of YITH_WC_Product_Countdown class
     *
     * @since 1.0.0
     * @return YITH_WC_Product_Countdown|YITH_WC_Product_Countdown_Premium
     */
    function YITH_WPC() {
        // Load required classes and functions
        require_once( YWPC_DIR . 'class.yith-wc-product-countdown.php' );

        if ( defined( 'YWPC_PREMIUM' ) && file_exists( YWPC_DIR . 'class.yith-wc-product-countdown-premium.php' ) ) {
            require_once( YWPC_DIR . 'class.yith-wc-product-countdown-premium.php' );
            return YITH_WC_Product_Countdown_Premium::get_instance();
        }

        return YITH_WC_Product_Countdown::get_instance();
    }
}


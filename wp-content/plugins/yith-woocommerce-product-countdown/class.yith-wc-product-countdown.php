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

/**
 * Main class
 *
 * @class   YITH_WC_Product_Countdown
 * @package Yithemes
 * @since   1.0.0
 * @author  Your Inspiration Themes
 */

if ( !class_exists( 'YITH_WC_Product_Countdown' ) ) {

    class YITH_WC_Product_Countdown {

        /**
         * Single instance of the class
         *
         * @var \YITH_WC_Product_Countdown
         * @since 1.0.0
         */
        protected static $instance;

        /**
         * Panel object
         *
         * @var     /Yit_Plugin_Panel object
         * @since   1.0.0
         * @see     plugin-fw/lib/yit-plugin-panel.php
         */
        protected $_panel = null;

        /**
         * @var $_premium string Premium tab template file name
         */
        protected $_premium = 'premium.php';

        /**
         * @var string Premium version landing link
         */
        protected $_premium_landing = 'http://yithemes.com/themes/plugins/yith-woocommerce-product-countdown/';

        /**
         * @var string Plugin official documentation
         */
        protected $_official_documentation = 'http://yithemes.com/docs-plugins/yith-woocommerce-product-countdown/';

        /**
         * @var string Yith WooCommerce Catalog Mode panel page
         */
        protected $_panel_page = 'yith-wc-product-countdown';

        /**
         * @var string id for Product Sales Countdown tab in product edit page
         */
        var $_product_tab = 'product_countdown';

        /**
         * Returns single instance of the class
         *
         * @return \YITH_WC_Product_Countdown
         * @since 1.0.0
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self( $_REQUEST );
            }

            return self::$instance;
        }

        /**
         * Constructor
         *
         * @since   1.0.0
         * @return  mixed
         * @author  Alberto Ruggiero
         */
        public function __construct() {

            add_action( 'plugins_loaded', array( $this, 'plugin_fw_loader' ), 12 );
            add_filter( 'plugin_action_links_' . plugin_basename( YWPC_DIR . '/' . basename( YWPC_FILE ) ), array( $this, 'action_links' ) );
            add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 4 );

            add_action( 'admin_menu', array( $this, 'add_menu_page' ), 5 );
            add_action( 'yith_product_countdown_premium', array( $this, 'premium_tab' ) );

            // Include required files
            $this->includes();

            if ( get_option( 'ywpc_enable_plugin' ) == 'yes' ) {

                if ( is_admin() ) {

                    add_filter( 'woocommerce_product_write_panel_tabs', array( $this, 'add_countdown_tab' ), 98 );
                    add_action( 'woocommerce_process_product_meta', array( $this, 'save_countdown_tab' ), 10, 2 );
                    add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

                }
                else {

                    add_action( 'woocommerce_before_main_content', array( $this, 'check_show_ywpc_product' ), 5 );
                    add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

                }

            }

        }

        /**
         * Include required core files
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function includes() {

            include_once( 'includes/functions-ywpc-countdown.php' );

        }

        /**
         * ADMIN FUNCTIONS
         */

        /**
         * Add a panel under YITH Plugins tab
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         * @use     /Yit_Plugin_Panel class
         * @see     plugin-fw/lib/yit-plugin-panel.php
         */
        public function add_menu_page() {

            if ( !empty( $this->_panel ) ) {
                return;
            }

            $admin_tabs = array();

            if ( defined( 'YWPC_PREMIUM' ) ) {
                $admin_tabs['premium-general'] = __( 'General', 'yith-woocommerce-product-countdown' );
                $admin_tabs['style']           = __( 'Customization', 'yith-woocommerce-product-countdown' );
                $admin_tabs['bulk']            = __( 'Bulk Operations', 'yith-woocommerce-product-countdown' );
                $admin_tabs['topbar']          = __( 'Top/Bottom Countdown bar', 'yith-woocommerce-product-countdown' );
            }
            else {
                $admin_tabs['general']         = __( 'General', 'yith-woocommerce-product-countdown' );
                $admin_tabs['premium-landing'] = __( 'Premium Version', 'yith-woocommerce-product-countdown' );
            }

            $args = array(
                'create_menu_page' => true,
                'parent_slug'      => '',
                'page_title'       => __( 'Product Countdown', 'yith-woocommerce-product-countdown' ),
                'menu_title'       => __( 'Product Countdown', 'yith-woocommerce-product-countdown' ),
                'capability'       => 'manage_options',
                'parent'           => '',
                'parent_page'      => 'yit_plugin_panel',
                'page'             => $this->_panel_page,
                'admin-tabs'       => $admin_tabs,
                'options-path'     => YWPC_DIR . 'plugin-options'
            );

            $this->_panel = new YIT_Plugin_Panel_WooCommerce( $args );

        }

        /**
         * Enqueue admin script files
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function admin_scripts() {

            $screen = get_current_screen();

            wp_enqueue_style( 'ywpc-admin', YWPC_ASSETS_URL . '/css/ywpc-admin.css' );

            if ( in_array( $screen->id, array( 'product', 'edit-product' ) ) ) {

                $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

                wp_enqueue_script( 'ywpc-admin', YWPC_ASSETS_URL . '/js/ywpc-admin' . $suffix . '.js', array( 'jquery', 'wc-admin-product-meta-boxes' ) );

                $js_vars = array(
                    'pre_schedule' => ( defined( 'YWPC_FREE_INIT' ) ) ? false : true,
                );

                wp_localize_script( 'ywpc-admin', 'ywpc', $js_vars );
            }

        }

        /**
         * Add sales countdown tab in product edit page
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function add_countdown_tab() {

            global $post;

            $save_post = $post;

            ?>

            <li class="<?php echo $this->_product_tab; ?>_options <?php echo $this->_product_tab; ?>_tab <?php echo apply_filters( 'ywpc_tab_class', 'show_if_simple' ) ?>">
                <a href="#<?php echo $this->_product_tab; ?>_tab"><?php _e( 'Product Countdown', 'yith-woocommerce-product-countdown' ); ?></a>
            </li>

            <?php

            $post = $save_post;

            add_action( 'woocommerce_product_write_panels', array( $this, 'write_tab_options' ) );

        }

        /**
         * Add sales countdown tab content in product edit page
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function write_tab_options() {

            global $post;

            ?>

            <div id="<?php echo $this->_product_tab; ?>_tab" class="panel woocommerce_options_panel">
                <div class="options_group sales_countdown">
                    <?php

                    $args = array(
                        'id'            => '_ywpc_enabled',
                        'wrapper_class' => '',
                        'label'         => __( 'Enable ', 'yith-woocommerce-product-countdown' ),
                        'description'   => __( 'Enable YITH WooCommerce Product Countdown for this product', 'yith-woocommerce-product-countdown' )
                    );

                    woocommerce_wp_checkbox( $args );

                    $sale_price_dates_from = ( $date = get_post_meta( $post->ID, '_ywpc_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                    $sale_price_dates_to   = ( $date = get_post_meta( $post->ID, '_ywpc_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

                    apply_filters( 'ywpc_countdown_tab_notice', '' );

                    ?>
                    <p class="form-field ywpc-dates">
                        <label for="_ywpc_sale_price_dates_from"><?php _e( 'Countdown Dates', 'yith-woocommerce-product-countdown' ) ?></label>
                        <input type="text" class="short ywpc_sale_price_dates_from" name="_ywpc_sale_price_dates_from" id="_ywpc_sale_price_dates_from" value="<?php echo esc_attr( $sale_price_dates_from ) ?>" placeholder="<?php _e( 'From&hellip;', 'yith-woocommerce-product-countdown' ) ?> YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
                        <input type="text" class="short ywpc_sale_price_dates_to" name="_ywpc_sale_price_dates_to" id="_ywpc_sale_price_dates_to" value="<?php echo esc_attr( $sale_price_dates_to ) ?>" placeholder="<?php _e( 'To&hellip;', 'yith-woocommerce-product-countdown' ) ?>  YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
                        <img class="help_tip" style="margin-top: 21px;" data-tip="<?php _e( 'The sale will end at the beginning of the set date.', 'yith-woocommerce-product-countdown' ) ?>" src="<?php echo esc_url( WC()->plugin_url() ) ?>/assets/images/help.png" height="16" width="16" />
                    </p>

                    <?php

                    apply_filters( 'ywpc_countdown_tab_options', '' );

                    ?>
                </div>
            </div>


            <?php
        }

        /**
         * Save sales countdown tab options
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function save_countdown_tab() {

            global $post;

            $ywpc_enabled = isset( $_POST['_ywpc_sale_price_dates_from'] ) ? 'yes' : 'no';
            update_post_meta( $post->ID, '_ywpc_enabled', $ywpc_enabled );

            $product = wc_get_product( $post->ID );

            if ( $product->product_type != 'variable' ) {

                $date_from = isset( $_POST['_ywpc_sale_price_dates_from'] ) ? wc_clean( $_POST['_ywpc_sale_price_dates_from'] ) : '';
                $date_to   = isset( $_POST['_ywpc_sale_price_dates_to'] ) ? wc_clean( $_POST['_ywpc_sale_price_dates_to'] ) : '';

                update_post_meta( $post->ID, '_ywpc_sale_price_dates_from', $date_from ? strtotime( $date_from ) : '' );
                update_post_meta( $post->ID, '_ywpc_sale_price_dates_to', $date_to ? strtotime( $date_to ) : '' );

                if ( $date_to && !$date_from ) {
                    $date_from = date( 'Y-m-d' );
                    update_post_meta( $post->ID, '_ywpc_sale_price_dates_from', strtotime( $date_from ) );
                }

            }

        }

        /**
         * FRONTEND FUNCTIONS
         */

        /**
         * Enqueue frontend script files
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function frontend_scripts() {

            $suffix   = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
            $template = get_option( 'ywpc_template', '1' );

            wp_enqueue_style( 'ywpc-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,700', array(), null );
            wp_enqueue_script( 'jquery-plugin', YWPC_ASSETS_URL . '/js/jquery.plugin' . $suffix . '.js', array( 'jquery' ) );
            wp_enqueue_script( 'jquery-countdown', YWPC_ASSETS_URL . '/js/jquery.countdown' . $suffix . '.js', array( 'jquery' ), '2.0.2' );
            wp_enqueue_style( 'ywpc-frontend', YWPC_ASSETS_URL . '/css/ywpc-style-' . $template . '.css' );

        }

        /**
         * Check if ywpc needs to be showed in product page
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function check_show_ywpc_product() {

            global $post;

            if ( isset( $post ) && is_object( $post ) ) {

                $has_countdown  = get_post_meta( $post->ID, '_ywpc_enabled', true );
                $show_countdown = get_option( 'ywpc_where_show' );

                if ( $has_countdown == 'yes' && $show_countdown != 'loop' ) {

                    $args = apply_filters( 'ywpc_showing_position_product', array(
                        'hook'     => 'before_single_product',
                        'priority' => 5 ) );

                    add_action( 'woocommerce_' . $args['hook'] . '_summary', array( $this, 'add_ywpc_product' ), $args['priority'] );

                }

            }

        }

        /**
         * Add sales countdown to product page
         *
         * @since   1.0.0
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function add_ywpc_product() {

            $what_show = get_option( 'ywpc_what_show' );

            global $post;

            $args = apply_filters( 'ywpc_product_args', array(
                'items' => array(
                    $post->ID => array(
                        'before'   => 'false',
                        'end_date' => get_post_meta( $post->ID, '_ywpc_sale_price_dates_to', true )
                    )
                )
            ), '', ''
            );

            if ( $what_show != 'bar' || $what_show == 'both' ) {

                include( YWPC_TEMPLATE_PATH . '/frontend/single-product-timer.php' );

            }

            apply_filters( 'ywpc_product_sales_bar', '', $what_show, $args );

            apply_filters( 'ywpc_product_scripts', '', $args );

        }

        /**
         * YITH FRAMEWORK
         */

        /**
         * Enqueue css file
         *
         * @since   1.0.0
         * @return  void
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function plugin_fw_loader() {
            if ( !defined( 'YIT_CORE_PLUGIN' ) ) {
                global $plugin_fw_data;
                if ( !empty( $plugin_fw_data ) ) {
                    $plugin_fw_file = array_shift( $plugin_fw_data );
                    require_once( $plugin_fw_file );
                }
            }
        }

        /**
         * Premium Tab Template
         *
         * Load the premium tab template on admin page
         *
         * @since   1.0.0
         * @return  void
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function premium_tab() {
            $premium_tab_template = YWPC_TEMPLATE_PATH . '/admin/' . $this->_premium;
            if ( file_exists( $premium_tab_template ) ) {
                include_once( $premium_tab_template );
            }
        }

        /**
         * Get the premium landing uri
         *
         * @since   1.0.0
         * @return  string The premium landing link
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         */
        public function get_premium_landing_uri() {
            return defined( 'YITH_REFER_ID' ) ? $this->_premium_landing . '?refer_id=' . YITH_REFER_ID : $this->_premium_landing;
        }

        /**
         * Action Links
         *
         * add the action links to plugin admin page
         * @since   1.0.0
         *
         * @param   $links | links plugin array
         *
         * @return  mixed
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         * @use     plugin_action_links_{$plugin_file_name}
         */
        public function action_links( $links ) {

            $links[] = '<a href="' . admin_url( "admin.php?page={$this->_panel_page}" ) . '">' . __( 'Settings', 'yith-woocommerce-product-countdown' ) . '</a>';

            if ( defined( 'YWPC_FREE_INIT' ) ) {
                $links[] = '<a href="' . $this->get_premium_landing_uri() . '" target="_blank">' . __( 'Premium Version', 'yith-woocommerce-product-countdown' ) . '</a>';
            }

            return $links;
        }

        /**
         * Plugin row meta
         *
         * add the action links to plugin admin page
         *
         * @since   1.0.0
         *
         * @param   $plugin_meta
         * @param   $plugin_file
         * @param   $plugin_data
         * @param   $status
         *
         * @return  Array
         * @author  Andrea Grillo <andrea.grillo@yithemes.com>
         * @use     plugin_row_meta
         */
        public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
            if ( ( defined( 'YWPC_INIT' ) && ( YWPC_INIT == $plugin_file ) ) ||
                ( defined( 'YWPC_FREE_INIT' ) && ( YWPC_FREE_INIT == $plugin_file ) )
            ) {

                $plugin_meta[] = '<a href="' . $this->_official_documentation . '" target="_blank">' . __( 'Plugin Documentation', 'yith-woocommerce-product-countdown' ) . '</a>';
            }

            return $plugin_meta;
        }

    }

}
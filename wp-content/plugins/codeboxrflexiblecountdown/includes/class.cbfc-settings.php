<?php
/**
 * weDevs Settings API wrapper class
 *
 * @package   Codeboxr_Flexible_CountDown
 * @author Tareq Hasan <tareq@weDevs.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2015 Codeboxr
 * Note: further modification by codeboxr.com team
 */
?>
<?php

class CodeboxrFlexibleCountdownSetting {

    /**
     * settings sections array
     *
     * @var array
     */
    private $settings_sections = array();

    /**
     * Settings fields array
     *
     * @var array
     */
    private $settings_fields = array();

    /**
     * Singleton instance
     *
     * @var object
     */


    private static $_instance;

    private $plugin_hook = '';

    public function __construct($hook = '') {
        if($hook != '')  $this->plugin_hook = $hook;

    }

    public static function getInstance($hook) {
        if ( !self::$_instance ) {
            self::$_instance = new CodeboxrFlexibleCountdownSetting($hook);
        }

        return self::$_instance;
    }

    /**
     * Set settings sections
     *
     * @param array $sections setting sections array
     */
    function set_sections( $sections ) {
        $this->settings_sections = $sections;
    }

    /**
     * Set settings fields
     *
     * @param array $fields settings fields array
     */
    function set_fields( $fields ) {
        $this->settings_fields = $fields;
    }

    /**
     * Initialize and registers the settings sections and fileds to WordPress
     *
     * Usually this should be called at `admin_init` hook.
     *
     * This function gets the initiated settings sections and fields. Then
     * registers them to WordPress and ready for use.
     */
    function admin_init() {

        //register settings sections
        foreach ($this->settings_sections as $section) {
            if ( false == get_option( $section['id'] ) ) {
                add_option( $section['id'] );
            }

            add_settings_section( $section['id'], $section['title'], '__return_false', $section['id'] );
        }

        //register settings fields
        foreach ($this->settings_fields as $section => $field) {
            foreach ($field as $option) {
                $args = array(
                    'id'        => $option['name'],
                    'desc'      => $option['desc'],
                    'name'      => $option['label'],
                    'section'   => $section,
                    'size'      => isset( $option['size'] ) ? $option['size'] : null,
                    'options'   => isset( $option['options'] ) ? $option['options'] : '',
                    'std'       => isset( $option['default'] ) ? $option['default'] : '',
                    'min'       => isset( $option['min'] ) ? $option['min'] : '',
                    'max'       => isset( $option['max'] ) ? $option['max'] : ''
                );
                add_settings_field( $section . '[' . $option['name'] . ']', $option['label'], array($this, 'callback_' . $option['type']), $section, $section, $args );
            }
        }

        // creates our settings in the options table
        foreach ($this->settings_sections as $section) {
            register_setting( $section['id'], $section['id'] );
        }
    }

    /**
     * Displays a text field for a settings field
     *
     * @param array $args settings field args
     */
    function callback_text( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<span class="descripstion"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays the number field for a settings field
     *
     * @param array $args settings field args
     */
    function callback_number( $args ) {
        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="number" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s" ', $size, $args['section'], $args['id'], $value );
        //$html .= sprintf( ' min="%s" ', $args['min'] );
        $html .= ( isset( $args['min'] ) ) ? sprintf( ' min="%d" ', $args['min'] ) : '';
        $html .= ( isset( $args['max'] ) ) ? sprintf( ' max="%d" ', $args['max'] ) : '';
        $html .= sprintf( '/>' );
        $html .= sprintf( '<span class="descripstion"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a checkbox for a settings field
     *
     * @param array $args settings field args
     */
    function callback_checkbox( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );

        $html = sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s]" name="%1$s[%2$s]" value="on"%4$s />', $args['section'], $args['id'], $value, checked( $value, 'on', false ) );
        $html .= sprintf( '<label for="%1$s[%2$s]"> %3$s</label>', $args['section'], $args['id'], $args['desc'] );

        echo $html;
    }

    /**
     * Displays a multicheckbox a settings field
     *
     * @param array $args settings field args
     */
    function callback_multicheck( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ($args['options'] as $key => $label) {
            $checked = isset( $value[$key] ) ? $value[$key] : '0';
            $html .= sprintf( '<input type="checkbox" class="checkbox" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s][%3$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $checked, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s</label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a multicheckbox a settings field
     *
     * @param array $args settings field args
     */
    function callback_radio( $args ) {

        $value = $this->get_option( $args['id'], $args['section'], $args['std'] );

        $html = '';
        foreach ($args['options'] as $key => $label) {
            $html .= sprintf( '<input type="radio" class="radio" id="%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s"%4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
            $html .= sprintf( '<label for="%1$s[%2$s][%4$s]"> %3$s</label><br>', $args['section'], $args['id'], $label, $key );
        }
        $html .= sprintf( '<span class="description"> %s</label>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a selectbox for a settings field
     *
     * @param array $args settings field args
     */
    function callback_select( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<select class="%1$s" name="%2$s[%3$s]" id="%2$s[%3$s]">', $size, $args['section'], $args['id'] );
        foreach ($args['options'] as $key => $label) {
            $html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
        }
        $html .= sprintf( '</select>' );
        $html .= sprintf( '<span class="description"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a textarea for a settings field
     *
     * @param array $args settings field args
     */
    function callback_textarea( $args ) {

        $value = esc_textarea( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<textarea rows="5" cols="55" class="%1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]">%4$s</textarea>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<br><span class="description"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a text field for a settings field
     *
     * @param array $args settings field args
     */
    function callback_datepicker( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="datepicker" id="%2$s[%3$s]" name="%2$s[%3$s]" placeholder="mm/dd/yy" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<span class="descripstion"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Displays a text field for a settings field
     *
     * @param array $args settings field args
     */
    function callback_colorpicker( $args ) {

        $value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
        $size = isset( $args['size'] ) && !is_null( $args['size'] ) ? $args['size'] : 'regular';

        $html = sprintf( '<input type="text" class="color-field" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
        $html .= sprintf( '<span class="descripstion"> %s</span>', $args['desc'] );

        echo $html;
    }

    /**
     * Get the value of a settings field
     *
     * @param string $option settings field name
     * @param string $section the section name this field belongs to
     * @param string $default default text if it's not found
     * @return string
     */
    function get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    }

    /**
     * Show navigations as tab
     *
     * Shows all the settings section labels as tab
     */
    function show_navigation() {
        $html = '<h2 class="nav-tab-wrapper nav-tab-wrapper-cbfc">';

        foreach ($this->settings_sections as $tab) {
            $html .= sprintf( '<a href="#%1$s" class="nav-tab" id="%1$s-tab">%2$s</a>', $tab['id'], $tab['title'] );
        }

        $html .= '</h2>';

        echo $html;
    }

    /**
     * Show the section settings forms
     *
     * This function displays every sections in a different form
     */
    function show_forms() {
        ?>
        <div class="metabox-holder metabox-holder-cbfc has-right-sidebar" >
            <div class="postbox">
                <?php foreach ($this->settings_sections as $form) { ?>
                    <div id="<?php echo $form['id']; ?>" class="cbfcgroup">
                        <form method="post" action="options.php">

                            <?php settings_fields( $form['id'] ); ?>
                            <?php do_settings_sections( $form['id'] ); ?>

                            <div style="padding-left: 10px">
                                <?php submit_button(); ?>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>

            <?php //require_once( 'public/views/sidebar.php' ); ?>
        </div>
        <?php
        $this->script();
    }

    /**
     * Tabbable JavaScript codes
     *
     * This code uses localstorage for displaying active tabs
     */
    function script() {

	    //change class name .group in php and js
	    //change storage variable and key name in js
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Switches option sections
                $('.cbfcgroup').hide();
                var cbfcgroupactivetab = '';
                if (typeof(localStorage) != 'undefined' ) {
	                cbfcgroupactivetab = localStorage.getItem("cbfcgroupactivetab");
                }
                if (cbfcgroupactivetab != '' && $(cbfcgroupactivetab).length ) {
                    $(cbfcgroupactivetab).fadeIn();
                } else {
                    $('.cbfcgroup:first').fadeIn();
                }
                $('.cbfcgroup .collapsed').each(function(){
                    $(this).find('input:checked').parent().parent().parent().nextAll().each(
                    function(){
                        if ($(this).hasClass('last')) {
                            $(this).removeClass('hidden');
                            return false;
                        }
                        $(this).filter('.hidden').removeClass('hidden');
                    });
                });

                if (cbfcgroupactivetab != '' && $(cbfcgroupactivetab + '-tab').length ) {
                    $(cbfcgroupactivetab + '-tab').addClass('nav-tab-active');
                }
                else {
                    $('.nav-tab-wrapper-cbfc a:first').addClass('nav-tab-active');
                }
                $('.nav-tab-wrapper-cbfc a').click(function(evt) {
                    $('.nav-tab-wrapper-cbfc a').removeClass('nav-tab-active');
                    $(this).addClass('nav-tab-active').blur();
                    var clicked_group = $(this).attr('href');
                    if (typeof(localStorage) != 'undefined' ) {
                        localStorage.setItem("cbfcgroupactivetab", $(this).attr('href'));
                    }
                    $('.cbfcgroup').hide();
                    $(clicked_group).fadeIn();
                    evt.preventDefault();
                });
            });
        </script>
        <?php
    }

}
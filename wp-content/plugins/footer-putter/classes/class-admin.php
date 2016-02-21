<?php
abstract class Footer_Putter_Admin {
	protected $version;
	protected $path;
	protected $parent_slug;
	protected $slug;
    protected $screen_id;
    private $tooltips;
    private $tips = array();
   private $messages = array();

	function __construct($version, $path, $parent_slug, $slug = '') {
		$this->version = $version;
		$this->path = $path;
		$this->parent_slug = $parent_slug;
		$this->slug = empty($slug) ? $this->parent_slug : ( $this->parent_slug.'-'.$slug );
		$this->tooltips = new Footer_Putter_Tooltip($this->tips);
		$this->init();
	}
	
	abstract function init() ;

	abstract function admin_menu() ;

	abstract function page_content(); 

   abstract function load_page();

    function get_screen_id(){
		return $this->screen_id;
	}

	function get_version() {
		return $this->version;
	}

    function get_path() {
		return $this->path;
	}

    function get_parent_slug() {
		return $this->parent_slug;
	}

    function get_slug() {
		return $this->slug;
	}

 	function get_url() {
		return admin_url('admin.php?page='.$this->get_slug());
	}

 	function get_code($code='') {
 		$format = empty($code) ? '%1$s' : '%1$s-%2$s';	
		return sprintf($format, $this->get_parent_slug(), $code);
	}
	
	function get_keys() { 
		return array_keys($this->tips);
	}

	function get_tip($label) { 
		return $this->tooltips->tip($label);
	}

	function print_admin_notices() {
		foreach ($this->messages as $message)
         print $message;
	}

	function add_admin_notice($subject, $message, $is_error = false) {
		$this->messages[] = sprintf('<div class="notice is-dismissible %1$s"><p>%2$s %3$s</p></div>', $is_error ? 'error' : 'updated', __($subject), __($message));
      add_action( 'admin_notices', array($this, 'print_admin_notices') );  
	}

	function plugin_action_links ( $links, $file ) {
		if ( is_array($links) && ($this->get_path() == $file )) {
			$settings_link = '<a href="' .$this->get_url() . '">Settings</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	function set_tooltips($tips) {
		$this->tips = $tips;
		$this->tooltips = new Footer_Putter_Tooltip($this->tips);
		$this->add_tooltip_support();
	}
	
	function add_tooltip_support() {
		add_action('admin_enqueue_scripts', array( $this, 'enqueue_tooltip_styles'));
		add_action('admin_enqueue_scripts', array( $this, 'enqueue_color_picker_styles'));
		add_action('admin_enqueue_scripts', array( $this, 'enqueue_color_picker_scripts'));
	}
	
	function register_tooltip_styles() {
		Footer_Putter_Utils::register_tooltip_styles();	
	}	

	function enqueue_tooltip_styles() {
		Footer_Putter_Utils::enqueue_tooltip_styles();
	}	

	function register_admin_styles() {
		wp_register_style($this->get_code('admin'), plugins_url('styles/admin.css',dirname(__FILE__)), array(),$this->get_version());
	}

	function enqueue_admin_styles() {
		wp_enqueue_style($this->get_code('admin'));
 	}

	function enqueue_color_picker_styles() {
        wp_enqueue_style('wp-color-picker');
	}

	function enqueue_color_picker_scripts() {
		wp_enqueue_script('wp-color-picker');
		add_action('admin_print_footer_scripts', array($this, 'enable_color_picker'));
 	}

   function enqueue_metabox_scripts() {
 		wp_enqueue_style($this->get_code('tabs'), plugins_url('styles/tabs.css',dirname(__FILE__)), array(),$this->get_version());
 		wp_enqueue_script($this->get_code('tabs'), plugins_url('scripts/jquery.tabs.js',dirname(__FILE__)), array(),$this->get_version());
    }

	function enqueue_postbox_scripts() {
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');	
		add_action('admin_footer-'.$this->get_screen_id(), array($this, 'toggle_postboxes'));
 	}
 		
 	function add_meta_box($code, $title, $callback_func, $callback_params = null, $context = 'normal', $priority = 'core', $post_type = false ) {
		if (empty($post_type)) $post_type = $this->get_screen_id();
		add_meta_box($this->get_code($code), __($title), array($this, $callback_func), $post_type, $context, $priority, $callback_params);
	}

	function form_field($id, $name, $label, $value, $type, $options = array(), $args = array(), $wrap = false) {
		if (!$label) $label = $id;
		$label_args = (is_array($args) && array_key_exists('label_args', $args)) ? $args['label_args'] : false;
 		return Footer_Putter_Utils::form_field($id, $name, $this->tooltips->tip($label, $label_args), $value, $type, $options, $args, $wrap);
 	}	

	function meta_form_field($meta, $key, $type, $options=array(), $args=array()) {
		return $this->form_field( $meta[$key]['id'], $meta[$key]['name'], false, 
			$meta[$key]['value'], $type, $options, $args);
 	}	

	function fetch_form_field($fld, $value, $type, $options = array(), $args = array(), $wrap = false) {
 		return $this->form_field($fld, $fld, false, $value, $type, $options, $args, $wrap);
 	}
 	
	function print_form_field($fld, $value, $type, $options = array(), $args = array(), $wrap = false) {
 		print $this->form_field($fld, $fld, false, $value, $type, $options, $args, $wrap);
	}

	function fetch_text_field($fld, $value, $args = array()) {
 		return $this->fetch_form_field($fld, $value, 'text', array(), $args);
	}

	function print_text_field($fld, $value, $args = array()) {
 		$this->print_form_field($fld, $value, 'text', array(), $args);
	}
	
 	function get_meta_form_data($metakey, $prefix, $values ) {
      $content = array();
		if (($post_id = Footer_Putter_Utils::get_post_id())
		&& ($meta = Footer_Putter_Utils::get_meta($post_id, $metakey)))
			$values = Footer_Putter_Utils::validate_options($values, $meta);	
		foreach ($values as $key => $val) {
			$content[$key] = array();
			$content[$key]['value'] = $val;
			$content[$key]['id'] = $prefix.$key;
			$content[$key]['name'] = $metakey. '[' . $key . ']';
		}
		return $content;
	}
	
   function get_newsfeeds() {
      return apply_filters('footer_putter_newsfeeds', array( FOOTER_PUTTER_NEWS));
		}

 	function news_panel($post,$metabox){	
		Footer_Putter_Feed_Widget::display_feeds($this->get_newsfeeds());
	}
	
	function get_nonces($referer) {
		return wp_nonce_field($referer, '_wpnonce', true, false).
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false, false ).
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false, false);
	}
	
 	function submit_button($button_text='Save Changes', $name = 'options_update') {	
		return sprintf('<p class="save"><input type="submit" name="%1$s" value="%2$s" class="button-primary" /></p>',  $name, $button_text);
	}
 	
	function save_options($options_class, $settings_name, $trim_option_prefix = false) {
      $saved = false;
  		$page_options = explode(",", stripslashes($_POST['page_options']));
  		if (is_array($page_options)) {
  			$options = call_user_func( array($options_class, 'get_options'));
  			$updates = false; 
    		foreach ($page_options as $option) {
       			$option = trim($option);
       			$val = array_key_exists($option, $_POST) ? trim(stripslashes($_POST[$option])) : '';
       			if ($trim_option_prefix) $option = substr($option,$trim_option_prefix); //remove prefix
				$options[$option] = $val;
    		} //end for
   			$saved = call_user_func( array($options_class, 'save_options'), $options) ;
   		if ($saved)  
	  		    $this->add_admin_notice($settings_name, 'settings saved successfully.');
   		else 
	  		    $this->add_admin_notice($settings_name, 'settings have not been changed.', true);   		
   			} else {
	  	  $this->add_admin_notice($settings_name, 'settings not found', true);   	
			}
  		return $saved;
	}

    function fetch_message() {
		if (isset($_REQUEST['message']) && ! empty($_REQUEST['message'])) { 
			$message = urldecode($_REQUEST['message']);
			$_SERVER['REQUEST_URI'] = remove_query_arg(array('message'), $_SERVER['REQUEST_URI']);
			$is_error = (strpos($message,'error') !== FALSE) || (strpos($message,'fail') !== FALSE);
			$this->add_admin_notice('', $message, $is_error);
         return $message;
		}
		return false;
    } 

	function screen_layout_columns($columns, $screen) {
		if (!defined( 'WP_NETWORK_ADMIN' ) && !defined( 'WP_USER_ADMIN' )) {
			if ($screen == $this->get_screen_id()) {
				$columns[$this->get_screen_id()] = 2;
			}
		}
		return $columns;
	}

	function admin_heading($title = '', $icon_class = '') {
		if (empty($title)) $title = sprintf('%1$s %2$s', ucwords(str_replace('-',' ',$this->slug)), $this->get_version());
		if (empty($icon_class)) $icon_class = FOOTER_PUTTER_ICON;
		$icon = sprintf('<i class="%1$s"></i>', 'dashicons-'==substr($icon_class,0,10) ? ('dashicons '.$icon_class) : $icon_class) ;
    	return sprintf('<h2 class="title">%2$s%1$s</h2>', $title, $icon);				
	}

	function print_admin_form_start($title, $referer = false, $keys = false, $enctype = false, $with_sidebar = false, $preamble = false) {
		$this_url = $_SERVER['REQUEST_URI'];
	 	$enctype = $enctype ? 'enctype="multipart/form-data" ' : '';
		$nonces = $referer ? $this->get_nonces($referer) : '';
		$page_options = '';
		if ($keys) {
			$keys = is_array($keys) ? implode(',', $keys) : $keys;
			$page_options = sprintf('<input type="hidden" name="page_options" value="%1$s" />', $keys);
		}
      $class = $with_sidebar ? ' columns-2' : '';
    	printf('<div class="wrap">%1$s<form id="diy_options" method="post" %2$saction="%3$s"><p>%4$s%5$s</p><div id="poststuff"><div id="post-body" class="metabox-holder%6$s"><div id="post-body-content">%7$s',
         $title, $enctype, $this_url, $page_options, $nonces, $class, $preamble ? $preamble : '');
   } 

	function print_admin_form_with_sidebar_middle() {
	   print '</div><div id="postbox-container-1" class="postbox-container">';
	}

	function print_admin_form_end() {
		print '</div></div><br class="clear"/></div></form></div>';
	}

   function print_admin_form_with_sidebar($title, $referer = false, $keys = false, $enctype = false, $preamble = false) {
      $this->print_admin_form_start ($title, $referer, $keys, $enctype, true, $preamble);
		do_meta_boxes($this->get_screen_id(), 'normal', null); 
		if ($keys) print $this->submit_button();		
		do_meta_boxes($this->get_screen_id(), 'advanced', null); 
		$this->print_admin_form_with_sidebar_middle();
		do_meta_boxes($this->get_screen_id(), 'side', null); 
		$this->print_admin_form_end();
	} 

   function print_admin_form ($title, $referer = false, $keys = false, $enctype = false, $preamble = false) {
      $this->print_admin_form_start ($title, $referer, $keys, $enctype, false, $preamble);
		do_meta_boxes($this->get_screen_id(), 'normal', null); 
		if ($keys) print $this->submit_button();	
		do_meta_boxes($this->get_screen_id(), 'advanced', null); 		
		$this->print_admin_form_end();
	}
	
	
	function display_metabox($tabs) {
      $labels = $contents = '';
      $t=0;
      $tab = isset($_REQUEST['tabselect']) ? $_REQUEST['tabselect'] : 'tab1';
      foreach ($tabs as $label => $content) {
         $t++;
         $labels .=  sprintf('<li class="tab tab%1$s"><a href="#">%2$s</a></li>', $t, $label);
         $contents .=  sprintf('<div class="tab%1$s"><div class="tab-content">%2$s</div></div>', $t, $content);
		}
      printf('<div class="footer-putter-metabox"><ul class="footer-putter-metabox-tabs">%1$s</ul><div class="metabox-content">%2$s</div><input type="hidden" id="tabselect" name="tabselect" value="%3$s" /></div>', $labels, $contents, $tab);
	}
	
	function toggle_postboxes() {
		$hook = $this->get_screen_id();
    	print <<< SCRIPT
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready( function($) {
	$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
	postboxes.add_postbox_toggles('{$hook}');
});
//]]>
</script>
SCRIPT;
    }	

    function enable_color_picker() {
	    print <<< SCRIPT
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready( function($) {
   $('.color-picker').wpColorPicker();
});
//]]>
</script>
SCRIPT;
    }

}

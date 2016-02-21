<?php
/*
Plugin Name: Sales Countdown Woocommerce Addon
Plugin URI: http://www.netattingo.com/
Description: This plugin is used to start the countdown for specified product. Countdown products will be displayed as a carousel.
Author: NetAttingo Technologies
Version: 1.0.0
Author URI: http://www.netattingo.com/
*/


define('SCFW_DIR', plugin_dir_path(__FILE__));
define('SCFW_URL', plugin_dir_url(__FILE__));
define('SCFW_PAGE_DIR', plugin_dir_path(__FILE__).'pages/');
define('SCFW_INCLUDE_URL', plugin_dir_url(__FILE__).'includes/');

//Include menu
function scwf_product_plugin_menu() {
	add_menu_page("Sales Countdown", "Sales Countdown", "administrator", "scwf-page-setting", "scwf_product_plugin_pages", '
dashicons-backup' ,36);
	add_submenu_page("scwf-page-setting", "Countdown Products", "Countdown Products", "administrator", "countdown-products", "scwf_product_plugin_pages");
    add_submenu_page("scwf-page-setting", "About Us", "About Us", "administrator", "about-us", "scwf_product_plugin_pages");
}

//menu pages
add_action("admin_menu", "scwf_product_plugin_menu");
function scwf_product_plugin_pages() {

   $itm = SCFW_PAGE_DIR.$_GET["page"].'.php';
   include($itm);
}

//Include front end css
function scwf_css_add_init() {
    wp_enqueue_style("scwf_css_and_js", SCFW_INCLUDE_URL."front-style.css", false, "1.0", "all"); 
	wp_enqueue_script('scwf_css_and_js');
}
add_action( 'wp_enqueue_scripts', 'scwf_css_add_init' );


//Include admin css
function scwf_admin_css() {
  wp_register_style('admin_css', plugins_url('includes/admin-style.css',__FILE__ ));
  wp_enqueue_style('admin_css');
}
add_action( 'admin_init','scwf_admin_css');

//add woocommerce admin css
function scwf_woo_admin_css() {
  wp_register_style('woo_admin_css', plugins_url('includes/admin.css',__FILE__ ));
  wp_enqueue_style('woo_admin_css');
}
add_action( 'admin_init','scwf_woo_admin_css');

// Add meta box for Sales Countdown
function scwf_get_meta($meta_name, $post){
	$meta_data = get_post_meta($post->ID, $meta_name, true);
	
	if( !empty($meta_data) )
		$save_meta = $meta_data;
	else
		$save_meta = '';
	return $save_meta;
}

add_action( 'add_meta_boxes', 'scwf_sales_countdown_box' );
function scwf_sales_countdown_box() {
    add_meta_box( 
        'scwf_sales_countdown_box',
        'Sales Countdown Box',
        'scwf_sales_countdown_box_content',
        'product',
        'side',
        'default'
    );
}

function scwf_sales_countdown_box_content( $post ) {  ?>
	<script>
		jQuery(document).ready(function() {
		 jQuery('#scwf_sales_date').datepicker({
		 dateFormat : 'dd-mm-yy'
		 });
		});
	</script>
	
<?php
  //checkbox
  $scwf_sales_yes = scwf_get_meta('scwf_sales_countdown', $post);
  $checked='';
  if($scwf_sales_yes == 'sales_yes'){ $checked='checked';}
  echo '<input type="checkbox" id="scwf_sales_countdown" name="scwf_sales_countdown" '.$checked.'  value="sales_yes"/>&nbsp;';
  echo '<label for="scwf_sales_countdown">Add Product in Sales Countdown</label>';
  
  // date  
  $scwf_sales_date = scwf_get_meta('scwf_sales_date', $post);
  echo '<div class="label-wrap"><label for="scwf_sales_countdown_date">Date:</label>';
  echo '<input type="text" id="scwf_sales_date" name="scwf_sales_date" value="'.$scwf_sales_date.'"></div>'; 
  
  //hour 
  $scwf_sales_hour = scwf_get_meta('scwf_sales_hour', $post);
  echo '<div class="label-wrap"><label for="scwf_sales_hour">Hour:</label>';
  echo '<select class="text_field scwf-select-admin" id="scwf_sales_hour" name="scwf_sales_hour">';
	 for($i = 1; $i <= 23; $i++):?>
	   <option value="<?php echo $i; ?>" <?php if($scwf_sales_hour == $i){ echo 'selected="selected"';} ?>><?php echo str_pad($i,2,'0',STR_PAD_LEFT) ?></option>
	   <?php
	endfor;
  echo '</select></div>';
  
  //minute			   
  $scwf_sales_minute = scwf_get_meta('scwf_sales_minute', $post);
  echo '<div class="label-wrap"><label for="scwf_sales_minute">Minute:</label>';
  echo '<select class="text_field scwf-select-admin" id="scwf_sales_minute" name="scwf_sales_minute">';
  for($mn = 0; $mn <= 59; $mn++):?>
		<option value="<?php echo str_pad($mn,2,'0',STR_PAD_LEFT) ?>" <?php if($scwf_sales_minute == $mn){ echo 'selected="selected"';} ?>><?php echo str_pad($mn,2,'0',STR_PAD_LEFT) ?></option>
	 <?php endfor;
  echo '</select></div>';
   
  //seconds
  $scwf_sales_second = scwf_get_meta('scwf_sales_second', $post);
  echo '<div class="label-wrap"><label for="scwf_sales_second">Second:</label>';
  echo '<select class="text_field scwf-select-admin" id="scwf_sales_second" name="scwf_sales_second">';
  for($sec = 0; $sec <= 59; $sec++):?>
		<option value="<?php echo str_pad($sec,2,'0',STR_PAD_LEFT) ?>" <?php if($scwf_sales_second == $sec){ echo 'selected="selected"';} ?>><?php echo str_pad($sec,2,'0',STR_PAD_LEFT) ?></option>
	<?php endfor;
  echo '</select></div>';
   
}

add_action( 'save_post', 'scwf_sales_countdown_box_save' );
function scwf_sales_countdown_box_save( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;
  
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }
  
  $scwf_sales_countdown= $_POST['scwf_sales_countdown'];
  update_post_meta( $post_id, 'scwf_sales_countdown', $scwf_sales_countdown);
  
  $scwf_sales_date= $_POST['scwf_sales_date'];
  update_post_meta( $post_id, 'scwf_sales_date', $scwf_sales_date);
  
  $scwf_sales_hour= $_POST['scwf_sales_hour'];
  update_post_meta( $post_id, 'scwf_sales_hour', $scwf_sales_hour);
  
  $scwf_sales_minute= $_POST['scwf_sales_minute'];
  update_post_meta( $post_id, 'scwf_sales_minute', $scwf_sales_minute);
  
  $scwf_sales_second= $_POST['scwf_sales_second'];
  update_post_meta( $post_id, 'scwf_sales_second', $scwf_sales_second);
  
  
  $scwf_sales_day= $_POST['scwf_sales_day'];
  update_post_meta( $post_id, 'scwf_sales_day', $scwf_sales_day);
}


//slider settings and script
function scwf_slider_trigger(){
	//getting all settings
	$autoplay= get_option('scwf_autoplay');
	$items = get_option('single_or_multiple');
	$controls= get_option('scwf_controls');
	$pagination= get_option('scwf_pagination');
	$stoponhover= get_option('scwf_stoponhover');
	$slide_speed= get_option('scwf_slide_speed');
	$navigation_text_next= get_option('scwf_navigation_text_next');
	$navigation_text_prev= get_option('scwf_navigation_text_prev');

	//if setting is null then initial setting
	if($items == ''){ $items= 3;}
	if($controls == ''){ $controls= 'true';}
	if($pagination == ''){ $pagination= 'true';}
	if( $stoponhover == ''){ $stoponhover= 'true';}
	if( $autoplay == ''){ $autoplay= 'false';}
	if($slide_speed == ''){ $slide_speed= 1000;}
	if($navigation_text_next == ''){ $navigation_text_next= '>';}
	if($navigation_text_prev == ''){ $navigation_text_prev= '<';}

	//include carousel css and js
	wp_enqueue_style("scwf_caro_css_and_js", SCFW_INCLUDE_URL."owl.carousel.css", false, "1.0", "all"); 
	wp_register_script( 'scwf_caro_css_and_js', SCFW_INCLUDE_URL."owl.carousel.min.js" );
	wp_enqueue_script('scwf_caro_css_and_js');
?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
		  jQuery('.scwf_latest_product_slider').owlCarousel({
			  autoPlay: <?php echo $autoplay; ?>, 
			  items : <?php echo $items; ?>,
			  itemsDesktopSmall : [1200,3],
			  itemsTablet : [660,2],
			  itemsMobile : [430,1],
			  paginationSpeed : 800,
			  stopOnHover : <?php echo $stoponhover; ?>,
			  navigation : <?php echo $controls; ?>,
			  pagination : <?php echo $pagination; ?>,
			  slideSpeed : <?php echo $slide_speed;?>,
			  navigationText : ["<?php echo $navigation_text_prev;?>","<?php echo $navigation_text_next;?>"],
		 
		  });
		});
	</script>
	
<?php
}
add_action('wp_footer','scwf_slider_trigger');

// Add Shortcode function for  latest product carousel
function scwf_sales_countdown_shortcode( $atts ) {
	// Attributes
	extract( shortcode_atts(
		array(
			'posts' => "-1",
			'order' => '',
			'orderby' => '',
			'title' => 'yes',
		), $atts )
	);

	$args = array(
			'post_type' => 'product',
		    'posts_per_page' => $posts,
			'meta_query' => array(
				array(
					'key' => 'scwf_sales_countdown',
					'value' => 'sales_yes',
					'compare' => '=',
					)
				)
			);
	$return_string = '<div id="scwf_latest_product_slider" class="scwf_latest_product_slider">';
	
	$thePosts=query_posts($args);
		if (have_posts()) :
			while (have_posts()) : the_post();
				$post_id = get_the_ID();
				$product_id = get_post_thumbnail_id();
				$product_url = wp_get_attachment_image_src($product_id,'full',true);
				$product_mata = get_post_meta($product_id,'_wp_attachment_image_alt',true);
				$product_link = get_permalink();
		
				$return_string .= '<div class="scwf_product_item">';
				if($product_link) : 
				$return_string .= '<a href="'.$product_link.'">';
				endif;
				$return_string .= '<img  src="'. $product_url[0] .'" alt="'. $product_mata .'" />';
				if($product_link) :
				$return_string .= '</a>';
				endif;
				
				$return_string .='<h3 class="scwf_pro_title">';
				if (strlen(get_the_title()) > 20) {
					$return_string .= substr(get_the_title(), 0, 20) . '...';
				}else{
					$return_string .= get_the_title();
				}
				$return_string .='</h3>';
				$sales_date = get_post_meta($post_id, 'scwf_sales_date', true);
				$sales_date = date("j F, Y", strtotime($sales_date));
				$now = time();
					
				$hours=intval(get_post_meta($post_id,'scwf_sales_hour',true));
				$minutes=intval( get_post_meta($post_id,'scwf_sales_minute',true));
				$seconds=intval(get_post_meta($post_id,'scwf_sales_second',true));	 
				
				$script='<script>jQuery(function(){
					var d = new Date("'.$sales_date.' '.$hours.':'.$minutes.':'.$seconds.'");	
					jQuery("#scwf_countdown'.$post_id.'").countdown({
						timestamp	: d,
					});	
				});</script>';

				$return_string .= $script;	
				$return_string .= '<div class="scwf_price_area_fix">'.do_shortcode('[add_to_cart id="'.get_the_ID().'"]').'</div>';
					$return_string .=  '<div id="scwf_countdown'.$post_id.'"></div><div class="scwf_dhm-time"><p><span class="scwf_days">Day</span> <span class="scwf_hr">Hour</span> <span class="scwf_min">Minute</span> <span class="scwf_sec">Second</span></p></div>';
				
				$return_string .= '</div>';
			endwhile;
		endif;
	$return_string .= '</div>';

	wp_reset_query();
	$prefix_string = '<div class="heading-wooCommerce-product-carousel"><h3>Product Sale </h3></div>';
	if(empty($thePosts)){
	    $return_string= '<div class="no-data"><strong>No Product Yet.</strong></div>';
	}
	return $prefix_string.$return_string;
}
add_shortcode( 'sales-countdown-product', 'scwf_sales_countdown_shortcode' ); // add shortcode


//countdown timer librarires
function wptuts_options_enqueue_scripts() {  
	wp_enqueue_script('jquery');
    wp_enqueue_style("scwf_caro_css_and_js1", SCFW_INCLUDE_URL."countdown/jquery.countdown.css", false, "1.0", "all"); 
    wp_register_script( 'scwf_caro_css_and_js1', SCFW_INCLUDE_URL."countdown/jquery.countdown.js" );
    wp_enqueue_script('scwf_caro_css_and_js1');	
			
}  

add_action( 'wp_enqueue_scripts', 'wptuts_options_enqueue_scripts' );
add_action('wp_init', 'wptuts_options_enqueue_scripts');

?>
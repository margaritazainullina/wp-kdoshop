<?php 
/*
 * multishop Enqueue css and js files
*/
function multishop_enqueue()
{
	wp_enqueue_style('multishop-bootstrap-min',get_template_directory_uri().'/css/bootstrap.css',array(),'','');
	wp_enqueue_style('multishop-font-awesome',get_template_directory_uri().'/css/font-awesome.css',array(),'','');
	
    wp_enqueue_style('style',get_stylesheet_uri(),array(),'','');
	wp_enqueue_style('multishop-media-css',get_template_directory_uri().'/css/media.css',array(),'','');
	
	wp_enqueue_script('multishop-bootstrap-js',get_template_directory_uri().'/js/bootstrap.js',array('jquery'));
	wp_enqueue_script('multishop-default-js',get_template_directory_uri().'/js/default.js',array('jquery'));
	wp_enqueue_style('multishop-owl-carousel-css',get_template_directory_uri().'/css/owl.carousel.css',array(),'','');	
	wp_enqueue_script('multishop-owl-carousel.min-js',get_template_directory_uri().'/js/owl.carousel.js',array('jquery'));
	wp_enqueue_script('multishop-easyResponsiveTabs-js',get_template_directory_uri().'/js/easyResponsiveTabs.js',array('jquery'));

        global $is_IE;
        if($is_IE)
         wp_enqueue_script('multishop-respond', get_template_directory_uri().'/js/respond.js', array());

        if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_enqueue_scripts', 'multishop_enqueue');

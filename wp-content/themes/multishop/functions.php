<?php 
/*
 * Set up the content width value based on the theme's design.
 */
add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
if ( ! function_exists( 'multishop_setup' ) ) :
function multishop_setup() {
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 745;
	}
	/*
	 * Make multishop theme available for translation.
	 */
	load_theme_textdomain( 'multishop', get_template_directory() . '/languages' );	
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', multishop_font_url() ) );
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
    add_theme_support( 'title-tag' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'multishop-full-width', 1038, 576, true );
	add_image_size( 'multishop-blog-image', 380, 260, true );
	// This theme uses wp_nav_menu() in one locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'multishop' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );
	add_theme_support( 'custom-background', apply_filters( 'multishop_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );
	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'multishop_get_featured_posts',
		'max_posts' => 6,
	) );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // multishop_setup
add_action( 'after_setup_theme', 'multishop_setup' );

/**
 * Register Istok Web Google font for multishop.
 */
function multishop_font_url() {
	$multishop_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Istok Web, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Istok+Web font: on or off', 'multishop' ) ) {
		$multishop_font_url = add_query_arg( 'family', urlencode( 'Istok+Web:400,700,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}
	return $multishop_font_url;
}

add_filter( 'comment_form_default_fields', 'multishop_comment_placeholders' );
/**
* Change default fields, add placeholder and change type attributes.
*
* @param array $fields
* @return array
*/
function multishop_comment_placeholders( $fields )
{
	$fields['author'] = str_replace(
	'<input',
	'<input placeholder="'
	/* Replace 'theme_text_domain' with your theme’s text domain.
	* I use _x() here to make your translators life easier. :)
	* See http://codex.wordpress.org/Function_Reference/_x
	*/
	. _x(
	'First Name',
	'comment form placeholder',
	'multishop'
	)
	. '"',
	$fields['author']
	);
	$fields['email'] = str_replace(
	'<input',
	'<input id="email" name="email" type="text" placeholder="'
	. _x(
	'Email Id',
	'comment form placeholder',
	'multishop'
	)
	. '"',
	$fields['email']
	);
	$fields['url'] = str_replace(
	'<input',
	'<input id="url" name="url" type="text" placeholder="'
	. _x(
	'Website',
	'comment form placeholder',
	'multishop'
	)
	. '"',
	$fields['url']
);	

return $fields;
}
add_filter( 'comment_form_defaults', 'multishop_textarea_insert' );
function multishop_textarea_insert( $fields )
{
$fields['comment_field'] = str_replace(
'</textarea>',
''. _x(
'Comment',
'comment form placeholder',
'multishop'
)
. ''. '</textarea>',
$fields['comment_field']
);
return $fields;
}

// now we set our cookie if we need to
function multishop_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', '', false); //this will fail if any part of page has been output- hope this works!
    $count = $_POST['woocommerce-sort-by-columns'];
  }
  // else normal page load and no cookie
  return $count;
}
 
add_filter('loop_shop_per_page','multishop_sort_by_page');

/*** Enqueue css and js files ***/
require get_template_directory() . '/functions/enqueue-files.php';

/*** Theme Default Setup ***/
require get_template_directory() . '/functions/theme-default-setup.php';

//multishop theme theme option
require get_template_directory() . '/theme-options/fasterthemes.php';

/*** Recent Post Widget ***/
require get_template_directory() . '/functions/recent-post-widget.php';

/*** Breadcrumbs ***/
require get_template_directory() . '/functions/breadcrumbs.php';

/*** Custom Header ***/
require get_template_directory() . '/functions/custom-header.php';

/*** TGM ***/
require get_template_directory() . '/functions/tgm-plugins.php';

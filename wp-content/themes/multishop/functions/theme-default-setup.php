<?php 
/*
 * thumbnail list
*/ 
function multishop_thumbnail_image($content) {
    if( has_post_thumbnail() )
         return the_post_thumbnail( 'thumbnail' ); 
}
/*
 * multishop Main Sidebar
*/
function multishop_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'multishop' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'multishop' ),
		'before_widget' => '<aside id="%1$s" class="sidebar-widget widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="sidebar-title"><h3 class="aside-h3">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area One', 'multishop' ),
		'id'            => 'footer-1',
		'description'   => __( 'Footer Area One that appears on the footer-1.', 'multishop' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget footer-widget-1 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-blogs">',
		'after_title'   => '</h1><div class="footer-title-line"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area Two', 'multishop' ),
		'id'            => 'footer-2',
		'description'   => __( 'Footer Area Two that appears on the footer-2.', 'multishop' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-blogs">',
		'after_title'   => '</h1><div class="footer-title-line"></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area Three', 'multishop' ),
		'id'            => 'footer-3',
		'description'   => __( 'Footer Area Three that appears on the footer-3.', 'multishop' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget footer-widget-3 no-padding %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-blogs">',
		'after_title'   => '</h1><div class="footer-title-line"></div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Four', 'multishop' ),
		'id'            => 'footer-4',
		'description'   => __( 'Footer Area Four that appears on the footer-4.', 'multishop' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-blogs">',
		'after_title'   => '</h1><div class="footer-title-line"></div>',
	) );
}
add_action( 'widgets_init', 'multishop_widgets_init' );

function multishop_entry_meta() {
	$multishop_category_list = get_the_category_list( __( ', ', ' ' ) );
	$multishop_tag_list = get_the_tag_list('<i class="fa fa-tag"></i> ',', ',' ');
	$multishop_date = sprintf( '<time datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$multishop_author = sprintf( '<a href="%1$s" title="%2$s" >%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'multishop' ), get_the_author() ) ),
		get_the_author()
	);

	if ( $multishop_tag_list ) {
		$multishop_utility_text = __( '<div class="multishop-tags"> Posted in  %1$s  <i class="fa fa-calendar"></i> %3$s  <i class="fa fa-user"></i>  %4$s  %2$s  <i class="fa fa-comments"></i>  '.get_comments_number(). '</div>', 'multishop' );
	} elseif ( $multishop_category_list ) {
		$multishop_utility_text = __( '<div class="multishop-tags"> Posted in  %1$s  <i class="fa fa-calendar"></i> %3$s  <i class="fa fa-user"></i>  %4$s  %2$s  <i class="fa fa-comments"></i>  '.get_comments_number().'</div>', 'multishop' );
	} else {
		$multishop_utility_text = __( '<div class="multishop-tags"> Posted <i class="fa fa-calendar"></i>  %3$s <i class="fa fa-user"></i>  %4$s  %2$s  <i class="fa fa-comments"></i>  '.get_comments_number(). '</div>', 'multishop' );
	}

	printf(
		$multishop_utility_text,
		$multishop_category_list,
		$multishop_tag_list,
		$multishop_date,
		$multishop_author
	);
} 

function multishop_read_more( ) {
return '...<div class="reading"><a class="readmore-btn" href="'. get_permalink() . '" >' .__('Continue Reading','multishop'). '</a></div>';
 }
add_filter( 'excerpt_more', 'multishop_read_more' ); 

/**length post text**/
function multishop_custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'multishop_custom_excerpt_length', 999 );


if ( ! function_exists('is_plugin_inactive')) {
      require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

function multishop_pagination() {
?>
<div class="col-md-12 multishop-default-pagination ">
			<?php 
				if(is_single()){
				the_post_navigation( array(
						'next_text' => '<span class="multishop_next_pagination meta-nav" aria-hidden="true">%title</span>',
						'prev_text' => '<span class="multishop_previous_pagination meta-nav" aria-hidden="true">%title</span>',
				) );
				}else{	
					the_posts_pagination( array(
						'prev_text'          => __( '<<' ),
						'next_text'          => __( '>>' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'multishop' ) . ' </span>',
					) ); 
				}
			?>
</div>
<?php }

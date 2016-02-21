<?php
/*
 * multishop Breadcrumbs
*/
function multishop_custom_breadcrumbs() {

  $multishop_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $multishop_delimiter = '/'; // multishop_delimiter between crumbs
  $multishop_home = __('Home','multishop'); // text for the 'Home' link
  $multishop_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $multishop_before = ' '; // tag before the current crumb
  $multishop_after = ' '; // tag after the current crumb

  global $post;
  $multishop_homelink = esc_url(home_url());

  if (is_home() || is_front_page()) {

    if ($multishop_showonhome == 1) echo '<div id="crumbs" class="conter-text multishop-breadcrumb"><a href="'.$multishop_homelink.'">'.$multishop_home.'</a></div>';
    
  } else {

   echo '<div id="crumbs" class="conter-text multishop-breadcrumb"><a href="'.$multishop_homelink.'">'.$multishop_home.'</a>'.$multishop_delimiter;
   

    if ( is_category() ) {
      $multishop_thisCat = get_category(get_query_var('cat'), false);
      if ($multishop_thisCat->parent != 0) echo get_category_parents($multishop_thisCat->parent, TRUE, ' ' . $multishop_delimiter . ' ');      
      printf(__('%1$s Archive by category %2$s','multishop'),$multishop_before,$multishop_after);
      
      

    } elseif ( is_search() ) {
      
    printf(__('%1$s Search results for "%2$s" %3$s','multishop'),$multishop_before,get_search_query(),$multishop_after);     
      
    } elseif ( is_day() ) {      
      printf(__('%1$s %2$s %3$s','multishop'),get_year_link(get_the_time('Y')),get_the_time('Y'),$multishop_delimiter);
      printf(__('%1$s %2$s %3$s','multishop'),get_month_link(get_the_time('Y'),get_the_time('m')),get_the_time('F'),$multishop_delimiter);
      printf(__('%1$s %2$s %3$s','multishop'), $multishop_before, get_the_time('d'), $multishop_after);
    } elseif ( is_month() ) {
	
	echo '<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a>'.$multishop_delimiter;
	printf(__('%1$s %2$s %3$s','multishop'), $multishop_before, get_the_time('F'), $multishop_after);

    } elseif ( is_year() ) {      
      printf(__('%1$s %2$s %3$s','multishop'), $multishop_before, get_the_time('Y'), $multishop_after);

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $multishop_post_type = get_post_type_object(get_post_type());
        $multishop_slug = $multishop_post_type->rewrite;        
	    echo '<a href="'.$multishop_homelink.'/'.$multishop_slug['slug'].'">'.$multishop_post_type->labels->singular_name.'</a>';
        if ($multishop_showcurrent == 1) echo ' ' . $multishop_delimiter . ' ' . $multishop_before . get_the_title() . $multishop_after;
      } else {
        $multishop_cat = get_the_category(); $multishop_cat = $multishop_cat[0];
        $multishop_cats = get_category_parents($multishop_cat, TRUE, ' ' . $multishop_delimiter . ' ');
        if ($multishop_showcurrent == 0) $multishop_cats = preg_replace("#^(.+)\s$multishop_delimiter\s$#", "$1", $multishop_cats);
        echo $multishop_cats;
        if ($multishop_showcurrent == 1) echo $multishop_before . get_the_title() . $multishop_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	if ( function_exists('is_post_type_archive') && is_post_type_archive() && get_post_type()) {
	    $multishop_post_type = get_post_type_object(get_post_type());
	    printf(__('%1$s %2$s %3$s','multishop'),$multishop_before, $multishop_post_type->labels->singular_name, $multishop_after);
	    
	}

    } elseif ( is_attachment() ) {
      $multishop_parent = get_post($post->post_parent);
      $multishop_cat = get_the_category($multishop_parent->ID); $multishop_cat = $multishop_cat[0];      
      printf(__('%1$s','multishop'),get_category_parents($multishop_cat, TRUE, ' ' . $multishop_delimiter . ' '));      
      echo '<a href="'.get_permalink($multishop_parent).'">'.$multishop_parent->post_title.'</a>';
      
      if ($multishop_showcurrent == 1) echo ' ' . $multishop_delimiter . ' ' . $multishop_before . get_the_title() . $multishop_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($multishop_showcurrent == 1) echo $multishop_before . get_the_title() . $multishop_after;

    } elseif ( is_page() && $post->post_parent ) {
      $multishop_parent_id  = $post->post_parent;
      $multishop_breadcrumbs = array();
      while ($multishop_parent_id) {
        $multishop_page = get_page($multishop_parent_id);
        $multishop_breadcrumbs[] = '<a href="' . get_permalink($multishop_page->ID) . '">' . get_the_title($multishop_page->ID) . '</a>';
        $multishop_parent_id  = $multishop_page->post_parent;
      }
      $multishop_breadcrumbs = array_reverse($multishop_breadcrumbs);
      for ($multishop_i = 0; $multishop_i < count($multishop_breadcrumbs); $multishop_i++) {
        echo $multishop_breadcrumbs[$multishop_i];
        if ($multishop_i != count($multishop_breadcrumbs)-1) echo ' ' . $multishop_delimiter . ' ';
      }
      if ($multishop_showcurrent == 1) echo ' ' . $multishop_delimiter . ' ' . $multishop_before . get_the_title() . $multishop_after;

    } elseif ( is_tag() ) {      
      printf(__('%1$s Posts tagged "%2$s"','multishop'),$multishop_before,single_tag_title('', false),$multishop_after);
    } elseif ( is_author() ) {
       global $author;
      $multishop_userdata = get_userdata($author);
      printf(__('%1$s Articles posted by %2$s','multishop'),$multishop_before,$multishop_userdata->display_name,$multishop_after);

    } elseif ( is_404() ) {      
      printf(__('%1$s Error 404 %1$s','multishop'),$multishop_before,$multishop_after);
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','multishop') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
} // end multishop_custom_breadcrumbs()

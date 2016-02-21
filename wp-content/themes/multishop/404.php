<?php
/*
* 404 page template
*/
get_header(); ?>
<!--section start-->
<div class="col-md-12 site-title">
  <div class="multishop-container multishop-breadcrumb">
    <h1><?php _e('404 Page','multishop'); ?></h1>
    <ol class="site-breadcumb">
      <?php if (function_exists('multishop_custom_breadcrumbs')) multishop_custom_breadcrumbs(); ?>
    </ol>
  </div>
</div>
<section class="shoap-section">
  <div class="multishop-container">
    <div class="col-md-12">
      <article class="article-left multishop-found">
        <h1 class="page-title"><?php _e( 'Not Found', 'multishop' ); ?></h1>
        <h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'multishop' ); ?></h2>
        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'multishop' ); ?></p>
        <div>
          <?php get_search_form(); ?>
        </div>
      </article>
    </div>
  </div>
</section>
<div class="clearfix"></div>
<!--section end-->

<?php get_footer(); ?>

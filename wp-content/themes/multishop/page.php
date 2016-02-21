<?php 
/**
 * Main Page template file
**/
get_header(); 
?>
<div class="clearfix"></div>
<div class="col-md-12 site-title">
  <div class="multishop-container multishop-breadcrumb">
    <h1><?php esc_attr(the_title()); ?></h1>
    <ol class="site-breadcumb">
      <?php  if (function_exists('multishop_custom_breadcrumbs')) multishop_custom_breadcrumbs(); ?>
    </ol>
  </div>
</div>

<div class="site-title-border"> </div>
<div class="multishop-container row">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-md-9 clearfix">
		<?php while ( have_posts() ) : the_post(); 
				get_template_part( 'content', get_post_format() );
				
				comments_template( '', true ); 
				
			endwhile; ?>
    </div>
    <?php  get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>

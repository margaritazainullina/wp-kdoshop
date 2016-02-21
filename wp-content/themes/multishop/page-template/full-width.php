<?php 
/**
 * Template Name: Full Width
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

<div class="multishop-container">
	<div class="col-md-12">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php while ( have_posts() ) : the_post(); 
					get_template_part( 'content', get_post_format() ); 
				 endwhile; ?>
			<?php  comments_template( '', true ); ?>
		</div>
   </div>
</div>
<?php get_footer(); ?>

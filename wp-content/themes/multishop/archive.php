<?php 
/**
 * Archive Page template file
**/
get_header(); 
?>

<div class="clearfix"></div>
<div class="col-md-12 site-title clearfix">
  <div class="multishop-container multishop-breadcrumb">
    <h1><?php	the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
	</h1>			
    <ol class="site-breadcumb">
      <?php  if (function_exists('multishop_custom_breadcrumbs')) multishop_custom_breadcrumbs(); ?>
    </ol>
  </div>
</div>

<div class="multishop-container row">
	<div class="col-md-9">
		<?php while ( have_posts() ) : the_post(); 
				get_template_part( 'content', get_post_format() ); 
			  endwhile;
		
			  multishop_pagination();
		?>
	</div>
	<?php  get_sidebar(); ?>
</div>
<?php get_footer(); ?>

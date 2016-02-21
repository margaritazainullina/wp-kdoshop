<?php 
/**
 * Search Page template file
**/
get_header(); 
?>

<div class="clearfix"></div>
<div class="col-md-12 site-title clearfix">
  <div class="multishop-container multishop-breadcrumb">
    <h1><?php printf( __( 'Search Results for: %s', 'multishop' ), get_search_query() ); ?></h1>
    <ol class="site-breadcumb">
      <?php if (function_exists('multishop_custom_breadcrumbs')) multishop_custom_breadcrumbs(); ?>
    </ol>
  </div>
</div>

<div class="multishop-container row">
  <div class="col-md-9">
	 <?php if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); 
					get_template_part( 'content', get_post_format() );
				endwhile;  
		  else : ?>	  
		<div>
			<?php echo	'<h3>' . __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','impressive') . '</h3>';
			 get_search_form(); ?>
		</div>	 
	<?php endif; 
	
		  multishop_pagination();	
     ?>
     
  </div>
  <?php  get_sidebar(); ?>
</div>
<?php get_footer(); ?>

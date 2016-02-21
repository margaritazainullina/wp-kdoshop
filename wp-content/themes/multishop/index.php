<?php 
/**
 * The main template file
**/
get_header(); 
$multishop_options = get_option( 'multishop_theme_options' );
?>
<div class="clearfix"></div>
<section class="shoap-section">
  <div class="site-title-border"> </div>
  <div class="multishop-container">
    <div class="col-md-9">
      <?php 
	  	$multishop_args = array( 
						'orderby'      => 'post_date', 
						'order'        => 'DESC',
						'post_type'    => 'post',
						'paged' => $paged,
						'post_status'    => 'publish'	
					  );
		$multishop_query = new WP_Query($multishop_args);
		?>
      <?php if ($multishop_query->have_posts() ) : while ($multishop_query->have_posts()) : $multishop_query->the_post(); 
				get_template_part( 'content', get_post_format() ); 
			endwhile; endif; // end of the loop.
		
			multishop_pagination();  ?>
  	 
    </div>
  </div>
</section>
<?php  get_footer(); ?>

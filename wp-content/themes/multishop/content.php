<?php
/**
 * The default template for displaying content
 */
?>
<div class="blog-box padding-top-0 clearfix">
	<?php
		if(is_page_template('page-template/full-width.php')){
			$multishop_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()),'full'); 	
			$image_blog_class = '';
		}else{	
			$multishop_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()),'multishop-blog-image'); 	
			$image_blog_class = 'class=blog-image';
		}	
		if($multishop_image[0] != "") { ?>
		<div <?php echo $image_blog_class ?>>
			<img src="<?php echo esc_url($multishop_image[0]); ?>" width="<?php echo $multishop_image[1]; ?>" height="<?php echo $multishop_image[2]; ?>"  alt="<?php esc_attr(the_title()); ?>" class="img-responsive" />
		</div>
		<?php }  ?>
	<div class="blog-body">
		<h4>
			<a href=<?php echo esc_url(get_permalink()); ?>><?php esc_attr(the_title()); ?></a>
		</h4>
		<?php multishop_entry_meta(); 
			  if(is_singular()){
					the_content();
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'multishop' ),
						'after' => '</div>',
					) );
			  }else{
					the_excerpt();
			  } ?>
	</div>
</div>

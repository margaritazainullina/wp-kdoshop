<?php 
//function for pagination
 function cwf_pagination($pages = '', $range = 4)
{ 
     $showitems = ($range * 2)+1; 
     //global $paged;
	 $paged = (sanitize_text_field( $_GET['paged'] )) ? sanitize_text_field( $_GET['paged'] ) : 1;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;&lsaquo;</a>"; //previous
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;&rsaquo;</a>"; //next
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

?>


<div class="wrap">
<h2>Countdown Products <a href="<?php echo site_url(); ?>/wp-admin/post-new.php?post_type=product" class="add-new-h2">Add Countdown Product</a></h2>
<table class="wp-list-table widefat fixed striped posts scwf-admin-table">
	<thead>
		<tr>
			<th scope="col" id="name" class="manage-column column-name sortable desc" style=""><span>Product Name</span></a></th>
			<th scope="col" id="thumb" class="manage-column column-thumb" style=""><span>Product Image</span></th>
			<th scope="col" id="date" class="manage-column column-date" style=""><span>Offer Ends</span></th>
			<th scope="col" class="manage-action" style=""><span>Action</span></th>
		</tr>
	</thead>
	<tbody>
<?php
    $paged = (sanitize_text_field( $_GET['paged'] )) ? sanitize_text_field( $_GET['paged'] ) : 1;
	$post_per_page=10;
	$args = array(
				'post_type' => 'product',
		        'posts_per_page' => $post_per_page,
	            'paged' => $paged,
			    'meta_query' => array(
						array(
						   'key' => 'scwf_sales_countdown',
						   'value' => 'sales_yes',
						   'compare' => '=',
						)
				    )
				);
	
	
	$the_query = new WP_Query( $args );
		
		if ( $the_query->have_posts() ) :
	  while ( $the_query->have_posts() ) : $the_query->the_post();
				$post_id = get_the_ID();
				$product_id = get_post_thumbnail_id();
				$product_url = wp_get_attachment_image_src($product_id,'full',true);
				$product_mata = get_post_meta($product_id,'_wp_attachment_image_alt',true);
				$product_link = get_permalink().'<br>';
			?>
			<tr id="post-<?php echo $post_id; ?>">
			    <td class="name column-name">
					<strong>
						<a class="row-title" href="<?php echo get_edit_post_link( $post_id ); ?>"><?php the_title(); ?></a>
					</strong>
				</td>
				<td class="thumb column-thumb">
					<a href="<?php echo get_edit_post_link( $post_id ); ?>">
						<?php echo the_post_thumbnail('thumbnail'); ?>
					</a>
				</td>
				<td class="date column-date">
				<?php $offer_ends = get_post_meta($post_id, 'scwf_sales_date', true); ?>
				<?php $str_time = strtotime($offer_ends); ?>
				<?php $now_time = time(); ?>
				
				<?php if($str_time > $now_time) { ?>
					<abbr title="<?php echo $offer_ends; ?>"><?php echo $offer_ends; ?></abbr>
				<?php } else{?>
					<abbr title="<?php echo $offer_ends; ?>"><?php echo "Timeout!"; ?></abbr>
				<?php } ?>
				
				</td>
				<td class="name column-name">
					<strong>
						<a class="row-title" href="<?php echo get_edit_post_link( $post_id ); ?>">Edit</a>
					</strong>
				</td>
			</tr>
			<?php
			endwhile;
	endif;
		
?>
<?php 
//pagination 
if (function_exists("cwf_pagination") and $the_query->found_posts > 10) {
 
?>
	<tr>
	   <td colspan="4">
	    <div  style="float:right;"><?php cwf_pagination($the_query->max_num_pages); ?></div>
	   </td> 
	</tr>
<?php
} 
?>
</tbody>
</table>
</div>
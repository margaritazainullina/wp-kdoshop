<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
<div class="clearfix"></div>
<div class="col-md-12 site-title">
  <div class="multishop-container multishop-breadcrumb">
    <h1> <?php _e('SHOP','multishop') ?> </h1>
    <ol class="site-breadcumb">
      <?php if (function_exists('multishop_custom_breadcrumbs')) multishop_custom_breadcrumbs(); ?>
    </ol>
  </div>
</div>

<!--section start-->
<section class="shoap-section">
  <div class="multishop-container">
    <div class="col-md-9">
       <div class="col-md-12 top-pagination no-padding-lr">
        <div class="col-md-5 pagination-icon no-padding-lr"> 
        <i class="fa fa-th-large"></i> 
          <?php   global $wp_query;?>
          <p class="woocommerce-result-count">
            <?php
							$paged = max( 1, $wp_query->get( 'paged' ) );
							$per_page = $wp_query->get( 'posts_per_page' );
							$total = $wp_query->found_posts;
							$first = ( $per_page * $paged ) - $per_page + 1;
							$last = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
							if ( 1 == $total ) {
							_e( 'Showing the single result', 'multishop' );
							} elseif ( $total <= $per_page || -1 == $per_page ) {
							printf( __( 'Showing all %d results', 'multishop' ), $total );
							} else {
							printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'multishop' ), $first, $last, $total );
							}
							?>
          </p>
          
        </div>
        <div class="col-md-7 no-padding-lr">
          <div class="pagination-sorting">
         	  <div class="sorting-all">
			  <label class="sele-label"><?php _e('Show All','multishop') ?></label>
              <form action="" method="POST" name="results" class="woocommerce-ordering">
                <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="form-control select-sort" onchange="this.form.submit()">
                  <?php
					$numberOfProductsPerPage='';
								//Get products on page reload
								if(!empty($_POST['woocommerce-sort-by-columns'])){
								if  (isset($_POST['woocommerce-sort-by-columns']) && (!empty($_COOKIE['shop_pageResults']))) {
									if($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns'])
										$numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
										  } else {
											  if(!empty($_COOKIE['shop_pageResults']))
												$numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
												else
												$numberOfProductsPerPage=$_POST['woocommerce-sort-by-columns'];
										  }
									  }else  $numberOfProductsPerPage=4;
									$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
												'5' 		=> '5',
												'9' 		=> '9',
												'12' 		=> '12',
												'15' 		=> '15',
												'20' 		=> '20',
												'-1' 		=> __('all', 'multishop'),
											));
			foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
				echo '<option value="' . $sort_id . '" ' . selected( $numberOfProductsPerPage, $sort_id, true ) . ' >' . $sort_name . '</option>';
							?>
                </select>
              </form>
              
            </div>  

          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row shoap-row">
        <?php if ( have_posts() ) : ?>
        <?php woocommerce_product_loop_start(); ?>
        <?php woocommerce_product_subcategories(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-4 col-sm-4 resp-grid woocommerce-product">
          <div class="item">
            <?php $multishop_feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  ?>
            <div class="main-border">
              <?php if($multishop_feat_image!="") { ?>
              <img src="<?php echo esc_url($multishop_feat_image); ?>" alt="<?php _e('Banner','multishop'); ?>" class="img-responsive"  />
              <?php } ?>
              <div class="product-details"> 
              <div class="product-text">
			  <?php if (!isset($product)) global $product; ?>
              	<span><?php echo $product->get_price_html(); ?></span>
                <h5>  <?php esc_attr(the_title()); ?> </h5>
               </div> 
                <div class="product-button"> <a id="id-<?php the_id(); ?>" href="<?php echo esc_url(get_permalink()); ?>" class="details-button"><?php _e('DETAILS','multishop') ?></a> <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="addtocart-button"><?php _e('ADD TO CART','multishop') ?></a> </div>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; // end of the loop. ?>
        <?php woocommerce_product_loop_end(); ?>
        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
        <?php wc_get_template( 'loop/no-products-found.php' ); ?>
        <?php endif; ?>
      </div>
      <div class="col-md-12 top-pagination no-padding-lr">
        <div class="col-md-4 pagination-icon no-padding-lr"> 
        			<i class="fa fa-th-large"></i>
          <?php   global $wp_query;
						if ( ! woocommerce_products_will_display() )
						return;
						?>
          <p class="woocommerce-result-count">
            <?php
						$paged = max( 1, $wp_query->get( 'paged' ) );
						$per_page = $wp_query->get( 'posts_per_page' );
						$total = $wp_query->found_posts;
						$first = ( $per_page * $paged ) - $per_page + 1;
						$last = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );
						if ( 1 == $total ) {
						_e( 'Showing the single result', 'multishop' );
						} elseif ( $total <= $per_page || -1 == $per_page ) {
						printf( __( 'Showing all %d results', 'multishop' ), $total );
						} else {
						printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'multishop' ), $first, $last, $total );
						}
						?>
          </p>
        </div>
			 <div class="col-md-8 no-padding-lr">
          <div class="pagination-sorting">
            <div class="sorting-all"> 

              <label class="sele-label"><?php _e('Show All','multishop') ?></label>
              <form action="" method="POST" name="results" class="woocommerce-ordering">
                <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="form-control select-sort" onchange="this.form.submit()">
                  <?php
                  
				  		//Get products on page reload
				  		if(!empty($_POST['woocommerce-sort-by-columns'])){
								if  (isset($_POST['woocommerce-sort-by-columns']) && (!empty($_COOKIE['shop_pageResults']))) {
													
									if($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns'])
										$numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
										  } else {
											  if(!empty($_COOKIE['shop_pageResults']))
												$numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
											else
												$numberOfProductsPerPage=$_POST['woocommerce-sort-by-columns'];

										  }
									  }else  $numberOfProductsPerPage=4;
										$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
												'5' 		=> '5',
												'9' 		=> '9',
												'12' 		=> '12',
												'15' 		=> '15',
												'20' 		=> '20',
												'-1' 		=> __('All', 'multishop'),
											));

										foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
											echo '<option value="' . $sort_id . '" ' . selected( $numberOfProductsPerPage, $sort_id, true ) . ' >' . $sort_name . '</option>';
								?>
                </select>
              </form>
            </div>  
          </div>
        </div>  
      </div>
    </div>
    
    <!--section end-->
    
    <?php
		do_action( 'woocommerce_sidebar' );
	?>
  </div>
</section>
<div class="clearfix"></div>
<?php get_footer( 'shop' ); ?>

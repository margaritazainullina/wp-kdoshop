<?php
/*
* Template Name:Home Page
*/
get_header();
$multishop_options = get_option( 'multishop_theme_options' );
?>
<div class="clearfix"></div>
  <!-- HOME BANNER -->
 <div class="multishop-home-banner">
    <?php if(get_header_image()){ ?>
    <div class="custom-header-img"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" class="img-responsive"> </a> </div>
    <?php } ?>
    <div class='site-title-text'>
	<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
	<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
  </div>
  </div>  
  <!-- END HOME BANNER -->
  
<section>
  <div class="container multishop-container">
    <div class="row multishop-home-section">
      <div class="col-md-3 col-sm-3">
        <div class="home-section1">
          <div class="ImageWrapper chrome-fix">
            <?php if(!empty($multishop_options['img-section-1'])) { ?>
            <img src="<?php echo esc_url($multishop_options['img-section-1']); ?>" alt="" class="img-responsive" />
            <?php } ?>
            <div class="ImageOverlayC"></div>
            <div class="Buttons StyleH">
              <div class="WhiteRounded">
                <h2>
                  <?php if(!empty($multishop_options['text-section-1'])) { ?>
                  <?php echo esc_attr($multishop_options['text-section-1']);?>
                  <?php } ?>
                </h2>
                <p>
                  <?php if(!empty($multishop_options['discount-section-1'])) { ?>
                  <?php echo esc_attr($multishop_options['discount-section-1']);?>
                  <?php } ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 resp-padding">
        <div class="home-section2">
          <div class="ImageWrapper chrome-fix">
            <?php if(!empty($multishop_options['img-section-2'])) { ?>
            <img src="<?php echo esc_url($multishop_options['img-section-2']); ?>" alt="" class="img-responsive" />
            <?php } ?>
            <div class="ImageOverlayC"></div>
            <div class="Buttons StyleH">
              <div class="WhiteRounded">
                <h2>
                  <?php if(!empty($multishop_options['text-section-2'])) { ?>
                  <?php echo esc_attr($multishop_options['text-section-2']);?>
                  <?php } ?>
                </h2>
                <p>
                  <?php if(!empty($multishop_options['discount-section-2'])) { ?>
                  <?php echo esc_attr($multishop_options['discount-section-2']);?>
                  <?php } ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div class="home-section1">
          <div class="ImageWrapper chrome-fix">
            <?php if(!empty($multishop_options['img-section-3'])) { ?>
            <img src="<?php echo esc_url($multishop_options['img-section-3']); ?>" alt="" class="img-responsive" />
            <?php } ?>
            <div class="ImageOverlayC"></div>
            <div class="Buttons StyleH">
              <div class="WhiteRounded">
                <h2>
                  <?php if(!empty($multishop_options['text-section-3'])) { ?>
                  <?php echo esc_attr($multishop_options['text-section-3']);?>
                  <?php } ?>
                </h2>
                <p>
                  <?php if(!empty($multishop_options['discount-section-3'])) { ?>
                  <?php echo esc_attr($multishop_options['discount-section-3']);?>
                  <?php } ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php    
    if (is_plugin_active('woocommerce/woocommerce.php')) {
    ?>
    <div class="woocommerce-product">
      <div class="product-header">
        <h2 class="widget-title"> <span class="product-title"><?php _e('TOP RATED PRODUCTS','multishop') ?></span> </h2>
      </div>
      <div class="col-md-12 next-prev-button"> <span id="prev2" class="prev black-box prev3"></span> <span id="next2" class="next black-box next3"></span> </div>
      <div class="clearfix"></div>
      <div class="inner-row" id="top-product">
        <?php
					  $args = array(
							'post_type' => 'product',
							'stock' => 1,
							'posts_per_page' => 9,
							'orderby' =>'date',
							'order' => 'DESC' );
					  $loop = new WP_Query( $args );
					  while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
        <div class="item">
          <?php $multishop_feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  ?>
          <div class="main-border">
            <?php if($multishop_feat_image!="") { ?>
            <img src="<?php echo esc_url($multishop_feat_image); ?>" alt="<?php _e('Banner','multishop'); ?>" class="img-responsive"  />
            <?php } ?>
            <div class="product-details"> <span><?php echo $product->get_price_html(); ?></span>
              <h5>
                <?php esc_attr(the_title()); ?>
              </h5>
              
              <div class="product-button"> <a id="id-<?php the_id(); ?>" href="<?php echo esc_url(get_permalink()); ?>" class="details-button"><?php _e('DETAILS','multishop') ?></a> <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="addtocart-button"><?php _e('ADD TO CART','multishop'); ?></a> </div>
            </div>
          </div>
        </div>
        <?php
						endwhile; 
						wp_reset_query(); // Remember to reset
						remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
						?>
      </div>
    </div>

    <?php
    }
    ?>
  </div>
</section>
<?php get_footer(); ?>

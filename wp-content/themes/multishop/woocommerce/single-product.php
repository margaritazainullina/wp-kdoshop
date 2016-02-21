<?php
/**
 * The Template for displaying all single products.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header( 'shop' ); ?>
<div class="clearfix"></div>
<div class="col-md-12 site-title">
  <div class="multishop-container multishop-breadcrumb">
    <h1>
      <?php esc_attr(the_title()); ?>
    </h1>
  </div>
</div>
<section class="shoap-section">
  <div class="multishop-container">
    <div class="col-md-9 no-padding-lr">
      <div class="clearfix"></div>
      <div class="col-md-12 no-padding single-product clearfix">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-5 no-padding-lr">
          <div class=" product-images"> <?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?> </div>
          <?php
					global $post, $product, $woocommerce;
					$attachment_ids = $product->get_gallery_attachment_ids();
					if ( $attachment_ids ) {  ?>
          <div class="col-md-12 no-padding-lr clearfix"> <a class="product-small progallery">
            <?php
						$loop = 0;
						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
						foreach ( $attachment_ids as $attachment_id ) 
						{
							$classes = array( 'zoom' );
							if ( $loop == 0 || $loop % $columns == 0 )
								$classes[] = 'first';
							if ( ( $loop + 1 ) % $columns == 0 )
								$classes[] = 'last';
								$image_link = wp_get_attachment_url( $attachment_id );
							if ( ! $image_link )
							continue;
								$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
								$image_class = esc_attr( implode( ' ', $classes ) );
								$image_title = esc_attr( get_the_title( $attachment_id ) );
							
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s progallery" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
							$loop++;
						 } ?>
            </a> </div>
          <?php }?>
        </div>
        <div class="col-md-7">
          <div class="product-details">
            <h3>
              <?php esc_attr(the_title()); ?>
            </h3>
            <p>
              <?php the_excerpt(); ?>
            </p>
          </div>
          <div class="clearfix"></div>
          <div class="product-availabilty">
            <label><?php _e('Availability:','multishop'); ?></label>
            <?php
							// Availability
							$availability = $product->get_availability();

							if ( $availability['availability'] )
							echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
							else
							echo "<p>".__('Out Stock','multishop')."</p>";
							?>
            <span><?php echo $product->get_price_html(); ?></span> </div>
          <div class="product-count">
            <?php
			if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
			global $product;
    	  ?>
            <?php if ( ! $product->is_in_stock() ) : ?>
            <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'multishop' ) ); ?></a>
            <?php else : ?>
            <?php
								$link = array(
									'url'   => '',
									'label' => '',
									'class' => ''
								);
				$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
				switch ( $handler ) {
					case "variable" :
						$link['url']    = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
						$link['label']  = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'multishop' ) );
						break;
					case "grouped" :
						$link['url']    = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
						$link['label']  = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'multishop' ) );
						break;
					case "external" :
						$link['url']    = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
						$link['label']  = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'multishop' ) );
						break;
					default :
					if ( $product->is_purchasable() ) {
						$link['url']    = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
						$link['label']  = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'multishop' ) );
						$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
					} else {
						$link['url']    = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
						$link['label']  = apply_filters( 'not_purchasable_text', __( 'Read More', 'multishop' ) );
					}break;
				}
				if ( $product->product_type == 'simple' ) {
   			  ?>
            <form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
              <?php woocommerce_quantity_input(); ?>
              <button type="submit" class="single-add-cart">
              <a  class="addcart-red-btn"><?php _e('add to cart','multishop'); ?> </a>
              </button>
            </form>
            <?php } else {
									echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );
								}
							?>
            <?php endif; ?>
          </div>
        </div>
        <?php endwhile; // end of the loop. ?>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12 product-tabs">
        <div id="horizontalTab" class="horizontal-tabs">
          <ul class="resp-tabs-list">
            <li><?php _e('Product Description','multishop') ?></li>
            <li><?php _e('Reviews','multishop') ?></li>
          </ul>
          <div class="resp-tabs-container">
            <div>
              <p>
                <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile;?>
              </p>
            </div>
            <div>
              <?php if ( comments_open() ) { ?>
              <li><a href="#">
                <?php _e('Reviews', 'multishop'); ?>
                <?php echo comments_number(' (0)', ' (1)', ' (%)'); ?></a>
                <section>
                  <?php comments_template(); ?>
                </section>
              </li>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php  get_sidebar(); ?>
  </div>
  <div class="clearfix"></div>
</section>
<?php
		do_action( 'woocommerce_after_main_content' );
	?>
<?php get_footer( 'shop' ); ?>

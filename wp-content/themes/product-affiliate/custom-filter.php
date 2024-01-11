<?php
// filter start //
function product_affiliate_get_shop_page_filter() {
    $product_affiliate_minPrice = $_POST['data']['minPrice'];
    $product_affiliate_maxPrice = $_POST['data']['maxPrice'];
    $product_affiliate_selectedRating = $_POST['data']['selectedRating'];
    $search_query = $_POST['data']['textValue'];

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
    );

    $product_affiliate_meta_query_array = array();
    $relation = 'AND';

    if (!empty($search_query)) {
        $args['s'] = $search_query;
    }

    if (!empty($product_affiliate_maxPrice)) {
        $product_affiliate_meta_query_array[] = array(
            'key' => '_price',
            'value' => array($product_affiliate_minPrice, $product_affiliate_maxPrice),
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC',
        );
    }

    if (!empty($product_affiliate_selectedRating)) {
        $product_affiliate_meta_query_array[] = array(
            'key' => '_wc_average_rating',
            'value' => $product_affiliate_selectedRating,
            'compare' => '=',
            'type' => 'NUMERIC',
        );
       
    }

    if (!empty($product_affiliate_meta_query_array)) {
        $args['meta_query'] = array(
            'relation' => $relation,
            $product_affiliate_meta_query_array,
        );
    }

  $loop = new WP_Query($args);
  $product_affiliate_shop_page_loop_html = '';
    ob_start();
  if ($loop->have_posts()){

    $i = 1;
		while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
  		<div class="prod">
  			<div class="product-image">
  				<?php the_post_thumbnail(); ?>
          <?php if(class_exists('YITH_WCWL')){ ?>
            <span class="wishlist"><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?></span>
          <?php }?>
  			</div>
  			<div class="details">
  				<a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>">
  					<h5 class="m-0"><?php the_title(); ?></h5>
  				</a>
  				<div class="product-price">
  					<div class="price">
  						<?php echo $product->get_price_html(); ?>
  					</div>
  				</div>	
  				<div class="product-rating mb-lg-3">
  					<div class="rat-star">
              <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?>
  					</div>
  				</div>
  				<div class="custom_product_meta my-4">
  					<?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $loop->post, $product ); } ?>		
  				</div>
  			</div>
  		</div>
		<?php $i++;
      endwhile; 
      wp_reset_query(); ?>
		</div>
    <?php }
    else { ?>
    <h3 class="no_product_found">
        <?php esc_html_e('No Product Found','product-affiliate'); ?>
    </h3>
    <?php }
   $product_affiliate_shop_page_loop_html = ob_get_clean();
   $product_affiliate_response_data = array(
     'next_offset'   =>  1,
     'current_page'  =>  0,
     'total_posts'   =>  0,
     'html'          =>  $product_affiliate_shop_page_loop_html
   );
   wp_send_json( $product_affiliate_response_data );
   exit;
}
add_action('wp_ajax_product_affiliate_get_shop_page_filter', 'product_affiliate_get_shop_page_filter');
add_action('wp_ajax_nopriv_product_affiliate_get_shop_page_filter', 'product_affiliate_get_shop_page_filter');
// filter end //
?>

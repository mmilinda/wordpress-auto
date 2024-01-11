<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider" >
    <div class="container">
      <?php $product_affiliate_slide_pages = array();
        for ( $product_affiliate_count = 1; $product_affiliate_count <= 3; $product_affiliate_count++ ) {
          $product_affiliate_mod = intval( get_theme_mod( 'product_affiliate_top_slider_page' . $product_affiliate_count ));
          if ( 'page-none-selected' != $product_affiliate_mod ) {
            $product_affiliate_slide_pages[] = $product_affiliate_mod;
          }
        }
        if( !empty($product_affiliate_slide_pages) ) :
          $product_affiliate_args = array(
            'post_type' => 'page',
            'post__in' => $product_affiliate_slide_pages,
            'orderby' => 'post__in'
          );
          $product_affiliate_query = new WP_Query( $product_affiliate_args );
          if ( $product_affiliate_query->have_posts() ) :
            $i = 1;
      ?>
      <div class="owl-carousel" role="listbox">
        <?php  while ( $product_affiliate_query->have_posts() ) : $product_affiliate_query->the_post(); ?>
          <div class="slider-box">
            <img src="<?php the_post_thumbnail_url('full'); ?>"/>
            <div class="slider-inner-box">
              <h2 class="mb-4"><?php the_title(); ?></h2>
              <p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
              <div class="slide-btn mt-5"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Shop Now','product-affiliate'); ?></a></div>
            </div>
          </div>
        <?php $i++; endwhile;
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
        <div class="no-postfound"></div>
      <?php endif;
      endif;?>
    </div>
  </section>

  <section id="advance-product" class="py-5">
    <div class="container">
        <div class="row m-0">
          <?php if ( class_exists( 'WooCommerce' ) ) { ?>
          <div class="col-lg-4">
            <?php if (get_theme_mod('product_affiliate_search_product_name')) { ?>
              <h3 class="search-heading">
                <?php echo esc_html(get_theme_mod('product_affiliate_search_product_name')); ?>
              </h3>
            <?php } ?>
          </div>
          <div class="col-lg-4">
            <?php if (get_theme_mod('product_affiliate_search_product_price')) { ?>
              <h3 class="search-heading">
               <?php echo esc_html(get_theme_mod('product_affiliate_search_product_price')); ?>
              </h3>
            <?php } ?>
          </div>
          <div class="col-lg-4">
            <?php if (get_theme_mod('product_affiliate_search_product_ratings')) { ?>
              <h3 class="search-heading">
                <?php echo esc_html(get_theme_mod('product_affiliate_search_product_ratings')); ?>
              </h3>
            <?php } ?>
          </div>
          <div class="col-lg-4 col-12 col-md-12 mt-lg-3 p-lg-0 ">
            <input id="product-search-text-field" type="text" placeholder="<?php esc_attr_e('Search here what you want','product-affiliate'); ?>">
          </div>
          <div class="col-lg-2 col-12 col-md-6 mt-lg-3 mt-3 position-relative ">  
            <div class="dropdown-search">
              <select  id="min-price" name="min-price" >
                <option selected="selected" value=""><?php esc_html_e('Min','product-affiliate'); ?></option>
                <?php
                for($i=1;$i<=4;$i++) { ?>
                  <option value="<?php echo esc_html(get_theme_mod('product_affiliate_minprice'.$i)); ?>"><?php echo esc_html(get_theme_mod('product_affiliate_minprice'.$i)); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-12 col-md-6 mt-lg-3 mt-3 position-relative max p-lg-0 ">
            <div class="dropdown-search">
              <select name="max-price" id="max-price" >
                <option selected="selected" value=""><?php esc_html_e('Max','product-affiliate'); ?></option>
                  <?php 
                  for($i=1;$i<= 4;$i++) { ?>
                    <option value="<?php echo esc_html(get_theme_mod('product_affiliate_maxprice'.$i)); ?>"><?php echo esc_html(get_theme_mod('product_affiliate_maxprice'.$i)); ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-12  col-md-6 mt-lg-3 mt-3 position-relative ratings ">
            <div class="dropdown-search">
              <select name="rating" id="rating" style=" color:#5755cf;">
                <!-- <option value="" >Select Ratings</option> -->
                <option value="" selected="selected">Select Ratings</option>
                <option value="1.00">&starf; &star; &star; &star; &star;</option>
                <option value="2.00">&starf; &starf; &star; &star; &star; </option>
                <option value="3.00">&#x2605; &#x2605; &#x2605; &star; &star;</option>
                <option value="4.00">&#x2605; &#x2605; &#x2605; &#x2605;  &star;</option>
                <option value="5.00">&#x2605; &#x2605; &#x2605; &#x2605; &#x2605;</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 p-lg-0 mt-lg-3 mt-3">
            <button class="filter-apply" id="apply-button"><?php esc_html_e('Apply','product-affiliate'); ?></button>  
          </div>
          <div class="owl-carousel">
            
            <?php 
            $args = array(
            'post_type' => 'product',
            'product_cat' => get_theme_mod('product_affiliate_trending_products_category'),
            'order' => 'ASC',
            );
            $loop = new WP_Query( $args );
            $i = 1;
            while ( $loop->have_posts() ) : $loop->the_post(); global $product;
            ?>
              <div class="prod ">
                <div class="product-image">
                  <?php the_post_thumbnail(); ?>
                  <?php if(class_exists('YITH_WCWL')){ ?>
                    <span class="wishlist"><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?></span>
                  <?php }?>
                </div>
                <div class="details">
                  <a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>">
                    <h5 class="m-0"><?php echo the_title(); ?></h5>
                  </a>
                  <div class="product-price">
                    <div class="price">
                      <?php echo $product->get_price_html(); ?>
                    </div>
                  </div>  
                  <div class="product-rating mb-lg-3">
                    <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?>
                  </div>
                  <div class="custom_product_meta mt-3">
                    <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $loop->post, $product ); } ?>  
                  </div>
                </div>
              </div>
            <?php $i++; endwhile; wp_reset_query(); ?>
          </div>
          <?php } ?>
        </div>
  </div> 
</section>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
<?php
/**
 * Displays top header 1
 *
 * @package Product Affiliate
 */
?>

<div class="top-header py-4">
	<div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 align-self-center text-sm-center text-lg-left">
                <?php if( get_theme_mod('product_affiliate_sidebar_toggle',false) != ''){ ?>
                    <?php if(is_active_sidebar( 'sidebar' )) : ?>
                        <span class="header_in">
                            <button type="button" class="toggle" id="toggle">
                               <span></span>
                            </button>
                        </span>
                        <div class="slidebar text-left" id='slidebar'>
                            <div class="sidebar">
                                <?php dynamic_sidebar( 'sidebar' ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php }?>

                <div class="navbar-brand text-center text-md-left">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $product_affiliate_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $product_affiliate_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('product_affiliate_logo_title_text',true) != ''){ ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } ?>
                            <?php else : ?>
                                <?php if( get_theme_mod('product_affiliate_logo_title_text',true) != ''){ ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $product_affiliate_description = get_bloginfo( 'description', 'display' );
                            if ( $product_affiliate_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('product_affiliate_theme_description',false) != ''){ ?>
                            <p class="site-description"><?php echo esc_html($product_affiliate_description); ?></p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-6 col-12 align-self-center product-search text-right pl-0">
                <?php if(class_exists('woocommerce')){ ?>
                    <?php get_product_search_form(); ?>
                <?php }?>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-12 btn-box align-self-center text-right">
                <span class="cart_no mr-3">
                    <?php if(class_exists('woocommerce')){ ?>
                        <?php global $woocommerce; ?>
                        <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'shopping cart','product-affiliate' ); ?>"><i class="fas fa-cart-plus"></i></a>
                    <?php }?>
                </span>
                <?php if ( get_theme_mod('product_affiliate_topbar1_wishlist_url') != "" ) {?>
                    <span class="wish-btn mr-3">
                        <a href="<?php echo esc_url(get_theme_mod('product_affiliate_topbar1_wishlist_url')); ?>"><i class="far fa-heart"></i></a>
                    </span>
                <?php }?>
                <?php if(class_exists('woocommerce')){ ?>
                    <span class="user-btn">
                        <?php if ( is_user_logged_in() ) { ?>
                            <a class="account-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','product-affiliate'); ?>"><i class="far fa-user"></i></a>
                        <?php } 
                        else { ?>
                            <a class="account-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','product-affiliate'); ?>"></a>
                        <?php } ?>
                    </span>
                <?php }?>
                
            </div>
        </div>
	</div>
</div>
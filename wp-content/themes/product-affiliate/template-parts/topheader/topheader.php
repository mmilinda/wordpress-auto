<?php
/**
 * Displays top header
 *
 * @package Product Affiliate
 */
?>

<div class="top-info text-right py-2">
	<div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 align-self-center top-box text-left">
                <div class="header-phone">
                     <?php if ( get_theme_mod('product_affiliate_topbar_email_id') != "" ) {?>
                        <span class="phone-box">
                            <i class="fas fa-envelope"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('product_affiliate_topbar_email_id')); ?>"><?php echo esc_html(get_theme_mod('product_affiliate_topbar_email_id')); ?></a>
                        </span>
                    <?php }?>
                    <?php if ( get_theme_mod('product_affiliate_topbar_phone_number') != "" ) {?>
                        <span>
                            <i class="fas fa-phone"></i><a href="tel:<?php echo esc_attr(get_theme_mod('product_affiliate_topbar_phone_number')); ?>"><?php echo esc_html(get_theme_mod('product_affiliate_topbar_phone_number')); ?></a>
                        </span>
                    <?php }?>
                   
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 align-self-center right-box">
                <span class="text-center translate-btn">
                    <?php if(class_exists('GTranslate')){ ?>
                        <?php echo do_shortcode('[gtranslate]', 'product-affiliate');?>
                    <?php }?>
                </span>
                <?php if(class_exists('WOOCS')){ ?>
                    <span class="currency">
                        <?php echo do_shortcode('[woocs]');?>
                    </span>
                <?php }?>
            </div>
        </div>
	</div>
</div>
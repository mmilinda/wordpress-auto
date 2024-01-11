<?php
/**
 * Product Affiliate Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Product Affiliate
 */

if ( ! defined( 'PRODUCT_AFFILIATE_URL' ) ) {
    define( 'PRODUCT_AFFILIATE_URL', esc_url( 'https://www.themgnifico.net/themes/product-affiliate-wordpress-theme/', 'product-affiliate') );
}
if ( ! defined( 'PRODUCT_AFFILIATE_TEXT' ) ) {
    define( 'PRODUCT_AFFILIATE_TEXT', __( 'Product Affiliate Pro','product-affiliate' ));
}
if ( ! defined( 'PRODUCT_AFFILIATE_BUY_TEXT' ) ) {
    define( 'PRODUCT_AFFILIATE_BUY_TEXT', __( 'Buy Product Affiliate Pro','product-affiliate' ));
}

use WPTRT\Customize\Section\Product_Affiliate_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Product_Affiliate_Button::class );

    $manager->add_section(
        new Product_Affiliate_Button( $manager, 'product_affiliate_pro', [
            'title'       => esc_html( PRODUCT_AFFILIATE_TEXT,'product-affiliate' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'product-affiliate' ),
            'button_url'  => esc_url( PRODUCT_AFFILIATE_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'product-affiliate-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'product-affiliate-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function product_affiliate_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('product_affiliate_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'product_affiliate_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'product_affiliate_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'product-affiliate' ),
        'section'        => 'title_tagline',
        'settings'       => 'product_affiliate_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('product_affiliate_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'product_affiliate_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'product_affiliate_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'product-affiliate' ),
        'section'        => 'title_tagline',
        'settings'       => 'product_affiliate_theme_description',
        'type'           => 'checkbox',
    )));

    //Logo
    $wp_customize->add_setting('product_affiliate_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'product_affiliate_sanitize_number_absint'
    ));
    $wp_customize->add_control('product_affiliate_logo_max_height',array(
        'label' => esc_html__('Logo Width','product-affiliate'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    // General Settings
     $wp_customize->add_section('product_affiliate_general_settings',array(
        'title' => esc_html__('General Settings','product-affiliate'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('product_affiliate_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'product_affiliate_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'product_affiliate_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'product-affiliate' ),
        'section'        => 'product_affiliate_general_settings',
        'settings'       => 'product_affiliate_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'product_affiliate_preloader_bg_color', array(
        'default' => '#6260E9',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'product_affiliate_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','product-affiliate'),
        'section' => 'product_affiliate_general_settings',
        'settings' => 'product_affiliate_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'product_affiliate_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'product_affiliate_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','product-affiliate'),
        'section' => 'product_affiliate_general_settings',
        'settings' => 'product_affiliate_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'product_affiliate_preloader_dot_2_color', array(
        'default' => '#2ECD6E',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'product_affiliate_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','product-affiliate'),
        'section' => 'product_affiliate_general_settings',
        'settings' => 'product_affiliate_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('product_affiliate_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'product_affiliate_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'product_affiliate_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'product-affiliate' ),
        'section'        => 'product_affiliate_general_settings',
        'settings'       => 'product_affiliate_scroll_hide',
        'type'           => 'checkbox',
    )));

    //TopBar
    $wp_customize->add_section('product_affiliate_topbar',array(
        'title' => esc_html__('Topbar Option','product-affiliate')
    ));

    $wp_customize->add_setting('product_affiliate_sidebar_toggle', array(
        'default' => false,
        'sanitize_callback' => 'product_affiliate_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'product_affiliate_sidebar_toggle',array(
        'label'          => __( 'Enable Sidebar Toggle', 'product-affiliate' ),
        'section'        => 'product_affiliate_topbar',
        'settings'       => 'product_affiliate_sidebar_toggle',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('product_affiliate_topbar_email_id',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_topbar_email_id',array(
        'label' => esc_html__('Email Id','product-affiliate'),
        'section' => 'product_affiliate_topbar',
        'setting' => 'product_affiliate_topbar_email_id',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('product_affiliate_topbar_phone_number',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_topbar_phone_number',array(
        'label' => esc_html__('Phone Number','product-affiliate'),
        'section' => 'product_affiliate_topbar',
        'setting' => 'product_affiliate_topbar_phone_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('product_affiliate_topbar1_wishlist_url',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_topbar1_wishlist_url',array(
        'label' => esc_html__('Wishlist Url','product-affiliate'),
        'section' => 'product_affiliate_topbar',
        'setting' => 'product_affiliate_topbar1_wishlist_url',
        'type'  => 'text'
    ));

     //Slider
    $wp_customize->add_section('product_affiliate_top_slider',array(
        'title' => esc_html__('Slider Settings','product-affiliate'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1400 x 550 px','product-affiliate')
    ));

    for ( $product_affiliate_count = 1; $product_affiliate_count <= 3; $product_affiliate_count++ ) {

        $wp_customize->add_setting( 'product_affiliate_top_slider_page' . $product_affiliate_count, array(
            'default'           => '',
            'sanitize_callback' => 'product_affiliate_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'product_affiliate_top_slider_page' . $product_affiliate_count, array(
            'label'    => __( 'Select Slide Page', 'product-affiliate' ),
            'section'  => 'product_affiliate_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }


     // Product 
    $wp_customize->add_section('product_affiliate_product_section',array(
        'title' => esc_html__('Product Option','product-affiliate'),
    ));

    $wp_customize->add_setting('product_affiliate_search_product_name',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_search_product_name',array(
        'label' => esc_html__('Product Heading 1','product-affiliate'),
        'section' => 'product_affiliate_product_section',
        'setting' => 'product_affiliate_search_product_name',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('product_affiliate_search_product_price',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_search_product_price',array(
        'label' => esc_html__('Product Heading 2','product-affiliate'),
        'section' => 'product_affiliate_product_section',
        'setting' => 'product_affiliate_search_product_price',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('product_affiliate_search_product_ratings',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('product_affiliate_search_product_ratings',array(
        'label' => esc_html__('Product Heading 3','product-affiliate'),
        'section' => 'product_affiliate_product_section',
        'setting' => 'product_affiliate_search_product_ratings',
        'type'  => 'text'
    ));

    for($i=1 ; $i<=4; $i++) {
        $wp_customize->add_setting('product_affiliate_minprice'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('product_affiliate_minprice'.$i,array(
            'label' => __('Min Price Amount ','product-affiliate'),
            'section' => 'product_affiliate_product_section',
            'setting'   => 'product_affiliate_minprice'.$i,
            'type'  => 'text'
        ));
        $wp_customize->add_setting('product_affiliate_maxprice'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('product_affiliate_maxprice'.$i,array(
            'label' => __('Max Price Amount','product-affiliate'),
            'section' => 'product_affiliate_product_section',
            'setting'   => 'product_affiliate_maxprice'.$i,
            'type'  => 'text'
        ));

    }

    $args = array(
        'type'                     => 'product',
          'child_of'                 => 0,
          'parent'                   => '',
          'orderby'                  => 'term_group',
          'order'                    => 'ASC',
          'hide_empty'               => false,
          'hierarchical'             => 1,
          'number'                   => '',
          'taxonomy'                 => 'product_cat',
          'pad_counts'               => false
      );
    $categories = get_categories( $args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        } 
        $cats[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('product_affiliate_trending_products_category',array(
      'sanitize_callback' => 'product_affiliate_sanitize_select',
    ));
    $wp_customize->add_control('product_affiliate_trending_products_category',array(
      'type'    => 'select',
      'choices' => $cats,
      'label' => __('Select Product Category','product-affiliate'),
      'section' => 'product_affiliate_product_section',
    ));
    
    // Footer
    $wp_customize->add_section('product_affiliate_site_footer_section', array(
        'title' => esc_html__('Footer', 'product-affiliate'),
    ));

    $wp_customize->add_setting('product_affiliate_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('product_affiliate_footer_text_setting', array(
        'label' => __('Replace the footer text', 'product-affiliate'),
        'section' => 'product_affiliate_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));
}
add_action('customize_register', 'product_affiliate_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function product_affiliate_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function product_affiliate_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function product_affiliate_customize_preview_js(){
    wp_enqueue_script('product-affiliate-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'product_affiliate_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function product_affiliate_panels_js() {
    wp_enqueue_style( 'product-affiliate-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'product-affiliate-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'product_affiliate_panels_js' );
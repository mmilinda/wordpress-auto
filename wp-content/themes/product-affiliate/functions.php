<?php
/**
 * Product Affiliate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Product Affiliate
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Product_Affiliate_Loader.php' );

$Product_Affiliate_Loader = new \WPTRT\Autoload\Product_Affiliate_Loader();

$Product_Affiliate_Loader->product_affiliate_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Product_Affiliate_Loader->product_affiliate_register();

if ( ! function_exists( 'product_affiliate_setup' ) ) :

	function product_affiliate_setup() {

		load_theme_textdomain( 'product-affiliate', get_template_directory() . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('product-affiliate-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','product-affiliate' ),
	        'footer'=> esc_html__( 'Footer Menu','product-affiliate' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'product_affiliate_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_product_affiliate_dismissable_notice', 'product_affiliate_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'product_affiliate_setup' );


function product_affiliate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'product_affiliate_content_width', 1170 );
}
add_action( 'after_setup_theme', 'product_affiliate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function product_affiliate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'product-affiliate' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'product-affiliate' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'product-affiliate' ),
		'id'            => 'product-affiliate-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'product-affiliate' ),
		'id'            => 'product-affiliate-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'product-affiliate' ),
		'id'            => 'product-affiliate-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'product_affiliate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function product_affiliate_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'josefin-sans',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'roboto',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'product-affiliate-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'product-affiliate-style', get_stylesheet_uri() );

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script('product-affiliate-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

	$tm_customscripts_object = array(
  	  'root'			=>	rest_url(),
  	  'ajaxurl'			=>	admin_url('admin-ajax.php'),
  	  'nonce'			=>	wp_create_nonce( 'wp_rest' ),
  	  'the_rest_url'	=>	get_rest_url(),
  	);
	wp_localize_script( 'product-affiliate-theme-js', 'tm_customscripts_object', $tm_customscripts_object );
	wp_enqueue_script( 'product-affiliate-theme-js' );
}
add_action( 'wp_enqueue_scripts', 'product_affiliate_scripts' );

/**
 * Enqueue Preloader.
 */
function product_affiliate_preloader() {

  $product_affiliate_theme_color_css = '';
  $product_affiliate_preloader_bg_color = get_theme_mod('product_affiliate_preloader_bg_color');
  $product_affiliate_preloader_dot_1_color = get_theme_mod('product_affiliate_preloader_dot_1_color');
  $product_affiliate_preloader_dot_2_color = get_theme_mod('product_affiliate_preloader_dot_2_color');
  $product_affiliate_logo_max_height = get_theme_mod('product_affiliate_logo_max_height');

  	if(get_theme_mod('product_affiliate_logo_max_height') == '') {
		$product_affiliate_logo_max_height = '24';
	}

	if(get_theme_mod('product_affiliate_preloader_bg_color') == '') {
		$product_affiliate_preloader_bg_color = '#6260E9';
	}
	if(get_theme_mod('product_affiliate_preloader_dot_1_color') == '') {
		$product_affiliate_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('product_affiliate_preloader_dot_2_color') == '') {
		$product_affiliate_preloader_dot_2_color = '#2ECD6E';
	}
	$product_affiliate_theme_color_css = '
		.custom-logo-link img{
			max-height: '.esc_attr($product_affiliate_logo_max_height).'px;
	 	}
		.loading{
			background-color: '.esc_attr($product_affiliate_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($product_affiliate_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($product_affiliate_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'product-affiliate-style',$product_affiliate_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'product_affiliate_preloader' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_parent_theme_file_path('custom-filter.php' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/* TGM. */
require get_parent_theme_file_path( '/inc/tgm.php' );

/*dropdown page sanitization*/
function product_affiliate_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * Get CSS
 */

function product_affiliate_getpage_css($hook) {
	wp_enqueue_script( 'product-affiliate-admin-script', get_template_directory_uri() . '/inc/admin/js/product-affiliate-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'product-affiliate-admin-script', 'product_affiliate_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_product-affiliate-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'product-affiliate-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'product_affiliate_getpage_css' );

if ( ! defined( 'PRODUCT_AFFILIATE_CONTACT_SUPPORT' ) ) {
define('PRODUCT_AFFILIATE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/product-affiliate/','product-affiliate'));
}
if ( ! defined( 'PRODUCT_AFFILIATE_REVIEW' ) ) {
define('PRODUCT_AFFILIATE_REVIEW',__('https://wordpress.org/support/theme/product-affiliate/reviews/','product-affiliate'));
}
if ( ! defined( 'PRODUCT_AFFILIATE_LIVE_DEMO' ) ) {
define('PRODUCT_AFFILIATE_LIVE_DEMO',__('https://www.themagnifico.net/demo/product-affiliate/','product-affiliate'));
}
if ( ! defined( 'PRODUCT_AFFILIATE_GET_PREMIUM_PRO' ) ) {
define('PRODUCT_AFFILIATE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/product-affiliate-wordpress-theme/','product-affiliate'));
}
if ( ! defined( 'PRODUCT_AFFILIATE_PRO_DOC' ) ) {
define('PRODUCT_AFFILIATE_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/product-affiliate-free-doc/','product-affiliate'));
}

add_action('admin_menu', 'product_affiliate_themepage');
function product_affiliate_themepage(){

	$product_affiliate_theme_test = wp_get_theme();

	$product_affiliate_theme_info = add_theme_page( __('Theme Options','product-affiliate'), __(' Theme Options','product-affiliate'), 'manage_options', 'product-affiliate-info.php', 'product_affiliate_info_page' );
}

function product_affiliate_info_page() {
	$product_affiliate_theme_user = wp_get_current_user();
	$product_affiliate_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap product-affiliate-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','product-affiliate'); ?><?php echo esc_html( $product_affiliate_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "product-affiliate"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Product Affiliate , feel free to contact us for any support regarding our theme.", "product-affiliate"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "product-affiliate"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "product-affiliate"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "product-affiliate"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "product-affiliate"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "product-affiliate"); ?></h3>
						<p><?php esc_html_e("If You love Product Affiliate theme then we would appreciate your review about our theme.", "product-affiliate"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "product-affiliate"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","product-affiliate"); ?></h2>
		<div class="product-affiliate-button-container">
			<a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "product-affiliate"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "product-affiliate"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "product-affiliate"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "product-affiliate"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "product-affiliate"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "product-affiliate"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "product-affiliate"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "product-affiliate"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "product-affiliate"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="product-affiliate-button-container">
			<a target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "product-affiliate"); ?>
			</a>
		</div>
	</div>
	<?php
}

function product_affiliate_deprecated_hook_admin_notice() {

    $dismissed = get_user_meta(get_current_user_id(), 'product_affiliate_dismissable_notice', true);
    if ( !$dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'product-affiliate'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'product-affiliate'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=product-affiliate-info.php' )); ?>"><?php esc_html_e( 'Get started', 'product-affiliate' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_PRO_DOC ); ?>"><?php esc_html_e( 'Documentation', 'product-affiliate' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( PRODUCT_AFFILIATE_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'product-affiliate' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'product_affiliate_deprecated_hook_admin_notice' );

function product_affiliate_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

function product_affiliate_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/*radio button sanitization*/
function product_affiliate_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function product_affiliate_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function product_affiliate_switch_theme() {
    delete_user_meta(get_current_user_id(), 'product_affiliate_dismissable_notice');
}
add_action('after_switch_theme', 'product_affiliate_switch_theme');
function product_affiliate_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'product_affiliate_dismissable_notice', true);
    die();
}

add_filter( 'woocommerce_get_price_html', 'product_affiliate_change_displayed_sale_price_html', 10, 2 );
function product_affiliate_change_displayed_sale_price_html( $price, $product ) {
    // Only on sale products on frontend and excluding min/max price on variable products
    if( $product->is_on_sale() && ! is_admin() && ! $product->is_type('variable')){
        // Get product prices
        $regular_price = (float) $product->get_regular_price(); // Regular price
        $sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

        // "Saving Percentage" calculation and formatting
        $precision = 1; // Max number of decimals
        $saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%';

        // Append to the formated html price
        $price .= sprintf( __('<span class="saved-sale">( -%s)</span>', 'product-affiliate' ), $saving_percentage );
    }
    return $price;
}

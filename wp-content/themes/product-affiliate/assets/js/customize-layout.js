/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

	/*
	** Reusable Functions
	*/
		var optPrefix = '#customize-control-product_affiliate_options-';
		
		// Label
		function product_affiliate_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'product_affiliate_scroll_hide' || id === 'product_affiliate_preloader_hide')  {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Colors

			if ( id === 'product_affiliate_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header

			if ( id === 'product_affiliate_topbar1_wishlist_url' || id === 'product_affiliate_topbar_phone_number' || id === 'product_affiliate_topbar_email_id' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'product_affiliate_top_slider_page1' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Product

			if ( id === 'product_affiliate_search_product_name'  ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'product_affiliate_footer_text_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-product_affiliate_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}


	/*
	** Tabs
	*/

	    // Site Identity
		product_affiliate_customizer_label( 'custom_logo', 'Logo Setup' );
		product_affiliate_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		product_affiliate_customizer_label( 'product_affiliate_preloader_hide', 'Preloader' );
		product_affiliate_customizer_label( 'product_affiliate_scroll_hide', 'Scroll To Top' );

		// Colors
		product_affiliate_customizer_label( 'product_affiliate_theme_color', 'Theme Color' );
		product_affiliate_customizer_label( 'background_color', 'Colors' );
		product_affiliate_customizer_label( 'background_image', 'Image' );

		//Header Image
		product_affiliate_customizer_label( 'header_image', 'Header Image' );

		// Social Icon 
		product_affiliate_customizer_label( 'product_affiliate_facebook_icon', 'Facebook' );
		product_affiliate_customizer_label( 'product_affiliate_twitter_icon', 'Twitter' );
		product_affiliate_customizer_label( 'product_affiliate_intagram_icon', 'Intagram' );
		product_affiliate_customizer_label( 'product_affiliate_linkedin_icon', 'Linkedin' );
		product_affiliate_customizer_label( 'product_affiliate_pintrest_icon', 'Pinterest' );

		// Header
		product_affiliate_customizer_label( 'product_affiliate_topbar1_wishlist_url', 'Header Wishlist' );
		product_affiliate_customizer_label( 'product_affiliate_topbar_phone_number', 'Phone Number' );
		product_affiliate_customizer_label( 'product_affiliate_topbar_email_id', 'Email' );

		//Slider
		product_affiliate_customizer_label( 'product_affiliate_top_slider_page1', 'Slider' );
		
		// Product
		product_affiliate_customizer_label( 'product_affiliate_search_product_name', 'Product' );

		//Footer
		product_affiliate_customizer_label( 'product_affiliate_footer_text_setting', 'Footer' );
	

	}); // wp.customize ready

})( jQuery );

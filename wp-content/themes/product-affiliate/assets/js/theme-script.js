function product_affiliate_best_seller_wrap_owl_carousel(){

  var owl = jQuery('#advance-product  .row .owl-carousel');
  owl.owlCarousel({
    margin: 20,
    nav:false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: false,
    autoplayHoverPause:true,
    navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      500: {
        items: 2
      },
      600: {
        items: 2
      },
      767: {
        items: 3
      },
      1000: {
        items: 3
      },
      1100: {
        items: 4
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
}
// filter end //
function product_affiliate_openNav() {
  jQuery(".sidenav").addClass('show');
}
function product_affiliate_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function product_affiliate_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const product_affiliate_nav = document.querySelector( '.sidenav' );

      if ( ! product_affiliate_nav || ! product_affiliate_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...product_affiliate_nav.querySelectorAll( 'input, a, button' )],
        product_affiliate_lastEl = elements[ elements.length - 1 ],
        product_affiliate_firstEl = elements[0],
        product_affiliate_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && product_affiliate_lastEl === product_affiliate_activeEl ) {
        e.preventDefault();
        product_affiliate_firstEl.focus();
      }

      if ( shiftKey && tabKey && product_affiliate_firstEl === product_affiliate_activeEl ) {
        e.preventDefault();
        product_affiliate_lastEl.focus();
      }
    } );
  }
  product_affiliate_keepFocusInMenu();
} )( window, document );

var product_affiliate_btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    product_affiliate_btn.addClass('show');
  } else {
    product_affiliate_btn.removeClass('show');
  }
});

product_affiliate_btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  
    var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: true,
    navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });

    product_affiliate_best_seller_wrap_owl_carousel();

})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});

var product_affiliate_btn_1 = document.querySelector('.toggle');
var btnst = true;

if(product_affiliate_btn_1) {
  product_affiliate_btn_1.onclick = function() {
    if(btnst == true) {
      document.querySelector('.toggle span').classList.add('toggle');
      document.getElementById('slidebar').classList.add('slidebarshow');
      btnst = false;
    }else if(btnst == false) {
      document.querySelector('.toggle span').classList.remove('toggle');
      document.getElementById('slidebar').classList.remove('slidebarshow');
      btnst = true;
    }
  }
}


// filter start //
jQuery(document).ready(function() {
  jQuery( '#apply-button' ).on( 'click', function() {
  const minPrice = document.getElementById('min-price').value;
  const maxPrice = document.getElementById('max-price').value;
  const selectedRating = document.getElementById('rating').value;
  const textValue = document.getElementById('product-search-text-field').value;
  data_obj = {
    minPrice : minPrice,
    maxPrice : maxPrice,
    selectedRating : selectedRating,
    textValue : textValue
  }

  // console.log(data_obj, 'data_obt');
  jQuery.post(tm_customscripts_object.ajaxurl, {
    'action': 'product_affiliate_get_shop_page_filter',
    'data':   data_obj
  },
  function(response) {
    // jQuery('#advance-product  .row .owl-carousel').html(response.html)
    jQuery('#advance-product  .row .owl-carousel').remove();
    jQuery('#advance-product .container .row').append(`
      <div class="owl-carousel">`+ response.html +`</div>
    `);
    product_affiliate_best_seller_wrap_owl_carousel();
  });
});
});
// filter end //


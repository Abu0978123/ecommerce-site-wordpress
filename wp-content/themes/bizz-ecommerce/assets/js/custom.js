(function ($) {
  "use strict";

  var $main_window = $(window);

/*====================================
        preloader js
======================================*/

  $main_window.on("load", function () {
    $(".preloader").delay(1000).fadeOut(500);
  });

/*========================
      Home Slider 
=========================*/ 

    $('.home-slider').owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        autoplay: true,
        smartSpeed: 1000,
        nav: true,
        navText: [
          '<i class="fa fa-long-arrow-left"></i>',
          '<i class="fa fa-long-arrow-right"></i>'
        ]
    });

/*====================================
  scroll to top js
======================================*/

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 250) {
      $("#c-scroll").fadeIn(200);
    } else {
      $("#c-scroll").fadeOut(200);
    }
  });
  
  $("#c-scroll").on("click", function () {
    $("html, body").animate({
        scrollTop: 0
      },
      "slow"
    );
    return false;
  });

/*====================================
     tooltip js
======================================*/

  $('[data-toggle="tooltip"]').tooltip(); 

/*====================================
     sticky menu js
======================================*/

  $main_window.on('scroll', function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
      $(".affix").addClass("sticky-menu");
    } else {
      $(".affix").removeClass("sticky-menu");
    }
  });
  
$('.skip-link-search-skip').focus(function(){
    $('.skip-link-search-back-skip').focus();
});
  
   // offcanvas menu
$(".menu-tigger").on("click", function () {
  $(".offcanvas-menu,.offcanvas-overly").addClass("active");
  return false;
});
$(".menu-close,.offcanvas-overly").on("click", function () {
  $(".offcanvas-menu,.offcanvas-overly").removeClass("active");
});


/*====================================
        toggle search
======================================*/

  $('.menu-search a').on("click", function () {
    $('.menu-search-form').toggleClass('s-active');
  });

 /*========================================
        Accordin Active
  ==========================================*/

    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    



/*====================================
      navigation mobile menu
======================================*/

  function mainmenu() {
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');

      return false;
    });
  }
  mainmenu();

/*================================================
             Wow js
=================================================*/

              new WOW().init();

/*=============================================
              product quantity              
=============================================*/

    $('.add').on('click', function () {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.sub').on('click', function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

/*=====  End of product quantity  ======*/

/*================================================
           Product slider
=================================================*/

  $('.product-slider').owlCarousel({
    loop:true,
    margin:20,
    dots:false,
    nav:false,
    responsiveClass:true,
    smartSpeed:1200,
    autoplay:true,
    responsive:{
        0:{
            items:1,  
        },
        600:{
            items:3,
        },
        1000:{
            items:5,
        }
    }
})
             
/*================================================
              Start product quick-view
=================================================*/

$(function () {
    'use strict';
    $(".quick-view-slider").owlCarousel({
        dots:false,
        items:1,
        nav:false,
        loop: true,
        autoplay: true,
        smartSpeed:1200,
        responsiveClass:true,
    });
});

/*==========================================
                Select 2             
=============================================*/

    $(".select2").select2({
        tags: true
    });    

/*====================  
  End of select2  
  =================*/

  
/*=============================================
     Checkout Account Form Toggle    
=============================================*/
    
    $('#account').on('click', function () {
      if ($('#account:checked').length > 0) {
        $('.checkout-account').slideDown();
      } else {
        $('.checkout-account').slideUp();
      }
    });
      
/*=====  End of Shipping Form Toggle  ======*/

/*-------------------
        Range Slider
    --------------------- */
    var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
        minamount.val('$' + ui.values[0]);
        maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));


/*=============================================
       Checkout Shipping Form Toggle         
=============================================*/
    
    $('#shipping').on('click', function () {
      if ($('#shipping:checked').length > 0) {
        $('.checkout-shipping').slideDown();
      } else {
        $('.checkout-shipping').slideUp();
      }
    });
    
/*=====  End of Shipping Form Toggle  ======*/


/*=============================================
        Payment Method Select         
=============================================*/

    var checked = $('.payment-radio input:checked')
    if (checked) {
        $(checked).siblings('.payment-details').slideDown(500);
    };
    $('.payment-radio input').on('change', function() {
        $('.payment-details').slideUp(500);
        $(this).siblings('.payment-details').slideToggle(500);
    });

/*=====  End of Payment  Method Select ======*/

})(jQuery);
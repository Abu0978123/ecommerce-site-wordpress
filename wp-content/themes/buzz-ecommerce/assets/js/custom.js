
// Owl Carousel
jQuery('.ecommerce-slider').owlCarousel({
    items : 1,
    itemsCustom : false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    },
    loop:true,
    margin:0,
    dots : false,
    nav: true,
    navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    autoplay : true,
});

/**
 * 
 * jquery all settings hear
 */
jQuery(document).ready(function ($) {

    // Menu resposnvie
    jQuery('#primary-menu li.menu-item-has-children').click(function(){
        $(this).toggleClass('child-active');

    });

    // Cart Section
    jQuery('div.header-cart div#cart_new').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().toggleClass('header-cart-show');

    });


    /**
     * Sticky Menu Options
     */
    // header-sticky
    $(window).scroll(function(){
        var scrollTop = $(window).scrollTop();

        if (scrollTop > 240) {
            $('.head-top').addClass('hidden');
            $('.main-navigation').addClass('nav-sticky');
            $('.main-navigation').addClass('fadeInDown');
            $('.main-navigation').addClass('animated');
        } else {
            $('.main-navigation').removeClass('fadeInDown');
            $('.main-navigation').removeClass('nav-sticky');
            $('.head-top').removeClass('hidden');
            
        }
    });

    /**
     * Sub Category section
     */
    jQuery( ".buzz-ecommerce-sub-cate" ).click(function() {
        jQuery( ".buzz-ecommerce-sub-cate " ).toggleClass( "buzz-ecommerce-rotate1" );
        jQuery( ".buzz-ecommerce-sub-category-sec " ).toggleClass( "show" );
    });

    /**
	 * Buzz eCommerce jquery match height section
     * 
	 * @since 1.0.0
     * @description Call the match height section.
	 */
    jQuery('body.page ul.products li.product').matchHeight();
    jQuery('body.single-product ul.products li.product').matchHeight();
    jQuery('section#products_upsell_options li.product').matchHeight();
    jQuery('section#products_tab_section li.product').matchHeight();

    /**
     * Tab section hear
     */
    jQuery('ul.tabs li').click(function(){
        var parent = jQuery(this).parents(".product");
        var tab_id = jQuery(this).attr('data-tab');

        parent.find('ul.tabs li').removeClass('current');
        parent.find('.tab-content').removeClass('current');

        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
      })


});
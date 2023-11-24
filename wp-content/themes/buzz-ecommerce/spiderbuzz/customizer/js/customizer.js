/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

    jQuery(document).ready( function () {
        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            if ( placement.partial.id === 'buzz_ecommerce_main_slider' ) {
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
            }
        });
    });

    wp.customize( 'buzz_ecommerce_slider_category_list_header_text', function ( value ) {
        value.bind( function ( newVal ) {
            $( '#frontpage_slider_section .title #buzz_ecommerce_slider_category_list_header_text' ).text( newVal );
        });
    });

    wp.customize( 'slider_button_text_change', function ( value ) {
        value.bind( function ( newVal ) {
            $( '#frontpage_slider_section .sidebar-slider .owl-item .item-text a' ).text( newVal );
        });
    });

    wp.customize( 'products_tabs_title', function ( value ) {
        value.bind( function ( newVal ) {
            $( '#products_tab_section h4#products_tabs_title' ).text( newVal );
        });
    });

    wp.customize( 'buzz_commerce_products_tab_background_images', function ( value ) {
        value.bind( function ( newVal ) {
            var background_image = "url('" + newVal + "')"; 
            $( '#products_tab_section' ).removeAttr( 'style' );
            $( '#products_tab_section' ).css( 'background-image', background_image );
        });
    });

    wp.customize( 'onsell_products_title', function ( value ) {
        value.bind( function ( newVal ) {
            $( '#products_upsell_options h4#onsale_products_title' ).text( newVal );
        });
    });

} )( jQuery );
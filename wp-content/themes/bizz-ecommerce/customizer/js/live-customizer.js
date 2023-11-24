/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ){
/**
 * Dynamic Internal/Embedded Style for a Control
 */
function bizz_ecommerce_add_dynamic_css( control, style ){
      control = control.replace( '[', '-' );
      control = control.replace( ']', '' );
      jQuery( 'style#' + control ).remove();

      jQuery( 'head' ).append(
            '<style id="' + control + '">' + style + '</style>'
      );
}
/**
 * Responsive Spacing CSS
 */
function bizz_ecommerce_responsive_spacing( control, selector, type, side ){
	wp.customize( control, function( value ){
		value.bind( function( value ){
			var sidesString = "";
			var spacingType = "padding";
			if ( value.desktop.top || value.desktop.right || value.desktop.bottom || value.desktop.left || value.tablet.top || value.tablet.right || value.tablet.bottom || value.tablet.left || value.mobile.top || value.mobile.right || value.mobile.bottom || value.mobile.left ) {
				if ( typeof side != undefined ) {
					sidesString = side + "";
					sidesString = sidesString.replace(/,/g , "-");
				}
				if ( typeof type != undefined ) {
					spacingType = type + "";
				}
				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control + '-' + spacingType + '-' + sidesString ).remove();

				var desktopPadding = '',
					tabletPadding = '',
					mobilePadding = '';

				var paddingSide = ( typeof side != undefined ) ? side : [ 'top','bottom','right','left' ];

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['desktop'][sideValue] ) {
						desktopPadding += spacingType + '-' + sideValue +': ' + value['desktop'][sideValue] + value['desktop-unit'] +';';
					}
				});

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['tablet'][sideValue] ) {
						tabletPadding += spacingType + '-' + sideValue +': ' + value['tablet'][sideValue] + value['tablet-unit'] +';';
					}
				});

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['mobile'][sideValue] ) {
						mobilePadding += spacingType + '-' + sideValue +': ' + value['mobile'][sideValue] + value['mobile-unit'] +';';
					}
				});

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + spacingType + '-' + sidesString + '">'
					+ selector + '	{ ' + desktopPadding +' }'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + tabletPadding + ' } }'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + mobilePadding + ' } }'
					+ '</style>'
				);

			} else {
				wp.customize.preview.send( 'refresh' );
				jQuery( 'style#' + control + '-' + spacingType + '-' + sidesString ).remove();
			}

		} );
	} );
}
/**
 * Apply CSS for the element
 */
function bizz_ecommerce_css( control, css_property, selector, unit ){

	wp.customize( control, function( value ) {
		value.bind( function( new_value ) {

			// Remove <style> first!
			control = control.replace( '[', '-' );
			control = control.replace( ']', '' );

			if ( new_value ){
				/**
				 *	If ( unit == 'url' ) then = url('{VALUE}')
				 *	If ( unit == 'px' ) then = {VALUE}px
				 *	If ( unit == 'em' ) then = {VALUE}em
				 *	If ( unit == 'rem' ) then = {VALUE}rem.
				 */
				if ( 'undefined' != typeof unit) {
					if ( 'url' === unit ) {
						new_value = 'url(' + new_value + ')';
					} else {
						new_value = new_value + unit;
					}
				}

				// Remove old.
				jQuery( 'style#' + control ).remove();

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '">'
					+ selector + '	{ ' + css_property + ': ' + new_value + ' }'
					+ '</style>'
				);

			} else {

				wp.customize.preview.send( 'refresh' );

				// Remove old.
				jQuery( 'style#' + control ).remove();
			}

		} );
	} );
}
/*******************************/
// Range slider live customizer
/*******************************/
function bizzEcommerceGetCss( arraySizes, settings, to ) {
    'use strict';
    var data, desktopVal, tabletVal, mobileVal,
        className = settings.styleClass, i = 1;

    var val = JSON.parse( to );
    if ( typeof( val ) === 'object' && val !== null ) {
        if ('desktop' in val) {
            desktopVal = val.desktop;
        }
        if ('tablet' in val) {
            tabletVal = val.tablet;
        }
        if ('mobile' in val) {
            mobileVal = val.mobile;
        }
    }

    for ( var key in arraySizes ) {
        // skip loop if the property is from prototype
        if ( ! arraySizes.hasOwnProperty( key )) {
            continue;
        }
        var obj = arraySizes[key];
        var limit = 0;
        var correlation = [1,1,1];
        if ( typeof( val ) === 'object' && val !== null ) {

            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }

            data = {
                desktop: ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0]) > limit ? ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0] ) : limit,
                tablet: ( parseInt(parseFloat( tabletVal ) / correlation[1]) + obj.values[1] ) > limit ? ( parseInt(parseFloat( tabletVal ) / correlation[1]) + obj.values[1] ) : limit,
                mobile: ( parseInt(parseFloat( mobileVal ) / correlation[2]) + obj.values[2] ) > limit ? ( parseInt(parseFloat( mobileVal ) / correlation[2]) + obj.values[2] ) : limit
            };
        } else {
            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }
            data =( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] > limit ? ( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] : limit;
        }
        settings.styleClass = className + '-' + i;
        settings.selectors  = obj.selectors;

        bizzEcommerceSetCss( settings, data );
        i++;
    }
}
function bizzEcommerceSetCss( settings, to ){
    'use strict';
    var result     = '';
    var styleClass = jQuery( '.' + settings.styleClass );
    if ( to !== null && typeof to === 'object' ){
        jQuery.each(
            to, function ( key, value ) {
                var style_to_add;
                if ( settings.selectors === '.container' ){
                    style_to_add = settings.selectors + '{ ' + settings.cssProperty + ':' + value + settings.propertyUnit + '; max-width: 100%; }';
                } else {
                    style_to_add = settings.selectors + '{ ' + settings.cssProperty + ':' + value + settings.propertyUnit + '}';
                }
                switch ( key ) {
                    case 'desktop':
                        result += style_to_add;
                        break;
                    case 'tablet':
                        result += '@media (max-width: 767px){' + style_to_add + '}';
                        break;
                    case 'mobile':
                        result += '@media (max-width: 544px){' + style_to_add + '}';
                        break;
                }
            }
        );
        if ( styleClass.length > 0 ) {
            styleClass.text( result );
        } else {
            jQuery( 'head' ).append( '<style type="text/css" class="' + settings.styleClass + '">' + result + '</style>' );
        }
    } else {
        jQuery( settings.selectors ).css( settings.cssProperty, to + 'px' );
    }
}
//*****************************/
// Logo
//*****************************/
wp.customize(
    'bizz_ecommerce_logo_width', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'max-width',
                    propertyUnit: 'px',
                    styleClass: 'open-logo-width'
                };

                var arraySizes = {
                    size3: { selectors:'.texture-logo img,.sticky-header .logo-content img', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
//top header
wp.customize('bizz_ecommerce_col1_texthtml', function(value){
         value.bind(function(to){
             $('.top-header-col1 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_col2_texthtml', function(value){
         value.bind(function(to) {
             $('.top-header-col2 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_col3_texthtml', function(value){
         value.bind(function(to) {
             $('.top-header-col3 .content-html').text(to);
         });
     });
bizz_ecommerce_css( 'bizz_ecommerce_above_brdr_clr','border-bottom-color', '.top-header,body.bizz-ecommerce-dark .top-header');
wp.customize(
    'bizz_ecommerce_abv_hdr_hgt', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'line-height',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.top-header .top-header-bar', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
wp.customize(
    'bizz_ecommerce_abv_hdr_botm_brd', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'border-bottom-width',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.top-header', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
/***************/
// MAIN HEADER
/***************/
wp.customize('bizz_ecommerce_main_hdr_btn_txt', function(value){
         value.bind(function(to){
             $('.btn-main-header').text(to);
         });
});
wp.customize('bizz_ecommerce_main_hdr_calto_txt', function(value){
         value.bind(function(to){
             $('.sprt-tel b').text(to);
         });
});
wp.customize('bizz_ecommerce_main_hdr_calto_nub', function(value){
         value.bind(function(to){
             $('.sprt-tel a').text(to);
         });
});
wp.customize('bizz_ecommerce_main_hdr_calto_nub', function(value){
         value.bind(function(to){
             $('.sprt-tel a').text(to);
         });
});

wp.customize('bizz_ecommerce_main_hdr_cat_txt', function(value){
         value.bind(function(to){
             $('.toggle-cat-wrap .toggle-title').text(to);
         });
});
//cat slider heading
wp.customize('bizz_ecommerce_cat_slider_heading', function(value){
         value.bind(function(to) {
             $('.texture-category-slide-section .texture-title .title').text(to);
         });
     });
//product slide
wp.customize('bizz_ecommerce_product_slider_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-slide-section .texture-title .title').text(to);
         });
     });
//product list
wp.customize('bizz_ecommerce_product_list_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-list-section .texture-title .title').text(to);
         });
     });
//product cat tab 
wp.customize('bizz_ecommerce_cat_tab_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-tab-section .texture-title .title').text(to);
         });
     });
//product cat tab list
wp.customize('bizz_ecommerce_list_cat_tab_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-tab-list-section .texture-title .title').text(to);
         });
     });
//Highlight 
wp.customize('bizz_ecommerce_hglgt_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-highlight-section .texture-title .title').text(to);
         });
     });
//Big Featured
wp.customize('bizz_ecommerce_product_img_sec_heading', function(value){
         value.bind(function(to) {
             $('.texture-product-image-tab-section .texture-title .title').text(to);
         });
     });
//Ribbon Text
wp.customize('bizz_ecommerce_ribbon_text', function(value){
         value.bind(function(to) {
             $('.texture-ribbon-content h3').text(to);
         });
     });
wp.customize('bizz_ecommerce_ribbon_btn_text', function(value){
         value.bind(function(to) {
             $('.texture-ribbon-content a.ribbon-btn').text(to);
         });
     });
//Custom section One
wp.customize('bizz_ecommerce_custom_1_heading', function(value){
         value.bind(function(to) {
             $('.texture-custom-one-section .texture-title .title').text(to);
         });
     });
//Custom section two
wp.customize('bizz_ecommerce_custom_2_heading', function(value){
         value.bind(function(to) {
             $('.texture-custom-two-section .texture-title .title').text(to);
         });
     });
//Custom section three
wp.customize('bizz_ecommerce_custom_3_heading', function(value){
         value.bind(function(to) {
             $('.texture-custom-three-section .texture-title .title').text(to);
         });
     });
//Custom section four
wp.customize('bizz_ecommerce_custom_4_heading', function(value){
         value.bind(function(to){
             $('.texture-custom-four-section .texture-title .title').text(to);
         });
     });
// slider
wp.customize('bizz_ecommerce_lay3_heading_txt', function(value){
         value.bind(function(to){
             $('.slider-cat-title a').text(to);
         });
     });

// blog
wp.customize('bizz_ecommerce_blog_read_more_txt', function(value){
         value.bind(function(to){
             $('a.texture-readmore.button ').text(to);
         });
     });
/****************/
// footer
/****************/
wp.customize('bizz_ecommerce_footer_col1_texthtml', function(value){
         value.bind(function(to) {
             $('.top-footer-col1 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_above_footer_col2_texthtml', function(value){
         value.bind(function(to) {
             $('.top-footer-col2 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_above_footer_col3_texthtml', function(value){
         value.bind(function(to) {
             $('.top-footer-col3 .content-html').text(to);
         });
     });
bizz_ecommerce_css( 'bizz_ecommerce_above_frt_brdr_clr','border-bottom-color', 'body.bizz-ecommerce-dark .top-footer,.top-footer');
wp.customize(
    'bizz_ecommerce_above_ftr_hgt', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'line-height',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.top-footer .top-footer-bar', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
wp.customize(
    'bizz_ecommerce_abv_ftr_botm_brd', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'border-bottom-width',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.top-footer', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);

 wp.customize('bizz_ecommerce_footer_bottom_col1_texthtml', function(value){
         value.bind(function(to) {
             $('.below-footer-col1 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_bottom_footer_col2_texthtml', function(value){
         value.bind(function(to) {
             $('.below-footer-col2 .content-html').text(to);
         });
     });
 wp.customize('bizz_ecommerce_bottom_footer_col3_texthtml', function(value){
         value.bind(function(to) {
             $('.below-footer-col3 .content-html').text(to);
         });
     });
bizz_ecommerce_css( 'bizz_ecommerce_bottom_frt_brdr_clr','border-top-color', '.below-footer,body.bizz-ecommerce-dark .below-footer');
wp.customize(
    'bizz_ecommerce_btm_ftr_hgt', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'line-height',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.below-footer .below-footer-bar', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
wp.customize(
    'bizz_ecommerce_btm_ftr_botm_brd', function (value){
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'border-top-width',
                    propertyUnit: 'px',
                    styleClass: ''
                };

                var arraySizes = {
                    size3: { selectors:'.below-footer', values: ['','',''] }
                };
                bizzEcommerceGetCss( arraySizes, settings, to );
            }
        );
    }
);
// loader
bizz_ecommerce_css( 'bizz_ecommerce_loader_bg_clr','background-color','.bizz_ecommerce_overlayloader');
//*****************************/
// Global Color Custom Style
//*****************************/
wp.customize( 'bizz_ecommerce_theme_clr', function( setting ){
        setting.bind( function( cssval ){
                var dynamicStyle = '';
                 dynamicStyle += 'a:hover, .bizz-ecommerce-menu li a:hover, .bizz-ecommerce-menu .current-menu-item a,.summary .yith-wcwl-add-to-wishlist.show .add_to_wishlist::before, .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a::before, .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a::before,.woocommerce .entry-summary a.compare.button.added:before,.header-icon a:hover,.texture-related-links .nav-links a:hover,.woocommerce .texture-list-view ul.products li.product.texture-woo-product-list .price,.woocommerce .woocommerce-error .button, .woocommerce .woocommerce-info .button, .woocommerce .woocommerce-message .button,article.texture-post-article .texture-readmore.button,.texture-wishlist a:hover, .texture-compare a:hover,.woocommerce .texture-product-hover a.th-button,.woocommerce ul.cart_list li .woocommerce-Price-amount, .woocommerce ul.product_list_widget li .woocommerce-Price-amount,.bizz-ecommerce-load-more button,.page-contact .leadform-show-form label,.texture-contact-col .fa,.summary .yith-wcwl-wishlistaddedbrowse a, .summary .yith-wcwl-wishlistexistsbrowse a,.texture-title .title:before,.texture-hglt-icon,.woocommerce .texture-product-content .star-rating,.texture-product-cat-list.slider a:hover, .texture-product-cat-list li a:hover,.site-title span a:hover,.header-support-icon a:hover span,.cart-icon a span:hover,.header-support-content i,.slider-cat-title a:before{ color: ' + cssval + '} ';
                 dynamicStyle += '.single_add_to_cart_button.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce button.button, .woocommerce input.button,.cat-list a:after,.tagcloud a:hover, .texture-tags-wrapper a:hover,.ribbon-btn,.btn-main-header,.page-contact .leadform-show-form input[type="submit"],.woocommerce .widget_price_filter .bizz-ecommerce-widget-content .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .bizz-ecommerce-widget-content .ui-slider .ui-slider-handle,.entry-content form.post-password-form input[type="submit"],#bizzecommerce-mobile-bar a,#bizzecommerce-mobile-bar,.post-slide-widget .owl-carousel .owl-nav button:hover,.woocommerce div.product form.cart .button,#search-button,#search-button:hover,.cart-contents .count-item, .woocommerce ul.products li.product .button,.slide-layout-1 .slider-content-caption a.slide-btn,.slider-content-caption a.slide-btn,.page-template-frontpage .owl-carousel button.owl-dot, .woocommerce #alm-quick-view-modal .alm-qv-image-slider .flex-control-paging li a,.button.return.wc-backward,.button.return.wc-backward:hover,.woocommerce .texture-product-hover a.add_to_cart_button:hover,.woocommerce .texture-product-hover .texture-wishlist a.add_to_wishlist:hover,.texture-wishlist .yith-wcwl-wishlistaddedbrowse:hover,.texture-wishlist .yith-wcwl-wishlistexistsbrowse:hover,.texture-quickview a:hover, .texture-compare .compare-button a.compare.button:hover,.texture-woo-product-list .texture-quickview a:hover,.texture-heading-wrap:before{ background: ' + cssval + '} ';
                 dynamicStyle += '.open-cart p.buttons a:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.texture-slide .owl-nav button.owl-prev:hover, .texture-slide .owl-nav button.owl-next:hover, .bizz-ecommerce-slide-post .owl-nav button.owl-prev:hover, .bizz-ecommerce-slide-post .owl-nav button.owl-next:hover,.texture-list-grid-switcher a.selected, .texture-list-grid-switcher a:hover,.woocommerce .woocommerce-error .button:hover, .woocommerce .woocommerce-info .button:hover, .woocommerce .woocommerce-message .button:hover,#searchform [type="submit"]:hover,article.texture-post-article .texture-readmore.button:hover,.bizz-ecommerce-load-more button:hover,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.texture-top2-slide.owl-carousel .owl-nav button:hover,.product-slide-widget .owl-carousel .owl-nav button:hover, .texture-slide.texture-brand .owl-nav button:hover,.woocommerce .texture-product-image-cat-slide .texture-woo-product-list:hover .texture-product{border-color: ' + cssval + '} ';
                bizz_ecommerce_add_dynamic_css( 'bizz_ecommerce_theme_clr', dynamicStyle );

        } );
    } );

bizz_ecommerce_css( 'bizz_ecommerce_text_clr','color','body,.woocommerce-error, .woocommerce-info, .woocommerce-message');
bizz_ecommerce_css( 'bizz_ecommerce_title_clr','color','.site-title span a,.sprt-tel b,.widget.woocommerce .widget-title, .open-widget-content .widget-title, .widget-title,.texture-title .title,.texture-hglt-box h6,h2.texture-post-title a, h1.texture-post-title ,#reply-title,h4.author-header,.page-head h1,.woocommerce div.product .product_title, section.related.products h2, section.upsells.products h2, .woocommerce #reviews #comments h2,.woocommerce table.shop_table thead th, .cart-subtotal, .order-total,.cross-sells h2, .cart_totals h2,.woocommerce-billing-fields h3,.page-head h1 a');
bizz_ecommerce_css( 'bizz_ecommerce_link_clr','color','a,#open-above-menu.bizz-ecommerce-menu > li > a');
bizz_ecommerce_css( 'bizz_ecommerce_link_hvr_clr','color','a:hover,#open-above-menu.bizz-ecommerce-menu > li > a:hover,#open-above-menu.bizz-ecommerce-menu li a:hover');

//Above Header
bizz_ecommerce_css( 'bizz_ecommerce_above_hd_bg_clr','background', '.top-header:before,body.bizz-ecommerce-dark .top-header:before');
// above header bg image
wp.customize('header_image', function (value){
    value.bind(function (to){
        $('.top-header').css('background-image', 'url( '+ to +')');
    });
});
// above header content
bizz_ecommerce_css( 'bizz_ecommerce_abv_content_txt_clr','color', '.top-header .top-header-bar,body.bizz-ecommerce-dark .top-header .top-header-bar');
bizz_ecommerce_css( 'bizz_ecommerce_abv_content_link_clr','color', '.top-header .top-header-bar a,body.bizz-ecommerce-dark .top-header .top-header-bar a');
bizz_ecommerce_css( 'bizz_ecommerce_abv_content_link_hvr_clr','color', '.top-header .top-header-bar a:hover,body.bizz-ecommerce-dark .top-header .top-header-bar a:hover');
// main header
bizz_ecommerce_css( 'bizz_ecommerce_main_hd_bg_clr','background', '.main-header:before,.sticky-header:before, .search-wrapper:before');
bizz_ecommerce_css( 'bizz_ecommerce_main_content_txt_clr','color', '.site-description,main-header-col1,.header-support-content,.mhdrthree .site-description p');
bizz_ecommerce_css( 'bizz_ecommerce_main_content_link_clr','color', '.mhdrthree .site-title span a,.header-support-content a, .texture-icon .count-item,.main-header a,.texture-icon .cart-icon a.cart-contents,.sticky-header .site-title a');
//Below Header Color Option
bizz_ecommerce_css( 'bizz_ecommerce_below_hd_bg_clr','background', '.below-header:before');
bizz_ecommerce_css( 'bizz_ecommerce_category_text_clr','color', '.menu-category-list .toggle-title,.toggle-icon');
bizz_ecommerce_css( 'bizz_ecommerce_category_icon_clr','background', '.below-header .cat-icon span');
//header icon
bizz_ecommerce_css( 'bizz_ecommerce_sq_icon_bg_clr','background', '.header-icon a ,.header-support-icon a.whishlist ,.texture-icon .cart-icon a.cart-contents i,.cat-icon,.sticky-header .header-icon a , .sticky-header .texture-icon .cart-icon a.cart-contents,.responsive-main-header .header-support-icon a,.responsive-main-header .texture-icon .cart-icon a.cart-contents,.responsive-main-header .menu-toggle .menu-btn,.sticky-header-bar .menu-toggle .menu-btn,.header-icon a.account,.header-icon a.prd-search');
bizz_ecommerce_css( 'bizz_ecommerce_sq_icon_clr','color', '.header-icon a ,.header-support-icon a.whishlist ,.texture-icon .cart-icon a.cart-contents i,.cat-icon,.sticky-header .header-icon a , .sticky-header .texture-icon .cart-icon a.cart-contents,.responsive-main-header .header-support-icon a,.responsive-main-header .texture-icon .cart-icon a.cart-contents,.responsive-main-header .menu-toggle .menu-btn,.sticky-header-bar .menu-toggle .menu-btn,.header-icon a.account,.header-icon a.prd-search');
bizz_ecommerce_css( 'bizz_ecommerce_sq_icon_clr','background', '.cat-icon span');
//menu
bizz_ecommerce_css( 'bizz_ecommerce_menu_link_clr','color', '.bizz-ecommerce-menu > li > a,.menu-category-list .toggle-title,.toggle-icon');
bizz_ecommerce_css( 'bizz_ecommerce_menu_link_hvr_clr','color', '.bizz-ecommerce-menu > li > a:hover');
bizz_ecommerce_css( 'bizz_ecommerce_sub_menu_bg_clr','background-color', '.bizz-ecommerce-menu ul.sub-menu');
bizz_ecommerce_css( 'bizz_ecommerce_sub_menu_lnk_clr','color', '.bizz-ecommerce-menu li ul.sub-menu li a');
bizz_ecommerce_css( 'bizz_ecommerce_sub_menu_lnk_hvr_clr','color', '.bizz-ecommerce-menu li ul.sub-menu li a:hover');
//move to top
bizz_ecommerce_css( 'bizz_ecommerce_move_to_top_bg_clr','background', '#move-to-top');
bizz_ecommerce_css( 'bizz_ecommerce_move_to_top_icon_clr','color', '#move-to-top');

//Slider Bg
bizz_ecommerce_css('bizz_ecommerce_lay3_bg_img_ovrly','background', '.texture-slider-section.slide-layout-3:before');
wp.customize('bizz_ecommerce_lay3_bg_background_image_url', function (value){
value.bind(function (to){
    $('.texture-slider-section.slide-layout-3').css('background-image', 'url( '+ to +')');
    });
});
bizz_ecommerce_css( 'bizz_ecommerce_lay3_bg_background_repeat','background-repeat', '.texture-slider-section.slide-layout-3');
bizz_ecommerce_css( 'bizz_ecommerce_lay3_bg_header_background_position','background-position', '.texture-slider-section.slide-layout-3');
bizz_ecommerce_css( 'bizz_ecommerce_lay3_bg_header_background_size','background-size', '.texture-slider-section.slide-layout-3');
bizz_ecommerce_css( 'bizz_ecommerce_lay3_bg_header_background_attach','background-attachment', '.texture-slider-section.slide-layout-3');
})( jQuery );
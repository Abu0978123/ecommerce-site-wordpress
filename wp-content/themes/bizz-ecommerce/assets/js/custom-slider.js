/**************/
// BizzEcommerceLib
/**************/
(function ($) {
    var BizzEcommerceLib = {
        
        init: function (){
            this.bindEvents();
        },

        bindEvents: function (){
              
             var $this = this;

            // $this.Top2Slider();
             $this.TopFullSlide();
                
        },
     
        /*Top2Slider:function(){
          if(bizz_ecommerce.bizz_ecommerce_rtl==true){
          var bzecm_rtl = true;
         }else{
          var bzecm_rtl = false;
         }

                      var owl = $('.texture-top2-slide');
                           owl.owlCarousel({
                             rtl:bzecm_rtl,
                             items:1,
                             nav: true,
                             navText: ["<i class='brand-nav fa fa-angle-left'></i>",
                             "<i class='brand-nav fa fa-angle-right'></i>"],
                             loop:true,
                             dots: false,
                             smartSpeed:500,
                             autoHeight: false,
                             margin:0,
                             autoplay:bizz_ecommerce.bizz_ecommerce_top_slider_optn,
                             autoplayTimeout: parseInt(bizz_ecommerce.bizz_ecommerce_slider_speed),
                              autoplayHoverPause: true, // Stops autoplay
                             
                 });
                         // add animate.css class(es) to the elements to be animated
                        function setAnimation ( _elem, _InOut ) {
                          // Store all animationend event name in a string.
                          // cf animate.css documentation
                          var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

                          _elem.each ( function () {
                            var $elem = $(this);
                            var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

                            $elem.addClass($animationType).one(animationEndEvent, function () {
                              $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
                            });
                          });
                        }

                      // Fired before current slide change
                        owl.on('change.owl.carousel', function(event) {
                            var $currentItem = $('.owl-item', owl).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-out]");
                            setAnimation ($elemsToanim, 'out');
                        });

                      // Fired after current slide has been changed
                        var round = 0;
                        owl.on('changed.owl.carousel', function(event) {

                            var $currentItem = $('.owl-item', owl).eq(event.item.index);
                            var $elemsToanim = $currentItem.find("[data-animation-in]");
                          
                            setAnimation ($elemsToanim, 'in');
                        })
                        
                        owl.on('translated.owl.carousel', function(event) {
                          // console.log (event.item.index, event.page.count);
                          
                            if (event.item.index == (event.page.count - 1))  {
                              if (round < 1) {
                                round++
                                // console.log (round);
                              } else {
                                owl.trigger('stop.owl.autoplay');
                                var owlData = owl.data('owl.carousel');
                                owlData.settings.autoplay = false; //don't know if both are necessary
                                owlData.options.autoplay = false;
                                owl.trigger('refresh.owl.carousel');
                              }
                            }
                        });
                          
        },*/

           TopFullSlide:function(){
                

                /*if(bizz_ecommerce.bizz_ecommerce_rtl==true){
                  var bzecm_rtl = true;
                }else{
                  var bzecm_rtl = false;
                }

                if(bizz_ecommerce.bizz_ecommerce_top_slider_optn == true){
                var sld_atply_p = true;
                }else{
                var sld_atply_p = false; 
                }*/

                var bzecm_rtl = false;
                var sld_atply_p = true; 
                
                var owl = $('.texture-slider-full-slide');
                     owl.owlCarousel({
                       rtl:bzecm_rtl,
                       items:1,
                       nav: true,
                       loop: true,
                       dots: true,
                       smartSpeed: 1800,
                       autoHeight: false,
                       margin:0,
                       autoplay: sld_atply_p,
                       autoplayHoverPause: true, // Stops autoplay
                       autoplayTimeout: 3000,
                       navText: [
                          '<i class="fa fa-long-arrow-left"></i>',
                          '<i class="fa fa-long-arrow-right"></i>'
                        ],
                       responsive:{
                        0:{
                                           items:1,
                                           
                                       },
                                       768:{
                                           items:1,
                                       },
                                       900:{
                                           items:1,
                                       },
                                       1025:{
                                           items:1,
                         }
                   }
                });
           }    
    }
 
   
BizzEcommerceLib.init();
 
})(jQuery);



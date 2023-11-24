( function( $ ) {
//**********************************/
// Slider settings
//**********************************/
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
		OPNCustomizerToggles ['bizz_ecommerce_cat_slide_layout'] = [
		    {
				controls: [    
				'bizz_ecommerce_category_slider_optn', 
				],
				callback: function(layout){
					if(layout =='cat-layout-1'){
					return true;
					}
					return false;
				}
			},	
				
			
			 
		];	
    });
})( jQuery );
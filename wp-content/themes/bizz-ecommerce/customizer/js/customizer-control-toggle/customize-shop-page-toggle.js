( function( $ ) {
//**********************************/
// Slider settings
//**********************************/
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
         OPNCustomizerToggles ['bizz_ecommerce_pagination'] = [
		    {
				controls: [    
				'bizz_ecommerce_pagination_loadmore_btn_text',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == 'click'){
					return true;
					}
					return false;
				}
			},
			
			];


    });
})( jQuery );
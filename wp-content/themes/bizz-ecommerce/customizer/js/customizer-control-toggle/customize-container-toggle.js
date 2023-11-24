/*********************************/
// Sidebar hide and show control
/*********************************/
( function( $ ){
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
OPNCustomizerToggles ['bizz_ecommerce_default_container'] = [
		    {
				controls: [    
				'bizz_ecommerce_conatiner_maxwidth',
				'bizz_ecommerce_conatiner_top_btm',
				],
				callback: function(layout){
					if(layout=='fullwidth'){
					return false;
					}
					return true;
				}
			},
			{
				controls: [    
				'bizz_ecommerce_conatiner_width',  
				],
				callback: function(layout){
					if(layout =='boxed'){
					return false;
					}
					return true;
				}
			},		
		];
	});
})( jQuery );
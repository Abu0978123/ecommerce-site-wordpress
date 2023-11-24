/*************************************/
// Ribbon Hide N Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
OPNCustomizerToggles ['bizz_ecommerce_ribbon_background'] = [
		     {
				controls:[    
				'bizz_ecommerce_ribbon_bg_background_image',
				
				],
				callback: function(layout){
					if(layout=='image'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [  
				'bizz_ecommerce_ribbon_video_poster_image',
				'bizz_ecommerce_ribbon_bg_video', 
			    
				],
				callback: function(layout1){
					if(layout1 =='video'){
					return true;
					}else{
					return false;	
					}
				}
			},	
		];	
	});
})( jQuery );
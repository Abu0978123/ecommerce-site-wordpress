/*************************************/
// Banner Hide N Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
OPNCustomizerToggles ['bizz_ecommerce_banner_layout'] = [
		     

		     {
				controls: [    
				'bizz_ecommerce_bnr_1_img',
				'bizz_ecommerce_bnr_1_url',
				'bizz_ecommerce_bnr_2_img',
				'bizz_ecommerce_bnr_2_url',
				'bizz_ecommerce_bnr_3_img',
				'bizz_ecommerce_bnr_3_url',
				'bizz_ecommerce_bnr_4_img',
				'bizz_ecommerce_bnr_4_url',
				'bizz_ecommerce_bnr_5_img',
				'bizz_ecommerce_bnr_5_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-four'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'bizz_ecommerce_bnr_1_img',
				'bizz_ecommerce_bnr_1_url',
				'bizz_ecommerce_bnr_2_img',
				'bizz_ecommerce_bnr_2_url',
				'bizz_ecommerce_bnr_3_img',
				'bizz_ecommerce_bnr_3_url',
				'bizz_ecommerce_bnr_4_img',
				'bizz_ecommerce_bnr_4_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-five' ||  layout=='bnr-four'){
					return true;
					}else{
					return false;	
					}
				}
			},	
		    {
				controls: [    
				'bizz_ecommerce_bnr_1_img',
				'bizz_ecommerce_bnr_1_url',
				'bizz_ecommerce_bnr_2_img',
				'bizz_ecommerce_bnr_2_url',
				'bizz_ecommerce_bnr_3_img',
				'bizz_ecommerce_bnr_3_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'bizz_ecommerce_bnr_1_img',
				'bizz_ecommerce_bnr_1_url',
				'bizz_ecommerce_bnr_2_img',
				'bizz_ecommerce_bnr_2_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-two'|| layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five' || layout=='bnr-six'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'bizz_ecommerce_bnr_1_img',
				'bizz_ecommerce_bnr_1_url',	
				],
				callback: function(layout){
					if(layout=='bnr-one' || layout=='bnr-two'|| layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five' || layout=='bnr-six'){
					return true;
					}else{
					return false;	
					}
				}
			},	
				
		];	
	});
})( jQuery );
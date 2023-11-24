/*************************************/
// Bottom Footer Hide and Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
OPNCustomizerToggles ['bizz_ecommerce_bottom_footer_layout'] = [
		    {
				controls: [ 
				'bizz_ecommerce_bottom_footer_col1_set',
				'bizz_ecommerce_footer_bottom_col1_texthtml',
				],
				callback: function(layout){
					if(layout=='ft-btm-none' ){
					return false;
					}
					return true;
				}
				
		},


		{
				controls: [ 
				'bizz_ecommerce_bottom_footer_col1_set',
				'bizz_ecommerce_footer_bottom_col1_texthtml',
				],
				callback: function(layout){
					if(layout=='ft-btm-none' || layout=='ft-btm-two' || layout=='ft-btm-three' ){
					return false;
					}
					return true;
				}
				
		},


		{
				controls: [ 
				'bizz_ecommerce_bottom_footer_col1_set',
				'bizz_ecommerce_footer_bottom_col1_texthtml',
				],
				callback: function(layout){
					if(layout=='ft-btm-one' ){
					return true;
					}
					return false;
				}
				
		},
		
		
		
		// col1
			{
				controls: [    
				'bizz_ecommerce_bottom_footer_col1_set',
				'bizz_ecommerce_footer_bottom_col1_texthtml',
				],
				callback: function(layout){
					var val = api( 'bizz_ecommerce_bottom_footer_col1_set' ).get();
					if((layout!== 'ft-btm-none') && val=='text'){
					return true;
					}
					return false;
				}
			},
				
									
					
];


OPNCustomizerToggles ['bizz_ecommerce_bottom_footer_col1_set'] = [
			{
				controls: [    
				'bizz_ecommerce_footer_bottom_col1_texthtml',
				],
				callback: function(layout){
					var val = api( 'bizz_ecommerce_bottom_footer_layout' ).get();
					if((layout == 'text') && (val!=='ft-btm-none')){
					return true;
					}
					return false;
				}
			},
			
			
			
			
		];


	});
})( jQuery );
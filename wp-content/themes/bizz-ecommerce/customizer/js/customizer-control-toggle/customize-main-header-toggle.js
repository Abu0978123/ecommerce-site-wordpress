/****************/
// Main header	
/****************/
( function( $ ) {
//**********************************/
// Main Header settings
//**********************************/
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
		OPNCustomizerToggles ['bizz_ecommerce_main_header_option'] = [
		    {
				controls: [    
				'bizz_ecommerce_main_hdr_btn_txt', 
				'bizz_ecommerce_main_hdr_btn_lnk',
				'bizz_ecommerce_main_hdr_calto_txt',
				'bizz_ecommerce_main_hdr_calto_nub',
				'bizz_ecommerce_main_hdr_calto_email',
				'bizz_ecommerce_main_header_widget_redirect'
				],
				callback: function(headeroptn){
					if (headeroptn =='none'){
					return false;
					}
					return true;
				}
			},	
			 {
				controls: [    
				'bizz_ecommerce_main_hdr_btn_txt', 
				'bizz_ecommerce_main_hdr_btn_lnk',
				],
				callback: function(layout){
					if(layout=='button'){
					return true;
					}
					return false;
				}
			},
			 {
				controls: [    
				'bizz_ecommerce_main_hdr_calto_txt',
				'bizz_ecommerce_main_hdr_calto_nub',
				'bizz_ecommerce_main_hdr_calto_email',
				],
				callback: function(layout){
					if(layout=='callto'){
					return true;
					}
					return false;
				}
			},
			{
				controls: [    
				'bizz_ecommerce_main_header_widget_redirect'
				],
				callback: function(layout){
					if(layout=='widget'){
					return true;
					}
					return false;
				}
			},
			 
		];	
		OPNCustomizerToggles ['bizz_ecommerce_sticky_header'] = [
		    {
				controls: [    
				'bizz_ecommerce_sticky_header_effect', 
				],
				callback: function(headeroptn){
					if (headeroptn == true){
					return true;
					}
					return false;
				}
			},	
		];	
    });
})( jQuery );
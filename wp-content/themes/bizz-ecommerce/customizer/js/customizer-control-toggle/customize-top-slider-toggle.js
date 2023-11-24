( function( $ ){
//**********************************/
// Slider settings
//**********************************/
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
		OPNCustomizerToggles['bizz_ecommerce_top_slide_layout'] = [
		    {
				controls: [    
				'bizz_ecommerce_top_slider_2_title',
				'bizz_ecommerce_lay2_adimg',
				'bizz_ecommerce_lay2_url',
				'bizz_ecommerce_lay2_adimg2',
				'bizz_ecommerce_lay2_url2',
				'bizz_ecommerce_top_slider_2_title2',
				'bizz_ecommerce_lay2_adimg3',
				'bizz_ecommerce_lay2_url3',
				'bizz_ecommerce_lay3_adimg',
				'bizz_ecommerce_lay3_url',
				'bizz_ecommerce_lay3_adimg3',
				'bizz_ecommerce_lay3_3url',
				'bizz_ecommerce_lay3_adimg2',
				'bizz_ecommerce_lay3_2url',
				'bizz_ecommerce_include_category_slider',
				'bizz_ecommerce_lay3_bg_img',
				'bizz_ecommerce_lay3_bg_img_ovrly',
				'bizz_ecommerce_lay3_heading_txt',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-1'){
					return false;
					}
					return true;
				}
			},	
			{
				controls: [    
				'bizz_ecommerce_top_slide_content',
				'bizz_ecommerce_top_slider_2_title',
				'bizz_ecommerce_lay2_adimg',
				'bizz_ecommerce_lay2_url',
				'bizz_ecommerce_lay2_adimg2',
				'bizz_ecommerce_lay2_url2',
				'bizz_ecommerce_top_slider_2_title2',
				'bizz_ecommerce_lay2_adimg3',
				'bizz_ecommerce_lay2_url3',
				'bizz_ecommerce_lay3_bg_img_ovrly',
				'bizz_ecommerce_lay3_bg_img',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-2'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [  
				'bizz_ecommerce_top_slide_content',  
				'bizz_ecommerce_lay3_adimg',
				'bizz_ecommerce_lay3_url',
				'bizz_ecommerce_lay3_adimg2',
				'bizz_ecommerce_lay3_2url',
				'bizz_ecommerce_lay3_adimg3',
				'bizz_ecommerce_lay3_3url',
				'bizz_ecommerce_include_category_slider',
				'bizz_ecommerce_lay3_bg_img_ovrly',
				'bizz_ecommerce_lay3_bg_img',
				'bizz_ecommerce_lay3_heading_txt',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-3'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [  
				
				'bizz_ecommerce_lay3_bg_img_ovrly',
				'bizz_ecommerce_lay3_bg_img',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-4' || slideroptn =='slide-layout-3'|| slideroptn =='slide-layout-2'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [    
				'bizz_ecommerce_top_slide_content',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-4' || slideroptn =='slide-layout-1' || slideroptn =='slide-layout-2' || slideroptn =='slide-layout-3'){
					return true;
					}
					return false;
				}
			},
			
			
			 
		];	
            OPNCustomizerToggles['bizz_ecommerce_top_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			
			];
			OPNCustomizerToggles['bizz_ecommerce_cat_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_cat_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			
			];
			OPNCustomizerToggles['bizz_ecommerce_product_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_product_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			];	
			OPNCustomizerToggles['bizz_ecommerce_category_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_category_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];

			OPNCustomizerToggles['bizz_ecommerce_product_list_slide_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_product_list_slide_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['bizz_ecommerce_feature_product_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_feature_product_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['bizz_ecommerce_cat_tb_lst_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_cat_tb_lst_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['bizz_ecommerce_brand_slider_optn'] = [
		    {
				controls: [    
				'bizz_ecommerce_brand_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
		];


    });
})( jQuery );
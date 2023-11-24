/*************************************/
// Blog Archive Hide and Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
OPNCustomizerToggles ['bizz_ecommerce_blog_post_content'] = [
		    {
				controls: [    
				'bizz_ecommerce_blog_expt_length',
				'bizz_ecommerce_blog_read_more_txt',
				],
				callback: function(layout){
					if(layout=='full'|| layout=='nocontent'){
					return false;
					}
					return true;
				}
			},	
		];	
	});
})( jQuery );
/*****************************************************************************/
/**********************customizer control setting*************************/
/*****************************************************************************/
( function( $ ) {
//**********************************/
// Footer widget hide and show settings
//**********************************/
OPNControlTrigger.addHook( 'bizz-ecommerce-toggle-control', function( argument, api ){
		OPNCustomizerToggles ['bizz_ecommerce_bottom_footer_widget_layout'] = [
			{
				controls: [
					
					
					'bizz_ecommerce_bottom_footer_widget_redirect',
				],
				callback: function(layout){
					if ('ft-wgt-none'== layout){
						return false;
					}
					return true;
				}
			},
				
		];	
 });
})( jQuery );
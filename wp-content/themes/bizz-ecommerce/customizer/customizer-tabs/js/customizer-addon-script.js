/**
 * Script fort the customizer tabs control focus function.
 */
var texture_customize_tabs_focus = function ( $ ) {
	'use strict';
	$(
		function () {
				var customize = wp.customize;
				$( '.customize-partial-edit-shortcut' ).on(
					'DOMNodeInserted', function () {
						$( this ).on(
							'click', function() {
								var controlId     = $( this ).attr( 'class' );
								var tabToActivate = '';
                                var controlFinalId = controlId.split( ' ' ).pop().split( '-' ).pop();

                                if ( controlId.indexOf( 'widget' ) !== -1 ) {
									tabToActivate = $( '.texture-customizer-tab>.widgets' );
								} else {
									tabToActivate      = $( '.texture-customizer-tab>.' + controlFinalId );
								}

								customize.preview.send( 'tab-previewer-edit', tabToActivate );
                                customize.preview.send( 'focus-control', controlFinalId );
							}
						);
					}
				);
		}
	);
};

texture_customize_tabs_focus( jQuery );

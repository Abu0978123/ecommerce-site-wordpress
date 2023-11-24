/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation don't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];
	const crossbtn = siteNavigation.getElementsByClassName( 'header-close-menu' )[ 0 ];

	// Return early if the button don't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	crossbtn.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	
}() );


/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {
    var masthead, menuToggle, siteNavContain, siteNavigation;

    function initMainNavigation( container ) {

        // Set the active submenu dropdown toggle button initial state.
        container.find( '.current-menu-ancestor > button' )
            .addClass( 'toggled-on' )
            .attr( 'aria-expanded', 'true' )
            .find( '.screen-reader-text' )
        // Set the active submenu initial state.
        container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        container.find( '.dropdown-toggle' ).click( function( e ) {
            var _this = $( this ),
                screenReaderSpan = _this.find( '.screen-reader-text' );

            e.preventDefault();
            _this.toggleClass( 'toggled-on' );
            _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

        });
    }

    initMainNavigation( $( '.main-navigation' ) );

    masthead       = $( '#masthead' );
    menuToggle     = masthead.find( '.menu-toggle' );
    siteNavContain = masthead.find( '.main-navigation' );
    siteNavigation = masthead.find( '.main-navigation > div > ul' );

    // Enable menuToggle.
    (function() {

        // Return early if menuToggle is missing.
        if ( ! menuToggle.length ) {
            return;
        }

        // Add an initial value for the attribute.
        menuToggle.attr( 'aria-expanded', 'false' );

        menuToggle.on( 'click.bizz-ecommerce', function() {
            siteNavContain.toggleClass( 'toggled-on' );

            $( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
        });
    })();

    // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
    (function() {
        if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
            return;
        }

        // Toggle `focus` class to allow submenu access on tablets.
        function toggleFocusClassTouchScreen() {
            if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

                $( document.body ).on( 'touchstart.bizz-ecommerce', function( e ) {
                    if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
                        $( '.main-navigation li' ).removeClass( 'focus' );
                    }
                });

                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
                    .on( 'touchstart.bizz-ecommerce', function( e ) {
                        var el = $( this ).parent( 'li' );

                        if ( ! el.hasClass( 'focus' ) ) {
                            e.preventDefault();
                            el.toggleClass( 'focus' );
                            el.siblings( '.focus' ).removeClass( 'focus' );
                        }
                    });

            } else {
                siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.bizz-ecommerce' );
            }
        }

        if ( 'ontouchstart' in window ) {
            $( window ).on( 'resize.bizz-ecommerce', toggleFocusClassTouchScreen );
            toggleFocusClassTouchScreen();
        }

        siteNavigation.find( 'a' ).on( 'focus.bizz-ecommerce blur.bizz-ecommerce', function() {
            $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
        });
    })();
})( jQuery );

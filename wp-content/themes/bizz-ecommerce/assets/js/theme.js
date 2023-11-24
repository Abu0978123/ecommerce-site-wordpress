
! function(e, t) {
    "use strict";
    ({
        customID: "bizzEcommerceScript",
        $document: e(document),
        $window: e(window),
        $body: e("body"),
        classes: {
            overlayActive: "overlay-enabled",
            collapsed: "collapsed",
            mainHeaderMenuActive: "header-menu-active",
            searchPopUpActive: "header-search-active"
        },
        init: function() {
            this.$document.on("ready", this.documentIsReady.bind(this)),
            this.$document.on("ready", this.headerAboveBarMobile.bind(this)),
            this.$document.on("ready", this.mobileMainMenuClone.bind(this)),
            this.$document.on("ready", this.mobileMainMenuRightClone.bind(this)),
            this.$document.on("ready", this.autoHeightSetOnHeader.bind(this)),
            this.$document.on("ready", this.mainMenuFocusAccessibility.bind(this)),
            this.$window.on("ready", this.documentIsReady.bind(this))
        },
        documentIsReady: function() {
            this.$document
            .on("click." + this.customID, ".menu-collapsed", this.mainMenuCollapse.bind(this))
            .on("click." + this.customID, ".header-close-menu", this.mainMenuCollapse.bind(this))
            .on("click." + this.customID, this.mainMenuHideMobilePopup.bind(this))
            .on("click." + this.customID, ".mobile-collapsed", this.mobileSubMenuCollapse.bind(this))
            .on("click." + this.customID, ".header-close-menu", this.resetMobileMenuCollapse.bind(this))
            .on("click." + this.customID, ".browse-btn", this.browseMenuCollapse.bind(this))
            .on("mainMenuHideMobilePopup." + this.customID, this.resetMobileMenuCollapse.bind(this))
            .on("resize." + this.customID, this.autoHeightSetOnHeader.bind(this))
            .on("ready." + this.customID, this.mainMenuFocusAccessibility.bind(this))
            .on("click." + this.customID, ".header-search-toggle", this.searchPopUpToggle.bind(this))
            .on("click." + this.customID, ".header-search-close", this.searchPopUpToggle.bind(this)),
            this.$window
            .on("load." + this.customID, this.autoHeightSetOnHeader.bind(this))
            .on("resize." + this.customID, this.autoHeightSetOnHeader.bind(this))
        },
        autoHeightSetOnHeader: function(t) {
            var i = e(".navigation-wrapper"),
                n = e(".navigation-wrapper > .main-mobile-nav"),
                a = e(".navigation-wrapper > .main-navigation-area *:not(.browse-cat *):not(.logo):not(.header_btn):not(.cart-wrapper *):not(.menu-item-has-children *):not(.search-button *):not(.header-search-popup)"),
                s = 0;
            e("body").find("div").hasClass("is-sticky-on") && ("block" == e("div.main-mobile-nav").css("display") ? (n.each(function() {
                var t = e(this).outerHeight(!0);
                t > s && (s = t)
            }), i.css("min-height", s), e(".breadcrumb-nav").hasClass("breadcrumb-sticky-on") && e(".main-navigation").hasClass("is-sticky-on") && e(".main-mobile-nav").hasClass("is-sticky-on") && e(".breadcrumb-sticky-on").css("top", s - 1)) : (a.each(function() {
                var t = e(this).outerHeight(!0);
                t > s && (s = t)
            }), i.css("min-height", s), e(".breadcrumb-nav").hasClass("breadcrumb-sticky-on") && e(".main-navigation").hasClass("is-sticky-on") && e(".main-mobile-nav").hasClass("is-sticky-on") && e(".breadcrumb-sticky-on").css("top", s - 1)))
        },
        browseMenuCollapse: function(t) {
            t.preventDefault();
            var i = e(t.currentTarget);
            //i.closest(".browse-menu .main-menu");            
            //(e.shiftKey ? document.activeElement === a : document.activeElement === o &&)
            this.isRTL, setTimeout(function() {
                e('.browse-cat').toggleClass("vertical-is-active"), e('.browse-menus').slideToggle()
            }, 250)
            /*
            t.preventDefault();
            var i = e(t.currentTarget);
            i.closest(".main-mobile-build .main-menu"), i.parents(".dropdown-menu").length;
            this.isRTL, setTimeout(function() {
                i.parent().toggleClass("current"), i.next().slideToggle()
            }, 250)
            */
        },
        mobileMainMenuRightClone: function(t) {
            e(".header-wrap-right").clone().appendTo(".mobile-menu-right")
        },
        mobileMainMenuClone: function(t) {
            e("#primary-menu").clone().appendTo(".main-mobile-build")
        },
        mainMenuFocusAccessibility: function(t) {
            e(".main-navbar, .widget_nav_menu, .browse-menu.active").find("a").on("focus blur", function() {
                e(this).parents("ul, li").toggleClass("focus")
            })
        },
        mainMenuCollapse: function(t) {
            var i = e(".menu-collapsed");
            this.$body.toggleClass(this.classes.mainHeaderMenuActive),
            this.$body.toggleClass(this.classes.overlayActive), i.toggleClass(this.classes.collapsed),
            this.$body.hasClass(this.classes.mainHeaderMenuActive) ? e(".header-close-menu").focus() : i.focus(),
            this.mainMenuAccessibility()
        },
        mainMenuAccessibility: function() {
            var e, t, i, n = document.querySelector(".main-mobile-build");
            let a = document.querySelector(".header-close-menu"),
                s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                o = s[s.length - 1];
            if (!n) return !1;
            for (t = 0, i = (e = n.getElementsByTagName("a")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);

            function c() {
                for (var e = this; - 1 === e.className.indexOf("main-mobile-build");) "li" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace(" focus", "") : e.className += " focus"), e = e.parentElement
            }
            document.addEventListener("keydown", function(e) {
                ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()))
            })
        },
        mainMenuHideMobilePopup: function(t) {
            var i = e(".menu-collapsed"),
                n = e(".main-mobile-build");
            e(t.target).closest(i).length || e(t.target).closest(n).length || this.$body.hasClass(this.classes.mainHeaderMenuActive) && (this.$body.removeClass(this.classes.mainHeaderMenuActive), this.$body.removeClass(this.classes.overlayActive), i.removeClass(this.classes.collapsed), this.$document.trigger("mainMenuHideMobilePopup." + this.customID), t.stopPropagation())
        },
        mobileSubMenuCollapse: function(t) {
            t.preventDefault();
            var i = e(t.currentTarget);
            i.closest(".main-mobile-build .nav-menu"), i.parents(".dropdown-menu").length;
            this.isRTL, setTimeout(function() {
                i.parent().toggleClass("current"), i.next().slideToggle()
            }, 250)
        },
        resetMobileMenuCollapse: function(t) {
            e(".main-mobile-build .nav-menu");
            var i = e(".main-mobile-build  .menu-item"),
                n = e(".main-mobile-build .dropdown-menu");
            setTimeout(function() {
                i.removeClass("current"), n.hide()
            }, 250)
        },
        searchPopUpToggle: function(t) {
            var i = e(".header-search-toggle"),
                n = e(".header-search-field");
            this.$body.toggleClass(this.classes.searchPopUpActive), this.$body.hasClass(this.classes.searchPopUpActive) ? n.focus() : i.focus(), this.searchPopupAccessibility()
        },
        searchPopupAccessibility: function() {
            var e, t, i, n = document.querySelector(".header-search-popup");
            let a = document.querySelector(".header-search-field"),
                s = n.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'),
                o = s[s.length - 1];
            if (!n) return !1;
            for (t = 0, i = (e = n.getElementsByTagName("button")).length; t < i; t++) e[t].addEventListener("focus", c, !0), e[t].addEventListener("blur", c, !0);

            function c() {
                for (var e = this; - 1 === e.className.indexOf("header-search-popup");) "input" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace("focus", "") : e.className += " focus"), e = e.parentElement
            }
            document.addEventListener("keydown", function(e) {
                ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === a && (o.focus(), e.preventDefault()) : document.activeElement === o && (a.focus(), e.preventDefault()))
            })
        },
        headerAboveAccessibility: function() {
            var t, i, n, a = document.querySelector(".header-above-wrapper");
            let e = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])',
                o = document.querySelector(".header-above-collapse"),
                c = a.querySelectorAll(e),
                r = c[c.length - 1];
            if (!a) return !1;
            for (i = 0, n = (t = a.getElementsByTagName("button")).length; i < n; i++) t[i].addEventListener("focus", s, !0), t[i].addEventListener("blur", s, !0);

            function s() {
                for (var e = this; - 1 === e.className.indexOf("header-above-index");) "div" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace(" focus", "") : e.className += " focus"), e = e.parentElement
            }
            document.addEventListener("keydown", function(e) {
                ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === o && (r.focus(), e.preventDefault()) : document.activeElement === r && (o.focus(), e.preventDefault()))
            })
        },
        headerAboveBarMobile: function() {
            //if (e(".above-header").length > 0) {
                var t = e(".header-above-wrapper"),
                    i = e(".header-widget"),
                    n = (e(".header-above-btn"), e(".header-above-collapse"));
                i.clone().appendTo(".header-above-bar"), n.on("click", function(e) {
                    t.toggleClass("is-active"), n.toggleClass("is-active"), 
                t.hasClass('.is-active') ? this.headerAboveAccessibility() : n.focus(), e.preventDefault()
                });
            //} else e(".header-above-wrapper").children().length > 0 ? e(".header-above-btn").hide() : 
            //e(".header-above-btn").show()
        }
    }).init()
}(jQuery, window.bizzEcommerceCustomize);

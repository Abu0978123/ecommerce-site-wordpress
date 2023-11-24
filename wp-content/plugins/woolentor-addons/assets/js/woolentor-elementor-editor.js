;(function($){

    elementor.hooks.addFilter("panel/elements/regionViews", function (panel) {
  
        if ( woolentorSetting.hasPro )
            return panel;
  
        var woolentorPromoHandler, freeCategoryIndex,
            elementsView    = panel.elements.view,
            categoriesView  = panel.categories.view,
            widgets         = panel.elements.options.collection,
            categories      = panel.categories.options.collection,
            woolentorProcategroy = [];
  
        _.each( woolentorSetting.proWidgets, function (widget, index) {
            widgets.add({
                name: widget.name,
                title: widget.title,
                icon: widget.icon,
                categories: ["woolentor-pro-addons"],
                editable: false
            })
        });
  
        widgets.each(function (widget) {
            "woolentor-pro-addons" === widget.get("categories")[0] && woolentorProcategroy.push(widget)
        });
  
        freeCategoryIndex = categories.findIndex({
            name: "woolentor-addons"
        });
  
        freeCategoryIndex && categories.add({
            name: "woolentor-pro-addons",
            title: wp.i18n.__('ShopLentor Pro','woolentor'),
            defaultActive: 1,
            items: woolentorProcategroy
        }, {
            at: freeCategoryIndex + 1
        });
  
  
        woolentorPromoHandler = {
            className: function () {

                let className = 'elementor-element-wrapper';

                if (!this.isEditable()) {
                    className += ' elementor-element--promotion';
                }

                if (this.model.get("name")) {
                    if (0 === this.model.get("name").indexOf("woolentor-"))
                        className += ' woolentor-promotion-element';
                }

                return className;
            },

            // Check Any Non Editatble Widget
            isLockWidget: function () {
                const hasLockWidget = ((typeof this.model.get("name") === 'string') && (this.model.get("name").length > 0)) ? true : false;
                return hasLockWidget;
            },

            // Chech Has WooLentor Widget
            isWooLentorWidget: function () {
                const hasWidget = this.model.get("name")?.indexOf("woolentor-") === 0 ? true : false;
                return hasWidget;
            },

            // Get Elementor Object data
            getWidgetElementObj: function (name) {

                let widgetObj = woolentorSetting.proWidgets.find(function (widget, index) {
                    if (widget.name == name)
                        return true;
                });
                return widgetObj;

            },

            onMouseDown: function () {

                if (!this.isLockWidget())
                    return;

                void this.constructor.__super__.onMouseDown.call(this);

                if (!this.isWooLentorWidget())
                    return;

                let widgetObject = this.getWidgetElementObj(this.model.get("name")),
                    widgetTitle  = this.model.get("title"),
                    widgetDescription = widgetObject?.description ? sprintf( widgetObject.description, widgetTitle ) : sprintf( wp.i18n.__('Use %s widget and dozens more pro features to extend your toolbox and build sites faster and better.', 'woolentor'), widgetTitle ),
                    actionURL    = widgetObject?.action_url;

                elementor.promotion.showDialog({
                    title: sprintf(wp.i18n.__('%s', 'woolentor'), widgetTitle),
                    content: widgetDescription,
                    top: "-7",
                    targetElement: this.$el,
                    actionButton: {
                        url: actionURL,
                        text: wp.i18n.__('Upgrade Now', 'woolentor')
                    }
                })
            }
        }
  
        panel.elements.view = elementsView.extend({
            childView: elementsView.prototype.childView.extend(woolentorPromoHandler)
        });

        panel.categories.view = categoriesView.extend({
            childView: categoriesView.prototype.childView.extend({
                childView: categoriesView.prototype.childView.prototype.childView.extend(woolentorPromoHandler)
            })
        });

        return panel;
  
    });
  
})(jQuery);
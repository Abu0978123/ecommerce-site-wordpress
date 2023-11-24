; (function ($) {
    'use strict';

    const popupBuilderAdmin = {
        init: function() {
            $('.wlpb-metabox-button-wrapper button').on('click', this.openModal);
            
            $('body').on('click', '.woolentor-template-edit-cross', this.closeModal);

            let saveButtonClass = '.woolentor-template-button-item button';

            // Add repeater row.
            // .wlpb-repeater-fields-add
            $('body').on('click', '.wlpb-repeater-fields-add', function (event) {
                event.preventDefault();

                var $repeaterRow = $(this).closest('.wlpb-modal').find('.wlpb-repeater-clone-field .wlpb-repeater-conditions-repeater-row-controls').clone();
                $('.wlpb-repeater-fields').append($repeaterRow);

                $(saveButtonClass).prop('disabled', false);
            });

            // Remove repeater row.
            $('body').on('click', '.wlpb-repeater-fields-remove i', this.removeRepeaterRow);

            // Listen to the name field change to populate the sub_name fields.
            $('body').on('change', '.wlpb-repeater-conditions-repeater-row-controls select', this.generateSubName);

            // Listen to the sub_name field change to populate the sub_id fields.
            $('body').on('change', '.wlpb-repeater-conditions-repeater-row-controls select[data-name="sub_name"]', this.generateSubId);

            // On any data change of the form fields.
            $('body').on('change keyup input', '.wlpb-modal', function(){
                $(saveButtonClass).prop('disabled', false);
            });

            // Number field increment/decrement.
            $('body').on('click', '.wlpb-modal .woolentor-admin-number-btn', this.numberFieldIncrementDecrement );

            // Only choose one trigger.
            $('body').on('change', '#wlpb-triggers .wplb-composite-field input[type="checkbox"]', this.manageTriggerCheckbox);

            // Save the popup settings.
            $('body').on('click', '.woolentor-template-button-item button', this.saveSettings);

            // Advanced tab.
            $('body').on('change', '#url_match_type', function(){
                if( this.value == 'parameter' ){
                    $('.wlpb-url-match-input').show();
                } else {
                    $('.wlpb-url-match-input').hide();
                }
            });

            // When the popup is opened.
            $(document).on('wlpb_module_popup_open', function(){
                if( $('#url_match_type').val() != 'parameter' ){
                    $('.wlpb-url-match-input').hide();
                }

                // Init the select2.
                $('.wlpb-modal select[multiple="multiple"]').each(function(){
                    const $this = $(this),
                        $parent = $this.parent();
                    $this.select2({
                        dropdownParent: $parent,
                        placeholder: "Select",
                    });
                })
            });

            /* Upgrate Pro Popup */
            $('body').on('click', '.wlpb-pro-adv', this.openProPopup);
            $('body').on('click', '.wlpb-modal [data-woolentor-pro="disabled"]', this.openProPopup);
            $('body').on('click', '.wlpb-pro-opacity', this.openProPopup);

            $('body').on('click', '.woolentor-admin-popup-close', this.closeProPopup);

            /* Woolentor Core behavior update */

            // Hide the set default checkbox on change of template type.
            $('body').on('change', '#woolentor-template-type', this.OnChangeTemplateType);

            // Hide the set default checkbox on edit popup.
            $(document).on('woolentor_template_edit_popup_open_ajax_success', this.OnEdit);
        },

        openModal: function(event) {
            if( $('.wlpb-modal').length ){
                $('body').addClass('open-editor');
                return;
            }

            var template = wp.template('wlpb-modal'), // returns function
                popupPlainMarkup = null;

            popupPlainMarkup = template({
                haselementor: 1,
                templatetype: 2,
                editor: 3,
                heading: 4,
                templatelist: 5,
            });

            $('body').append(popupPlainMarkup);
            $('body').addClass('open-editor');
            
            // Render and activate Tab.
            const $tabList      = $('.wlpb-tab-nav li'),
                $tabListLink    = $('.wlpb-tab-nav li a'),
                $tabBorder      = $('.wlpb-tab-border'),
                $tabPane        = $('.wlpb-tab-pane');

            function tabBorderAnimation() {
                const $tabActive = $('.wlpb-tab-nav li.wlpb-active');
                $tabBorder.stop().css({
                    top: $tabActive.position().top,
                    height: $tabActive.height()
                });
            }

            tabBorderAnimation();

            $tabList.on('click', 'a', function (e) {
                e.preventDefault();
                const $tabTarget = $(this).attr('href');
        
                $tabListLink.stop().parent('li').removeClass('wlpb-active');
                $(this).stop().parent('li').addClass('wlpb-active');
                tabBorderAnimation();
        
                $tabPane.stop().removeClass('wlpb-active');
                $($tabTarget).addClass('wlpb-active');
            });

            $(document).trigger('wlpb_module_popup_open');
        },

        closeModal: function (event) {
            $('body').removeClass('open-editor');
        },

        generateSubName: function (event) {
            const field = $(this).data('name');
            const name = $(this).val();
            const $row = $(this).closest('.wlpb-repeater-conditions-repeater-row-controls');

            if( field == 'namee' ){

                $.ajax({
                    url: wlpb_params.ajax_url,
                    type: 'POST',
                    //dataType: 'json',
                    data: {
                        'action': 'wlpb_generate_sub_name',
                        'name': name,
                        'nonce' : wlpb_params.nonce
                    },
            
                    beforeSend:function(){
                    },
            
                    success:function(response) {
                        $row.find('.wlpb-sub_name').remove();
                        $row.find('.wlpb-sub_id').remove();

                        if( response.data ){
                            var $field_html = $('<div class="woolentor-admin-select wlpb-sub_name">'+ response.data +'</div>');
                            $row.find('.wlpb-name').after($field_html);
                        }

                        // Enable the save button.
                        $('.wlpb-modal .woolentor-template-button-item button').prop('disabled', false);
                    },
            
                    complete:function( response ){
                    },
            
                    error: function(errorThrown){
                        console.log(errorThrown);
                    }
                });
            }
        },

        generateSubId: function (event) {
            const $repeaterRow    = $(this).closest('.wlpb-repeater-conditions-repeater-row-controls');
            const name            = $repeaterRow.find('select[data-name="namee"]').val();
            const subName         = $(this).val();
            const $subName        = $(this).parent();
            const $subId          = $repeaterRow.find('.wlpb-sub_id');

            $.ajax({
                url: wlpb_params.ajax_url,
                type: 'POST',
                // dataType: 'json',
                data: {
                    'action': 'wlpb_generate_sub_id',
                    'name': name,
                    'sub_name': subName,
                    'nonce' : wlpb_params.nonce
                },

                beforeSend:function(){
                },

                success:function(response) {
                    $subId.remove();

                    // Create, update and append the sub_id field.
                    if( response.data ){
                        var $field_html = $('<div class="woolentor-admin-select wlpb-sub_id">'+ response.data +'</div>');

                        $subName.after($field_html);
                    }

                    // Enable the save button.
                    $('.wlpb-modal .woolentor-template-button-item button').prop('disabled', false);
                },

                complete:function( response ){
                },

                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        },

        removeRepeaterRow: function (event) {
            event.preventDefault();

            $(this).closest('.wlpb-repeater-conditions-repeater-row-controls').remove();
            $('.wlpb-modal .woolentor-template-button-item button').prop('disabled', false);
        },

        numberFieldIncrementDecrement: function (event) {

            event.preventDefault();
            const $this = $(this),
            $input = $this.parent('.woolentor-admin-number').find('input[type="number"]')[0];

            if( $this.hasClass('increase') ){
                $input.value = Number($input.value) + 1;
            } else if( $this.hasClass('decrease') && Number($input.value) > 1 ){
                $input.value = Number($input.value) - 1;
            }
            
            // Fire the input event.
            $(event.target).siblings('input[type="number"]').trigger('input');
        },

        manageTriggerCheckbox: function(){
            let $compositeFieldSiblings = $(this).closest('.wplb-composite-field').siblings('.wplb-composite-field'),
                checked = $(this).prop('checked');

            // If the checkbox is checked then disable all other checkboxes inside $compositeFieldSiblings.
            if( checked ){
                $compositeFieldSiblings.find('input[type="checkbox"]').prop('checked', false);
            }

        },

        saveSettings: function (event) {
            event.preventDefault();

            const $_this = $(this);
            var dataObj = {
                'action': 'wlpb_save_popup_settings',
                'popup_id': $_this.data('popup_id'),
                'nonce': wlpb_params.nonce
            };
            dataObj.conditions = [];
            dataObj.triggers = {};
            dataObj.advanced = {};

            
            // var repeaterValues = [];
            $('.wlpb-repeater-fields .wlpb-repeater-conditions-repeater-row-controls').each(function(){
                var $row = $(this);

                var repeaterRowData = {
                    'type'      : $row.find('select[data-name="type"]').val(),
                    'name'      : $row.find('select[data-name="namee"]').val(),
                    'sub_name'  : $row.find('select[data-name="sub_name"]').val() || '',
                    'sub_id'    : $row.find('select[data-name="sub_id"]').val() || '',
                };

                dataObj.conditions.push(repeaterRowData);
            });

            let allFields = {
                triggers:  [
                    'on_page_load',
                    'page_load_delay',
                    'on_scroll',
                    'scroll_direction',
                    'scroll_percentage',
                    'on_click',
                    'clicks_count',
                    'on_click_element',
                    'on_click_selector',
                    'on_inactivity',
                    'inactivity_time',
                    'on_exit_intent',
                ],
                general: [
                    'animation_in',
                    'animation_out',
                    'animation_in_duration',
                    'disable_overlay',
                    'disable_page_scroll',
                    'disable_close_button',
                    'dismiss_on_esc_key',
                    'dismiss_on_overlay_click',
                    'close_after_page_scroll',
                    'dismiss_automatically',
                    'dismiss_automatically_delay'
                ],
                advanced: [
                    'do_not_show_again',
                    'do_not_show_again_timespan',
                    'do_not_show_again_closecount',
                    'url_match',
                    'url_match_type',
                    'url_match_input', // for parameter and query string
                    'url_match_value',
                    'show_on_devices',
                    'devices',
                    'show_on_browsers',
                    'browsers'
                ],
                customization: [
                    'popup_vertical_position',
                    'popup_horizontal_position',
                    'width',
                    'height',
                    'z_index',
                    'pos_vertical',
                    'pos_horizontal',
                    'margin',
                    'padding',
                    'css_class',
                    'close_button_vertical_position[amount]',
                    'close_button_vertical_position[unit]',
                    'close_button_horizontal_position[amount]',
                    'close_button_horizontal_position[unit]'
                ]
            };

            $.each(allFields, function(groupName, fields){

                $.each(fields, function(index, field_name){
                    let fieldElement = $('body');
                    let fieldValue     = '';

                    if( $('.wlpb-field [name="' + field_name + '"]').length ){
                        fieldElement = $('.wlpb-field [name="' + field_name + '"]');
                    }else if( $('.wlpb-field [name="'+ field_name +'[]"').length ){ // for multiple select
                        fieldElement = $('.wlpb-field [name="'+ field_name +'[]"');
                    }

                    if( fieldElement.is(':checkbox') ){
                        if( fieldElement.prop('checked') ){
                            fieldValue = 1;
                        } else {
                            fieldValue = 0;
                        }
                    } else {
                        fieldValue = fieldElement.val();
                    }

                    if (groupName == 'triggers' || groupName == 'advanced') {
                        dataObj[groupName][field_name] = fieldValue;
                    } else { 
                        dataObj[field_name] = fieldValue;
                    }
                });

            });

            $.ajax({
                url: wlpb_params.ajax_url,
                type: 'POST',
                //dataType: 'json',
                data: dataObj,
        
                beforeSend:function(){
                    $_this.addClass('updating-message').text('Saving...');
                },
        
                success:function(response) {
                    $_this.removeClass('updating-message').prop('disabled', true).text('All Data Saved');
                    let popupId = $_this.data('popup_id');

                    // If do_not_show_again is disabled then clear all the cookie.
                    if( Number(dataObj.advanced.do_not_show_again) == 0 ){
                        Cookies.remove('wlpb_'+ popupId +'_do_not_show_again');
                        Cookies.remove('wlpb_'+ popupId +'_close_count');
                    }
                    
                    // Clear the wlpb_id_close_count cookie if the close count is changed.
                    let prevCloseCount = $_this.parents('.woolentor-template-edit-popup').find('[name="do_not_show_again_closecount"]').data('close_count');
                        prevCloseCount = Number(prevCloseCount);

                    let newCloseCount = $_this.parents('.woolentor-template-edit-popup').find('[name="do_not_show_again_closecount"]').val();
                        newCloseCount = Number(newCloseCount);

                    if( Number(dataObj.advanced.do_not_show_again) > 0 && (prevCloseCount != newCloseCount) ){
                        Cookies.remove('wlpb_' + popupId + '_close_count');
                    }

                    // Reload iframe to reflect the changes.
                    let $iframe = $('#elementor-preview iframe');
                    if( $iframe.length ){
                        $iframe.attr('src', $iframe.attr('src'));
                    }
                },
        
                complete:function( response ){
                },
        
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });
        },

        openProPopup: function (e) {
            e.preventDefault()
            const $popup = $('#woolentor-admin-pro-popup')
            $popup.addClass('open')
        },

        closeProPopup: function (e) {
            e.preventDefault()
            const $popup = $('#woolentor-admin-pro-popup')
            $popup.removeClass('open')
        },

        OnChangeTemplateType: function (e) {
            if( this.value == 'popup' ){
                $('.woolentor-template-edit-set-default-field.woolentor-template-edit-set-checkbox').hide();
            } else {
                $('.woolentor-template-edit-set-default-field.woolentor-template-edit-set-checkbox').show();
            }
        },

        OnEdit: function (e, templateType) {
            if( templateType == 'popup' ){
                $('.woolentor-template-edit-set-default-field.woolentor-template-edit-set-checkbox').hide();
            } else {
                $('.woolentor-template-edit-set-default-field.woolentor-template-edit-set-checkbox').show();
            }
        }

    }

    $(document).ready(function(){
        popupBuilderAdmin.init();
    });

    if( typeof elementor != "undefined" ){
        elementor.on("panel:init", function (e) {
            elementor.getPanelView().footer.currentView.addSubMenuItem("saver-options", {
                before: "save-draft",
                name: "wlpb_conditions",
                icon: "elementor-icon eicon-settings",
                title: wlpb_params.label_popup_settings,
                callback: function () {
                    return elementor.trigger("wlpb_conditions_open_elementor");
                },
            });
        });

        elementor.on("wlpb_conditions_open_elementor", function (e) {
            popupBuilderAdmin.openModal();
        });
    }

})(jQuery);
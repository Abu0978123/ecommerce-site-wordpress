<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woolentor_Wl_Popup_Trigger_Button_Widget extends Widget_Base{
    public function get_name() {
        return 'wlpb_trigger_button';
    }
    
    public function get_title() {
        return __( 'WL: Popup Close Trigger Button', 'woolentor' );
    }

    public function get_icon() {
        return 'eicon-click';
    }

    public function get_categories() {
        return [ 'woolentor-addons' ];
    }

    public function get_help_url() {
        return 'https://woolentor.com/documentation/';
    }

    public function get_style_depends(){
        return ['wlpb-frontend','elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid'];
    }

    public function get_keywords(){
        return ['popup','trigger','button'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => __( 'General', 'woolentor' ),
            ]
        );
            $this->add_control(
                'button_text',
                [
                    'label' => __( 'Button Text', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Close', 'woolentor' ),
                ]
            );

            $this->add_responsive_control(
                'alignment',
                [
                    'label' => __( 'Alignment', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'woolentor' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'woolentor' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'woolentor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => false,
                ]
            );

            $this->add_control(
                'action',
                [
                    'label' => __( 'Action', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'close_popup',
                    'options' => [
                        'close_popup' => __( 'Close Popup', 'woolentor' ),
                        'go_back_to_previous_page' => __( 'Close and Back To Previous Page', 'woolentor' ),
                    ],
                ]
            );

            $this->add_control(
                'redirect_url',
                [
                    'label' => __( 'Redirect URL', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '',
                    'description' => __( 'Enter the URL where you want to redirect after closing the popup.', 'woolentor' ),
                    'placeholder' => 'https://yourdomain.com/sample-page/',
                    'condition' => [
                        'action' => array('close_popup'),
                    ],
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Button Icon', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'fa4compatibility' => 'buttonicon',
                ]
            );

            $this->add_responsive_control(
                'icon_position',
                [
                    'label' => __( 'Icon Position', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Before', 'woolentor' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'After', 'woolentor' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'default' => 'left',
                    'toggle' => false,
                ]
            );

            $this->add_responsive_control(
                'icon_specing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'woolentor' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 7,
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .wlpb-trigger-button'  => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
        // End General Controls.
        $this->end_controls_section();

        // Style Controls.
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Button Area', 'woolentor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            // Background
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'label' => __( 'Background', 'woolentor' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .wlpb-trigger-button',
                ]
            );

            // Text Color
            $this->add_control(
                'text_color',
                [
                    'label' => __( 'Text Color', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button .wlpb-trigger-button-text' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Text Typography
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_text_typography',
                    'label' => __( 'Typography', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .wlpb-trigger-button .wlpb-trigger-button-text',
                ]
            );

            // Border
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .wlpb-trigger-button',
                ]
            );

            // Border Radius
            $this->add_responsive_control(
                'border_radius',
                [
                    'label' => __( 'Border Radius', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Margin
            $this->add_responsive_control(
                'margin',
                [
                    'label' => __( 'Margin', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'placeholder' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Padding
            $this->add_responsive_control(
                'padding',
                [
                    'label' => __( 'Padding', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'placeholder' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        // End Style Controls.
        $this->end_controls_section();

        // Button Icon Style Controls.
        $this->start_controls_section(
            'button_icon_style_section',
            [
                'label' => __( 'Button Icon', 'woolentor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_icon[value]!' => '',
                ],
            ]
        );

            // Color
            $this->add_control(
                'button_icon_color',
                [
                    'label' => __( 'Icon Color', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            // Size
            $this->add_responsive_control(
                'button_icon_size',
                [
                    'label' => __( 'Icon Size', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // Background
            $this->add_control(
                'button_icon_background',
                [
                    'label' => __( 'Icon Background', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            // Border
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'button_icon_border',
                    'label' => __( 'Border', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .wlpb-trigger-button i',
                ]
            );

            // Border Radius
            $this->add_responsive_control(
                'button_icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Margin
            $this->add_responsive_control(
                'button_icon_margin',
                [
                    'label' => __( 'Icon Margin', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'placeholder' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Padding
            $this->add_responsive_control(
                'button_icon_padding',
                [
                    'label' => __( 'Icon Padding', 'woolentor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'placeholder' => [
                        'top' => '',
                        'right' => '',
                        'bottom' => '',
                        'left' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlpb-trigger-button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        // End Style Controls.
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $button_text   = $settings['button_text'];
        $button_icon   = $settings['button_icon'];
        $icon_position = $settings['icon_position'];
        $alignment     = $settings['alignment'];
        $action        = $settings['action'];
        $redirect_url  = $settings['redirect_url'];

        $button_icon = '';
        if( !empty( $settings['button_icon']['value'] ) ){
            $button_icon = woolentor_render_icon( $settings, 'button_icon', 'buttonicon' );
        }

        $short_code_attributes = [
            'button_text' => $button_text,
            'button_icon' => htmlentities($button_icon),
            'icon_position' => $icon_position,
            'button_align' => $alignment,
            'action' => $action,
            'redirect_url' => $redirect_url,
        ];

        echo woolentor_do_shortcode( 'wlpb_trigger_button', $short_code_attributes );

    }
}
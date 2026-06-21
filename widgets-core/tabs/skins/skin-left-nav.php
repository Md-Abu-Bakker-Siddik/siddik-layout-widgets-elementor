<?php
namespace UniqueAddons\Widgets\Tabs\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Skin_Base as Elementor_Skin_Base;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Left_Nav extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-tabs/tm_general/after_section_end', [ $this, 'register_layout_controls1' ] );
		add_action( 'elementor/element/uae-tabs/tm_general/after_section_end', [ $this, 'register_layout_controls2' ] );
	}

	public function get_id() {
		return 'skin-left-nav';
	}


	public function get_title() {
		return __( 'Skin - Left Nav', 'siddik-layout-widgets-elementor' );
	}


	public function register_layout_controls1( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'design_options',
			[
				'label' => esc_html__( 'Design Style', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( "Design Style", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''	=> 	esc_html__( "Default", 'siddik-layout-widgets-elementor' ),
					'skin-left-nav-classic'	=> 	esc_html__( "Style Classic", 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);
		$this->end_controls_section();
	}


	public function register_layout_controls2( Widget_Base $widget ) {
		$this->parent = $widget;









		$this->start_controls_section(
			'wrapper_styling',
			[
				'label' => esc_html__( 'Tab & Content Placement', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper_flex_direction',
			[
				'label' => esc_html__( "Tab & Content Flex Direction", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_direction_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .row' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();




		//Features
		$this->start_controls_section(
			'list_icon_options',
			[
				'label' => esc_html__( 'Icon Options (Tab)', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'siddik-layout-widgets-elementor' ),
					'rotate' => esc_html__( 'Rotate', 'siddik-layout-widgets-elementor' ),
					'rotate-x' => esc_html__( 'Rotate X', 'siddik-layout-widgets-elementor' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'siddik-layout-widgets-elementor' ),
					'scale'  => esc_html__( 'Scale', 'siddik-layout-widgets-elementor' ),
					'translate'  => esc_html__( 'Translate', 'siddik-layout-widgets-elementor' ),
					'translate-x'  => esc_html__( 'Translate X Left', 'siddik-layout-widgets-elementor' ),
					'translate-x-right'  => esc_html__( 'Translate X Right', 'siddik-layout-widgets-elementor' ),
					'translate-y'  => esc_html__( 'Translate Y', 'siddik-layout-widgets-elementor' ),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'breadcrumb_nav_icon_typography',
				'label' => esc_html__( 'Icon Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon',
			]
		);
		$this->start_controls_tabs('tabs_nav_icon_style');
		$this->start_controls_tab(
			'tab_nav_icon_normal',
			[
				'label' => esc_html__('Normal', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_responsive_control(
			'hide_icon',
			[
				'label' => esc_html__( 'Hide Icon', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'siddik-layout-widgets-elementor' ),
				'label_off' => __( 'Show', 'siddik-layout-widgets-elementor' ),
				'return_value'	=> 'none',
				'default'	=> 'flex',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_color_options',
			[
				'label' => esc_html__( 'Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( "Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options',
			[
				'label' => esc_html__( 'Postion Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options',
			[
				'label' => esc_html__( 'Icon Wrapper Dimension Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width',
			[
				'label' => esc_html__( 'Width', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height',
			[
				'label' => esc_html__( 'Height', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color',
				'label' => esc_html__( 'Icon Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon',
			]
		);
		$this->add_control(
			'list_icon_border_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon',
			]
		);
		$this->add_responsive_control(
			'list_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'list_icon_opacity',
			[
				'label' => esc_html__( 'Icon Opacity', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li .tabs-icon' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_icon_hover',
			[
				'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'list_icon_color_options_hover',
			[
				'label' => esc_html__( 'Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color_hover',
			[
				'label' => esc_html__( "Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color_hover',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options_hover',
			[
				'label' => esc_html__( 'Postion Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical_hover',
			[
				'label' => __( 'Vertical Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y_hover',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_vertical_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal_hover',
			[
				'label' => __( 'Horizontal Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x_hover',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_horizontal_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options_hover',
			[
				'label' => esc_html__( 'Dimension Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width_hover',
			[
				'label' => esc_html__( 'Width', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height_hover',
			[
				'label' => esc_html__( 'Height', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options_hover',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color_hover',
				'label' => esc_html__( 'Icon Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon',
			]
		);
		$this->add_control(
			'list_icon_border_hover_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon',
			]
		);
		$this->add_responsive_control(
			'list_icon_margin_hover',
			[
				'label' => esc_html__( 'Icon Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'list_icon_opacity_hover',
			[
				'label' => esc_html__( 'Icon Opacity', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li:hover .tabs-icon' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();






		$this->start_controls_tab(
			'tab_nav_icon_active',
			[
				'label' => esc_html__('Active', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'list_icon_color_options_active',
			[
				'label' => esc_html__( 'Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color_active',
			[
				'label' => esc_html__( "Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored_active',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color_active',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored_active',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options_active',
			[
				'label' => esc_html__( 'Postion Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical_active',
			[
				'label' => __( 'Vertical Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y_active',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_vertical_active.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal_active',
			[
				'label' => __( 'Horizontal Orientation', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x_active',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' =>
							'{{skin_left_nav_list_icon_orientation_horizontal_active.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options_active',
			[
				'label' => esc_html__( 'Dimension Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width_active',
			[
				'label' => esc_html__( 'Width', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height_active',
			[
				'label' => esc_html__( 'Height', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options_active',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color_active',
				'label' => esc_html__( 'Icon Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon',
			]
		);
		$this->add_control(
			'list_icon_border_active_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius_active',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon',
			]
		);
		$this->add_responsive_control(
			'list_icon_margin_active',
			[
				'label' => esc_html__( 'Icon Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'list_icon_opacity_active',
			[
				'label' => esc_html__( 'Icon Opacity', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active .tabs-icon' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		//Features
		$this->start_controls_section(
			'list_styling',
			[
				'label' => esc_html__( 'Text Typography/Color  (Tab)', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_list_style');
		$this->start_controls_tab(
			'tab_list_normal',
			[
				'label' => esc_html__('Normal', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list__typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li, {{WRAPPER}} .tm-tabs-vertical-nav li a',
			]
		);
		$this->add_control(
			'list_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'border_options',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => esc_html__( 'List Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li a',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li a',
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();






		$this->start_controls_tab(
			'tab_list_hover',
			[
				'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list__typography_hover',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li a:hover',
			]
		);
		$this->add_control(
			'list_text_color_options_hover',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'bg_color_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'border_options_hover',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border_hover',
				'label' => esc_html__( 'List Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li a:hover',
			]
		);
		$this->add_responsive_control(
			'border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li a:hover',
			]
		);
		$this->add_responsive_control(
			'list_margin_hover',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();








		$this->start_controls_tab(
			'tab_list_active',
			[
				'label' => esc_html__('Active', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list__typography_active',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li.active, {{WRAPPER}} .tm-tabs-vertical-nav li.active a',
			]
		);
		$this->add_control(
			'list_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored_active',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color_active',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'border_options_active',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border_active',
				'label' => esc_html__( 'List Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li.active a',
			]
		);
		$this->add_responsive_control(
			'border_radius_active',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav li.active a',
			]
		);
		$this->add_responsive_control(
			'list_margin_active',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding_active',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav li.active a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();












		$this->start_controls_section(
			'title_block_section_styling',
			[
				'label' => esc_html__( 'Tab Block - Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->start_controls_tabs('tabs_title_block_style');
		$this->start_controls_tab(
			'title_block_style_normal',
			[
				'label' => esc_html__('Idle', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_block_margin',
			[
				'label' => esc_html__( 'Block Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_padding',
			[
				'label' => esc_html__( 'Block Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_border_radius',
			[
				'label' => esc_html__( "Block Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link',
			]
		);
		$this->add_control(
			'title_block_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_block_border',
				'label' => esc_html__( 'Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_normal', [
				'label' => esc_html__( "Border Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height',
			[
				'label' => esc_html__( "Falling Shutter Height", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:not(.active):not(:hover)' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_block_style_active',
			[
				'label' => esc_html__('Active', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color_active',
			[
				'label' => esc_html__( "Custom Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active',
			]
		);
		$this->add_control(
			'title_block_border_color_options_active',
			[
				'label' => esc_html__( 'Border Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_active', [
				'label' => esc_html__( "Border Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_active', [
				'label' => esc_html__( "Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height_active',
			[
				'label' => esc_html__( "Falling Shutter Height", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link.active' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();




		$this->start_controls_tab(
			'title_block_style_hover',
			[
				'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'title_block_bg_color_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover',
			]
		);
		$this->add_control(
			'title_block_border_color_options_hover',
			[
				'label' => esc_html__( 'Border Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_hover', [
				'label' => esc_html__( "Border Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_block_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'title_block_falling_shutter_height_hover',
			[
				'label' => esc_html__( "Falling Shutter Height", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs .nav-tabs .nav-link:hover' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		$this->start_controls_section(
			'tab_link_wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper of Tab Blocks', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_block_width',
			[
				'label' => esc_html__( "Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tab_link_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_link_wrapper_border',
				'label' => esc_html__( 'Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs',
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_link_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_link_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow(Hover)', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}}:hover .tm-tabs-vertical-nav .col-nav-tabs',
			]
		);
		$this->add_control(
			'tab_link_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-tabs-vertical-nav .col-nav-tabs' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-nav-tabs' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'tab_link_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-tabs-vertical-nav .col-nav-tabs' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();












		$this->start_controls_section(
			'tab_content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Style', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_width',
			[
				'label' => esc_html__( "Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .col-content' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_content_typo',
				'selector' => '{{WRAPPER}} .tab-content .tab-pane',
			]
		);
		$this->add_control(
			'tab_content_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'tab_content_wrapper_border',
				'label' => esc_html__( 'Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .tab-content',
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_content_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-tabs-vertical-nav .tab-content',
			]
		);
		$this->add_control(
			'tab_content_wrapper_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_custom_text_color',
			[
				'label' => esc_html__( "Custom Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tab_content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'tab_content_wrapper_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-tabs-vertical-nav .tab-content' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();


	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-tabs';
		$classes[] = 'tm-tabs-vertical-nav';
		$classes[] = $settings['skin_left_nav_design_style'];

		$settings['classes'] = $classes;

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('tabs');
		$settings['rand'] = rand(10,100);
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
			<div class="row">
		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list = array();
				$i=1;
		?>
			<div class="col-4 col-nav-tabs">
			<ul class="nav nav-tabs flex-column" id="myTab-<?php echo esc_attr($settings['holder_id']); ?>" role="tablist">
			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['title'] = $item['title'];
					$settings['expand'] = $item['expand'];
					$settings['i'] = $i;
					$settings['tab_id_list'] = $tab_id_list;


					$icon_html_code = '';


					// Tab Icon/image
					if ( $item['tabs_tab_icon_type'] != '' ) {
						if ( $item['tabs_tab_icon_type'] == 'font' && ( ! empty( $item['tabs_tab_icon_fontawesome'] ) ) ) {

							$icon_font = $item['tabs_tab_icon_fontawesome'];
							$icon_out = '';
							// add icon migration
							$migrated = isset( $item['__fa4_migrated'][ $item['tabs_tab_icon_fontawesome'] ] );
							$is_new = Icons_Manager::is_migration_allowed();
							if ( $is_new || $migrated ) {
								ob_start();
								Icons_Manager::render_icon( $item['tabs_tab_icon_fontawesome'], [ 'aria-hidden' => 'true' ] );
								$icon_out .= ob_get_clean();
							} else {
								$icon_out .= '<i class="icon ' . esc_attr( $icon_font ) . '"></i>';
							}
							$icon_html_code = '<span class="tabs-icon">' . $icon_out . '</span>';
						}
						if ( $item['tabs_tab_icon_type'] == 'image' && ! empty( $item['tabs_tab_icon_thumbnail'] ) ) {
							if ( ! empty( $item['tabs_tab_icon_thumbnail']['url'] ) ) {
								$this->parent->add_render_attribute( 'thumbnail', 'src', $item['tabs_tab_icon_thumbnail']['url'] );
								$this->parent->add_render_attribute( 'thumbnail', 'alt', Control_Media::get_image_alt( $item['tabs_tab_icon_thumbnail'] ) );
								$this->parent->add_render_attribute( 'thumbnail', 'title', Control_Media::get_image_title( $item['tabs_tab_icon_thumbnail'] ) );
								$icon_out = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'tabs_tab_icon_thumbnail' );
								$icon_html_code = '<span class="tabs-icon tabs-icon-image">' . $icon_out . '</span>';
							}
						}
					}
					// End Tab Icon/image
					$settings['icon_html_code'] = $icon_html_code;


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= unique_addons_get_widgetcore_template_part( 'tab-title', null, 'tabs/tpl', $settings, false );
					$i++;
				}
			?>
			</ul>
			</div>
		<?php
			}
		?>


		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list2 = array();
				$i=1;
		?>
			<div class="col-8 col-content">
				<div class="tab-content" id="myTabContent-<?php echo esc_attr($settings['holder_id']); ?>">

			<?php
				foreach (  $settings['tabs_items'] as $item ) {
					$tab_id_list2[$i] = 'tab-'.$settings['holder_id'].'-'.$i;
					$settings['expand'] = $item['expand'];
					$settings['i'] = $i;
					$settings['tabs_content_type'] = $item['tabs_content_type'];
					$settings['tabs_content_templates'] = $item['tabs_content_templates'];
					$settings['tabs_content'] = $item['tabs_content'];
					$settings['tab_id_list2'] = $tab_id_list2;


					//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
					$html .= unique_addons_get_widgetcore_template_part( 'tab-content', null, 'tabs/tpl', $settings, false );
					$i++;
				}
			?>
				</div>
			</div>
		<?php
			}
		?>
		</div>
		</div>
	<?php
	}
}

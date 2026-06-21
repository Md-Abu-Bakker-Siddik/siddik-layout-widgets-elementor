<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Social_Links extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'uae-social-links';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Social Links', 'siddik-layout-widgets-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'unique-addons' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'unique-addons-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {



		$this->start_controls_section(
			'social_url_options',
			[
				'label' => esc_html__( 'Social Url Options', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'url_twitter',
			[
				'label' => esc_html__( "Twitter URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_facebook',
			[
				'label' => esc_html__( "Facebook URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_youtube',
			[
				'label' => esc_html__( "Youtube URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_linkedin',
			[
				'label' => esc_html__( "Linkedin URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_instagram',
			[
				'label' => esc_html__( "Instagram URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'group_social_urls',
			[
				'label' => esc_html__( "Tumblr URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_vk',
			[
				'label' => esc_html__( "VK URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_pinterest',
			[
				'label' => esc_html__( "Pinterest URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->add_control(
			'url_reddit',
			[
				'label' => esc_html__( "Reddit URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => '',
				'default' => ''
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'Design Style', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'target',
			[
				'label' => esc_html__( "Link Target", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'_blank' => esc_html__( 'New Tab (Blank)', 'siddik-layout-widgets-elementor' ),
					'_self' => esc_html__( 'Self', 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Horizontal Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => 'default',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-social-links' => 'justify-content: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( "Item Margin", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-social-links li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => esc_html__( "Icon Style", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'siddik-layout-widgets-elementor' ),
					'icon-circled' => esc_html__( 'Circled', 'siddik-layout-widgets-elementor' ),
					'icon-rounded' => esc_html__( 'Rounded', 'siddik-layout-widgets-elementor' ),
					'icon-square' => esc_html__( 'Square', 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( "Icon Size", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'siddik-layout-widgets-elementor' ),
					'icon-xs' => esc_html__( 'Extra Small', 'siddik-layout-widgets-elementor' ),
					'icon-sm' => esc_html__( 'Small', 'siddik-layout-widgets-elementor' ),
					'icon-md' => esc_html__( 'Medium', 'siddik-layout-widgets-elementor' ),
					'icon-lg' => esc_html__( 'Large', 'siddik-layout-widgets-elementor' ),
					'icon-xl' => esc_html__( 'Extra Large', 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);
		$this->add_control(
			'icon_custom_fontsize',
			[
				'label' => esc_html__( "Icon Custom Font Size", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-social-links li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_custom_size',
			[
				'label' => esc_html__( "Icon Area Custom Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-social-links li a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_outlined', [
				'label' => esc_html__( "Make Icon Outlined?", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon Predefined Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-dark' => esc_html__( 'Dark', 'siddik-layout-widgets-elementor' ),
					'icon-light' => esc_html__( 'Light', 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);



		$this->start_controls_tabs('tabs_icon_style');
		$this->start_controls_tab(
			'tabs_icon_style_normal',
			[
				'label' => esc_html__('Normal', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'border_options',
			[
				'label' => esc_html__( 'Border Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .social-link',
			]
		);
		$this->add_control(
			'border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'icon_text_color_options',
			[
				'label' => esc_html__( 'Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__( "Icon Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'icon_bg_options',
			[
				'label' => esc_html__( 'Icon BG Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( "Icon BG Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();






		$this->start_controls_tab(
			'tabs_icon_style_hover',
			[
				'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'border_options_hover',
			[
				'label' => esc_html__( 'Border Options (Hover)', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'label' => esc_html__( 'Border (Hover)', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .social-link:hover',
			]
		);
		$this->add_control(
			'border_theme_colored_hover',
			[
				'label' => esc_html__( "Border Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .social-link' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);



		$this->add_control(
			'icon_text_color_options_hover',
			[
				'label' => esc_html__( 'Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_text_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-link:hover' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social-link:hover' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);


		$this->add_control(
			'icon_bg_options_hover',
			[
				'label' => esc_html__( 'Icon BG Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( "Icon BG Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .social-link:hover' => 'background-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .social-link:hover' => 'background-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();





		$this->add_control(
			'hr2-icon',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);



		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();

		if( isset($settings['text_alignment']) && !empty($settings['text_alignment']) ) {
			$classes[] = $settings['text_alignment'];
		}
		if( isset($settings['icon_style']) && !empty($settings['icon_style']) ) {
			$classes[] = $settings['icon_style'];
		}

		if( isset($settings['icon_size']) && !empty($settings['icon_size']) ) {
			$classes[] = $settings['icon_size'];
		}
		if( isset($settings['icon_outlined']) && !empty($settings['icon_outlined']) ) {
			$classes[] = 'links-outlined';
		}
		if( isset($settings['icon_color']) && !empty($settings['icon_color']) ) {
			$classes[] = $settings['icon_color'];
		}

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'social-links', null, 'social-links/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}

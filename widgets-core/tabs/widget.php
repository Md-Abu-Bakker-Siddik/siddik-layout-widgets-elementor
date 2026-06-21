<?php
namespace UniqueAddons\Widgets\Tabs;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Tabs extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-tabs-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/tabs' . $direction_suffix . '.css' );
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
		return 'uae-tabs';
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
		return esc_html__( 'TM Tabs', 'siddik-layout-widgets-elementor' );
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

	public function get_style_depends() {
		return [ 'tm-tabs-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Left_Nav( $this ) );
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
			'tm_general',
			[
				'label' => esc_html__( 'General', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);



		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'expand',
			[
				'label' => esc_html__( "Make It Active/Expand?", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_type',
			[
				'label' => esc_html__( 'Add Icon/Image', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'' => [
						'title' => esc_html__( 'None', 'siddik-layout-widgets-elementor' ),
						'icon' => 'fa fa-ban',
					],
					'font' => [
						'title' => esc_html__( 'Icon', 'siddik-layout-widgets-elementor' ),
						'icon' => 'far fa-smile',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'siddik-layout-widgets-elementor' ),
						'icon' => 'fa fa-image',
					]
				],
				'default' => '',
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_fontawesome',
			[
				'label' => esc_html__('Icon', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'condition' => [
					'tabs_tab_icon_type' => 'font',
				],
				'description' => esc_html__('Select icon from Fontawesome library.', 'siddik-layout-widgets-elementor'),
			]
		);
		$repeater->add_control(
			'tabs_tab_icon_thumbnail',
			[
				'label' => esc_html__('Image', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'condition' => [
					'tabs_tab_icon_type' => 'image',
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'tabs_content_type',
			[
				'label' => esc_html__('Content Type', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'content' => esc_html__('Content', 'siddik-layout-widgets-elementor'),
					'template' => esc_html__('Elementor Templates', 'siddik-layout-widgets-elementor'),
				],
				'default' => 'content',
			]
		);
		$repeater->add_control(
			'tabs_content_templates',
			[
				'label' => esc_html__('Choose Elementor Template', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => unique_addons_get_elementor_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);
		$repeater->add_control(
			'tabs_content',
			[
				'label' => esc_html__('Tab Content', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'siddik-layout-widgets-elementor' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [
					'tabs_content_type' => 'content',
				],
			]
		);
		$this->add_control(
			'tabs_items',
			[
				'label' => esc_html__( "Item", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Title 1', 'siddik-layout-widgets-elementor' ),
						'expand' => 'yes',
					],
					[
						'title' => __( 'Title 2', 'siddik-layout-widgets-elementor' ),
					],
					[
						'title' => __( 'Title 3', 'siddik-layout-widgets-elementor' ),
					],
				],
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'title_vertical_flex_settings',
			[
				'label' => esc_html__( 'Tab Block - Width/Alignment', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->add_control(
			'tabs_link_z_index',
			[
				'label' => esc_html__( "Z Index", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'z-index: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_wrapper_flex_horizontal',
			[
				'label' => esc_html__( "Horizontal Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_wrapper_title_block_each_width',
			[
				'label' => esc_html__( "Each Tab Block Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-item' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_wrapper_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_icon_vertical_flex_options',
			[
				'label' => esc_html__( 'Each Title + Icon/Image Alignment', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'tabs_icon_position',
			[
				'label' => esc_html__('Icon/Image & Title Position', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Top', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'row-reverse' => [
						'title' => esc_html__( 'Right', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Bottom', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__( 'Left', 'siddik-layout-widgets-elementor' ),
						'icon' => 'eicon-h-align-left',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_block_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'text-align: {{VALUE}};'
				],
				'default' => 'center',
			]
		);
		$this->add_responsive_control(
			'title_flex_vertical',
			[
				'label' => esc_html__( "Title + Icon Vertical Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_flex_horizontal',
			[
				'label' => esc_html__( "Title + Icon Horizontal Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'background-color: var(--theme-color{{VALUE}});'
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
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
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link',
			]
		);
		$this->add_responsive_control(
			'title_block_border_color_normal', [
				'label' => esc_html__( "Border Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-color: {{VALUE}} !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link' => 'border-color: var(--theme-color{{VALUE}}) !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link:not(.active):not(:hover):before' => 'height: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link.active',
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
					'{{WRAPPER}} .nav-tabs .nav-link.active' => 'border-color: {{VALUE}} !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link.active' => 'border-color: var(--theme-color{{VALUE}}) !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link.active:before' => 'height: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_block_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link:hover',
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
					'{{WRAPPER}} .nav-tabs .nav-link:hover' => 'border-color: {{VALUE}} !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;'
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
					'{{WRAPPER}} .nav-tabs .nav-link:hover:before' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();











		$this->start_controls_section(
			'title_styling',
			[
				'label' => esc_html__( 'Title (Tab)', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_title_style');
		$this->start_controls_tab(
			'title_style_normal',
			[
				'label' => esc_html__('Idle', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .nav-tabs .nav-link .tabs-title',
			]
		);
		$this->add_control(
			'title_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_title_margin',
			[
				'label' => esc_html__('Margin', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link .tabs-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_style_active',
			[
				'label' => esc_html__('Active', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'title_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_active',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link.active .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();




		$this->start_controls_tab(
			'title_style_hover',
			[
				'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'title_text_color_options_hover',
			[
				'label' => esc_html__( 'Text Color Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover .tabs-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover .tabs-title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


















		/**
		 * STYLE -> ICON
		 */

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon (Tab)', 'siddik-layout-widgets-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_icon_size',
			[
				'label' => esc_html__('Icon Font Size', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon:not(.tabs-icon-image)' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_icon_line_height',
			[
				'label' => esc_html__('Icon Line Height', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 38,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon:not(.tabs-icon-image)' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_icon_image_width',
			[
				'label' => esc_html__('Icon Image Width', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 26,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon.tabs-icon-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_icon_margin',
			[
				'label' => esc_html__('Margin', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_tabs' );
		$this->start_controls_tab(
			'tabs_icon_idle',
			[ 'label' => esc_html__('Idle', 'siddik-layout-widgets-elementor') ]
		);
		$this->add_control(
			'tabs_icon_color',
			[
				'label' => esc_html__('Icon Color', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_active',
			[ 'label' => esc_html__('Active', 'siddik-layout-widgets-elementor') ]
		);
		$this->add_control(
			'tabs_icon_color_active',
			[
				'label' => esc_html__('Icon Color', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .nav-link.active .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .nav-link.active .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored_active',
			[
				'label' => esc_html__( "Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-link.active .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .nav-link.active .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_hover',
			[ 'label' => esc_html__('Hover', 'siddik-layout-widgets-elementor') ]
		);
		$this->add_control(
			'tabs_icon_color_hover',
			[
				'label' => esc_html__('Icon Color', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => ['active' => true],
				'selectors' => [
					'{{WRAPPER}} .nav-link:hover .tabs-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .nav-link:hover .tabs-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tabs_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .nav-link:hover .tabs-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .nav-link:hover .tabs-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/**
		 * STYLE -> CONTENT
		 */
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Tab Content', 'siddik-layout-widgets-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
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
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__('Padding', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '32',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_margin',
			[
				'label' => esc_html__('Margin', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tabs_content_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::COLOR,
				'dynamic' => [ 'active' => true ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'tabs_content_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'tabs_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tabs_content_border',
				'selector' => '{{WRAPPER}} .tab-content .tab-pane',
			]
		);
		$this->add_responsive_control(
			'tabs_content_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-content .tab-pane' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
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
		$html = '';
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-tabs';
		$classes[] = 'tm-tabs-horizontal-nav';
		$classes[] = $settings['custom_css_class'];

		$settings['classes'] = $classes;

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('tabs');
		$settings['rand'] = rand(10,100);
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list = array();
				$i=1;
		?>
			<ul class="nav nav-tabs" id="myTab-<?php echo esc_attr($settings['holder_id']); ?>" role="tablist">
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
		<?php
			}
		?>


		<?php
			if ( $settings['tabs_items'] ) {
				$tab_id_list2 = array();
				$i=1;
		?>
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
		<?php
			}
		?>
		</div>
	<?php
	}
}
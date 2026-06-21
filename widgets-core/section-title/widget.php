<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Section_Title extends Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		if ( ! has_action( 'elementor/frontend/before_register_scripts', array( __CLASS__, 'register_widget_scripts' ) ) ) {
			add_action( 'elementor/frontend/before_register_scripts', array( __CLASS__, 'register_widget_scripts' ), 10 );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'register_widget_scripts' ), 10 );
		}
	}

	/**
	 * Register widget scripts on supported enqueue hooks.
	 *
	 * @return void
	 */
	public static function register_widget_scripts() {
		if ( wp_script_is( 'tm-section-title-split-text', 'registered' ) || ! wp_script_is( 'gsap', 'registered' ) ) {
			return;
		}

		$gsap_deps = array( 'jquery', 'gsap' );
		if ( wp_script_is( 'gsap-scrolltrigger', 'registered' ) ) {
			$gsap_deps[] = 'gsap-scrolltrigger';
		}
		if ( wp_script_is( 'gsap-splittext', 'registered' ) ) {
			$gsap_deps[] = 'gsap-splittext';
		}

		wp_register_script( 'tm-section-title-split-text', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/section-title-split-text.js', $gsap_deps, UNIQUE_ADDONS_VERSION, true );
		wp_register_script( 'tm-section-title-text-reveal', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/section-title-text-reveal.js', $gsap_deps, UNIQUE_ADDONS_VERSION, true );
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
		return 'uae-section-title';
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
		return esc_html__( 'Section Title', 'siddik-layout-widgets-elementor' );
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
		return [ 'unique-addons-elementor', 'tm-section-title-split-text' ];
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
			'title_options',
			[
				'label' => esc_html__( 'Title', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( "Title Text", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "This is a section title", 'siddik-layout-widgets-elementor' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h2',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_appear_animation', [
				'label' => esc_html__( "Appeared Animation", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_animate_css_animation_list(),
			]
		);
		$this->add_control(
			'title_part1_slide_animation', [
				'label' => esc_html__( "On Appeared Slide Animation", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'enable_gsap_text_reveal', [
				'label' => esc_html__( "Enable GSAP Text Reveal Animation", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'gsap_text_reveal_opacity',
			[
				'label' => esc_html__( "Initial Opacity", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.3,
				],
				'condition' => [
					'enable_gsap_text_reveal' => 'yes'
				],
			]
		);
		$this->add_control(
			'gsap_text_reveal_x',
			[
				'label' => esc_html__( "Initial X Offset", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => -15,
				],
				'condition' => [
					'enable_gsap_text_reveal' => 'yes'
				],
			]
		);


		$this->add_control(
			'title_other_part',
			[
				'label' => esc_html__( 'Other Parts', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title_other_text',
			[
				'label' => esc_html__( "Title Text", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'title_other_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'title_other_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_other_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .title  {{CURRENT_ITEM}}',
			]
		);
		$repeater->add_control(
			'title_other_slide_animation', [
				'label' => esc_html__( "On Appeared Slide Animation", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'siddik-layout-widgets-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .title  {{CURRENT_ITEM}}',
				'fields_options' => [
					'position' => ['default' => 'bottom center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$repeater->add_responsive_control(
			'title_bg_img_size',
			[
				'label' => esc_html__( "Background Image Size", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'background-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Text Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
            'stroke_text_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'siddik-layout-widgets-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
				'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$repeater->add_control(
			'stroke_text_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'stroke_text_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$repeater->add_control(
			'cursor_mouseover_image', [
				'label' => esc_html__( "Cursor Mouse Over Image", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'link_url',
			[
				'label' => esc_html__( "Link URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Paste URL or type', 'siddik-layout-widgets-elementor' ),
			]
		);
		$this->add_control(
			'title_list',
			[
				'label' => esc_html__( "Title Other Parts", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->add_control(
			'enable_typed_text_effect', [
				'label' => esc_html__( "Enable Typed Text Effect using these parts", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'enable_typed_text_effect_options',
			[
				'label' => esc_html__( 'Typed Text Effect Options', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'enable_typed_text_effect' => array('yes')
				]
			]
		);
		$this->add_control(
			'typed_loop', [
				'label' => esc_html__( "Autotype loop", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'siddik-layout-widgets-elementor' ),
				'label_on' => __( 'On', 'siddik-layout-widgets-elementor' ),
				'return_value' => '1',
				'default' => '1',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_cursor', [
				'label' => esc_html__( "Autotype cursor", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'siddik-layout-widgets-elementor' ),
				'label_on' => __( 'On', 'siddik-layout-widgets-elementor' ),
				'return_value' => '1',
				'default' => '1',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_cursor_char', [
				'label' => esc_html__( "Autotype cursor character", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"default" => esc_html__( '|', 'siddik-layout-widgets-elementor' ),
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_speed',
			[
				'label' => esc_html__( "Autotype speed", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __('Autotype speed', 'siddik-layout-widgets-elementor'),
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
				'default' => array(
					'size' => 6
				),
				'step' => 0.5,
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 10
					)
				)
			]
		);
		$this->add_control(
			'typed_delay',
			[
				'label' => esc_html__( "Autotype delay (in sec.)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'after',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
				'default' => array(
					'size' => 2
				),
				'step' => 0.5,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 10
					)
				)
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_other_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .title  .tm-typed-text-animation-wrapper',
			]
		);
		$this->add_control(
			'title_other_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title  .tm-typed-text-animation-wrapper' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_other_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  .tm-typed-text-animation-wrapper' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'subtitle_options',
			[
				'label' => esc_html__( 'Sub Title', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Sub Title", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'sub_title_text',
			[
				'label' => esc_html__( "Sub Title Text", 'siddik-layout-widgets-elementor' ),
				"description" => esc_html__( "It will be displayed above/under title", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "This is a Sub Title.", 'siddik-layout-widgets-elementor' ),
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_control(
			'sub_title_position',
			[
				'label' => esc_html__( "Sub Title Position", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'above-title' => esc_html__( 'Above Title', 'siddik-layout-widgets-elementor' ),
					'below-title' => esc_html__( 'Below Title', 'siddik-layout-widgets-elementor' ),
				],
				'default' => 'above-title',
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'div',
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'paragraph_options',
			[
				'label' => esc_html__( 'Paragraph', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Paragraph", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'siddik-layout-widgets-elementor' ),
				"description" => esc_html__( "It will be displayed above/under title", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description, that will describe something useful.", 'siddik-layout-widgets-elementor' ),
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General Settings', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
			'label' => esc_html__( "Custom CSS class", 'siddik-layout-widgets-elementor' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			"description" => esc_html__( 'To style particular content element.', 'siddik-layout-widgets-elementor' ),
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( "Design Style", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'style1' => esc_html__( 'Style 1 - Default', 'siddik-layout-widgets-elementor' ),
				],
				'default' => 'style1'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'horizontal_line_options',
			[
				'label' => esc_html__( 'Horizontal Line Options', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'line_bottom_style',
			[
				'label' => esc_html__( "Horizontal Line Bottom Style", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''	=> 	esc_html__( "No", 'siddik-layout-widgets-elementor' ),
					'line-left-current-theme'	=> 	esc_html__( "Style Left - Current Theme", 'siddik-layout-widgets-elementor' ),
					'line-left-current-theme-white'	=> 	esc_html__( "Style Left - Current Theme White", 'siddik-layout-widgets-elementor' ),
					'line-right-current-theme'	=> 	esc_html__( "Style Right - Current Theme", 'siddik-layout-widgets-elementor' ),
					'line-right-current-theme-white'	=> 	esc_html__( "Style Right - Current Theme White", 'siddik-layout-widgets-elementor' ),
					'line-center-current-theme'	=> 	esc_html__( "Style Center - Current Theme", 'siddik-layout-widgets-elementor' ),
					'line-center-current-theme-white'	=> 	esc_html__( "Style Center White - Current Theme", 'siddik-layout-widgets-elementor' ),
				],
				'default' => ''
			]
		);
		$this->add_responsive_control(
			'horizontal_line_align',
			[
				'label' => esc_html__('Line Horizontal Alignment', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'siddik-layout-widgets-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'siddik-layout-widgets-elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'siddik-layout-widgets-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'horizontal-line-align-',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'vertical_line_align',
			[
				'label' => esc_html__('Line Vertical Alignment', 'siddik-layout-widgets-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'bottom',
				'options' => [
					'bottom' => [
						'title' => esc_html__('Bottom', 'siddik-layout-widgets-elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
					'top' => [
						'title' => esc_html__('Top', 'siddik-layout-widgets-elementor'),
						'icon' => 'eicon-v-align-top',
					],
				],
				'prefix_class' => 'vertical-line-align-',
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs('horizontal_line_after_style');
		$this->start_controls_tab(
			'horizontal_line_after',
			[
				'label' => esc_html__('After', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'horizontal_line_after_bg_color',
			[
				'label' => esc_html__( "Color (After)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'horizontal_line_after_bgtheme_colored',
			[
				'label' => esc_html__( "Theme Color (After)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'horizontal_line_before',
			[
				'label' => esc_html__('Before', 'siddik-layout-widgets-elementor'),
			]
		);
		$this->add_control(
			'horizontal_line_before_bg_color',
			[
				'label' => esc_html__( "Color (Before)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:before' => 'background-color: {{VALUE}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'horizontal_line_before_bgtheme_colored',
			[
				'label' => esc_html__( "Theme Color (Before)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		$this->start_controls_section(
			'title_icon_options',
			[
				'label' => esc_html__( 'Title Icon', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_title_icon',
			[
				'label' => esc_html__( "Show Title Icon?", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'title_icon_position',
			[
				'label' => esc_html__( "Icon Position", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-top' => esc_html__( 'Top', 'siddik-layout-widgets-elementor' ),
					'icon-left'  => esc_html__( 'Left of Subtitle', 'siddik-layout-widgets-elementor' ),
				],
				'default' => 'icon-top',
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->add_control(
			'title_icon',
			[
				'label' => esc_html__( "Title Icon", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->add_control(
			'title_icon_custom_size',
			[
				'label' => esc_html__( "Icon Custom Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'condition' => [
					'show_title_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'title_bg_wrapper_options',
			[
				'label' => esc_html__( 'Title Background Image Options', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'siddik-layout-widgets-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .title',
				'fields_options' => [
					'position' => ['default' => 'bottom center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Sub Title Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Sub Title Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Sub Title Text Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-section-title .subtitle' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Sub Title Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Sub Title Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-section-title .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .tm-sc-section-title .subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Sub Title Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'subtitle_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'subtitle_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'subtitle_wrapper_background',
				'label' => esc_html__( 'Background', 'siddik-layout-widgets-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-section-title .title-wrapper .sub-title-outer .subtitle',
				'fields_options' => [
					'position' => ['default' => 'center center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$this->add_control(
			'subtitle_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();









		$this->start_controls_section(
			'title_shadow_text_options',
			[
				'label' => esc_html__( 'Title Shadow Text', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_shadow_text',
			[
				'label' => esc_html__( "Title Shadow Text", 'siddik-layout-widgets-elementor' ),
				"description" => esc_html__( "It will be displayed behind the title as a big blurred gray text", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shadow_text_enable_textillate_animation',
			[
				'label' => esc_html__( "Enable Text Textillate Animation on Text?", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'title_shadow_options_styling',
			[
				'label' => esc_html__( 'Title Shadow Text Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
			]
		);
		$this->add_control(
			'title_shadow_text_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_shadow_text_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title .title-shadow-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_shadow_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_shadow_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title .title-shadow-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_width',
			[
				'label' => esc_html__( "Text Container Width", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_shadow_text_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
			]
		);


		$this->add_control(
			'title_shadow_text_pos_options',
			[
				'label' => esc_html__( 'Position', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_horizontal',
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
			'title_shadow_text_orientation_offset_x',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' =>
							'{{title_shadow_text_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_vertical',
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
			'title_shadow_text_orientation_offset_y',
			[
				'label' => __( 'Offset', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' =>
							'{{title_shadow_text_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_shadow_text_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_shadow_text_opacity',
			[
				'label' => esc_html__( 'Opacity', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'paragraph_options_styling',
			[
				'label' => esc_html__( 'Paragraph Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'paragraph_color',
			[
				'label' => esc_html__( "Paragraph Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .paragraph' => 'color: {{VALUE}};',
					'{{WRAPPER}} .paragraph *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'paragraph_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .paragraph' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .paragraph *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'paragraph_theme_colored',
			[
				'label' => esc_html__( "Paragraph Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .paragraph' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .paragraph *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'paragraph_theme_colored_hover',
			[
				'label' => esc_html__( "Paragraph Theme Colored (Hover)", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .paragraph' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .paragraph *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'paragraph_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .paragraph, {{WRAPPER}} .paragraph *',
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'bg_wrapper_options',
			[
				'label' => esc_html__( 'Wrapper Background Options', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'bg_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background',
				'label' => esc_html__( 'Background', 'siddik-layout-widgets-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container',
				'fields_options' => [
					'position' => ['default' => 'center center'],
					'repeat' => ['default' => 'no-repeat'],
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
		$settings = $this->get_settings_for_display();
		$settings['title_mouse_helper'] = $this->get_render_attribute_string('title');
		//classes
		$classes = array();

		if( $settings['line_bottom_style'] ) {
			$classes[] = $settings['line_bottom_style'];
		}
		if( $settings['title_icon_position'] ) {
			$classes[] = 'title-icon-pos-'.$settings['title_icon_position'];
		}
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;


		//title classes
		$title_classes = array();
		if( isset($settings['title_appear_animation']) && !empty($settings['title_appear_animation']) ) {
			$title_classes[] = $settings['title_appear_animation'];
			unique_addons_maybe_enqueue_gsap_script( 'gsap' );
			unique_addons_maybe_enqueue_gsap_script( 'gsap-scrolltrigger' );
			unique_addons_maybe_enqueue_gsap_script( 'gsap-splittext' );
		}
		if( isset($settings['enable_gsap_text_reveal']) && $settings['enable_gsap_text_reveal'] == 'yes' ) {
			$title_classes[] = 'tm-text-reveal';
			unique_addons_maybe_enqueue_gsap_script( 'gsap' );
			unique_addons_maybe_enqueue_gsap_script( 'gsap-scrolltrigger' );
			unique_addons_maybe_enqueue_gsap_script( 'gsap-splittext' );
			if ( wp_script_is( 'tm-section-title-text-reveal', 'registered' ) ) {
				wp_enqueue_script( 'tm-section-title-text-reveal' );
			}
		}
		$settings['title_classes'] = $title_classes;


		$title_part1_classes = array();
		if( $settings['title_part1_slide_animation'] == "yes" ) {
			$title_part1_classes[] = 'tm-onappear-slide-animation';
		}
		$settings['title_part1_classes'] = $title_part1_classes;


		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('typed');
		if( $settings['enable_typed_text_effect'] == "yes" ) {
			wp_enqueue_script( 'typed', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/typed.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'typed-custom', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/typed-custom.js', array('typed'), false, true );
		}


		//sub title classes
		$sub_title_classes = array();
		$settings['sub_title_classes'] = $sub_title_classes;


		//title_shadow_text classes
		$title_shadow_text_class = array();
		if ( $settings['shadow_text_enable_textillate_animation'] == 'yes' ) {
			wp_enqueue_script( 'jquery-lettering' );
			wp_enqueue_script( 'jquery-textillate' );
			$title_shadow_text_class[] = 'tm-textillate-animation';
		}
		$settings['title_shadow_text_class'] = $title_shadow_text_class;


		$html = unique_addons_get_widgetcore_template_part( 'section-title-' . $settings['design_style'], null, 'section-title/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
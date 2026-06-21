<?php
namespace UniqueAddons\Widgets\HeroSlider;

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
class TM_Elementor_HeroSlider extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-hero-slider-loader', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/hero-slider/hero-slider-loader' . $direction_suffix . '.css' );
		}

		wp_enqueue_style( 'swiper' );
		wp_enqueue_script( 'swiper' );
		wp_register_script( 'tm-hero-slider', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/hero-slider.js', array('jquery'), false, true );
		wp_enqueue_script( array( 'tm-hero-slider' ) );
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
		return 'uae-hero-slider';
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
		return esc_html__( 'TM Hero Slider', 'siddik-layout-widgets-elementor' );
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
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
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
			'hero_slider_options', [
				'label' => esc_html__( 'Hero Items', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "This is a section subtitle", 'siddik-layout-widgets-elementor' ),
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "This is a section title", 'siddik-layout-widgets-elementor' ),
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'siddik-layout-widgets-elementor' ),
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'link_text',
			[
				'label' => esc_html__( "Link Text", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "Read more", 'siddik-layout-widgets-elementor' ),
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__( "Link URL", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$repeater->add_control(
			'featured_image_section',
			[
				'label' => esc_html__( 'Featured Image Section', 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'featured_image',
			[
				'label' => esc_html__( "Featured Image", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Featured Image Size", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'medium',
			]
		);
		$repeater->add_control(
			'featured_image_two',
			[
				'label' => esc_html__( "Thumbnail Image", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'featured_image_two_size',
			[
				'label' => esc_html__( "Thumbnail Image Size", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'thumbnail',
			]
		);
		$this->add_control(
			'hero_slider_items_array',
			[
				'label' => esc_html__( "Hero Slider Items", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'siddik-layout-widgets-elementor' ),
						'subtitle' => esc_html__( 'Subtitle #1', 'siddik-layout-widgets-elementor' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'siddik-layout-widgets-elementor' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'siddik-layout-widgets-elementor' ),
						'subtitle' => esc_html__( 'Subtitle #2', 'siddik-layout-widgets-elementor' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'siddik-layout-widgets-elementor' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'siddik-layout-widgets-elementor' ),
						'subtitle' => esc_html__( 'Subtitle #3', 'siddik-layout-widgets-elementor' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'siddik-layout-widgets-elementor' ),
					],
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'tm_animation',
			[
				'label' => esc_html__( 'Slider Default Settings', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'slider_animation', [
				'label'        => __( 'Slider Animation', 'siddik-layout-widgets-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'siddik-layout-widgets-elementor' ),
				'label_off'    => __( 'Hide', 'siddik-layout-widgets-elementor' ),
				'default'      => 'yes',
			]
		);
		$this->add_responsive_control(
			'slider_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Slider Content Width', 'siddik-layout-widgets-elementor' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Slider Height', 'siddik-layout-widgets-elementor' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slider_padding',
			[
				'label'      => __( 'Slider Padding', 'siddik-layout-widgets-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
				'{{WRAPPER}} .hero-slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
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
			'display_type', [
				'label' => esc_html__( "Display Type", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'carousel'  =>  esc_html__( 'Carousel/Slider', 'siddik-layout-widgets-elementor' ),
				],
				'default' => 'carousel'
			]
		);
		$this->add_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  =>  '1',
					'2'  =>  '2',
					'3'  =>  '3',
					'4'  =>  '4',
					'5'  =>  '5',
					'6'  =>  '6',
				],
				'default' => '4',
				'condition' => [
					'display_type!' => array('carousel')
				]
			]
		);

		//responsive grid layout
		unique_addons_elementor_grid_responsive_columns($this);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Subtitle", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
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
			'show_button', [
				'label' => esc_html__( "Show Button", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_thumb', [
				'label'        => __( 'Show Thumb', 'siddik-layout-widgets-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'siddik-layout-widgets-elementor' ),
				'label_off'    => __( 'Hide', 'siddik-layout-widgets-elementor' ),
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'show_thumb_img', [
				'label' => esc_html__( "Show Thumb Image", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition'   => [
						'show_thumb' => [ 'yes' ]
				]
			]
		);
		$this->add_control(
			'show_thumb_title', [
				'label' => esc_html__( "Show Thumb Text", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition'   => [
						'show_thumb' => [ 'yes' ]
				]
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h2'
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Subtitle Tag", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h6'
			]
		);
		$this->add_responsive_control(
			'content_alignment',
			[
				'label' => esc_html__( "Content Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'thumb_alignment',
			[
				'label' => esc_html__( "Thumb Alignment", 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
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
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .hero-slider-item .slider-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_bg_text_color',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-title' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Subtitle Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .hero-slider-item .slider-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_bg_text_color',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-subtitle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'excerpt_options_styling',
			[
				'label' => esc_html__( 'Paragraph Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'excerpt_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-details' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'excerpt_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-details' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .hero-slider-item .slider-details',
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hero-slider-item .slider-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		unique_addons_get_button_arraylist($this, 1);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		unique_addons_get_button_text_color_typo_arraylist($this, 1);
		$this->end_controls_section();






		$this->start_controls_section(
			'tm_thumb_settings',
			[
				'label' => esc_html__( 'Thumb Settings', 'siddik-layout-widgets-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'thumb_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Thumb Wrapper Width', 'siddik-layout-widgets-elementor' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-parts-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Thumb Height', 'siddik-layout-widgets-elementor' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-parts-thumbnail .thumb-item' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-parts-thumbnail .thumb-item img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_margin',
			[
				'label'      => __( 'Thumb Box Margin', 'siddik-layout-widgets-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
				'{{WRAPPER}} .tm-parts-thumbnail .thumb-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_padding',
			[
				'label'      => __( 'Thumb Box Padding', 'siddik-layout-widgets-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
				'{{WRAPPER}} .tm-parts-thumbnail .thumb-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-parts-thumbnail .thumb-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'thumb_title_bg_color',
			[
				'label' => esc_html__( "Background Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-item' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'thumb_title_img_overlay_color',
			[
				'label' => esc_html__( "Image Overlay  Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-item .thumb-inner:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'thumb_title_options_styling',
			[
				'label' => esc_html__( 'Thumb Title Styling', 'siddik-layout-widgets-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thumb_title_text_color',
			[
				'label' => esc_html__( "Text Color", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-item .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'thumb_title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'siddik-layout-widgets-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .thumb-item .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'thumb_title_typography',
				'label' => esc_html__( 'Typography', 'siddik-layout-widgets-elementor' ),
				'selector' => '{{WRAPPER}} .thumb-item .title',
			]
		);
		$this->add_responsive_control(
			'thumb_title_margin',
			[
				'label' => esc_html__( 'Margin', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .thumb-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_title_padding',
			[
				'label' => esc_html__( 'Padding', 'siddik-layout-widgets-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .thumb-item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();










		//Swiper Slider Options
		unique_addons_get_swiper_slider_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		unique_addons_get_swiper_slider_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		unique_addons_get_swiper_slider_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );






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

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'hero-slider-style1', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/hero-slider/hero-slider-style1' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		if( $settings['slider_animation'] == 'yes' ) {
			$classes[] = 'animation-yes';
		}
		$settings['classes'] = $classes;


		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//icon classes
		$icon_classes = array();

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('hero-slider');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'slider', $settings['display_type'], 'hero-slider/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}

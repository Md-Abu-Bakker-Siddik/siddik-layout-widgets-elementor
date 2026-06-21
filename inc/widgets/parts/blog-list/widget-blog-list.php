<?php

/*
 * Adds Unique_Addons_Widget_BlogList widget.
 */
if( !class_exists( 'Unique_Addons_Widget_BlogList' ) ) {
class Unique_Addons_Widget_BlogList extends Unique_Addons_Widget_Loader {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->widgetOptions = array(
			'classname'		=> 'widget-blog-list clearfix',
			'description'	=> esc_html__( 'A widget that displays list of blog posts.', 'siddik-layout-widgets-elementor' ),
		);
		parent::__construct( 'tm_widget_blog_list', esc_html__( '(TM) Latest News', 'siddik-layout-widgets-elementor' ), $this->widgetOptions );
		$this->getFormFields();
	}


	/**
	 * Get form fields of the widget.
	 */
	protected function getFormFields() {
		$this->formFields = array(
			array(
				'id'		=> 'title',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Widget Title:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'default'	=> esc_html__( 'Latest News', 'siddik-layout-widgets-elementor' ),
			),
			array(
				'id'		=> 'custom_css_class',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Custom CSS Class:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> esc_html__( 'To style particular content element', 'siddik-layout-widgets-elementor' ),
			),
			array(
				'id'		=> 'num_of_posts',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Number of Posts:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'limit_title_words',
				'type'		=> 'text',
				'title'		=> esc_html__( 'Limit number of words to display in title:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
			),
			array(
				'id'		=> 'blog_category',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Blog Category:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'options'	=> unique_addons_get_post_all_categories_array()
			),
			array(
				'id'		=> 'order_by',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Order By:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'options'	=> array(
					'title'		=> esc_html__( 'Title', 'siddik-layout-widgets-elementor' ),
					'date'			=> esc_html__( 'Date', 'siddik-layout-widgets-elementor' ),
					'comment_count' => esc_html__( 'Number of Comments', 'siddik-layout-widgets-elementor' )
				)
			),
			array(
				'id'		=> 'order',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Order:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'options'	=> array(
					'DESC' => esc_html__( 'DESC', 'siddik-layout-widgets-elementor' ),
					'ASC'  => esc_html__( 'ASC', 'siddik-layout-widgets-elementor' )
				)
			),
			array(
				'id'		=> 'disable_thumb',
				'type'		=> 'checkbox',
				'title'		=> esc_html__( 'Disable Thumbnail', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'value'	=> 'on',
			),
			array(
				'id'		=> 'post_title_tag',
				'type'		=> 'dropdown',
				'title'		=> esc_html__( 'Post Title Tag:', 'siddik-layout-widgets-elementor' ),
				'desc'		=> '',
				'options'	=> array(
					'h6' => 'h6',
					'h5' => 'h5',
					'h4' => 'h4',
					'h3' => 'h3',
					'h2' => 'h2',
				)
			),
		);
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args	 Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] );
		}

		//default posts per page
		$posts_per_page = ( $instance['num_of_posts'] == '' ) ? -1 : $instance['num_of_posts'];
		//query args
		$query_args = array(
			'orderby' => $instance['order_by'],
			'order' => $instance['order'],
			'category__in' => $instance['blog_category'],
			'posts_per_page' => $posts_per_page,
		);

		$the_query = new \WP_Query( $query_args );
		$instance['the_query'] = $the_query;

		$instance['disable_thumb'] = isset($instance['disable_thumb']) ? $instance['disable_thumb'] : '';

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, widget_ob_start)
		$html = unique_addons_get_widget_template_part( 'blog-list', null, 'blog-list/tpl', $instance, false );

		echo wp_kses_post($args['after_widget']);
	}
}
}
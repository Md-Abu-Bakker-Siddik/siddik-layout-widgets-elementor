<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
    <div class="tab-pane fade <?php if($expand === 'yes') { echo esc_html( 'show active' ); }?>" id="<?php echo esc_attr($tab_id_list[$i]); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id_list[$i]); ?>-tab">
      <div class="tab-content-inner">
      <?php
        if ( 'content' === $tabs_content_type ) {
            echo wp_kses_post( do_shortcode( $tabs_content ) );
        } elseif ( 'template' === $tabs_content_type ) {
            $id      = absint( $tabs_content_templates );
            $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $id );
            unique_addons_print_elementor_template_content( $content );
        }
      ?>
      </div>
    </div>
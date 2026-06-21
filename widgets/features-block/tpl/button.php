<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="btn-view-details">
    <a
      <?php unique_addons_print_link_target_attrs( $features_link ); ?>
      href="<?php echo esc_url( $features_link['url'] );?>"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>
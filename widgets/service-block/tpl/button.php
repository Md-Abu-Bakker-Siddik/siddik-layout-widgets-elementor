<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="btn-view-details">
    <a
      <?php unique_addons_print_link_target_attrs( $feature_link ); ?>
      href="<?php echo esc_url( $feature_link['url'] );?>" aria-label="Read More"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( $settings['show_button'] == 'yes' ) { ?>
<div class="btn-view-details slider-btn-area <?php if( isset($settings['button_alignment']) & !empty($settings['button_alignment']) ) echo esc_attr( $settings['button_alignment'] );?>">
    <a
      <?php unique_addons_print_link_target_attrs( $feature_link ); ?>
      href="<?php echo esc_url( $feature_link['url'] );?>" aria-label="Read More"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>
<?php } ?>
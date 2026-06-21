<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings;?>
<div class="tm-sc-info-box tm-info-box-skin8">
  <div class="info-box-wrapper">
    <div class="icon-wrapper elementor-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
    <div class="info-text">
      <?php unique_addons_get_widgetcore_template_part( 'title', null, 'info-box/tpl', $settings, false );?>
      <div class="text"><?php echo wp_kses_post( $content ); ?></div>
    </div>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php unique_addons_get_widgetcore_template_part( 'button', null, 'info-box/tpl', $settings, false );?>
    <?php endif; ?>
    <div class="bottom-circle"></div>
  </div>
</div>
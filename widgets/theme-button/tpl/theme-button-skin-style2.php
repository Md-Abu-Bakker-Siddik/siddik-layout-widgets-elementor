<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings;?>
<a href="<?php echo esc_url( $button['url'] ); ?>"
	<?php unique_addons_print_link_target_attrs( $link ); ?>
	class="btn-style2">

  <span class="theme-btn-arrow-left">
		<?php if( ! empty( $button_icon['value'] ) ) { ?>
		  <?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?>
		<?php }?>
  </span>
  <span class="theme-btn">
		<?php
			if( !empty( $button_text ) ) {
				echo esc_html( $button_text );
			}
		?>
  </span>
  <span class="theme-btn-arrow-right">
		<?php if( ! empty( $button_icon['value'] ) ) { ?>
		  <?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?>
		<?php }?>
  </span>
</a>
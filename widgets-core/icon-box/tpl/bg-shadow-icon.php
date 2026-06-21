<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	<?php if ( ! empty( $show_bg_shadow_icon ) && 'yes' === $show_bg_shadow_icon ) : ?>
		<div class="bg-shadow-icon">
		<?php if( isset($icon_type) ) { ?>
			<?php unique_addons_get_widgetcore_template_part( 'icon-type', $icon_type, 'icon-box/tpl', $settings, false );?>
		<?php } ?>
		</div>
	<?php endif; ?>
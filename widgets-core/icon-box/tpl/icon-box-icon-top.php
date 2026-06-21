<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="tm-sc-icon-box icon-box icon-top <?php if ( ! empty( $classes ) ) { echo esc_attr( implode( ' ', $classes ) ); } ?>">
	<?php unique_addons_get_widgetcore_template_part( 'bgimg-hover', null, 'icon-box/tpl', $settings, false ); ?>
	<div class="icon-box-wrapper">
		<?php unique_addons_get_widgetcore_template_part( 'icon', null, 'icon-box/tpl', $settings, false ); ?>
		<div class="icon-text">
			<?php if ( ! empty( $settings['switch_title_content_pos'] ) && 'yes' === $settings['switch_title_content_pos'] ) { ?>
			<?php unique_addons_get_widgetcore_template_part( 'content', null, 'icon-box/tpl', $settings, false );?>
			<?php unique_addons_get_widgetcore_template_part( 'title', null, 'icon-box/tpl', $settings, false );?>
			<?php } else {?>
			<?php unique_addons_get_widgetcore_template_part( 'title', null, 'icon-box/tpl', $settings, false );?>
			<?php unique_addons_get_widgetcore_template_part( 'content', null, 'icon-box/tpl', $settings, false );?>
			<?php }?>

			<?php unique_addons_get_widgetcore_template_part( 'bg-shadow-icon', null, 'icon-box/tpl', $settings, false );?>

			<?php if ( ! empty( $show_view_details_button ) && 'yes' === $show_view_details_button ) : ?>
			<?php unique_addons_get_widgetcore_template_part( 'button', null, 'icon-box/tpl', $settings, false );?>
			<?php endif; ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
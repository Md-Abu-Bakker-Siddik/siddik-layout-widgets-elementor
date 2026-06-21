<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="clearfix">
	<div class="icon"><?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?></div>
	<?php if(!empty($prefix)) {?><div class="prefix"><?php echo esc_html( $prefix );?></div><?php } ?>
	<div class="text">
		<<?php echo esc_attr( $title_tag );?>
		<?php if ( 'a' === $title_tag ) : ?>
		href="<?php echo esc_url( $link_url['url'] ); ?>"
		<?php unique_addons_print_link_target_attrs( $link_url ); ?>
		<?php endif; ?>
		>
		<?php echo esc_html( $title );?>
		</<?php echo esc_attr( $title_tag );?>>
	</div>
</li>
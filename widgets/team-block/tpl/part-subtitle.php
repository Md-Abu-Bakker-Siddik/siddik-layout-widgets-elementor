<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( $settings['show_subtitle'] == 'yes' ) { ?>
	<?php if( !empty( $subtitle ) ) : ?>
	<<?php echo esc_attr( $subtitle_tag );?> class="team-subtitle">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php unique_addons_print_link_target_attrs( $feature_link ); ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo esc_html( $subtitle );?>
		</a>
		<?php else: ?>
			<?php echo esc_html( $subtitle );?>
		<?php endif ?>
	</<?php echo esc_attr( $subtitle_tag );?>>
	<?php endif; ?>
<?php } ?>
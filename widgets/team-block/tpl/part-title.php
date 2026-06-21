<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	//link url
		$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="team-title">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php unique_addons_print_link_target_attrs( $feature_link ); ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo esc_html( $title ); ?>
		</a>
		<?php else: ?>
			<?php echo esc_html( $title ); ?>
		<?php endif ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

		<?php if( !empty( $title ) ) : ?>
		<<?php echo esc_attr( $title_tag );?> class="icon-box-title <?php echo esc_attr(implode(' ', $title_classes)); ?>">
			<?php if( !empty( $url ) && $link_title === 'yes' ): ?>
			<a 
				<?php unique_addons_print_link_target_attrs( $link ); ?>
				href="<?php echo esc_url( $url ); ?>">
				<?php echo wp_kses_post( $title ); ?>
			</a>
			<?php else: ?>
				<?php echo wp_kses_post( $title ); ?>
			<?php endif ?>
		</<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>
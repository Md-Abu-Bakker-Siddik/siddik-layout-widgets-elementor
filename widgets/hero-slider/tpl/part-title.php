<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="slider-title">
		<?php echo esc_html( $title ); ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>
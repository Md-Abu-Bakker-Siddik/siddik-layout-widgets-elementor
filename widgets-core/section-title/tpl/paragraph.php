<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<?php if ( $content ) { ?>
	<div class="paragraph">
		<?php echo wp_kses_post( $content ); ?>
	</div>
	<?php } ?>
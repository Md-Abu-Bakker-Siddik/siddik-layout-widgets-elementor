<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( ! empty( $show_paragraph ) && 'yes' === $show_paragraph ) { ?>
<div class="content"><?php echo wp_kses_post( $content ); ?></div>
<?php } ?>
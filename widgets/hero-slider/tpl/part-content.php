<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( $settings['show_paragraph'] == 'yes' ) { ?>
<div class="slider-details"><?php echo wp_kses_post( $content ); ?></div>
<?php } ?>
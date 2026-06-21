<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings;?>
<a href="<?php echo esc_url( $button['url'] ); ?>"
	<?php unique_addons_print_link_target_attrs( $link ); ?>
	class="theme-btn btn-style5">
	<span class="btn-title">
		<?php
			if( !empty( $button_text ) ) {
				echo esc_html( $button_text );
			}
		?>
	</span>
	<span class="dot-box"><span class="dot-item"></span></span>
</a>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="title-wrapper">
<?php if(isset($subtitle) && !empty($subtitle)) { ?>
<<?php echo esc_attr( $subtitle_tag );?> class="subtitle"><?php echo esc_html( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag );?>>
<?php } ?>

<<?php echo esc_attr( $title_tag );?> class="title <?php echo esc_attr(implode(' ', $title_classes)); ?>"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag );?>>
</div>
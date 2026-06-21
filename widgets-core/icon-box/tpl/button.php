<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="btn-view-details <?php if(isset($button_alignment)) echo esc_attr( $button_alignment );?>">
    <a  
      <?php unique_addons_print_link_target_attrs( $link ); ?>
      href="<?php echo esc_url( $url );?>"
      class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
      <?php echo esc_html( $view_details_button_text  ); ?>
    </a>
</div>
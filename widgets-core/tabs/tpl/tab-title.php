<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

    <li class="nav-item <?php if($expand === 'yes') { echo esc_html( 'active' ); }?>" role="presentation">
      <a class="nav-link <?php if($expand === 'yes') { echo esc_html( 'active' ); }?>" id="<?php echo esc_attr($tab_id_list[$i]); ?>-tab" data-bs-toggle="tab" href="#<?php echo esc_attr($tab_id_list[$i]); ?>" role="tab" aria-controls="<?php echo esc_attr($tab_id_list[$i]); ?>" aria-selected="true">

        <?php echo wp_kses_post( $icon_html_code ); ?>

        <span class="tabs-title"><?php echo esc_html( $title ); ?></span>
      </a>
    </li>

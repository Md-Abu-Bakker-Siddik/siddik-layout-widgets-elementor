
	<ul class="social-share-icons-text list-inline">
	<?php foreach ( $enabled_social_networks as $key => $value ) { if ( $key != "placebo" ) { ?>
		<li class="list-inline-item"><a target="_blank" <?php if ( $tooltip_directions != 'none' ) { ?> data-toggle="tooltip" data-placement="<?php echo esc_attr( $tooltip_directions );?>"<?php } ?> title="<?php echo esc_attr( $social_network_list[$key]['text'] );?>" class="<?php echo esc_attr( $key );?>" href="<?php echo esc_url( $social_network_list[$key]['href'] );?>"><?php echo esc_html( $social_network_list[$key]['name'] );?></a></li>
	<?php } } ?>
	</ul>
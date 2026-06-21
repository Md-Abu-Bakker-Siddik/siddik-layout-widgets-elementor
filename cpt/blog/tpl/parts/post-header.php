<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	<?php if ( $show_featured_image == 'yes' ) : ?>
	<div class="entry-header">
		<?php unique_addons_get_post_thumbnail( $post_format, $featured_image_size ); ?>
	</div>
	<?php endif; ?>
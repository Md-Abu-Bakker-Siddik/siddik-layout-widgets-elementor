<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings;?>
<article <?php post_class(); ?>>
	<div class="link-content">
		<?php do_action( 'unique_addons_blog_post_entry_header_start' ); ?>
		<?php unique_addons_get_post_thumbnail( $post_format, $featured_image_size ); ?>
		<?php do_action( 'unique_addons_blog_post_entry_header_end' ); ?>
	</div>
</article>
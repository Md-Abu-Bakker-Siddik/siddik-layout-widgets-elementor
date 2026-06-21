<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- News Block -->
<div class="blog-item-current-style1">
	<div class="thumb">
		<?php unique_addons_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
		<?php unique_addons_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
		<span class="date">
			<?php echo esc_html( get_the_date('d') ); ?>
		</span>
	</div>
	<div class="content">
		<?php if ( $show_title == 'yes' ) : ?>
			<?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
		<?php endif; ?>
		<?php if ( $show_excerpt == 'yes' ) : ?>
				<?php if ( empty($excerpt_length) ) { ?>
					<?php unique_addons_get_excerpt(); ?>
				<?php } else { ?>
					<?php unique_addons_get_excerpt($excerpt_length); ?>
				<?php } ?>
		<?php endif; ?>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php the_permalink();?>" class="link-btn">
				<?php echo esc_html( $view_details_button_text ); ?> <i class="fa fa-arrow-right"></i>
			</a>
		<?php endif; ?>
	</div>
</div>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 if ( $the_query->have_posts() ) : ?>
  <div class="tm-widget-blog-list <?php echo esc_attr( $custom_css_class );?>">
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<article class="post media-post clearfix">
		<?php if ( $show_featured_image == 'yes' ) : ?>
		<a class="post-thumb" href="<?php the_permalink();?>">
			<?php the_post_thumbnail( $featured_image_size ); ?>
		</a>
		<?php endif; ?>
		<div class="post-right">
			<?php if ( $show_post_meta == 'yes' &&  $post_meta_placement == 'top' ) : ?>
			<?php unique_addons_post_shortcode_meta( $post_meta_options ); ?>
			<?php endif; ?>

			<?php if ( $show_title == 'yes' ) : ?>
			<div class="title-holder">
				<<?php echo esc_attr( $title_tag );?> class="entry-title">
					<a href="<?php the_permalink();?>">
						<?php
							if ( empty($title_length) ) {
								the_title();
							} else {
								$title = get_the_title();
								echo wp_kses_post( unique_addons_slice_text_by_length( $title, $title_length ) );
							}
						?>
					</a>
				</<?php echo esc_attr( $title_tag );?>>
			</div>
			<?php endif; ?>

			<?php if ( $show_post_meta == 'yes' &&  $post_meta_placement == 'center' ) : ?>
			<?php unique_addons_post_shortcode_meta( $post_meta_options ); ?>
			<?php endif; ?>

			<?php if ( $show_excerpt == 'yes' ) : ?>
				<div class="post-excerpt">
					<?php if ( empty($excerpt_length) ) { ?>
						<?php unique_addons_get_excerpt(); ?>
					<?php } else { ?>
						<?php unique_addons_get_excerpt($excerpt_length); ?>
					<?php } ?>
				</div>
			<?php endif; ?>

			<?php if ( $show_post_meta == 'yes' &&  $post_meta_placement == 'bottom' ) : ?>
			<?php unique_addons_post_shortcode_meta( $post_meta_options ); ?>
			<?php endif; ?>
		</div>
	</article>
	<?php endwhile; ?>
	<!-- end of the loop -->
  </div>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>
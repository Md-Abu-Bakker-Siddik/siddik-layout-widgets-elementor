<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( $the_query->have_posts() ) : ?>
  <div class="tm-widget tm-widget-blog-list <?php echo esc_attr( $custom_css_class );?>">
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<article class="post media-post clearfix">
		<?php if( $disable_thumb != 'on' ): ?>
		<a class="post-thumb" href="<?php the_permalink();?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
		<?php endif; ?>
		<div class="post-right">
		<<?php echo esc_attr( $post_title_tag );?> class="post-title">
			<a href="<?php the_permalink();?>">
				<?php
					if( !isset($limit_title_words) ) {
						the_title();
					} else {
						$title = get_the_title();
						echo wp_kses_post( unique_addons_slice_text_by_length( $title, $limit_title_words ) );
					}
				?>
			</a>
		</<?php echo esc_attr( $post_title_tag );?>>
		<?php unique_addons_posted_on_date();?>
		</div>
	</article>
	<?php endwhile; ?>
	<!-- end of the loop -->
  </div>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>
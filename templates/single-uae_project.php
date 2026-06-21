<?php
/**
 * Single project fallback template.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="uae-cpt-template uae-cpt-template--single-project site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'uae-project-item' ); ?>>
			<header class="uae-project-item__header entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="uae-project-item__thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
				<div class="uae-project-item__meta entry-meta">
					<?php echo wp_kses_post( get_the_term_list( get_the_ID(), 'uae_project_cat', '<span class="uae-project-item__categories">', ', ', '</span>' ) ); ?>
				</div>
			</header>
			<div class="uae-project-item__content entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	endwhile;
	?>
</main>
<?php
get_footer();

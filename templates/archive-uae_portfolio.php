<?php
/**
 * Portfolio archive fallback template.
 *
 * Used only when the active theme does not provide archive-uae_portfolio.php.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="uae-cpt-template uae-cpt-template--archive-portfolio site-main">
	<header class="uae-portfolio-archive__header page-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="uae-portfolio-archive__grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'uae-portfolio-archive__item' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="uae-portfolio-archive__thumb" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium_large' ); ?>
						</a>
					<?php endif; ?>
					<h2 class="uae-portfolio-archive__title entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php if ( has_excerpt() ) : ?>
						<div class="uae-portfolio-archive__excerpt"><?php the_excerpt(); ?></div>
					<?php endif; ?>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No portfolio items found.', 'siddik-layout-widgets-elementor' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();

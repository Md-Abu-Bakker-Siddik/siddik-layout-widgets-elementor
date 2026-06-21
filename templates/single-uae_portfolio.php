<?php
/**
 * Single portfolio fallback template.
 *
 * Used only when the active theme does not provide single-uae_portfolio.php.
 *
 * @package SiddikLayoutWidgetsElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="primary" class="uae-cpt-template uae-cpt-template--single-portfolio site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'uae-portfolio-item' ); ?>>
			<header class="uae-portfolio-item__header entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="uae-portfolio-item__thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
				<div class="uae-portfolio-item__meta entry-meta">
					<?php echo wp_kses_post( get_the_term_list( get_the_ID(), 'uae_portfolio_cat', '<span class="uae-portfolio-item__categories">', ', ', '</span>' ) ); ?>
				</div>
			</header>
			<div class="uae-portfolio-item__content entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>
<?php
get_footer();

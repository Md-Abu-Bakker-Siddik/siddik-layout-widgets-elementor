<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 $settings['settings'] = $settings;?>
<article <?php post_class(); ?>>
	<?php unique_addons_get_cpt_shortcode_template_part( 'each-item', $settings['_skin'], 'blog/tpl/design-style', $settings, false ); ?>
</article>
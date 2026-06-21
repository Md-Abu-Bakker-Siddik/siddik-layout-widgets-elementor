<?php
$loaders = array(
	'cpt/projects/loader.php',
	'inc/post-types/portfolio/loader.php',
	'inc/widgets/parts/blog-list/loader.php',
	'inc/social-share/loader.php',
	'inc/post-types/side-push-panel/loader.php',
	'inc/post-types/projects/loader.php',
	'inc/post-types/page-title/loader.php',
	'inc/post-types/megamenu/loader.php',
	'inc/post-types/header-top/loader.php',
	'inc/post-types/footer/loader.php',
	'elementor-elements/loader.php',
);

$root = dirname( __DIR__ );
$guard = "if ( ! defined( 'ABSPATH' ) ) {\n\texit;\n}\n\n";

foreach ( $loaders as $rel ) {
	$path = $root . DIRECTORY_SEPARATOR . str_replace( '/', DIRECTORY_SEPARATOR, $rel );
	if ( ! is_file( $path ) ) {
		echo "Missing: $rel\n";
		continue;
	}

	$content = file_get_contents( $path );
	if ( false !== strpos( $content, 'ABSPATH' ) ) {
		echo "Skipped (already guarded): $rel\n";
		continue;
	}

	$content = preg_replace( '/^<\?php\r?\n/', "<?php\n" . $guard, $content, 1 );
	file_put_contents( $path, $content );
	echo "Guarded: $rel\n";
}

<?php
$plugin_dir = dirname( __DIR__ );
$guard      = "if ( ! defined( 'ABSPATH' ) ) {\n\texit;\n}\n";
$scan_roots = array( 'widgets', 'widgets-core', 'widgets-shop', 'cpt', 'templates' );
$fixed      = 0;

foreach ( $scan_roots as $root ) {
	$base = $plugin_dir . DIRECTORY_SEPARATOR . $root;
	if ( ! is_dir( $base ) ) {
		continue;
	}

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $base, FilesystemIterator::SKIP_DOTS )
	);

	foreach ( $iterator as $file ) {
		if ( ! $file->isFile() || 'php' !== $file->getExtension() ) {
			continue;
		}

		$content = file_get_contents( $file->getPathname() );
		if ( false === $content || strpos( $content, 'ABSPATH' ) !== false ) {
			continue;
		}

		if ( strncmp( $content, '<?php', 5 ) === 0 ) {
			$rest = substr( $content, 5 );
			$new_content = "<?php\n" . $guard . ltrim( $rest, "\r\n" );
		} else {
			$new_content = "<?php\n" . $guard . "?>\n" . $content;
		}

		file_put_contents( $file->getPathname(), $new_content );
		++$fixed;
	}
}

echo "Added ABSPATH guard to {$fixed} file(s).\n";

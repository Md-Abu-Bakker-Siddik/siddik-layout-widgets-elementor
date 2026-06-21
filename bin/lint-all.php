<?php
$dir = dirname( __DIR__ );
$it  = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir ) );
$errors = 0;

foreach ( $it as $file ) {
	if ( ! $file->isFile() || 'php' !== $file->getExtension() || 'lint-all.php' === $file->getFilename() ) {
		continue;
	}

	$output = array();
	$code   = 0;
	exec( 'D:\\xampp\\php\\php.exe -l ' . escapeshellarg( $file->getPathname() ) . ' 2>&1', $output, $code );
	if ( 0 !== $code ) {
		++$errors;
		echo implode( PHP_EOL, $output ) . PHP_EOL;
	}
}

echo PHP_EOL . "Total syntax errors: {$errors}" . PHP_EOL;
exit( $errors > 0 ? 1 : 0 );

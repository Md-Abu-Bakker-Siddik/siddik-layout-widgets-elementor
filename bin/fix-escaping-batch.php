<?php
$root = dirname( __DIR__ );
$it   = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $root ) );
$n    = 0;

foreach ( $it as $f ) {
	if ( 'php' !== $f->getExtension() ) {
		continue;
	}
	if ( false !== strpos( $f->getPathname(), DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR ) ) {
		continue;
	}

	$c = file_get_contents( $f->getPathname() );
	$o = $c;

	$c = str_replace(
		'<?php echo html_entity_decode( esc_attr( implode(\' \', $swiper_slide_data_info) ) ) ?>',
		'<?php unique_addons_print_pre_escaped_html_attrs( $swiper_slide_data_info ); ?>',
		$c
	);
	$c = str_replace(
		'<?php echo html_entity_decode( esc_attr( $animation_duration ) );?>',
		'<?php unique_addons_print_pre_escaped_html_attrs( $animation_duration ); ?>',
		$c
	);

	if ( $c !== $o ) {
		file_put_contents( $f->getPathname(), $c );
		$n++;
	}
}

echo 'Updated ' . $n . " files\n";

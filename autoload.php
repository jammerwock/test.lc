<?php
$autoload_dirs = array( '.','classes', 'libs/google-api/src');

spl_autoload_register( function ($name) use($autoload_dirs) {
	$name = str_replace( '\\', DIRECTORY_SEPARATOR, $name );
	foreach ( $autoload_dirs as $dir ) {
		if ( is_readable( $dir . "/" . $name . ".php" ) ) {
			include_once($dir . "/" . $name . ".php");
			return;
		}
	}
} );
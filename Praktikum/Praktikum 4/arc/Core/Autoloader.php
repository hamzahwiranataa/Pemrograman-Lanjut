<?php

spl_autoload_register(function ($class) {
	// Only autoload classes from the App namespace
	$prefix = 'App\\';
	$base_dir = __DIR__ . '/../';

	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		// Not an App class
		return;
	}

	// Get the relative class name
	$relative_class = substr($class, $len);
	// Replace namespace separators with directory separators, append .php
	$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

	if (file_exists($file)) {
		require_once $file;
	}
});

?>

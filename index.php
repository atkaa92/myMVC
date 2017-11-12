<?php 
	spl_autoload_register(function ($class_name) {
		$filename = str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
	    include $filename;
	});

	use system\Routes;
	new Routes;
 ?>
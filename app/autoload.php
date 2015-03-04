<?php
	require_once __DIR__ . '/../vendor/autoload.php';

	// simple one folder layer and no namespace autoloader...
	$root = __DIR__ . '/';
	$folderNames = array('models','helpers', 'components', 'gateways', 'controllers');
	spl_autoload_register(function($clazz) use ($root, $folderNames){
		foreach($folderNames as $folderName) {

			$path = $root . $folderName . '/' . $clazz . '.php';
			if (is_readable($path)) {
				require_once $path;
				break;
			}
		}
	});

	require_once __DIR__ . '/config/db.php';
?>
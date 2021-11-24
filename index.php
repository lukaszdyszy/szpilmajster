<?php
	require_once('functions.php');

	$uri = splitURL();

	$db = dbConnect();
	if(!$db){
		include('views/errors/dberror.php');
		die();
	}

	$controller = empty($uri[0]) ? 'home' : $uri[0];

	if(!file_exists('controllers/'.$controller.'.controller.php')){
		include('views/errors/404.php');
		die();
	}

	include('controllers/'.$controller.'.controller.php');
	$controller = ucwords($controller);

	include('views/includes/header.php');
	$c = new $controller();
	include('views/includes/footer.php');
?>

<?php
	require_once('functions.php');

	$uri = splitURL();

	$controller = empty($uri[0]) ? 'home' : $uri[0];
	echo $controller;
?>

<?php
	/** define paths ---------------------- */
	define('ROOT', $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR);
	define('CONTROLLER', ROOT.'controllers'.DIRECTORY_SEPARATOR);
	define('VIEW', ROOT.'views'.DIRECTORY_SEPARATOR);
	define('ERROR', VIEW.'errors'.DIRECTORY_SEPARATOR);
	define('MODEL', ROOT.'models'.DIRECTORY_SEPARATOR);
	/** =================================== */
	
	try {
		require_once('functions.php');
		require_once('exceptions.php');
		require_once('db.config.php');
	
		$uri = splitURL();	// przygotowanie parametrów na podstawie adresu zapytania
		
		// połączenie z bazą
		$db = new PDO('mysql:dbname='.$db_name.';host='.$db_host, $db_user, $db_pass);
	
		$controller = strtolower(empty($uri[0]) ? 'home' : $uri[0]);	// controller - default 'home'
		$action		= strtolower(empty($uri[1]) ? 'index' : $uri[1]);	// action - default index

		// error 404 jeśli controller nie istnieje
		if(!file_exists(CONTROLLER.$controller.'.controller.php')) throw new NotFoundException();
		
		// w przeciwnym razie include controller
		include(CONTROLLER.$controller.'.controller.php');
		$controller = ucwords($controller);

		$controller = new $controller(array_slice($uri, 2));	// instancja controllera
		$controller->$action();	// wywołanie akcji
	} catch (PDOException $e) {	// błąd bazy danych
		http_response_code(500);
		include(ERROR.'dberror.php');
	}catch (NotFoundException $e) {	// nie znaleziono strony
		http_response_code(404);
		include(ERROR.'404.php');
	} 
?>

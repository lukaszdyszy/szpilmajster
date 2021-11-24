<?php
	function splitURL(){
		return  explode('/', trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'));
	}

	function dbConnect(){
		include('db.config.php');
		try {
			return new PDO('mysql:dbname='.$db_name.';host='.$db_host, $db_user, $db_pass);
		} catch (PDOException $e) {
			return false;
		}
	}
?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/controllers/controller.php');

class Article extends Controller
{
	public function __construct(){
		global $uri;
		if(!isset($uri[1])){
			header('Location: /');
		}else{
			echo "Artyku nr ".$uri[1];
		}
	}
}


?>
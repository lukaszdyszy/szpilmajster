<?php
require($_SERVER['DOCUMENT_ROOT'].'/controllers/controller.php');
require($_SERVER['DOCUMENT_ROOT'].'/models/article.model.php');

class Home extends Controller
{
	private $articleModel;

	public function __construct(){
		global $db;
		$this->articleModel = new Article($db);
		echo '<main class="main-content">Home page</main>';
	}
	
}
?>
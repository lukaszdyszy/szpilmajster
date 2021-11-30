<?php
require(CONTROLLER.'controller.php');

class Home extends Controller
{
	public function index(){
		try {
			$articleModel = $this->loadModel('article');
			$result = $articleModel->getPage(2);
			print_r($result);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}
?>
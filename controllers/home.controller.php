<?php
require(CONTROLLER.'controller.php');

class Home extends Controller
{
	public function index(){
		try {
			$articleModel = $this->loadModel('article');
			$homeView = $this->loadView('home');
			$this->render($articleModel->getPage(1));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	// wyświetlanie strony artykułów o najnowszego (home/newest/:nr_strony) - 6 artykułów na stronę (albo więcej, jak tam chcecie XD);
	public function newest(){
		throw new NotImplementedException();
	}
}
?>
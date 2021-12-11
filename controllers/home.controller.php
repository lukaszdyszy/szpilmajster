<?php
require_once(CONTROLLER.'controller.php');

class Home extends Controller
{
	public function index(){
		try {
			$articleModel = $this->loadModel('article');
			$this->loadView('home');

			$newest = $articleModel->getPage(1);
			$recommended = $articleModel->getRecommended();

			$this->data = array(
				'recommended'	=> $recommended,
				'articles'		=> $newest
			);

			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
	}
	
	// wyświetlanie strony artykułów od najnowszego (home/newest/:nr_strony) - 6 artykułów na stronę
	public function newest(){
		try {
			$articleModel = $this->loadModel('article');
			
			$page = intval($this->params[0])===0 ? 1 : intval($this->params[0]);

			$pages = ceil($articleModel->getNrOfArticles()['number']/6);
			if($pages < $page) $page = $pages;
			
			$newest = $articleModel->getPage($page);

			$this->data = array(
				'articles'	=> $newest,
				'pages'		=> $pages,
				'page'		=> $page
			);

			$this->loadView('newest');
			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}
}
?>
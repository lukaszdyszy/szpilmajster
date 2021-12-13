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

	// artykuły z konkretnej kategorii
	public function category()
	{
		try {
			$articleModel = $this->loadModel('article');

			$category	= $this->params[0];
			$page		= (intval($this->params[1])===0 || empty($this->params[1])) ? 1 : intval($this->params[1]);

			$pages = ceil($articleModel->getNrOfArticlesCategory($category)['number']/6);
			if($pages < $page) $page = $pages;

			$articles = $articleModel->getPageCategory($page, $category);

			$this->data = array(
				'articles'	=> $articles,
				'pages'		=> $pages,
				'page'		=> $page,
				'category'	=> $category
			);

			$this->loadView('category');
			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
	}
}
?>
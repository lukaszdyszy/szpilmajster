<?php
require(CONTROLLER.'controller.php');

class Single extends Controller
{
	public function index(){
		throw new NotFoundException();
	}

	// wyświetlanie pojedynczego artykułu (single/read/:id)
	public function read(){
		try {
			$articleModel = $this->loadModel('article');
			$article = $articleModel->getArticleById($this->params[0]);
			if(!$article) throw new NotFoundException();
			$this->loadView('single');
			$this->render($article);
		} catch (PDOException $e) {
			throw $e;
		} catch (FunctionalityException $e) {
			throw $e;
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}

	// dodawanie nowego artykułu (single/write)
	public function write(){
		throw new NotImplementedException();
	}

	// modyfikacja artykułu (single/edit)
	public function edit(){
		throw new NotImplementedException();
	}
}
?>
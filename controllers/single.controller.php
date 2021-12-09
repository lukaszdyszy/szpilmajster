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
		$data = array('errors' => '');

		$title = '';
		$content = '';
		$category = 13;
		$image = 'placeholder.png';

		// sprawdź uprawnienia użytkownika
		if(!isset($_SESSION['logged']) || $_SESSION['logged']['id_role'] > 3){
			throw new UnauthorizedException();
		}
		$author = $_SESSION['logged']['id_user'];
		
		try {
			// jeżeli formularz przesłany
			if(isset($_POST['add-article'])){

				// czy jest tytuł
				if(empty($_POST['title'])) throw new BadRequestException('Tytuł jest wymagany');
				$title = $_POST['title'];

				// czy jest zawartość
				if(empty($_POST['content'])) throw new BadRequestException('Treść nie może być pusta');
				$content = $_POST['content'];

				// kategoria
				$category = intval($_POST['category']);
				
				// prześlij plik, jeśli istnieje
				if(is_uploaded_file($_FILES['article-image']['tmp_name'])){
					$image = uploadFile('article-image');
				}

				// dodaj artykuł
				$articleModel = $this->loadModel('article');
				$inserted = $articleModel->addArticle($author, $title, $content, $category, $image);
				
				// sukces
				$_SESSION['messages'] = array('Artykuł pomyślnie dodany');
				header('Location: /single/read/'.$inserted);
			}

			// w przeciwnym razie wyświetl formularz
			$this->loadView('addarticle');
			$this->render($data);
		} catch (FunctionalityException $e) {
			$this->loadView('addarticle');
			http_response_code($e->getStatus());
			$data['error'] = $e->getMessage();
			$this->render($data);
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e) {
			throw new IternalErrorException();
		}
	}

	// modyfikacja artykułu (single/edit)
	public function edit(){
		throw new NotImplementedException();
	}
}
?>
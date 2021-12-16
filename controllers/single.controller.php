<?php
require_once(CONTROLLER.'controller.php');

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
			$comments = $articleModel->getCommentsByArticleId($this->params[0]);
			if(!$article) throw new NotFoundException();

			$this->data['article'] = $article;
			$this->data['comments'] = $comments;

			$this->loadView('single');
			$this->render();
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
				if(!empty($_POST['category'])){
					$category = intval($_POST['category']);
				}

				// prześlij plik, jeśli istnieje
				if(is_uploaded_file($_FILES['article-image']['tmp_name'])){
					$image = uploadFile('article-image');
				}

				// dodaj artykuł
				$articleModel = $this->loadModel('article');
				$inserted = $articleModel->addArticle($author, $title, $content, $category, $image);

				// sukces
				$_SESSION['messages'] = array('Artykuł pomyślnie dodany');
				header('Location: '.HREF.'single/read/'.$inserted);
			}

		} catch (FunctionalityException $e) {
			http_response_code($e->getStatus());
			$this->data['error'] = $e->getMessage();
		} catch (PDOException $e) {
			if($e->getCode() === '23000'){
				$this->data['error'] = 'Kategoria nie istnieje';
			} else {
				throw $e;
			}
		} catch (Exception $e) {
			throw new IternalErrorException();
		}

		$this->loadView('addarticle');
		$this->render();
	}

	// modyfikacja artykułu (single/edit)
	public function edit(){
		throw new NotImplementedException();
	}

	// dodanie komentarza (single/makeComment)
	public function makeComment() {
		$content = '';

		// sprawdź uprawnienia użytkownika
		if(!isset($_SESSION['logged'])){
			throw new UnauthorizedException();
		}
		$author = $_SESSION['logged']['id_user'];

		try {
			// jeżeli formularz przesłany
			if(isset($_POST['add_comment'])){

				// czy jest zawartość
				if(empty($_POST['content'])) throw new BadRequestException('Treść nie może być pusta');
				$content = $_POST['content'];

				$articleModel = $this->loadModel('article');
				$inserted = $articleModel->addComment($this->params[0], $content, $author);

				// sukces
				$_SESSION['messages'] = array('Artykuł pomyślnie dodany');
				header('Location: '.HREF.'single/read/'.$inserted);
			}

		} catch (FunctionalityException $e) {
			http_response_code($e->getStatus());
			$this->data['error'] = $e->getMessage();
		} catch (Exception $e) {
			throw new IternalErrorException();
		}

		$this->loadView('single');
		$this->render();
	}
}
?>

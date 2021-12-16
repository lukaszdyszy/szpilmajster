<?php
require_once(CONTROLLER.'controller.php');

class User extends Controller
{
	// logowanie jako default akcja
	public function index(){
		try {
			$userModel = $this->loadModel('usermodel');

			$result = $userModel->login($_POST['user'], $_POST['pass']);
			if(!$result){
				$_SESSION['messages'] = array('Błędny login lub hasło');
			} else {
				$_SESSION['logged'] = $result;
			}

			header('Location: '.HREF);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	// wyloguj
	public function logout(){
		session_destroy();
		header('Location: '.HREF);
	}

	// rejestracja
	public function register(){
		try {
			if(isset($_POST['register'])){
				$userModel = $this->loadModel('usermodel');
				if(!preg_match('/^[A-Za-z][A-Za-z0-9]{6,20}$/', $_POST['username'])){
					$this->data['errors']['username'] = 'Niepoprawny login (6-20 znaków, musi zaczynać się od litery i zawierać tylko małe i duże litery oraz cyfry)';
				} else if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $_POST['password'])){
					$this->data['errors']['password'] = 'Niepoprawne hasło (min. 8 znaków, musi zawierać małe i duże litery cyfrę oraz znak specjalny)';
				} else if($_POST['password'] != $_POST['password2']){
					$this->data['errors']['password'] = 'Hasła nie są zgodne';
				} else {
					$userModel->register($_POST['username'], $_POST['password']);
					$_SESSION['messages'] = array('Pomyślna rejestracja');
					header('Location: '.HREF);
				}
			}
			$this->loadView('registration');
			$this->render();
		} catch (PDOException $e) {
			if($e->getCode() === '23000'){
				$this->data['errors']['username'] = 'Nazwa użytkownika już zajęta';
				$this->loadView('registration');
				$this->render();
			} else {
				throw $e;
			}
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}

	// wyświetl profil użytkownika
	public function profil()
	{
		if(empty($this->params[0])) throw new NotFoundException();
		$this->data['username'] = $this->params[0];
		
		try {
			$userModel = $this->loadModel('usermodel');
			$userrole = $userModel->getUserRole($this->data['username'])['name'];
			if(!$userrole) throw new NotFoundException();
			
			$articleModel = $this->loadModel('article');
			$comments = $articleModel->getCommentsByUser($this->data['username'], 1);
			$articles = $articleModel->getArticlesByUser($this->data['username'], 1);

			$this->data['articles'] = $articles;
			$this->data['comments'] = $comments;
			$this->data['userrole'] = $userrole;

			$this->loadView('userprofil');
			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} catch (NotFoundException $e){
			throw $e;
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}

	// usuń konto
	public function delete()
	{
		if(empty($this->params[0])) throw new NotFoundException();
		$id = $this->params[0];
		
		if($id != $_SESSION['logged']['id_user'] && $_SESSION['logged']['id_role'] != 1) throw new UnauthorizedException();

		try {
			$usermodel = $this->loadModel('usermodel');
			$usermodel->deleteUser($id);

			if($_SESSION['logged']['id_user'] == $id){
				session_destroy();
				header('Location: '.HREF);
			} else {
				header('Location: '.HREF.'admin');
			}
			$_SESSION['messages'][] = 'Użytkownik usunięty';

		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}

	// zmień hasło
	public function changepass()
	{
		if(empty($this->params[0])) throw new NotFoundException();
		$id = $this->params[0];
		
		if($id != $_SESSION['logged']['id_user']) throw new UnauthorizedException();

		try {
			if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $_POST['pass'])){
				throw new Exception('Niepoprawne hasło (min. 8 znaków, musi zawierać małe i duże litery cyfrę oraz znak specjalny)');
			} else if ($_POST['pass'] != $_POST['pass2']){
				throw new BadRequestException('Hasła nie są zgodne');
			}

			$usermodel = $this->loadModel('usermodel');
			$usermodel->changePassword($id, $_POST['pass']);

			$_SESSION['messages'][] = 'Hasło zmienione pomyślnie';
		} catch (PDOException $e) {
			throw $e;
		} catch (BadRequestException $e) {
			http_response_code($e->getStatus());
			$_SESSION['messages'][] = $e->getMessage();
		} catch (Exception $e) {
			throw new InternalErrorException();
		}

		header('Location: '.HREF.'user/profil/'.$_SESSION['logged']['username']);
	}
	
	// artykuły użytkownika (user/articles/:user/:page)
	function articles(){
		if(empty($this->params[0])) throw new NotFoundException();

		try {
			$username = $this->params[0];
			$page = intval($this->params[1])===0 ? 1 : intval($this->params[1]);

			$articlemodel = $this->loadModel('article');
			
			$articles = $articlemodel->getArticlesByUser($username, $page);

			$pages = ceil($articlemodel->getNrOfArticlesUser($username)['number']/6);
			if($pages < $page) $page = $pages;
			

			$this->data = array(
				'articles'	=> $articles,
				'pages'		=> $pages,
				'page'		=> $page,
				'username'	=> $username
			);

			$this->loadView('userarticles');
			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}

	// komentarze użytkownika (user/comments/:user/:page)
	function comments(){
		if(empty($this->params[0])) throw new NotFoundException();

		try {
			$username = $this->params[0];
			$page = intval($this->params[1])===0 ? 1 : intval($this->params[1]);

			$articlemodel = $this->loadModel('article');

			$pages = ceil($articlemodel->getNrOfCommentsUser($username)['number']/10);
			if($pages < $page) $page = $pages;
			
			$articles = $articlemodel->getCommentsByUser($username, $page);

			$this->data = array(
				'comments'	=> $articles,
				'pages'		=> $pages,
				'page'		=> $page,
				'username'	=> $username
			);

			$this->loadView('usercomments');
			$this->render();
		} catch (PDOException $e) {
			throw $e;
		} /*catch (Exception $e) {
			throw new InternalErrorException();
		}*/
	}
}
?>
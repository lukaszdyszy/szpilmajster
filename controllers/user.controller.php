<?php
require(CONTROLLER.'controller.php');

class User extends Controller
{
	// logowanie jako default akcja
	public function index(){
		try {
			$userModel = $this->loadModel('usermodel');

			$result = $userModel->login($_POST['user'], $_POST['pass']);
			if(!$result){
				$_SESSION['messages'] = array('Błędny login lub');
			} else {
				$_SESSION['logged'] = $result;
			}

			header('Location: /home');
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	// wyloguj
	public function logout(){
		session_destroy();
		header('Location: /home');
	}

	// rejestracja
	public function register(){
		$data = array('errors' => array());
		try {
			if(isset($_POST['register'])){
				$userModel = $this->loadModel('usermodel');
				if(!preg_match('/^[A-Za-z][A-Za-z0-9]{6,20}$/', $_POST['username'])){
					$data['errors']['username'] = 'Niepoprawny login (6-20 znaków, musi zaczynać się od litery i zawierać tylko małe i duże litery oraz cyfry)';
				} else if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $_POST['password'])){
					$data['errors']['password'] = 'Niepoprawne hasło (min. 8 znaków, musi zawierać małe i duże litery cyfrę oraz znak specjalny)';
				} else if($_POST['password'] != $_POST['password2']){
					$data['errors']['password'] = 'Hasła nie są zgodne';
				} else {
					$userModel->register($_POST['username'], $_POST['password']);
					$_SESSION['messages'] = array('Pomyślna rejestracja');
					header('Location: /home');
				}
			}
			$this->loadView('registration');
			$this->render($data);
		} catch (PDOException $e) {
			if($e->getCode() === '23000'){
				$data['errors']['username'] = 'Nazwa użytkownika już zajęta';
				$this->loadView('registration');
				$this->render($data);
			} else {
				throw $e;
			}
		} catch (Exception $e) {
			throw new InternalErrorException();
		}
	}
	
}
?>
<?php
require_once(CONTROLLER.'controller.php');

class Admin extends Controller
{
  public function index() {
    throw new NotFoundException();
  }

  public function main(){
    if(!isset($_SESSION['logged']) || $_SESSION['logged']['id_role'] > 2){
			throw new UnauthorizedException();
		}
    try {
      $articleModel = $this->loadModel('article');
      $userModel = $this->loadModel('usermodel');


      $this->data['users'] = $userModel->getAll();
      $this->data['listed'] = $articleModel->getListed();
      $this->data['recommended'] = $articleModel->getRecommended();

      $userModel = $this->loadView('adminmain');
      $this->render();
    } catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
  }

  public function setRole() {
    if(!isset($_SESSION['logged']) || $_SESSION['logged']['id_role'] > 2){
			throw new UnauthorizedException();
		}
    try {
      $userModel = $this->loadModel('usermodel');
      $id = $this->params[0];
      $role = $_GET['role'];
      $myRole = $_SESSION['logged']['id_role'];

      if($role <= $myRole) {
        $_SESSION['messages'] = array('brak uprawnień!');
        header('Location: '.HREF.'admin/main');
        return;
      }

      if($userModel->setRole($id, $role, $myRole)) {
        $_SESSION['messages'] = array('Pomyślnie ustawiono role nr. '.$role);
      } else {
        $_SESSION['messages'] = array('brak uprawnień!');
      }

      header('Location: '.HREF.'admin/main');
    } catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
  }

  public function remove() {
    if(!isset($_SESSION['logged']) || $_SESSION['logged']['id_role'] > 3){
			throw new UnauthorizedException();
		}
	if(empty($this->params[0])) throw new NotFoundException();
	$id = $this->params[0];
    try {
      $articleModel = $this->loadModel('article');

      $articleModel->deleteArticle($id, $hidden);

      header('Location: '.HREF.'admin/main');
    } catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
  }

  public function togglerecommended() {
    if(!isset($_SESSION['logged']) || $_SESSION['logged']['id_role'] > 3){
			throw new UnauthorizedException();
		}
	if(!isset($this->params[0])) throw new NotFoundException();
	$id = $this->params[0];
    try {
      $articleModel = $this->loadModel('article');

      $articleModel->toggleRecommended($id);

      header('Location: '.HREF.'admin/main');
    } catch (PDOException $e) {
			throw $e;
		} catch (Exception $e){
			throw new InternalErrorException();
		}
  }
}
 ?>

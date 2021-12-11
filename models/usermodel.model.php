<?php
require_once(MODEL.'model.php');

class Usermodel extends Model
{
	public function login($user, $pass){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=:user");
		$stmt->execute(array(':user' => $user));
		if($stmt->rowCount() === 0) return false;

		$result = $stmt->fetch();
		if(password_verify($pass, $result['password'])){
			return array(
				'id_user' 	=> $result['id_user'],
				'username' 	=> $result['username'],
				'id_role'	=> $result['id_role']
			);
		} 
		return false;
	}

	public function register($username, $password){
		$password = password_hash($password, PASSWORD_DEFAULT); // hashowanie hasła
		$stmt = $this->db->prepare("INSERT INTO users VALUES(null, :user, :pass, 4)");
		$stmt->execute(array(':user' => $username, ':pass' => $password));
	}
}



?>
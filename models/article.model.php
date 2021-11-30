<?php
require(MODEL.'model.php');

class Article extends Model
{
	public function getPage($page){
		// global $db;
		$stmt = $this->db->prepare("SELECT * FROM articles");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}


?>
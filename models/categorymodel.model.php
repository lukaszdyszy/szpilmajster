<?php
require_once(MODEL.'model.php');

class Categorymodel extends Model
{
	public function getCategories(){
		$stmt = $this->db->prepare("SELECT * FROM categories");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
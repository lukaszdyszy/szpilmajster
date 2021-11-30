<?php
require(MODEL.'model.php');

class Article extends Model
{
	public function getPage($page){
		$offset = ($page-1)*6;
		$stmt = $this->db->prepare("SELECT * FROM articles ORDER BY date_added LIMIT 6 OFFSET $offset");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}


?>
<?php
require(MODEL.'model.php');

class Article extends Model
{
	public function getPage($page){
		$offset = ($page-1)*6;
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category ORDER BY date_added LIMIT 6 OFFSET :offset;");
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getRecommended(){
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND articles.recommended=1 ORDER BY date_added;");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getNrOfArticles(){
		$stmt = $this->db->prepare("SELECT COUNT(id_article) AS 'number' FROM articles;");
		$stmt->execute();
		return $stmt->fetch();
	}

	public function getArticleById($id){
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, articles.content, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND articles.id_article=:id;");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}


?>
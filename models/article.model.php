<?php
require_once(MODEL.'model.php');

class Article extends Model
{
	public function getPage($page){
		$offset = ($page-1)*6;
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category ORDER BY date_added DESC LIMIT 6 OFFSET :offset;");
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getRecommended(){
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND articles.recommended=1 ORDER BY date_added DESC;");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getNrOfArticles(){
		$stmt = $this->db->prepare("SELECT COUNT(id_article) AS 'number' FROM articles;");
		$stmt->execute();
		return $stmt->fetch();
	}

	public function getArticleById($id){
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, articles.content, users.username AS 'author', articles.date_added, articles.date_modified, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND articles.id_article=:id;");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function addArticle($author, $title, $content, $category, $image){
		$stmt = $this->db->prepare("INSERT INTO articles (author, title, content, date_added, date_modified, id_category, image) VALUES(:author, :title, :content, :date_added, :date_modified, :id_category, :image)");
		$stmt->bindValue(':author', $author, PDO::PARAM_STR);
		$stmt->bindValue(':title', $title, PDO::PARAM_STR);
		$stmt->bindValue(':content', $content, PDO::PARAM_STR);
		$stmt->bindValue(':date_added', date('Y-m-d H:m:s', time()), PDO::PARAM_STR);
		$stmt->bindValue(':date_modified', date('Y-m-d H:m:s', time()), PDO::PARAM_STR);
		$stmt->bindValue(':id_category', $category, PDO::PARAM_INT);
		$stmt->bindValue(':image', $image, PDO::PARAM_STR);
		$stmt->execute();
		return $this->db->lastInsertId();
	}
}


?>
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

	public function getPageCategory($page, $cat){
		$offset = ($page-1)*6;
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND categories.name=:cat ORDER BY date_added DESC LIMIT 6 OFFSET :offset;");
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->bindValue(':cat', $cat, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getListed() {
		$stmt = $this->db->prepare("SELECT articles.id_article AS 'id', articles.title AS 'title', users.username AS 'author', users.id_user AS 'author_id' FROM articles, users WHERE articles.author=users.id_user ORDER BY date_added DESC;");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getRecommended(){
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, users.username AS 'author', articles.date_added, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND articles.recommended=1 ORDER BY date_added DESC;");
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public function toggleRecommended($id){
		$stmt = $this->db->prepare("UPDATE articles SET recommended=!recommended WHERE id_article=:id");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getNrOfArticles(){
		$stmt = $this->db->prepare("SELECT COUNT(id_article) AS 'number' FROM articles;");
		$stmt->execute();
		return $stmt->fetch();
	}
	public function getNrOfArticlesCategory($cat){
		$stmt = $this->db->prepare("SELECT COUNT(id_article) AS 'number' FROM articles, categories
									WHERE articles.id_category=categories.id_category AND categories.name=:cat;");
		$stmt->bindValue(':cat', $cat, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function getNrOfArticlesUser($user){
		$stmt = $this->db->prepare("SELECT COUNT(id_article) AS 'number' FROM articles, users
									WHERE articles.author=users.id_user AND users.username=:user;");
		$stmt->bindValue(':user', $user, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function getNrOfCommentsUser($user){
		$stmt = $this->db->prepare("SELECT COUNT(id_comment) AS 'number' FROM comments, users
									WHERE comments.id_user=users.id_user AND users.username=:user;");
		$stmt->bindValue(':user', $user, PDO::PARAM_STR);
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
		$stmt = $this->db->prepare("INSERT INTO articles (author, title, content, date_added, date_modified, id_category, image, recommended) VALUES(:author, :title, :content, :date_added, :date_modified, :id_category, :image, 0)");
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

	public function getCommentsByArticleId($id){
		$stmt = $this->db->prepare("SELECT comments.date_added AS 'date', comments.content AS 'content', users.username AS 'author' FROM comments, users WHERE comments.id_user=users.id_user AND comments.id_article=:id ORDER BY comments.date_added DESC;");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function addComment($article_id, $content, $author){
		$stmt = $this->db->prepare("INSERT INTO comments (id_article, id_user, content, date_added, date_modified) VALUES(:article_id, :author, :content, :date_added, :date_modified)");
		$stmt->bindValue(':author', $author, PDO::PARAM_STR);
		$stmt->bindValue(':content', $content, PDO::PARAM_STR);
		$stmt->bindValue(':date_added', date('Y-m-d H:m:s', time()), PDO::PARAM_STR);
		$stmt->bindValue(':date_modified', date('Y-m-d H:m:s', time()), PDO::PARAM_STR);
		$stmt->bindValue(':article_id', $article_id, PDO::PARAM_STR);
		$stmt->execute();
		return $article_id;
	}

	public function getCommentsByUser($username, $page){
		$offset = ($page-1)*10;
		$stmt = $this->db->prepare("SELECT comments.date_added AS 'date', comments.content AS 'content', articles.id_article FROM comments, users, articles WHERE comments.id_user=users.id_user AND comments.id_article=articles.id_article AND users.username=:user ORDER BY comments.date_added DESC LIMIT 10 OFFSET :offset;");
		$stmt->bindValue(':user', $username, PDO::PARAM_STR);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getArticlesByUser($username, $page){
		$offset = ($page-1)*6;
		$stmt = $this->db->prepare("SELECT articles.id_article, articles.title, articles.content, users.username AS 'author', articles.date_added, articles.date_modified, categories.name AS 'category', articles.image FROM articles, users, categories WHERE articles.author=users.id_user AND categories.id_category=articles.id_category AND users.username=:user ORDER BY articles.date_added DESC LIMIT 6 OFFSET :offset;");
		$stmt->bindValue(':user', $username, PDO::PARAM_STR);
		$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function deleteArticle($article_id){
		$stmt = $this->db->prepare("DELETE FROM articles WHERE articles.id_article = :article_id;");
		$stmt->bindValue(':article_id', $article_id, PDO::PARAM_INT);
		$stmt->execute();
	}
}


?>

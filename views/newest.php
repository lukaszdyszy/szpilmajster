<?php include(VIEW.'includes/header.php');?>
<main class="page-content">

	<div class="container">
		<h1>Najnowsze</h1>
		<div class="newest-grid">
			<?php
				foreach ($data['newest'] as $art) {
					?>
					<article class="article-excerpt">
						<img src="<?php echo ASSETS.'img/'.$art['image']; ?>" alt="<?php echo $art['title']; ?>" class="article-excerpt-img">
						<div class="article-excerpt-caption">
							<div class="cat-btn">
								<a href="/category/<?php echo $art['category']; ?>">
									<?php echo $art['category']; ?>
								</a>
							</div>
							<h2 class="excerpt-title">
								<a href="/single/<?php echo $art['id_article']; ?>">
									<?php echo $art['title']; ?>
								</a>
							</h2>
							<div class="author"><?php 
								echo '<a href="/user/articles/1">'.$post['author'].'</a>, '.explode(' ', $art['date_added'])[0]; 
							?></div>
						</div>
					</article>
			<?php } ?>
		</div>

		<div class="newest-pagination">
			<a href="/home/newest/1">1</a>
			<?php echo $data['page']; ?>
			<a href="/home/newest/<?php echo $data['pages']; ?>"><?php echo $data['pages']; ?></a>
		</div>
	</div>
	
</main>
<?php include(VIEW.'includes/footer.php'); ?>
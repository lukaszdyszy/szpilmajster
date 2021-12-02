<?php include(VIEW.'includes/header.php');?>
<main class="page-content">
	<section class="recommended">
		<div class="container">
			<h1 class="recommended-header">Polecane</h1>
			<div id="my-slider">
				<div class="slide-wrapper">
					<?php foreach ($data['recommended'] as $art){ ?>
						<div class="slide">
							<img src="<?php echo ASSETS.'img/'.$art['image']; ?>" class="slide-img">
							<div class="slide-caption">
								<div class="cat-btn">
									<a href="/category/<?php echo $art['category']; ?>">
										<?php echo $art['category']; ?>
									</a>
								</div>
								<h2 class="excerpt-title">
									<a href="/single/read/<?php echo $art['id_article']; ?>">
										<?php echo $art['title']; ?>
									</a>
								</h2>
								<div class="author"><?php 
									echo '<a href="/user/articles/1">'.$art['author'].'</a>, '.explode(' ', $art['date_added'])[0]; 
								?></div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="slider-pagination">
				<?php foreach ($data['recommended'] as $post){ ?>
					<div class="pag">&bull;</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="newest">
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
									<a href="/single/read/<?php echo $art['id_article']; ?>">
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

			<a href="/home/newest/2" class="more-newest-btn">Więcej</a>
		</div>
	</section>
</main>
<?php include(VIEW.'includes/footer.php'); ?>
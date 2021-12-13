<div class="newest-grid">
	<?php
		foreach ($data['articles'] as $art) {
			?>
			<article class="article-excerpt">
				<img src="<?php echo ASSETS.'img/'.$art['image']; ?>" alt="<?php echo $art['title']; ?>" class="article-excerpt-img">
				<div class="article-excerpt-caption">
					<div class="cat-btn">
						<a href="<?php echo HREF; ?>home/category/<?php echo $art['category']; ?>">
							<?php echo $art['category']; ?>
						</a>
					</div>
					<h2 class="excerpt-title">
						<a href="<?php echo HREF; ?>single/read/<?php echo $art['id_article']; ?>">
							<?php echo $art['title']; ?>
						</a>
					</h2>
					<div class="author"><?php 
						echo '<a href="'.HREF.'user/articles/1">'.$art['author'].'</a>, '.explode(' ', $art['date_added'])[0]; 
					?></div>
				</div>
			</article>
	<?php } ?>
</div>
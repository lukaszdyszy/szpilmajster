<div class="newest-grid">
	<?php
		foreach ($data['articles'] as $art) {
			?>
			<article class="article-excerpt">
				<img src="<?php echo ASSETS.'img/'.$art['image']; ?>" alt="<?php echo $art['title']; ?>" class="article-excerpt-img">
				<div class="article-excerpt-caption">
					<div class="cat-btn">
						<a href="<?php echo HREF; ?>category/<?php echo $art['category']; ?>">
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

<!-- Paginacja -->
<?php 
	global $controller, $action;
	$controllerClass = get_class($controller);
	if($action === 'index' && $controllerClass === 'Home'){
		echo '<a href="'.HREF.'home/newest/2" class="more-newest-btn">Więcej</a>';
	} else {
?>
<div class="newest-pagination">
	<a href="<?php echo HREF.$controllerClass.'/'.$action.'/'; ?>" id="page-hidden" style="visibility: hidden;"></a>
	<a href="<?php echo HREF.$controllerClass.'/'.$action.'/'.($data['page']-1); ?>" class="more-newest-btn pag-nav"><</a>
	<input id="page-number" type="number" 
		min="1" 
		max="<?php echo $data['pages']; ?>" 
		value="<?php echo $data['page']; ?>"
	>
	z
	<a href="<?php echo HREF.$controllerClass.'/'.$action.'/'.$data['pages']; ?>"><?php echo $data['pages']; ?></a>
	<a href="<?php echo HREF.$controllerClass.'/'.$action.'/'.($data['page']+1); ?>" class="more-newest-btn pag-nav">></a>
</div>
<?php } ?>
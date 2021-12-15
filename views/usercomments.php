<?php include(VIEW.'includes/header.php');?>
<main class="page-content">

	<div class="container">
		<h1>Komentarze użytkownika: <?php echo $data['username']; ?></h1>

		<?php if(!empty($data['comments'])){ foreach ($data['comments'] as $com) { ?>
			<div class="single-comment">
				<div class="comment-author">
					<a href="<?php echo HREF.'single/read/'.$com['id_article']; ?>">Skocz do artykułu</a>
					<div style="float: right"><?php echo $com["date"] ?></div>
				</div>
				<div class="comment-content">
					<?php echo $com["content"] ?>
				</div>
			</div>
		<?php } } else echo 'Brak komentarzy'; ?>
		
		<!-- Paginacja -->
		<div class="newest-pagination">
			<a href="<?php echo HREF.'user/comments/'.$data['username'].'/'; ?>" id="page-hidden" style="visibility: hidden;"></a>
			<?php if($data['page']-1 >= 1){ ?><a href="<?php echo HREF.'user/comments/'.$data['username'].'/'.($data['page']-1); ?>" class="more-newest-btn pag-nav"><</a><?php } ?>
			<input id="page-number" type="number" 
				min="1" 
				max="<?php echo $data['pages']; ?>" 
				value="<?php echo $data['page']; ?>"
			>
			z
			<a href="<?php echo HREF.'user/comments/'.$data['username'].'/'.$data['pages']; ?>"><?php echo $data['pages']; ?></a>
			<?php if($data['page']+1 <= $data['pages']){ ?><a href="<?php echo HREF.'user/comments/'.$data['username'].'/'.($data['page']+1); ?>" class="more-newest-btn pag-nav">></a><?php } ?>
		</div>

	</div>
	
</main>
<?php include(VIEW.'includes/footer.php'); ?>
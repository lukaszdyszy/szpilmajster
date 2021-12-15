<?php include(VIEW.'includes/header.php');?>
<main class="page-content">

	<div class="container">
		<h1>Artykuły użytkownika: <?php echo $data['username']; ?></h1>

		<?php include(VIEW.'includes/articlesgrid.php'); ?>
		
		<!-- Paginacja -->
		<div class="newest-pagination">
			<a href="<?php echo HREF.'user/articles/'.$data['username'].'/'; ?>" id="page-hidden" style="visibility: hidden;"></a>
			<?php if($data['page']-1 >= 1){ ?><a href="<?php echo HREF.'user/articles/'.$data['username'].'/'.($data['page']-1); ?>" class="more-newest-btn pag-nav"><</a><?php } ?>
			<input id="page-number" type="number" 
				min="1" 
				max="<?php echo $data['pages']; ?>" 
				value="<?php echo $data['page']; ?>"
			>
			z
			<a href="<?php echo HREF.'user/articles/'.$data['username'].'/'.$data['pages']; ?>"><?php echo $data['pages']; ?></a>
			<?php if($data['page']+1 <= $data['pages']){ ?><a href="<?php echo HREF.'user/articles/'.$data['username'].'/'.($data['page']+1); ?>" class="more-newest-btn pag-nav">></a><?php } ?>
		</div>

	</div>
	
</main>
<?php include(VIEW.'includes/footer.php'); ?>
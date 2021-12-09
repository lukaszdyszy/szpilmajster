<?php include(VIEW.'includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<h1><?php echo $data['title'] ?></h1>
		<img src="<?php echo ASSETS.'img/'.$data['image']; ?>" alt="" class="single-image">
		<div class="single-info">
			<div class="single-author">Autor: <?php echo $data['author']; ?></div>
			<div class="single-date">
				<?php
					echo explode(' ', $data['date_added'])[0];
					if($data['date-added'] != $data['date-modified']) echo 'edytowano: '.$data['date-modified'];
				?>
			</div>
		</div>
		<div id="article-content"><?php echo $data['content']; ?></div>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
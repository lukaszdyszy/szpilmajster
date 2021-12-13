<?php include(VIEW.'includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<h1><?php echo $data['article']['title'] ?></h1>
		<img src="<?php echo ASSETS.'img/'.$data['article']['image']; ?>" alt="" class="single-image">
		<div class="single-info">
			<div class="single-author">Autor: <?php echo $data['article']['author']; ?></div>
			<div class="single-date">
				<?php
					echo explode(' ', $data['article']['date_added'])[0];
					if($data['article']['date_added'] != $data['article']['date_modified']) {
						echo '<br>edytowano: '.$data['article']['date_modified'];
					}
				?>
			</div>
		</div>
		<div id="article-content"><?php echo $data['article']['content']; ?></div>

		<!-- Sekcja komentarzy -->
		<section class="comments"></section>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
<?php include(VIEW.'includes/header.php');?>
<main class="page-content">

	<div class="container">
		<h1>Najnowsze</h1>
		<div class="newest-grid">
			<?php
				foreach ($data as $art) {
					?>
					<article class="article-excerpt">
						<img src="<?php echo 'public/img/'.$art['image'] ?>" alt="" class="article-excerpt-img">
						<div class="article-description">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, natus, illum voluptatum inventore accusantium earum voluptatem explicabo suscipit laboriosam fugit eos dolores, cum quo officia.
						</div>
					</article>
			<?php	}
			?>
		</div>
	</div>
	
</main>
<?php include(VIEW.'includes/footer.php'); ?>
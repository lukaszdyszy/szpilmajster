<?php include(VIEW.'includes/header.php');?>
<main class="page-content">
	<section class="recommended">
		<div class="container">
			<div id="my-slider">
				<div class="slide-wrapper">
					<div class="slide">
						<img src="public/img/placeholder.png" class="slide-img">
						<div class="slide-caption">
							Recomended title #1
						</div>
					</div>
					<div class="slide">
						<img src="public/img/placeholder.png" class="slide-img">
						<div class="slide-caption">
							Recomended title #2
						</div>
					</div>
					<div class="slide">
						<img src="public/img/placeholder.png" class="slide-img">
						<div class="slide-caption">
							Recomended title #3
						</div>
					</div>
					<div class="slide">
						<img src="public/img/placeholder.png" class="slide-img">
						<div class="slide-caption">
							Recomended title #4
						</div>
					</div>
					<div class="slide">
						<img src="public/img/placeholder.png" class="slide-img">
						<div class="slide-caption">
							Recomended title #5
						</div>
					</div>
				</div>
			</div>
			<div class="slider-pagination">
				<div class="pag">&bull;</div>
				<div class="pag">&bull;</div>
				<div class="pag">&bull;</div>
				<div class="pag">&bull;</div>
				<div class="pag">&bull;</div>
			</div>
		</div>
	</section>

	<section class="newest">
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
	</section>
</main>
<?php include(VIEW.'includes/footer.php'); ?>
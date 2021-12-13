<?php include(VIEW.'includes/header.php');?>

<main class="page-content">
	<!-- Slider z polecanymi -->
	<section class="recommended">
		<div class="container">
			<h1 class="recommended-header">Polecane</h1>
			<div id="my-slider">
				<div class="slide-wrapper">
					<?php foreach ($data['recommended'] as $art){ ?>
						<div class="slide">
							<img draggable="false" src="<?php echo ASSETS.'img/'.$art['image']; ?>" class="slide-img">
							<div class="slide-caption">
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
						</div>
					<?php } ?>
				</div>
			</div>

			<!-- paginacja slidera -->
			<div class="slider-pagination">
				<?php foreach ($data['recommended'] as $post){ ?>
					<div class="slider-pag">&bull;</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="newest">
		<div class="container">
			<h1>Najnowsze</h1>
			
			<?php include(VIEW.'includes/articlesgrid.php'); ?>

			<a href="/home/newest/2" class="more-newest-btn">Więcej</a>

		</div>
	</section>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
<?php include(VIEW.'includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<section class="user-header">
			<div class="user-info">
				<h1><?php echo $data['username']; ?></h1>
				<span class="user-role"><?php echo $data['userrole']; ?></span>
			</div>
			<?php if(isset($_SESSION['logged']) && $_SESSION['logged']['username'] == $data['username']) { ?>
				<div class="user-activities">
					<a href="#" class="btn">Zmień hasło</a>
					<a href="#" class="btn">Usuń konto</a>
				</div>
			<?php } ?>
		</section>

		<section class="user-uploaded">
			<div class="user-section-switch">
				<a href="#comments" class="btn">Komentarze</a>
				<?php if($data['userrole'] != 'standard user') ?><a href="#articles" class="btn">Artykuły</a>
			</div>
			<section class="user-comments">
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
				<?php } } else echo 'Brak komentarzy'?>

				<a href="<?php echo HREF; ?>user/comments/2" class="more-newest-btn">Więcej</a>
			</section>
			<section class="user-articles" style="display: none;">
				<?php include(VIEW.'includes/articlesgrid.php'); ?>

				<a href="<?php echo HREF; ?>user/articles/2" class="more-newest-btn">Więcej</a>
			</section>
		</section>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
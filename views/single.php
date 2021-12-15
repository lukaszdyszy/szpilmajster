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
		<section class="comments">
			<h2>Komentarze</h2>
			<form class="" action="<?php echo HREF; ?>single/makeComment/<?php echo $data['article']["id_article"]; ?>" method="post" enctype="multipart/form-data">
				<textarea name="content" rows="8" cols="80"></textarea>
				<input type="submit" name="add_comment" value="dodaj">
			</form>
			<div class="">
				<?php
				foreach ($data["comments"] as $i => $com) {
					?> <div class="single-comment">
						<div class="comment-author">
							<?php echo $com["author"] ?> <div style="float: right"><?php echo $com["date"] ?></div>
						</div>
						<div class="comment-content">
							<?php echo $com["content"] ?>
						</div>
					</div> <?php
				}
				?>
			</div>
		</section>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>

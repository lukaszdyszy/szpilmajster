<?php include(VIEW.'includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<div class="error"><?php if(isset($data['error'])) echo $data['error']; ?></div>
		<form action="<?php echo HREF; ?>single/write" method="post" enctype="multipart/form-data" id="add-article-form">
			<div class="add-input-row">
				<label for="category-select">Kateogria</label>
				<select name="category" id="category-select">
					<?php
						foreach ($header['categories'] as $category) {
							?>
								<option 
									value="<?php echo $category['id_category']; ?>" 
									<?php if(isset($_POST['category']) && $_POST['category']===$category['id_category']) echo 'selected'; ?>>
										<?php echo $category['name']; ?>
								</option>
							<?php
						}
					?>
				</select>
			</div>
			<div class="add-input-row">
				<input	type="text" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" placeholder="Tytuł...">
			</div>
			<label for="add-article-image">Obraz</label>
			<input type="file" name="article-image" id="add-article-image">
			<br>
			<br>
			<textarea 
				name="content" 
				value="<?php if(isset($_POST['content'])) echo $_POST['content']; ?>" 
				id="new-article-content">
			</textarea>
			<input type="submit" name="add-article" value="Wyślij" class="register-submit">
		</form>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
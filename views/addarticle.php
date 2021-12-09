<?php include(VIEW.'includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<div class="error"><?php echo $data['error']; ?></div>
		<form action="/single/write" method="post" enctype="multipart/form-data" id="add-article-form">
			<div class="add-input-row">
				<label for="category-select">Kateogria</label>
				<select name="category" id="category-select">
					<option value="1" <?php if($_POST['category']==='RPG') echo 'selected'; ?>>RPG</option>
					<option value="9" <?php if($_POST['category']==='FPS') echo 'selected'; ?>>FPS</option>
					<option value="13" <?php if($_POST['category']==='Inne') echo 'selected'; ?>>Inne</option>
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
<?php include($_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<h1><?php echo $data['title'] ?></h1>
		<div class="content"><?php echo $data['content']; ?></div>
	</div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php'); ?>
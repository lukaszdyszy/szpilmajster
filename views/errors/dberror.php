<?php include($_SERVER['DOCUMENT_ROOT'].'/views/includes/header.php'); ?>

<main class="page-content">
	<div class="container">
		<div class="error">Ups! Wygląda na to, że wystąpił problem z połączeniem z baza danych. Przepraszamy. <?php echo $e->getMessage(); ?></div>
	</div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/views/includes/footer.php'); ?>
<?php include(VIEW.'includes/header.php');?>
<main class="page-content">

	<div class="container">
		<h1>Kategoria: <?php echo $data['category']; ?></h1>

		<?php include(VIEW.'includes/articlesgrid.php'); ?>
		
		<!-- Paginacja -->
		<?php include(VIEW.'includes/categorypagination.php'); ?>

	</div>
	
</main>
<?php include(VIEW.'includes/footer.php'); ?>
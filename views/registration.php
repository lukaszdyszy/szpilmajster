<?php include(VIEW.'includes/header.php');?>

<main class="page-content">
	<div class="container">
		<form action="/user/register" method="post">
			<label for="new-username">Nazwa użytkownika:</label>
			<input type="text" name="username" id="new-username" value="<?php echo $_POST['username'] ?? ''; ?>">
			<span class="error"><?php echo $data['errors']['username']; ?></span>

			<br>

			<label for="new-password">Hasło: </label>
			<input type="password" name="password" id="new-password" value="<?php echo $_POST['password'] ?? ''; ?>">
			<span class="error"><?php echo $data['errors']['password']; ?></span>
			
			<br>

			<label for="new-password-2">Powtórz hasło: </label>
			<input type="password" name="password2" id="new-password-2">

			<input type="submit" value="zarejestruj się" name="register">
		</form>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
<?php include(VIEW.'includes/header.php');?>

<main class="page-content">
	<div class="container">
		<h1>Rejestracja</h1>
		<form action="<?php echo HREF; ?>user/register" method="post" class="register-form">

			<div class="register-input-row">
				<label for="new-username">Nazwa użytkownika:</label>
				<input 	type="text" 
						name="username" 
						id="new-username" 
						value="<?php echo $_POST['username'] ?? ''; ?>"
						class="register-input">
				<span class="error"><?php if(isset($data['errors']['username'])) echo $data['errors']['username']; ?></span>
			</div>

			<div class="register-input-row">
				<label for="new-password">Hasło: </label>
				<input 	type="password" 
						name="password" 
						id="new-password" 
						value="<?php echo $_POST['password'] ?? ''; ?>"
						class="register-input">
				<span class="error"><?php if(isset($data['errors']['password'])) echo $data['errors']['password']; ?></span>
			</div>

			<div class="register-input-row">
				<label for="new-password-2">Powtórz hasło: </label>
				<input type="password" name="password2" id="new-password-2" class="register-input">
			</div>

			<input type="submit" value="zarejestruj się" name="register" class="register-submit">
		</form>
	</div>
</main>

<?php include(VIEW.'includes/footer.php'); ?>
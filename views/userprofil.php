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
					<a href="#changepass" class="btn">Zmień hasło</a>
					<a href="#deleteaccount" class="btn">Usuń konto</a>
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

<div class="login-popup change-pass-popup">
	<form action="<?php echo HREF.'user/changepass/'.$_SESSION['logged']['id_user']; ?>" method="post" class="login-form">
		<header class="login-form-header">
			<h2>Zmiana hasła</h2>
			<i class="far fa-times-circle close-form"></i>
		</header>
		<label>
			Nowe hasło:
			<input type="password" name="pass" class="login-form-input" placeholder="password">
		</label>
		<label>
			Powtórz nowe hasło:
			<input type="password" name="pass2" class="login-form-input" placeholder="password">
		</label>
		<input type="submit" value="Zmień" name="changepass" class="login-form-input">
	</form>
</div>

<div class="login-popup delete-account-popup">
	<form action="<?php echo HREF.'user/delete/'.$_SESSION['logged']['id_user']; ?>" method="post" class="login-form">
		<header class="login-form-header">
			<h2>Czy napewno?</h2>
			<i class="far fa-times-circle close-form"></i>
		</header>
		
		<input type="submit" value="Usuń" name="deleteaccount" class="login-form-input">
	</form>
</div>

<?php include(VIEW.'includes/footer.php'); ?>
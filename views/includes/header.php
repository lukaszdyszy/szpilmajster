<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $data['pageTitle']; ?></title>

	<link rel="stylesheet" href="<?php echo ASSETS.'style.css'; ?>">
	<script src="https://kit.fontawesome.com/bbec1a708a.js" crossorigin="anonymous"></script>
</head>
<body class="theme-dark">
	<header class="main-header">
		<div class="website-logo">Logo</div>
		<div class="menu-toggle" id="menu-toggle">
			<div class="hamburger-bar top"></div>
			<div class="hamburger-bar middle"></div>
			<div class="hamburger-bar bottom"></div>
		</div>
		<div class="website-menu" id="website-menu">
			<nav class="main-nav">
				<ul class="menu main-menu">
					<li class="menu-item main-menu-item">
						<a class="menu-link" href="/">Strona główna</a>
					</li>
					<li class="menu-item main-menu-item sub-menu-link">
						<a class="menu-link">Kategorie <i class="fas fa-caret-down"></i></a>
						<ul class="menu sub-menu">
							<li class="menu-item sub-menu-item">MMORPG</li>
							<li class="menu-item sub-menu-item">Strategiczne</li>
						</ul>
					</li>
					<?php if(isset($_SESSION['logged'])){ ?>
						<li class="menu-item main-menu-item sub-menu-link">
							<a class="menu-link"><?php echo $_SESSION['logged']['username']; ?> <i class="fas fa-caret-down"></i></a>
							<ul class="menu sub-menu">
								<li class="menu-item sub-menu-item">Profil</li>
								<li class="menu-item sub-menu-item">
									<a class="menu-link" href="/user/logout">Wyloguj</a>
								</li>
							</ul>
						</li>
					<?php } else { ?>
						<li class="menu-item main-menu-item">
							<a class="menu-link" href="/user/register">Rejestracja</a>
						</li>
						<li class="menu-item main-menu-item" id="open-form">
							<a class="menu-link">Zaloguj</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
			<?php if(!isset($_SESSION['logged'])){ ?>
				<form action="/user" method="post" class="login-form form-moblie">
					<h2>Logowanie</h2>
					<input type="text" name="user" class="login-form-input" placeholder="username...">
					<input type="password" name="pass" class="login-form-input" placeholder="password">
					<input type="submit" value="zaloguj" name="login" class="login-form-input">
				</form>
			<?php } ?>
			<div class="theme-switch">
				<i class="fas fa-moon"></i>
				<label class="switch">
					<input type="checkbox" id="theme-switch">
					<span class="slider round"></span>
				</label>
				<i class="fas fa-sun"></i>
			</div>
		</div>

		<!-- desktop login -->
		<?php if(!isset($_SESSION['logged'])){ ?>
			<div class="login-popup">
				<form action="/user" method="post" class="login-form">
					<h2 class="login">Logowanie <i class="far fa-times-circle" id="close-form"></i></h2>
					<input type="text" name="user" class="login-form-input" placeholder="username...">
					<input type="password" name="pass" class="login-form-input" placeholder="password">
					<input type="submit" value="zaloguj" name="login" class="login-form-input">
				</form>
			</div>
		<?php } ?>

		<!-- message -->
		<div class="messages">
			<?php foreach ($_SESSION['messages'] as $msg) {?>
				<div class="message">
					<?php echo $msg; ?>
				</div>
			<?php } $_SESSION['messages'] = array(); ?>
		</div>
	</header>
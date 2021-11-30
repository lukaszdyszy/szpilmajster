<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Strona główna</title>

	<link rel="stylesheet" href="public/style.css">
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
						<a class="menu-link">Strona główna</a>
					</li>
					<li class="menu-item main-menu-item sub-menu-link">
						<a class="menu-link">Kategorie <i class="fas fa-caret-down"></i></a>
						<ul class="menu sub-menu">
							<li class="menu-item sub-menu-item">MMORPG</li>
							<li class="menu-item sub-menu-item">Strategiczne</li>
						</ul>
					</li>
					<li class="menu-item main-menu-item">
						<a class="menu-link">Rejestracja</a>
					</li>
					<li class="menu-item main-menu-item" id="open-form">
						<a class="menu-link">Zaloguj</a>
					</li>
				</ul>
			</nav>
			<form action="/login" method="post" class="login-form form-moblie">
				<h2>Logowanie</h2>
				<input type="text" name="user" class="login-form-input" placeholder="username...">
				<input type="password" name="pass" class="login-form-input" placeholder="password">
				<input type="submit" value="zaloguj" name="login" class="login-form-input">
			</form>
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
		<div class="login-popup">
			<form action="/login" method="post" class="login-form">
				<h2 class="login">Logowanie <i class="far fa-times-circle" id="close-form"></i></h2>
				<input type="text" name="user" class="login-form-input" placeholder="username...">
				<input type="password" name="pass" class="login-form-input" placeholder="password">
				<input type="submit" value="zaloguj" name="login" class="login-form-input">
			</form>
		</div>
	</header>
<?php global $header; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $header['title']; ?></title>

	<!-- Nasze style -->
	<link rel="stylesheet" href="<?php echo ASSETS.'style.css'; ?>">

	<!-- FontAwesome - ikonki -->
	<script src="https://kit.fontawesome.com/bbec1a708a.js" crossorigin="anonymous"></script>

	<!-- Interpreter i edytor MD - pisanie i wyświetlanie postów -->
	<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
	<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
</head>

<body class="theme-dark">
	<!-- Górny pasek strony -->
	<header class="main-header">

		<!-- Logo -->
		<div class="website-logo"><a class="menu-link" href="<?php echo HREF; ?>">Logo</a></div>

		<!-- Moblie menu toggler -->
		<div class="menu-toggle" id="menu-toggle">
			<div class="hamburger-bar top"></div>
			<div class="hamburger-bar middle"></div>
			<div class="hamburger-bar bottom"></div>
		</div>

		<!-- Menu główne -->
		<div class="website-menu" id="website-menu">
			<nav class="main-nav">
				<ul class="menu main-menu">
					<li class="menu-item">
						<a class="menu-link" href="<?php echo HREF; ?>">Strona główna</a>
					</li>
					<li class="menu-item sub-menu-link">
						<a class="menu-link">Kategorie <i class="fas fa-caret-down"></i></a>
						<ul class="menu sub-menu">
							<?php
								foreach ($header['categories'] as $category) {
									?>
									<li class="menu-item sub-menu-item">
										<!-- Dobra ścieżka - loop -->
										<a href="<?php echo HREF.'home/category/'.$category['name'] ?>"><?php echo $category['name']; ?></a> 
									</li>
									<?php
								}
							?>
						</ul>
					</li>

					<!-- Pozycje menu dla zalogowanego uśytkownika -->
					<?php if(isset($_SESSION['logged'])){ ?>
						<li class="menu-item sub-menu-link">
							<a class="menu-link"><?php echo $_SESSION['logged']['username']; ?> <i class="fas fa-caret-down"></i></a>
							<ul class="menu sub-menu">
								<li class="menu-item sub-menu-item">
									<a class="menu-link" 
									href="<?php echo HREF; ?>user/profil/<?php echo $_SESSION['logged']['username']; ?>">
										Profil
									</a>
								</li>
								<li class="menu-item sub-menu-item">
									<a class="menu-link" href="<?php echo HREF; ?>user/logout">Wyloguj</a>
								</li>
							</ul>
						</li>

						<!-- Tylko dla mogących pisać artykuły -->
						<?php if($_SESSION['logged']['id_role']<3){ ?>
							<li class="menu-item">
								<a href="<?php echo HREF; ?>single/write">
									Nowy artykuł
								</a> 
							</li>
						<?php } ?>
					
					<!-- Tylko dla niezalogowanych -->
					<?php } else { ?>
						<li class="menu-item">
							<a href="<?php echo HREF; ?>user/register">Rejestracja</a>
						</li>
						<li class="menu-item" id="open-form">
							<a>Zaloguj</a>
						</li>
					<?php } ?>
				</ul>
			</nav>

			<!-- Formularz logowania mobilny -->
			<?php if(!isset($_SESSION['logged'])){ ?>
				<form action="<?php echo HREF; ?>user" method="post" class="login-form form-moblie">
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

		<!-- Formularz logowania desktop -->
		<?php if(!isset($_SESSION['logged'])){ ?>
			<div class="login-popup">
				<form action="<?php echo HREF; ?>user" method="post" class="login-form">
					<header class="login-form-header">
						<h2>Logowanie</h2>
						<i class="far fa-times-circle" id="close-form"></i>
					</header>
					<input type="text" name="user" class="login-form-input" placeholder="username...">
					<input type="password" name="pass" class="login-form-input" placeholder="password">
					<input type="submit" value="zaloguj" name="login" class="login-form-input">
				</form>
			</div>
		<?php } ?>

		<!-- messages -->
		<div class="messages">
			<?php if(isset($_SESSION['messages'])){foreach ($_SESSION['messages'] as $msg) {?>
				<div class="message">
					<?php echo $msg; ?>
				</div>
			<?php } $_SESSION['messages'] = array(); } ?>
		</div>
	</header>
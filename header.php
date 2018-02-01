<div class="header">
	<div class="headerarea">
		<div class="logo"><a href=""><img src="images/logo.png" alt = "logo"></a></div>
		<div class="navbar">
			<div class="navbutton"><a href="./index.php?page=main"><img src="./images/home_button.png" alt = "nav"></a></div>
			<div class="navbutton"><a href="./index.php?page=about"><img src="./images/about_button.png" alt = "about"></a></div>
			<?php session_start(); if (($_SESSION['logged_in']) == True) { ?>
			<div class="navbutton"><a href="logout.php"><img src="./images/logout_button.png" alt ="logout"></a></div>
			<?php } else { ?>
			<div class="navbutton"><a href="./index.php?page=login"><img src="./images/login_button.png" alt = "login"></a></div>
			<?php
			}
			?>
			<div class="navbutton"><a href="./index.php?page=donate"><img src="./images/donate_button.png" alt = "donate"></a></div>
		</div>
		
		<div class="logged_in_user"><?php echo $_SESSION['sess_username']; ?></div>
		
	</div>
</div>

<?php 
		include 'pagelocker.php';
		$_SESSION['logged_in'] = False;
		session_destroy();
		header('Location: index.php?page=main');
		exit();
	
?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link type="text/css" href="styles.css" rel="stylesheet"/> <!-- bradly -->
<link rel="stylesheet" type="text/css" href="login_styles.css" /> <!-- bradly -->
<link rel="stylesheet" type="text/css" href="footer_styles.css" /> <!-- bradly -->
<link rel = "stylesheet" type = "text/css" href = "projectCss.css" /> <!-- patrick f -->
<link rel = "stylesheet" type = "text/css" href = "stylesp.css" /> <!-- patrick c -->
<link rel = "stylesheet" type = "text/css" href = " style.css" /> <!-- brendon -->
<title>Web Dev Final</title>
</head>

<body>
	<?php 
		include 'pagelocker.php';
		include 'header.php';
	
	
	?>
	
	<?php
		switch($_GET['page']) {
			case 'main':
				include 'finalHome.php';
				break;
			case 'about':
				include 'about.php';
				break;
			case 'login':
				include 'login.php';
				break;
			case 'donate':
				include 'donate.php';
				break;
			case 'finalEntry':
				include 'finalEntry.php';
				break;
			default:
				include 'finalHome.php';
				break;
		}	
	?>
	
	
	<?php
	
		include 'footer.php';
	?>

</body>
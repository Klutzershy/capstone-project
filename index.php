<!DOCTYPE html>
<html lang="en">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap core CSS (Must be First CSS Link) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--<link type="text/css" href="bootstrap/bootstrap.css" rel="stylesheet"/>
<link type="text/css" href="styles.css" rel="stylesheet"/> <!-- bradly -->
<!--<link rel="stylesheet" type="text/css" href="login_styles.css" /> <!-- bradly -->
<!--<link rel="stylesheet" type="text/css" href="footer_styles.css" /> <!-- bradly -->
<!--<link rel = "stylesheet" type = "text/css" href = "projectCss.css" /> <!-- patrick f -->
<!--<link rel = "stylesheet" type = "text/css" href = "stylesp.css" /> <!-- patrick c -->
<!--<link rel = "stylesheet" type = "text/css" href = " style.css" /> <!-- brendon -->
<title>Capstone Project</title>
</head>

<body>
	<?php
		session_start();
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
		include 'bootstrap_js.php';
	?>


</body>

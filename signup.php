<!DOCTYPE html>
<html lang="en">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link type="text/css" href="styles.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="login_styles.css" />
<title>Web Dev Final</title>
</head>

<body>
<?php 
	session_start();
	include 'header.php'
	
?>

<?php

function checkEmail($email) {

	$email = filter_var($email, FILTER_VALIDATE_EMAIL);

	if (!$email) {
		$GLOBALS['emailError'] = 'Please input a valid E-mail.';
		return false;
	}
	if(empty($_POST['email'])) {
		return false;
	} 
	return true;
}

function checkPassword($password) {
	
	if(empty($_POST['password'])) {
		$GLOBALS['passwordError'] = 'Please input a password.';
		return false;
	}
	return true;
}

function checkUsername($userN) {
	$userN = trim($userN);
	$userN = stripslashes($userN);
	$userN = htmlspecialchars($userN);
	
	if(empty($_POST['username'])) {
		$GLOBALS['userNError'] = 'Please input a valid Username.';
		return false;
	}
	return true;
}



$validEmail = $validPassword = $validUsername = $validInput = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$userN = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$validUsername = checkUsername($userN);
	$validPassword = checkPassword($password);
	$validEmail = checkEmail($email);
	
	$validInput = $validUsername && $validPassword && $validEmail;

}

if ($validInput) {
	
	$servername = "localhost";
	$servUsername = "root";
	$servPassword = "mysql";
	$databaseName = "projectData";
	
	$connection = new mysqli($servername, $servUsername, $servPassword, $databaseName);
	
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	
	
	$options = array (
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		'cost' => 10,
	);
	
	$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
	
	$insertSQL = "INSERT INTO user (email, password, display_name) VALUES ('$email', '$password_hash', '$userN')";
	
		if($connection->query($insertSQL) === TRUE) {
			header('Location: ./index.php?page=login');
			exit();
		} else {
			echo "Connection Error: Please try again later";
		}
		
		$connection->close();
} else {
?>

<div class="login_inform">Please enter the following information to sign up.</div>

<div class="login_form">
<form method="POST" action="./signup.php">
	<span class="login_email">Email</span><br>
		<input type="email" name="email"><?php echo $emailError; ?><br>
	<span class="login_pass">Password</span><br>
		<input type="password" name="password"><?php echo $passwordError; ?><br>
		<span class="login_email">Username</span><br>
		<input type="text" name="username"><?php echo $userNError; ?><br><br>
	<input type="submit" name="submit" value="Sign Up">
</form>
</div>

<?php 
}
?>
<?php 

	include 'footer.php'
	
?>
</body>
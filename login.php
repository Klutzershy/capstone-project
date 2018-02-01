<?php
session_start();
if (isset($_SESSION['logged_in'])){
header("Location: ./index.php?page=main");
}
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


$validEmail = $validPassword = $validInput = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	$validPassword = checkPassword($password);
	$validEmail = checkEmail($email);
	
	if ($_SESSION['logged_in']) {
	
	}
	
	$validInput = $validPassword && $validEmail;

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
	
	$email = $_POST['email'];
	$SQLchecker = "SELECT * FROM `user` WHERE email = '$email'";
	$resultem = mysqli_query($connection, $SQLchecker);
	$resultem = mysqli_fetch_assoc($resultem);
	$_SESSION['sess_email'] = $resultem['email'];
	echo $_SESSION['sess_email'];
	

	$SQLchecker = "SELECT * FROM `user` WHERE email = '$email'";
	$resultem = mysqli_query($connection, $SQLchecker);
	$resultem = mysqli_fetch_assoc($resultem);
	$_SESSION['sess_username'] = $resultem['display_name'];
	echo $_SESSION['sess_username'];
	
	
	//password verification
	$email = $_POST['email'];
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	$sql = "SELECT password FROM `user` WHERE email = '$email'";
	$result = mysqli_query($connection, $sql);
	$result = mysqli_fetch_assoc($result);
	$password_hash = $result['password'];
	
	if (password_verify($password, $password_hash)) {
		session_start();
		$_SESSION['logged_in'] = True;
	} else {
		echo "FAILED VALIDATION";
	}
		
		$connection->close();
		
		header("Location: ./index.php?page=main");
} else {
?>

<div class = "loginarea">
<div class="login_inform">Please enter the following information to login.</div>

<div class="login_form">
<form method="POST" action="./login.php" >
	<span class="login_email">Email</span><br>
		<input type="email" name="email"><br>
	<span class="login_pass">Password</span><br>
		<input type="password" name="password"><br><br>
	<input type="submit" name="submit" value="Login"><br>
	<a class="signup_link" href='signup.php'>Don't have an account? Sign up here</a>
</form>
	
</div>
</div>
<?php
}
?>
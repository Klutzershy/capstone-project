<form method = "POST" action = "/project/admin.php">
Username: <input type ="text" name = "username"><br><br>
Password: <input type = "password" name = "pw"><br><br>
<input type = "Submit" name = "submit" value = "Submit">
</form>




<?php

if ($_SERVER['REQUEST_METHOD'] == "POST"){
	$servername = "localhost";
	$username = "root"; 
	$password = "mysql";
	$databaseName = "projectData";
	
	$connection = new mysqli($servername, $username, $password, $databaseName);
	
	if($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	$username = $_POST['username'];
	$pw = mysqli_real_escape_string($connection, $_POST['pw']);
	$sql = "SELECT password FROM `admin` WHERE username = '$username'";
	$result = mysqli_query($connection, $sql);
	$result = mysqli_fetch_assoc($result);
	$password_hash = $result['password'];
	
	if(password_verify($pw, $password_hash)){
		session_start();
		$_SESSION['admin_rights'] = true;
		echo "Page is unlocked " . "Session set to " . $_SESSION['admin_rights'];	
	} else {
		echo "Failed Validation " . "Page locked";
	}
}

?>


<!-- admin password -->
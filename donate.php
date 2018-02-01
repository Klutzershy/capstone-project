<link rel="stylesheet" type="text/css" href="projectCss.css">


<div class = "donateWrapper">
	<div class = "donateForm">
	

		<div class = "help">
		
		<p class = "donateLarge">
		 DONATE
		</p>
		<p class = "weNeed">
		We need YOUR help!
		</p>
		<p class = "lorem">
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec interdum ex. Etiam quis
		egestas quam, a luctus lorem. Mauris varius aliquam posuere. 
		</p>
		
		</div>
	
		<div class = "donateInner">
<script>
function resetForm(){
	document.getElementById("contact_done").reset();
}
</script>

		
<?php

function checkEmail($email){
	
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	
	if (!$email) {
		$GLOBALS['emailError'] = "Please input a valid E-mail";
		return false;
	}
	return true;
}
	$amount;
	
	if(isset($_POST['amount'])) {
        if($_POST['amount'] == 'five') {
            $amount = "$5";
        } elseif($_POST['amount'] == 'ten') {
            $amount = "$10";
        }
		elseif($_POST['amount'] == 'fifteen'){
			$amount = "$15";
		}
		elseif($_POST['amount'] == 'twenty'){
			$amount = "$20";
		}
    }
	
$validEmail = $validInput = false;


	if ($_SERVER['REQUEST_METHOD'] === "POST"){
		
		$email = $_POST['email'];
		$validEmail = checkEmail($email);
		
		$validInput = $validEmail;	
	}
	
	
	
	if ($validInput) {
	
	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$databaseName = "projectData";
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	
	$connection = new mysqli($servername, $username, $password, $databaseName);
	
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}
		
	$insertSQL = "INSERT INTO donateAmount (amount, email, ipaddress) VALUES ('$amount', '$email', '$ipaddress')"; 

	if ($connection->query($insertSQL) === TRUE) {
		echo "Thank you for your " . $amount . " donation";		
	}
	
	else {
		echo "Error: " . $insertSQL . "<br>" . $connection->error; 
	}

	$connection->close();
	
}

   	
	
else {

?>	
		
		
		
		<form method = "POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=donate";?>" name ="contact_us" id = "contact_us">
			<input type="radio" name="amount" value="five"> $5
			<input type="radio" name="amount" value="ten"> $10
			<input type="radio" name="amount" value="fifteen"> $15
			<input type="radio" name="amount" value="twenty"> $20  <span style = "color:red"> *Amount is required <?php echo $amountError; ?></span><br><br>
			Email:<input type ="text" name = "email"> <span style = "color:red"> *Email is required <?php echo $emailError; ?></span><br><br>
			<input type="submit" value="Submit">
			<input type = "reset" name = "resetButton" value = "Reset" onclick="resetForm()">
		</form>
	
<?php
}?>
	
		</div>
	
	
	
	
	
	
	
	</div>
</div>
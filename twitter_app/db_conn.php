	<?php
				$servername = "localhost";
        $username = "teamCapstone";
        $password = "Robinson1!";
        $databaseName = "Capstone2018";


      $connection = new mysqli($servername, $username, $password, $databaseName);

      if ($connection->connect_error){
        die("connection failed: ".$connection->connect_error);
      }
	  ?>

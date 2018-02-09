	<?php
				$servername = "localhost";
        $username = "root";
        $password = "mysql";
        $databaseName = "TestData";


      $connection = new mysqli($servername, $username, $password, $databaseName);

      if ($connection->connect_error){
        die("connection failed: ".$connection->connect_error);
      }
	  ?>

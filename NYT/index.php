<!DOCTYPE html>
<html>
<head>
	<title>Movie Reviews</title>
</head>
<body>
	<h1>New York Times Movie Reviews</h1>

	<form action = "./index.php">
		<input type="text" name="query" placeholder="Search by Title">
	</form>

 	<?php

 		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$query = array(
  			"api-key" => "b4addf38cdea4f18a3b09d82d0cbcd2d",
  			"query" => $_GET['query']
		);


		curl_setopt($curl, CURLOPT_URL,
  			"https://api.nytimes.com/svc/movies/v2/reviews/search.json" . "?" . http_build_query($query)
		);


		$result = json_decode(curl_exec($curl), true);

		// echo "<pre>";
		// print_r($result);
		// echo "<pre>";


		$servername = "localhost";
		$username = "root";
		$password = "mysql";
		$databasename = "movie_reviews";

		$connection = new mysqli($servername, $username, $password, $databasename);

		if ($connection->connect_error){
			die("Connection failed: " . $connection->connect_error);
		}


		$item = $result[results];


		/* Sets all variables which will be put into the database */
		$byLine          = $item[0]{'byline'};
		$criticsPick     = $item[0]{'critics_pick'};
		$dateUpdated     = $item[0]{'date_updated'};
		$displayTitle    = mysqli_real_escape_string($connection,
													 $item[0]{'display_title'});
		$headline        = mysqli_real_escape_string($connection,
													 $item[0]{'headline'});
		$linkText        = mysqli_real_escape_string($connection,
													 $item[0][link]{'suggested_link_text'});
		$linkType        = $item[0][link]{'type'};
		$linkUrl         = $item[0][link]{'url'};
		$rating          = $item[0]{'mpaa_rating'};
		// $mediaHeight     = $item[0][multimedia]{'height'};
		// $mediaSource     = $item[0][multimedia]{'src'};
		// $mediaType       = $item[0][multimedia]{'type'};
		// $mediaWidth      = $item[0][multimedia]{'width'};
		$openingDate     = $item[0]{'opening_date'};
		$publicationDate = $item[0]{'publication_date'};
		$summaryShort    = mysqli_real_escape_string($connection,
													 $item[0]{'summary_short'});



		/* Prints out all results to screen*/
		for ($i = 0; $i < count($result[results]); $i++){
			echo "<br>";
			echo "--------------------------------------------------";
			echo "<br>";
			echo "<br>";
			echo "Title:"        . $item[$i]{'display_title'} . "<br>";
			echo "Opening Date:" . $item[$i]{'opening_date'} . "<br>";
			echo "Rated:"        . $item[$i]{'mpaa_rating'} . "<br>";
			echo "Summary:"      . $item[$i]{'summary_short'} . "<br>";
			echo "Read the full review " . '<a target="_blank" href="' .
					$item[$i][link]{'url'} . '">here</a>';
			echo "<br>";
			echo "<br>";
		}



		$insertSQL = 	"INSERT INTO `reviewValues`
								 (byLine, criticsPick, dateUpdated,
								 displayTitle, headline, linkText, linkType,
								 linkUrl, rating, openingDate,
								 publicationDate, summaryShort)

					 	VALUES ('$byLine', '$criticsPick', '$dateUpdated',
					  		  '$displayTitle', '$headline', '$linkText',
					  		  '$linkType', '$linkUrl', '$rating',
							  '$openingDate', '$publicationDate',
							  '$summaryShort')";


		if ($connection->query($insertSQL) === TRUE){

		} else {
			echo "Error"."<br>".$insertSQL."<br>".$connection->error;;
		}

		$connection->close();

 	?>

</body>
</html>

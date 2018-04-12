<!DOCTYPE html>
<html lang="en">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap core CSS (Must be First CSS Link) -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link type="text/css" href="custom_styles.css" rel="stylesheet"/>

<title>Capstone Project</title>
</head>

<body class = "login_backg">

<div class = "row top login_text">

<div class = "container">
 <div class = "text-center">

<p>
  <a class="btn btn-primary" data-toggle="collapse" href="#genre" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Search by Genre</a>
   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#review" aria-expanded="false" aria-controls="multiCollapseExample2">Search by Review</button>
</p>

</div>
</div>

<div class = "container w-50">
<div class = "col text-center ">
<div class="collapse " id="genre">
  <div class="card card-body">

   <form action = "./search.php">
	<input type = "text" name = "search" placeholder = "Search by Title"/>
	<br>
	<select name="gens">
		<option value="" selected>Select a genre:</option>
		<option value="action">Action</option>
		<option value="adventure">Adventure</option>
		<option value="animation">Animation</option>
		<option value="comedy">Comedy</option>
		<option value="crime">Crime</option>
		<option value="documentary">Documentary</option>
		<option value="drama">Drama</option>
		<option value="family">Family</option>
		<option value="fantasy">Fantasy</option>
		<option value="history">History</option>
		<option value="horror">Horror</option>
		<option value="music">Music</option>
		<option value="mystery">Mystery</option>
		<option value="romance">Romance</option>
		<option value="science">Science Fiction</option>
		<option value="tv">TV Movie</option>
		<option value="thriller">Thriller</option>
		<option value="war">War</option>
		<option value="western">Western</option>
	</select>
	<button type = "submit">Submit</button>
</form>




<?php

	if(isset($_GET['gens'])){
		if($_GET['gens'] == ''){
			$genCode = "Select valid genre!";
		} elseif ($_GET['gens'] == 'action'){
			$genCode = 28;
		} elseif ($_GET['gens'] == 'adventure') {
			$genCode = 12;
		} elseif ($_GET['gens'] == 'animation') {
			$genCode = 16;
		} elseif ($_GET['gens'] == 'comedy') {
			$genCode = 35;
		} elseif ($_GET['gens'] == 'crime') {
			$genCode = 80;
		} elseif ($_GET['gens'] == 'documentary') {
			$genCode = 99;
		} elseif ($_GET['gens'] == 'drama') {
			$genCode = 18;
		} elseif ($_GET['gens'] == 'family') {
			$genCode = 10751;
		} elseif ($_GET['gens'] == 'fantasy') {
			$genCode = 14;
		} elseif ($_GET['gens'] == 'history') {
			$genCode = 36;
		} elseif ($_GET['gens'] == 'horror') {
			$genCode = 27;
		} elseif ($_GET['gens'] == 'music') {
			$genCode = 10402;
		} elseif ($_GET['gens'] == 'mystery') {
			$genCode = 9648;
		} elseif ($_GET['gens'] == 'romance') {
			$genCode = 10749;
		} elseif ($_GET['gens'] == 'science') {
			$genCode = 878;
		} elseif ($_GET['gens'] == 'tv') {
			$genCode = 10770;
		} elseif ($_GET['gens'] == 'thriller') {
			$genCode = 53;
		} elseif ($_GET['gens'] == 'war') {
			$genCode = 10752;
		} elseif ($_GET['gens'] == 'western') {
			$genCode = 37;
		}
	}






if(!empty($_GET['search'])){
	$search_url = 'https://api.themoviedb.org/3/search/movie?api_key=2b026bda7ea9b58930161475b7d89a62&language=en-US&query=' . urlencode($_GET['search']) . '&page=1&include_adult=false&region=US%7CCA';

	$search_json = file_get_contents($search_url);
	$search_array = json_decode($search_json,true);
}


	$prefix = "https:/image.tmdb.org/t/p/w500/";

	if(!empty($_GET['search']) and !($_GET['gens'] == '')){
	echo "You are searching for movies with the words: " . ucfirst($_GET['search']) . " in the " . ucfirst($_GET['gens']) . " category.";
	}
	else{
		echo "Enter a valid search and genre!";
	}

	$rec = array(); //array to get movie ids
	$title = array(); //array to get movie titles


if(is_array($search_array)){
	foreach($search_array[results] as $movie){

			if(in_array($genCode, $movie[genre_ids])){
				if($movie[original_language] == "en"){
				$s.="<p><img src= $prefix.$movie[poster_path] height=80 width=60/></p>";
				$s.="<p>Title: $movie[original_title]<br>Release Date: $movie[release_date]</p>";
				array_push($rec, $movie[id]); //push ids into array
				array_push($title, $movie[original_title]); //push titles into array
				$record = array_pop(array_reverse($rec)); //return first movie id
				$titles = array_pop(array_reverse($title)); //return first movie title
			}
			}
		}
	}
	echo $s;

	if(empty($rec)){
		$record = 0;
	}

	if(empty($title)){
		$titles = " ";
	}


	require 'db_conn.php';

	$search = ucfirst($_GET['search']);

function removeZero(){
	require 'db_conn.php';
	$query = "DELETE FROM `movSearch` WHERE `movID` = 0";
	$result = mysqli_query($connection, $query);
}

function idInDatabase($dbMov){
	require 'db_conn.php';
	$query = "SELECT movID from `movSearch` WHERE movID = $dbMov";
	$result = mysqli_query($connection, $query);
	$result = mysqli_fetch_assoc($result);
	$chkID = $result['movID'];
	$connection->close();
	if($dbMov == $chkID){
		return TRUE;
	} else {
		return FALSE;
	}
}

function updateDatabase($dbMov,$dbSearch,$dbFirst,$dbGen) {
    require 'db_conn.php';
	$query = "SELECT movID FROM `movSearch` where movID = $dbMov";
	$result = mysqli_query($connection, $query);
	$result = mysqli_fetch_assoc($result);
    $chkSearch = $result['search'];
    $chkFirst = $result['firstMov'];
    $chkGen = $result['genCode'];
    $connection->close();
    if($dbSearch != $chkSearch){
      $insertSQL = "INSERT INTO movSearch (search) VALUES ('$dbSearch')";
    }
    if($dbFirst != $chkFirst){
      $insertSQL = "INSERT INTO movSearch (firstMov) VALUES ('$dbFirst')";
    }
    if($dbGen != $chkGen){
      $insertSQL = "INSERT INTO movSearch (genCode) VALUES ('$dbGen')";
    }
  }

	$dbMov = $record;
	$dbSearch = $search;
	$dbFirst = $titles;
	$dbGen = $genCode;

if(!idInDatabase($dbMov)){


    $insertSQL = "INSERT INTO movSearch (search, movID, firstMov, genCode) VALUES ('$search', '$record', '$titles', '$genCode')";

    if($connection->query($insertSQL) === TRUE){

      echo "Success";
    } else {
      echo "Error: ".$insertSQL."<br/>".$connection->error;
    }
  }


  updateDatabase($dbMov,$dbSearch,$dbFirst,$dbGen);
  removeZero();

  $connection->close();


	?>
  </div>
</div>
</div>
</div>


<div class = "container">
<div class="col">
    <div class="collapse multi-collapse" id="review">
      <div class="card card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</div>

</body>

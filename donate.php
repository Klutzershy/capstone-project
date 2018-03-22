
<?php

//Patrick Foltyn 		2/23/2018
//Capstone Project

?>




<form action = "./donate.php">
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

	echo $s;

	$search = ucfirst($_GET['search']);

	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$databaseName = "finalData";


	$connection = new mysqli($servername, $username, $password, $databaseName);

	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}

	$insertSQL = "INSERT INTO movSearch (search, movID, firstMov, genCode) VALUES ('$search', '$record', '$titles', '$genCode')";



	$connection->close();

	?>

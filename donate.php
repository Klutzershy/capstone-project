


<?php

//Patrick Foltyn 		2/23/2018
//Capstone Project

if(!empty($_GET['search'])){
	$search_url = 'https://api.themoviedb.org/3/search/movie?api_key=2b026bda7ea9b58930161475b7d89a62&language=en-US&query=' . urlencode($_GET['search']) . '&page=1&include_adult=false';

	$search_json = file_get_contents($search_url);
	$search_array = json_decode($search_json,true);
}

?>



<form action = "./donate.php">
	<input type = "text" name = "search" placeholder = "Search by Genre"/>
	<button type = "submit">Search</button>
	<br>
</form>



<?php
	$genres = array( "28"=>"Action", "12"=>"Adventure", "16"=>"Animation", "35"=>"Comedy", "80"=>"Crime", "99"=>"Documentary", "18"=>"Drama",
		"10751"=>"Family", "14"=>"Fantasy", "36"=>"History", "27"=>"Horror", "10402"=>"Music", "9648"=>"Mystery", "10749"=>"Romance", "878"=>"Science Fiction", "10770"=>"TV Movie", "53"=>"Thriller", "10752"=>"War", "37"=>"Western");

	$prefix = "https:/image.tmdb.org/t/p/w500/";

	if(!empty($_GET['search'])){
	echo "You are searching for movies with the words: " . $_GET['search'] . ".";
	}
	else{
	echo "Enter a valid search!";
	}




	foreach($search_array[results] as $movie){
			$s.="<p><img src= $prefix.$movie[poster_path] height=80 width=60/></p>";
			$genArray = implode(" " ,$movie[genre_ids]);
			$s.="<p>Title: $movie[original_title]<br>Release Date: $movie[release_date]<br>Genre ID: $genArray</p>";
		}

	echo $s;

?>

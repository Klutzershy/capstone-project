


<?php

//Patrick Foltyn 		2/23/2018
//Capstone Project

if(!empty($_GET['search'])){
	$search_url = 'https://api.themoviedb.org/3/search/movie?api_key=2b026bda7ea9b58930161475b7d89a62&language=en-US&query=' . urlencode($_GET['search']) . '&page=1&include_adult=false';

	$search_json = file_get_contents($search_url);
	$search_array = json_decode($search_json);
}

?>



<form action = "./donate.php">
	<input type = "text" name = "search"/>
	<button type = "submit">search</button>
	<br>
</form>


<?php

	echo "You are searching for movies with the name: " . $_GET['search'];
	echo '<pre>';
	print_r($search_array);
	echo '</pre>';
?>

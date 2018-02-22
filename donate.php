<link rel="stylesheet" type="text/css" href="projectCss.css">


<div class = "donateWrapper">
	<div class = "donateForm">




		<div class = "donateInner">

<?php

if(!empty($_GET['search'])){
	$search_url = 'https://api.themoviedb.org/3/search/movie?api_key=2b026bda7ea9b58930161475b7d89a62&language=en-US&query=' . $_GET['search'];

	$search_json = file_get_contents($search_url);
	$search_array = json_decode($search_json, true);
}

?>

<h1> The Movie Database API Search </h1>

<p> Search for movie by title </p>

<form action = "">
	<input type = "text" name = "search"/>
	<button type = "submit">search</button>
	<br>
	<?php

	foreach($search_array[results] as $movie){
			echo $movie['title'] . " released: " . $movie[release_date] . "<br>";
		}


	?>
</form>

</div>







	</div>
</div>

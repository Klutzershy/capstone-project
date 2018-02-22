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

<form action = "./donate.php">
	<input type = "text" name = "search"/>
	<button type = "submit">search</button>
	<br>
	<?php
	$prefix = "https://cf2.imgobject.com/t/p/w500";

		foreach($search_array[results] as $movie){
				$s.="<p><img src= $prefix.$movie[poster_path] height=80 width=60/></p>";
				$s.="<p>Title: $movie[original_title]<br>Release Date: $movie[release_date]</p>";


			}

		echo $s;


	?>
</form>

</div>







	</div>
</div>

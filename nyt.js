

var url = "https://api.nytimes.com/svc/movies/v2/reviews/search.json";
		url += '?' + $.param({
		  'api-key': "b4addf38cdea4f18a3b09d82d0cbcd2d",
		  'query': "comedy"
		});

		$.ajax({
		  url: url,
		  method: 'GET',
		}).done(function(result) {
		  console.log(result);
		  document.write(JSON.stringify(result));
		}).fail(function(err) {
		  throw err;
		});

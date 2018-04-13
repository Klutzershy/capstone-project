<script>
      var map;
      var infowindow;


      function GetLatlong()
        {
        var geocoder = new google.maps.Geocoder();
        var address = "Rowan University";

        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

            }
          });
}
      function initMap() {
        var Location = {lat: <?php $latOne ?>, lng: <?php $lngOne ?>};

        map = new google.maps.Map(document.getElementById('map'), {
          center: Location,
          zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: Location,
          radius: 50000,
          type: ['movie_theater']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
</script>
<div id="map" class="col-md-6" style="height:100%;margin:auto"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJcbdw_nWmu-ZogZc0TbOPDWDKVDCd3MQ&libraries=places&callback=initMap" async defer></script>

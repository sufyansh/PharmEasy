<!DOCTYPE html>
<html>
<body>

<h1>My First Google Map</h1>

<!-- Add input field for searching location -->
<input id="locationInput" type="text" placeholder="Enter location">
<button onclick="searchLocation()">Search</button>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap(latitude, longitude) {
  var mapProp = {
    center: new google.maps.LatLng(latitude, longitude),
    zoom: 12,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

// Function to search for a location entered by the user
function searchLocation() {
  var location = document.getElementById("locationInput").value;
  navigateToLocation(location);
}

// Function to navigate to location
function navigateToLocation(location) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': location }, function(results, status) {
    if (status === 'OK') {
      var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 12,
        center: results[0].geometry.location
      });
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

// Function to extract parameters from URL
function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Get location query from URL parameter
var locationQuery = getUrlParameter('query');

// If location query is provided, search for the location
if (locationQuery) {
  searchLocation(locationQuery);
}
</script>

<!-- Dynamic loading of Google Maps JavaScript API -->
<script>
  (function() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBIJnDNO0YMVyi0ibW70HDvH24WPsn9K1U&callback=myMap';
    document.body.appendChild(script);
  })();
</script>

</body>
</html>

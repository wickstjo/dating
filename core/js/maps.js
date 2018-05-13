var coords;
var map;
var hsl;

function geocode(query) {

   console.log('map query: ' + query);
   
   axios.get('https://maps.googleapis.com/maps/api/geocode/json', {

      params:{
         address: query + ', Finland',
         key: 'AIzaSyCN4kOw1na9LgXGDPokVeZXOo9pfXGQ2eA'
      }
   
   }).then(function(response) {
      coords = response.data.results[0].geometry.location;

      initMap();

      // HSL
      axios.get('https://api.digitransit.fi/geocoding/v1/search?text=cafe&boundary.circle.lat=' + coords.lat + '&boundary.circle.lon=' + coords.lng + '&boundary.circle.radius=2', {
      }).then(function(response) {
         hsl = response.data.features;
         var counter = 0;

         $.each(hsl, function(){
            addMarker(hsl[counter]);
            counter++;
         });

      }).catch(function(error) {
         console.log(error);
      });

   }).catch(function(error) {
      console.log(error);

   });
}

function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: coords
   });
   
   var circle = new google.maps.Circle({
	   map: map,
		center: coords,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.35,
		radius: 2000
   });
}

 function addMarker(place) {
   var asdf = { lat: place.geometry.coordinates[1], lng: place.geometry.coordinates[0] };

   var marker = new google.maps.Marker({
      map: map,
      position: asdf,
      label: place.properties.name,
      icon: {
         url: 'https://developers.google.com/maps/documentation/javascript/images/circle.png',
         anchor: new google.maps.Point(10, 10),
         scaledSize: new google.maps.Size(10, 17)
      }
   });
 }

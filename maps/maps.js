var coords;
var map;
var service;

function geocode(query) {

   console.log('map query: ' + query);
   
   axios.get('https://maps.googleapis.com/maps/api/geocode/json', {

      params:{
         address: query,
         key: 'AIzaSyCN4kOw1na9LgXGDPokVeZXOo9pfXGQ2eA'
      }
   
   }).then(function(response) {
      coords = response.data.results[0].geometry.location;
      initMap();
      performSearch();

   }).catch(function(error) {
      console.log(error);

   })
}

function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: coords
   });

   var marker = new google.maps.Marker({
      position: coords,
      map: map
   });

   service = new google.maps.places.PlacesService(map);
   map.addListener('idle', performSearch);
}

function performSearch() {
   var request = {
      location: coords,
      radius: 1000,
      types: ['cafe']
   };

   service.radarSearch(request, callback);
}

function callback(results, status) {
   if (status !== google.maps.places.PlacesServiceStatus.OK) {
      console.error(status);
      return;
   }

   for (var i = 0, result; result = results[i]; i++) {
      addMarker(result);
   }
}

 function addMarker(place) {
   var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location,
      icon: {
         url: 'https://developers.google.com/maps/documentation/javascript/images/circle.png',
         anchor: new google.maps.Point(10, 10),
         scaledSize: new google.maps.Size(10, 17)
      }
   });
 }

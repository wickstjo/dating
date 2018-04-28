function geocode(query) {

   var query = query;
   console.log('map query: ' + query);
   
   axios.get('https://maps.googleapis.com/maps/api/geocode/json', {

      params:{
         address: query,
         key: 'AIzaSyCN4kOw1na9LgXGDPokVeZXOo9pfXGQ2eA'
      }
   
   }).then(function(response) {
      var coords = response.data.results[0].geometry.location;
      initMap(coords);

   }).catch(function(error) {
      console.log(error);

   })
}

function initMap(query) {
   var coords = query;

   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: coords
   });

   var marker = new google.maps.Marker({
      position: coords,
      map: map
   });
}
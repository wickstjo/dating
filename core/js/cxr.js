
// IF IT DOESN'T EXIST
   if (localStorage.getItem('CXR-rates') === null || localStorage.getItem('CXR-headers') === null) {
      
      // SET NEW ITEM
      $.get('https://openexchangerates.org/api/latest.json', {app_id: 'efde46f514f8464a9c4b88c307981b1e'}, function(data) {
         localStorage.setItem('CXR-rates', JSON.stringify(data));
      });

      $.get('https://openexchangerates.org/api/currencies.json', function(data) {
         localStorage.setItem('CXR-headers', JSON.stringify(data));
      });

   // IF IT DOES EXIST
   } else {

      // LAST UPDATE
      var check = JSON.parse(localStorage.getItem('CXR-rates')).timestamp;

      // CURRENT TIME
      var now = (Date.now() / 1000).toFixed(0);

      // IF MORE THAN SIX HOURS HAS EXPIRED SINCE LAST UPDATE
      if (now > check + 21600) {

         // REMOVE OLD ONES
         localStorage.removeItem('CXR-rates');
         localStorage.removeItem('CXR-headers');

         // SET NEW ITEMS
         $.get('https://openexchangerates.org/api/latest.json', {app_id: 'efde46f514f8464a9c4b88c307981b1e'}, function(data) {
            localStorage.setItem('CXR-rates', JSON.stringify(data));
         });

         $.get('https://openexchangerates.org/api/currencies.json', function(data) {
            localStorage.setItem('CXR-headers', JSON.stringify(data));
         });

      }

   }
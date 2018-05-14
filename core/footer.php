</div>
</body>

<script type="text/javascript" src="http://dating.proj/core/js/tools.js"></script>
<?php

   // INJECT MAPS RELATED JS WHEN ON CORRECT PAGE
   if (isset($_GET['code'])) {
      echo '
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRaig-uTjZ9r6fcIFupRCALwjCiXc5b5o&callback=initMap"></script>
      ';
      
   }
?>
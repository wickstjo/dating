<?php
    require_once '../init.php';

   if (isset($_POST['col'])) {
      $col = $_POST['col'];

      // WHITELIST
      $list = array('username', 'zip', 'income', 'seeks');

      // CHECK THAT QUERY FALLS WITHIN WHITELIST
      if (in_array($col, $list)) {

         $people = new people($col);
         $people->show();

      } else {
         echo 'Error. PHP Form not found.';
      }
   }
?>
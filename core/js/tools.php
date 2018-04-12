<?php
    require_once '../init.php';

   if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $list = array('login', 'register', 'settings');

      // CHECK THAT QUERY FALLS WITHIN ALLOWED SECTIONS
      if (in_array($id, $list)) {

         // FETCH CORRECT FORM FOR CORRECT WINDOW
         switch ($id) {
            case 'login':
               form::login();
            break;
            case 'register':
               form::register();
            break;
            case 'settings':
               form::settings();
            break;
         }
      } else {
         echo 'Error. PHP Form not found.';
      }
   }
?>
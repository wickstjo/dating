<?php
    require_once '../init.php';

   if (isset($_POST['id'])) {
      $id = $_POST['id'];
      $list = array('login', 'register', 'settings', 'date_request', 'date_cancel');

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
            case 'date_request':
               form::date_request();
            break;
            case 'date_cancel':
               form::date_cancel();
            break;
         }
      } else {
         echo 'Error. PHP Form not found.';
      }
   }
?>
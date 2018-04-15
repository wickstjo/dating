<?php
    require_once '../init.php';

   if (post::isset('id')) {

      $id = post::val('id');

      // ACCEPT AND DECLINE NEED ANOTHER VARIABLE
      if (post::isset('source')) {
         $source = post::val('source');
      }

      $list = array('login', 'register', 'settings', 'date_request', 'date_cancel', 'accept', 'decline', 'comment', 'remove');

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
            case 'accept':
               form::accept($source);
            break;
            case 'decline':
               form::decline($source);
            break;
            case 'comment':
               form::comment();
            break;
            case 'remove':
               form::remove($source);
            break;
         }
      } else {
         echo 'Error. PHP Form not found.';
      }
   }
?>
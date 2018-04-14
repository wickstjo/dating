<?php
   $section = 'people';
	require_once 'core/header.php';

   // EVERYONE
   if (!isset($_GET['username'])) {

      $people = new people();
      $people->sortMenu();
      $people->show();

   // SINGLE PEOPLE
   } else {

      // IF USER EXISTS
      if (misc::userExists($_GET['username'])) {

         $person = new person($_GET['username']);
         $person->show();

         // SHOW BUTTON IF LOGGED IN & YOU AREN'T VIEWING YOUR OWN PAGE
         if (isset($_SESSION['auth']) && $_SESSION['auth']->fetch('username') != strtolower($_GET['username'])) {
            $person->button();
         }

      // IF USER DOES NOT EXIST
      } else {
         misc::error('User was not found');

      }
   }

   require_once 'core/footer.php';
?>
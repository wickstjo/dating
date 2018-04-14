<?php
   $section = 'people';
	require_once 'core/header.php';

   // EVERYONE
   if (!get::isset('username')) {

      $people = new people();
      $people->sortMenu();
      $people->show();

   // SINGLE PEOPLE
   } else {

      // IF USER EXISTS
      if (misc::userExists(get::val('username'))) {

         $person = new person(get::val('username'));
         $person->show();

         // SHOW BUTTON IF LOGGED IN & YOU AREN'T VIEWING YOUR OWN PAGE
         if (session::logged() && session::username() != strtolower(get::val('username'))) {
            $person->button();
         }

      // IF USER DOES NOT EXIST
      } else {
         misc::error('User was not found');

      }
   }

   require_once 'core/footer.php';
?>
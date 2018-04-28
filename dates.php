<?php
	$section = 'dates';
	require_once 'core/header.php';

   // CHECK THAT USER IS LOGGED IN
   if (session::logged()) {

      // ALL DATES
      if (!get::isset('code')) {

         $dates = new dates(session::username());

         // IF DATE COUNT != 0
         if ($dates->count() != 0) {
            $dates->show();

         // IF IT DOES
         } else {
            misc::error('You have no pending dates yet.');

         }

      // SINGLE DATE
      } else {

         // IF DATE-CODE EXISTS IN DB
         if (misc::codeExists(get::val('code'))) {

            // CREATE OBJECT TO BE ABLE TO REFER TO INTERNAL VALUES
            $date = new date(get::val('code'));

            // CHECK IF VIEWER IS PARTAKING OF THIS DATE
            if (in_array(session::username(), $date->allowed())) {
               $date->show();
               $date->map();

               // PRINT OUT COMMENTS
               $comments = new comments($date->code());

               // IF COMMENTS COUNT != 0
               if ($comments->count() != 0) {
                  $comments->show();

               // IF IT DOES
               } else {
                  misc::error('No comments have been published yet.');

               }

               // EITHER WAY, PRINT BUTTON AT THE BOTTOM
               $comments->button();
               
            // IF NOT
            } else {
               misc::error('You do not have permission to view this material.');

            }

         // IF DATE-CODE DOESN'T EXIST
         } else {
            misc::error('Cannot find the page you are seeking!');

         }

      }

   // IF USER ISN'T LOGGED IN
   } else {
      echo '<div id="error">You need to be logged in to view this page!</div>';
   }

   require_once 'core/footer.php';
?>
<?php
	$section = 'dashboard';
	require_once 'core/header.php';

   // LOGOUT FUNCTIONALITY
	if (get::isset('logout')) {
		unset($_SESSION['auth']);
      misc::redirect('home');
   }

   // IF USER IS LOGGED IN
   if (session::logged()) {
      misc::success('Greetings ' . ucfirst(session::username()) . '!');

      $requests = new requests(session::username());

      // SHOW REQUESTS IF COUNT != 0
      if ($requests->count() != 0) {
         $requests->show();
         
      } else {
         misc::error('There are no pending date requests.');
      }

   // IF USER IS LOGGED OUT
   } else {
      misc::error('Hello Stranger! How about <a href="javascript: void(0)" name="register">registering</a>?');
   }

   require_once 'core/footer.php';
?>
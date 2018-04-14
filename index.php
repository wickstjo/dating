<?php
	$section = 'dashboard';
	require_once 'core/header.php';

   // LOGOUT FUNCTIONALITY
	if (isset($_GET['logout'])) {
		unset($_SESSION['auth']);
      misc::redirect('home');
   }

   if (isset($_SESSION['auth'])) {
      echo '<div id="success">Greetings ' . $_SESSION['auth']->fetch('username') . '!</div>';

      $requests = new requests($_SESSION['auth']->fetch('username'));
      $requests->show();

   } else {
      echo '<div id="error">Hello Stranger! How about <a href="javascript: void(0)" name="register">registering</a>?</div>';
   }

   require_once 'core/footer.php';
?>
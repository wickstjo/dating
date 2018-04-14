<?php
	$section = 'dates';
	require_once 'core/header.php';

   if (session::logged()) {
      echo '<div id="success">Success</div>';

   } else {
      echo '<div id="error">You need to be logged in to view this page!</div>';
   }

   require_once 'core/footer.php';
?>
<?php
	$section = 'dashboard';
	require_once 'core/header.php';

   // LOGOUT FUNCTIONALITY
	if (isset($_GET['logout'])) {
		unset($_SESSION['auth']);
      misc::redirect('home');
   }
?>

<div id="success">Index</div>

<?php require_once 'core/footer.php'; ?>
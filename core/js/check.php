<?php
   require_once '../init.php';
   $check;

   switch ($_POST['src']) {
      case 'login':
         $check = db::instance()->count('SELECT * FROM users WHERE username = ? AND password = ?', array($_POST['username'], hash('sha256', $_POST['password'])));
      break;
      case 'register':
         $check = db::instance()->count('SELECT * FROM users WHERE username = ?', array($_POST['username']));
      break;
   }

   echo json_encode($check);
?>
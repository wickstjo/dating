<?php

   // LOGIN
   if (isset($_POST['login'])) {

      if (isset($_POST['username']) && isset($_POST['password'])) {
         $check = db::instance()->count("SELECT * FROM people WHERE username = ? AND password = ?", array($_POST['username'], hash('sha256', $_POST['password'])));

         if ($check == 1) {
            $_SESSION['auth'] = new person($_POST['username']);
            misc::redirect('self');
         }
      }
   
   // REGISTER
   } else if (isset($_POST['register'])) {

      if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat_password'])) {
         $check = db::instance()->count('SELECT * FROM people WHERE username = ?', array($_POST['username']));

         if ($check == 0) {
            db::instance()->action(
               'INSERT INTO users (username, email, password, status, date) VALUES (?, ?, ?, ?, ?)',
               array(
                  strtolower($_POST['username']),
                  $_POST['email'],
                  $_POST['password'],
                  'Student',
                  date('Y-m-d H:i:s')
               )
            );

            $_SESSION['auth'] = new user($_POST['username']);
            misc::redirect('profile');
         }
      }
   }

?>
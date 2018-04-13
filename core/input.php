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

      if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat_password']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['zip']) && isset($_POST['income']) && isset($_POST['seeks']) && isset($_POST['descr'])) {
         $check = db::instance()->count('SELECT * FROM people WHERE username = ?', array($_POST['username']));

         if ($check == 0) {
            db::instance()->action(
               'INSERT INTO people (username, name, password, email, zip, income, descr, seeks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
               array(
                  strtolower($_POST['username']),
                  $_POST['name'],
                  hash('sha256', $_POST['password']),
                  strtolower($_POST['email']),
                  $_POST['zip'],
                  $_POST['income'],
                  $_POST['descr'],
                  strtolower($_POST['seeks'])
               )
            );

            $_SESSION['auth'] = new person($_POST['username']);
            misc::redirect('profile');
         }
      }
   }

?>
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

         // MAKE SURE USERNAME DOES NOT EXIST
         if (!misc::userExists($_POST['username'])) {

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

   } else if (isset($_POST['settings'])) {

      // CHANGE NAME
      if (!empty($_POST['name'])) {
         db::instance()->action('UPDATE people SET name = ? WHERE username = ?', array($_POST['name'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('name', strtolower($_POST['name']));
      }

      // CHANGE EMAIL
      if (!empty($_POST['email'])) {
         db::instance()->action('UPDATE people SET email = ? WHERE username = ?', array($_POST['email'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('email', strtolower($_POST['email']));
      }

      // CHANGE ZIP
      if (!empty($_POST['zip'])) {
         db::instance()->action('UPDATE people SET zip = ? WHERE username = ?', array($_POST['zip'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('zip', strtolower($_POST['zip']));
      }

      // CHANGE INCOME
      if (!empty($_POST['income'])) {
         db::instance()->action('UPDATE people SET income = ? WHERE username = ?', array($_POST['income'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('income', strtolower($_POST['income']));
      }

      // CHANGE SEEKS
      if (!empty($_POST['seeks'])) {
         db::instance()->action('UPDATE people SET seeks = ? WHERE username = ?', array($_POST['seeks'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('seeks', strtolower($_POST['seeks']));
      }

      // CHANGE DESCRIPTION
      if (!empty($_POST['descr'])) {
         db::instance()->action('UPDATE people SET descr = ? WHERE username = ?', array($_POST['descr'], $_SESSION['auth']->fetch('username')));
         $_SESSION['auth']->set('descr', $_POST['descr']);
      }

      misc::redirect('self');
   }

?>
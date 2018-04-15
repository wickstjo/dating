<?php

   // LOGIN
   if (post::isset('login')) {
      if (!empty(post::val('username')) && !empty(post::val('password'))) {
         $check = db::instance()->count("SELECT * FROM people WHERE username = ? AND password = ?", array(post::val('username'), hash('sha256', post::val('password'))));

         if ($check == 1) {
            $_SESSION['auth'] = new person(strtolower(post::val('username')));
            misc::redirect('self');
         }
      }
   
   // REGISTER
   } else if (post::isset('register')) {
      if (!empty(post::val('username')) && !empty(post::val('password')) && !empty(post::val('repeat_password')) && !empty(post::val('name')) && !empty(post::val('email')) && !empty(post::val('zip')) && !empty(post::val('income')) && !empty(post::val('seeks')) && !empty(post::val('descr'))) {

         // MAKE SURE USERNAME DOES NOT EXIST
         if (!misc::userExists(strtolower(post::val('username')))) {

            db::instance()->action(
               'INSERT INTO people (username, name, password, email, zip, income, seeks, descr) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
               array(
                  strtolower(post::val('username')),
                  strtolower(post::val('name')),
                  hash('sha256', post::val('password')),
                  strtolower(post::val('email')),
                  post::val('zip'),
                  post::val('income'),
                  strtolower(post::val('seeks')),
                  post::val('descr')
               )
            );

            $_SESSION['auth'] = new person(strtolower(post::val('username')));
            misc::redirect('profile');
         }
      }

   // CHANGE SETTINGS
   } else if (post::isset('settings')) {

      // CHANGE NAME
      if (!empty(post::val('name'))) {
         $name = strtolower(post::val('name'));

         db::instance()->action('UPDATE people SET name = ? WHERE username = ?', array($name, session::username()));
         session::set('name', $name);
      }

      // CHANGE EMAIL
      if (!empty(post::val('email'))) {
         $email = strtolower(post::val('email'));

         db::instance()->action('UPDATE people SET email = ? WHERE username = ?', array($email, session::username()));
         session::set('email', $email);
      }

      // CHANGE ZIP
      if (!empty(post::val('zip'))) {
         $zip = strtolower(post::val('zip'));

         db::instance()->action('UPDATE people SET zip = ? WHERE username = ?', array($zip, session::username()));
         session::set('zip', $zip);
      }

      // CHANGE INCOME
      if (!empty(post::val('income'))) {
         $income = post::val('income');
 
         db::instance()->action('UPDATE people SET income = ? WHERE username = ?', array($income, session::username()));
         session::set('income', $income);
      }

      // CHANGE SEEKS
      if (!empty(post::val('seeks'))) {
         $seeks = strtolower(post::val('seeks'));

         db::instance()->action('UPDATE people SET seeks = ? WHERE username = ?', array($seeks, session::username()));
         session::set('seeks', $seeks);
      }

      // CHANGE DESCRIPTION
      if (!empty(post::val('descr'))) {
         $descr = post::val('descr');

         db::instance()->action('UPDATE people SET descr = ? WHERE username = ?', array($descr, session::username()));
         session::set('descr', $descr);
      }

      misc::redirect('self');
   
   // DATE REQUEST
   } else if (post::isset('date_request')) {
      if (!empty(post::val('msg'))) {
      
         db::instance()->action(
            'INSERT INTO requests (fromUser, toUser, msg, status, date) VALUES (?, ?, ?, ?, ?)',
            array(
               session::username(),
               strtolower(get::val('username')),
               post::val('msg'),
               'pending',
               date('Y-m-d H:i:s')
            )
         );
   
         misc::redirect('self');
      }
   
   // CANCEL DATE REQUEST
   } else if (post::isset('date_cancel')) {
      if (post::val('confirm') == 'Confirm' && !empty(post::val('from'))) {
         
         db::instance()->action(
            'DELETE FROM requests WHERE fromUser = ? AND toUser = ?',
            array(
               session::username(),
               strtolower(get::val('username'))
            )
         );

         misc::redirect('self');
      }

   // ACCEPT REQUEST
   } else if (post::isset('accept')) {
      if (post::val('accept_confirm') == 'Accept' && !empty(post::val('from'))) {
         
         db::instance()->action(
            'DELETE FROM requests WHERE fromUser = ? AND toUser = ?',
            array(
               post::val('from'),
               session::username()
            )
         );

         // SAVE ID FOR LATER REDIRECT
         $dateID = misc::generateCode();

         db::instance()->action(
            'INSERT INTO dates (code, person1, person2, date) VALUES (?, ?, ?, ?)',
            array(
               $dateID,
               session::username(),
               post::val('from'),
               date('Y-m-d H:i:s'),
            )
         );

         // REDIRECT TO GENERATED ID
         misc::redirect('dates', $dateID);
      }

   // DECLINE REQUEST
   } else if (post::isset('decline')) {
      if (post::val('decline_confirm') == 'Decline' && !empty(post::val('from'))) {
         
         db::instance()->action(
            'DELETE FROM requests WHERE fromUser = ? AND toUser = ?',
            array(
               post::val('from'),
               session::username()
            )
         );

         misc::redirect('self');
      }

   // POST COMMENT
   } else if (post::isset('post_comment')) {
      if (!empty(post::val('comment'))) {
         
         db::instance()->action(
            'INSERT INTO comments (ref, author, comment, date) VALUES (?, ?, ?, ?)',
            array(
               get::val('code'),
               session::username(),
               post::val('comment'),
               date('Y-m-d H:i:s')
            )
         );

         misc::redirect('self');
      }

   // REMOVE COMMENT
   } else if (post::isset('remove_comment')) {
      if (post::val('remove_confirm') == 'Remove' && !empty(post::val('from'))) {
         
         db::instance()->action(
            'DELETE FROM comments WHERE id = ?', array(post::val('from'))
         );

         misc::redirect('self');
      }
   }

?>
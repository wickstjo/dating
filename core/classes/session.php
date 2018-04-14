<?php
   class session {

      // CHECK IF THERE IS A SESSION
      public function logged() {
         $ret = false;

         if (isset($_SESSION['auth'])) {
            $ret = true;
         }

         return $ret;
      }

      public function username() {
         return $_SESSION['auth']->fetch('username');
      }

      public function name() {
         return $_SESSION['auth']->fetch('name');
      }

      public function email() {
         return $_SESSION['auth']->fetch('email');
      }

      public function zip() {
         return $_SESSION['auth']->fetch('zip');
      }

      public function income() {
         return $_SESSION['auth']->fetch('income');
      }

      public function seeks() {
         return $_SESSION['auth']->fetch('seeks');
      }

      public function descr() {
         return $_SESSION['auth']->fetch('descr');
      }

      public function set($var, $to) {
         $_SESSION['auth']->set($var, $to);
      }

   }
?>
<?php
   class post {

      public function isset($var) {
         $ret = false;

         if (isset($_POST[$var])) {
            $ret = true;
         }

         return $ret;
      }

      public function val($var) {
         return $_POST[$var];
      }

   }
?>
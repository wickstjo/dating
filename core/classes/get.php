<?php
   class get {

      public function isset($var) {
         $ret = false;

         if (isset($_GET[$var])) {
            $ret = true;
         }

         return $ret;
      }

      public function val($var) {
         return $_GET[$var];
      }

   }
?>
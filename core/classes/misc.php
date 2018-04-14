<?php
   class misc {

      // REDIRECT
      public function redirect($str, $q = '') {
         $host = 'http://' . getenv('HTTP_HOST') . '/';

         switch ($str) {
            case 'home':
               return header("location: {$host}");
            break;

            case 'people':
               return header("location: {$host}people");
            break;

            case 'profile':
               return header("location: {$host}/people/{session::username()}");
            break;

            case 'self':
               $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
               return header("location: " . $url);
            break;
         }
      }

      // RETURNS CORRECT HREF FOR MAINMENU LINKS
      public function menuHref($string) {
         $bone = '';

         if ($string == 'none') {
            $bone = 'javascript: void(0)';
         } else {
            $bone = 'http://' . getenv('HTTP_HOST') . '/' . $string;
         }

         return $bone;
      }

      // UNDERLINE CURRENT SECTION IN MAINMENU
      public function menuCurrent($current, $section) {
         if ($current == $section) {
            return ' id="active"';
         }
      }

      // CHECK IF USER EXISTS
      public function userExists($username) {
         $count = db::instance()->count('SELECT * FROM people WHERE username = ?', array(strtolower($username)));
         $bool = false;

         if ($count == 1) {
            $bool = true;
         }

         return $bool;
      }

      // ERROR DIV
      public function error($text) {
         echo '<div id="error">' . $text . '.</div>';
      }

      // FORMAT INCOME NUMBER PROPERLY
      public function income($number) {
         return number_format($number, 0, '', ' ');
      }
 
   }
?>
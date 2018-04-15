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

            case 'dates':
               return header("location: {$host}dates/{$q}");
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

      // CHECK IF DATE-CODE EXISTS
      public function codeExists($code) {
         $count = db::instance()->count('SELECT * FROM dates WHERE code = ?', array($code));
         $bool = false;

         if ($count == 1) {
            $bool = true;
         }

         return $bool;
      }

      // SUCCESS DIV
      public function success($text) {
         echo '<div id="success">' . $text . '</div>';
      }

      // ERROR DIV
      public function error($text) {
         echo '<div id="error">' . $text . '</div>';
      }

      // FORMAT INCOME NUMBER PROPERLY
      public function income($number) {
         return number_format($number, 0, '', ' ');
      }

      // GENERATE UNIQUE DATE ID
      public function generateCode() {
         $code = rand(100000, 999999);
         $check = db::instance()->count("SELECT * FROM dates WHERE code = ?", array($code));

         // LOOP UNTIL CODE CANNOT BE FOUND IN DB
         while ($check == 1) {
            $code = rand(100000, 999999);
         }

         return $code;
      }

      // REFORMAT DATES
      public function date($date, $type) {
         switch ($type) {
            case 'short';
               return date('d/m/y', strtotime($date));
            break;

            case 'shorter';
               return date('d/m', strtotime($date));
            break;

            case 'long';
               return date('d/m/Y @ h:i A', strtotime($date));
            break;

            case 'txt';
               return date('F dS, Y', strtotime($date));
            break;

            case 'title';
               return date('F dS', strtotime($date));
            break;
         }
      }
 
   }
?>
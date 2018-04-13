<?php
   class people {
      private $object;

      public function __construct() {
         $this->object = db::instance()->get('SELECT * FROM people ORDER BY username ASC');
      }

      public function show() {
         echo '
            <table id="people-tbl">
               <tr>
                  <td>Username</td>
                  <td>Zip</td>
                  <td>Income</td>
                  <td>Seeks</td>
               </tr>
         ';

         foreach ($this->object as $res => $r) {
            echo '
               <tr>
                  <td><a href="http://' . getenv('HTTP_HOST') . '/people/' . $r['username'] . '">' . ucfirst($r['username']) . '</a></td>
                  <td>' . $r['zip'] . '</td>
                  <td>' . misc::income($r['income']) . '</td>
                  <td>' . ucfirst($r['seeks']) . '</td>
               </tr>
            ';
         }

         echo '</table>';
      }

   }
?>
<?php
   class people {
      private $object;
      private $order = 'ASC';

      public function __construct($col = 'username') {

         // SORT INCOME BY HIGHEST, REST IN ALPHABETICAL ORDER
         if ($col == 'income') {
            $this->order = 'DESC';
         }

         $this->object = db::instance()->get("SELECT * FROM people ORDER BY {$col} {$this->order}");
      }

      public function show() {
         echo '
            <div id="sorting">
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

         echo '
            </table>
            </div>
         ';
      }

      public function sortMenu() {
         echo '
            <div id="success">
            <table><tr>
               <td>Sort By:</td>
               <td>
                  <a href="javascript: void(0)" name="sort" id="username">Username</a> &nbsp;-&nbsp; <a href="javascript: void(0)" name="sort" id="zip">Zip Code</a> &nbsp;-&nbsp; <a href="javascript: void(0)" name="sort" id="income">Income</a> &nbsp;-&nbsp; <a href="javascript: void(0)" name="sort" id="seeks">Seeks</a>
               </td>
            </tr></table>
            </div>
         ';
      }

   }
?>
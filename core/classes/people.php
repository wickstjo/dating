<?php
   class people {
      private $object;
      private $order = 'ASC';

      public function __construct($col = 'username') {

         // SORT INCOME BY HIGHEST, REST IN ALPHABETICAL ORDER
         if ($col == 'income') {
            $this->order = 'DESC';
         }

         $this->object = db::instance()->get("SELECT username, zip, income, seeks FROM people ORDER BY {$col} {$this->order} LIMIT 4");
      }

      public function show() {
         $curr = 'USD';
         if (session::logged()) {
            $curr = session::currency();
         }

         echo '
            <div id="sorting">
            <table id="people-tbl">
               <tr>
                  <td>Username</td>
                  <td>Zip</td>
                  <td>Income (' . $curr . ')</td>
                  <td>Seeks</td>
               </tr>
         ';

         foreach ($this->object as $res => $r) {
            echo '
               <tr>
                  <td><a href="http://' . getenv('HTTP_HOST') . '/people/' . $r['username'] . '">' . ucfirst($r['username']) . '</a></td>
                  <td>' . $r['zip'] . '</td>
                  <td><div id="money">' . $r['income'] . '</div></td>
                  <td>' . ucfirst($r['seeks']) . '</td>
               </tr>
            ';
         }

         echo '
            </table>
            </div>
         ';
      }

      // SORTING MENU -- JS CONFIG @ core/js/tools.js
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
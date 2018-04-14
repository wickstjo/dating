<?php
   class requests {
      private $object;
      private $count;

      public function __construct($username) {
         $this->object = db::instance()->get('SELECT * FROM requests WHERE toUser = ? ORDER BY date', array(strtolower($username)));
         $this->count = db::instance()->count('SELECT * FROM requests WHERE toUser = ?', array(strtolower($username)));
      }

      public function show() {
         echo '
            <table id="request-tbl">
               <tr>
                  <td>Username</td>
                  <td>Message</td>
                  <td>Options</td>
               </tr>
         ';

         foreach ($this->object as $res => $r) {
            echo '
               <tr>
                  <td>' . $r['fromUser'] . '</td>
                  <td>' . $r['msg'] . '</td>
                  <td>Accept &nbsp;-&nbsp; Decline</td>
               </tr>
            ';
         }

         echo '</table>';
      }

   }
?>
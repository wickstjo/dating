<?php
   class requests {
      private $object;

      public function __construct($username) {
         $this->object = db::instance()->get('SELECT * FROM requests WHERE toUser = ? ORDER BY date', array(strtolower($username)));
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
                  <td><a href="javascript: void(0)" class="accept" name="accept_request">Accept</a> &nbsp;-&nbsp; <a href="javascript: void(0)" class="decline" name="decline_request">Decline</a></td>
               </tr>
            ';
         }

         echo '</table>';
      }

   }
?>
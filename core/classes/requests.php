<?php
   class requests {
      private $object;
      private $count;

      public function __construct($username) {
         $username = strtolower($username);
         $this->object = db::instance()->get('SELECT fromUser, msg FROM requests WHERE toUser = ? ORDER BY date', array($username));
         $this->count = db::instance()->count('SELECT * FROM requests WHERE toUser = ?', array($username));
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
                  <td><a href="people/' . $r['fromUser'] . '">' . ucfirst($r['fromUser']) . '</a></td>
                  <td>' . $r['msg'] . '</td>
                  <td><a href="javascript: void(0)" class="accept" name="accept" label="' . $r['fromUser'] . '">Accept</a> &nbsp;-&nbsp; <a href="javascript: void(0)" class="decline" name="decline" label="' . $r['fromUser'] . '">Decline</a></td>
               </tr>
            ';
         }

         echo '</table>';
      }

      public function count() {
         return $this->count;
      }

   }
?>
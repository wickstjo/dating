<?php
   class dates {
      private $object;
      private $username;
      private $count;

      public function __construct($username) {
         $this->username = strtolower($username);
         $this->object = db::instance()->get("SELECT * FROM dates WHERE person1 = ? OR person2 = ?", array($this->username, $this->username));
         $this->count = db::instance()->count("SELECT * FROM dates WHERE person1 = ? OR person2 = ?", array($this->username, $this->username));
      }

      public function show() {
         echo '
            <table id="people-tbl">
               <tr>
                  <td>Participant:</td>
                  <td>Code</td>
                  <td>Created</td>
               </tr>
         ';

         foreach ($this->object as $res => $r) {

            if ($r['person1'] == $this->username) {
               $otherPerson = $r['person2'];
            } else {
               $otherPerson = $r['person1'];
            }
 
            echo '
               <tr>
                  <td><a href="people/' . $otherPerson . '">' . ucfirst($otherPerson) . '</a></td>
                  <td><a href="http://' . getenv('HTTP_HOST') . '/dates/' . $r['code'] . '">' . $r['code'] . '</a></td>
                  <td>' . $r['date'] . '</td>
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
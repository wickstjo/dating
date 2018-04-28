<?php
   class date {
      private $code;
      private $person1;
      private $person2;
      private $date;
      private $postal;

      public function __construct($code) {
         $result = db::instance()->get("SELECT * FROM dates WHERE code = ?", array($code));
         $this->code = $code;

         foreach ($result as $res => $r) {
            $this->person1 = $r['person1'];
            $this->person2 = $r['person2'];
            $this->date = $r['date'];
            $this->postal = db::instance()->string('SELECT * FROM people WHERE username = ?', 'zip', array($this->person1));
         }
      }

      // SHOW TABLE
      public function show() {

         if ($this->person1 == session::username()) {
            $otherPerson = $this->person2;
         } else {
            $otherPerson = $this->person1;
         }

         echo '
            <table id="person-tbl">
               <tr>
                  <td>Date #' . $this->code . '</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>Participant:</td>
                  <td><a href="../people/' . $otherPerson . '">' . $otherPerson . '</a></td>
               </tr>
               <tr>
                  <td>Created:</td>
                  <td>' . misc::date($this->date, 'long') . '</td>
               </tr>
            </table>
         ';
      }

      public function map() {
         echo '
            <div id="map"></div>
            <script type="text/javascript">geocode("' . $this->postal . '");</script>
         ';
      }

      // PUT ALLOWED VIEWERS INTO ARRAY
      public function allowed() {
         $array = [$this->person1, $this->person2];
         return $array;
      }

      public function code() {
         return $this->code;
      }

   }
?>
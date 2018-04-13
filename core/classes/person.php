<?php
   class person {
      private $username;
      private $name;
      private $email;
      private $zip;
      private $income;
      private $descr;
      private $seeks;

      public function __construct($person) {
         $result = db::instance()->get('SELECT * FROM people WHERE username = ?', array(strtolower($person)));

         foreach ($result as $res => $r) {
            $this->username = $r['username'];
            $this->name = $r['name'];
            $this->email = $r['email'];
            $this->zip = $r['zip'];
            $this->income = $r['income'];
            $this->descr = $r['descr'];
            $this->seeks = $r['seeks'];
         }
      }

      public function show() {
         echo '
            <table id="person-tbl">
               <tr>
                  <td>Profile of ' . ucfirst($this->username) . '</td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>Name:</td>
                  <td>' . ucwords($this->name) . '</td>
               </tr>
               <tr>
                  <td>Email:</td>
                  <td>' . ucfirst($this->email) . '</td>
               </tr>
               <tr>
                  <td>Zip:</td>
                  <td>' . $this->zip . '</td>
               </tr>
               <tr>
                  <td>Income:</td>
                  <td>' . misc::income($this->income) . '</td>
               </tr>
               <tr>
                  <td>Seeks:</td>
                  <td>' . ucfirst($this->seeks) . '</td>
               </tr>
               </table>
               <div id="success">' . $this->descr . '</div>
         ';
      }

      public function fetch($var) {
         return $this->$var;
      }
   }
?>

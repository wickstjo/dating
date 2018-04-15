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

      // PRINT TABLE WITH VALUES
      public function show() {
         echo '
            <table id="person-tbl">
               <tr>
                  <td>Profile of <u>' . ucfirst($this->username) . '</u></td>
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

      // FOR FETCHING VALUES
      public function fetch($var) {
         return $this->$var;
      }

      // FOR SETTING VALUES
      public function set($var, $value) {
         $this->$var = $value;
      }

      // PRINT REQUEST DATE BUTTON
      public function button() {
         
         // CHECK IF THERE IS A REQUEST PENDING FROM LOGGED USER
         if (session::logged() && session::username() != $_GET['username']) {
            $pending = db::instance()->count('SELECT * FROM requests WHERE fromUser = ? AND toUser = ?', array(session::username(), $this->username));
         }

         // FORMAT LABELS ACCORDINGLY
         if ($pending != 0) {
            $header = 'Cancel Request';
            $name = 'date_cancel';

         } else {
            $header = 'Ask Out';
            $name = 'date_request';
         }

         // IF THE OTHER PERSON ALREADY HAS A PENDING REQUEST FROM THE SAME SOURCE
         $crossCheck = db::instance()->count('SELECT * FROM requests WHERE toUser = ? AND fromUser = ?', array(session::username(), $this->username));
         
         // PRINT CONTENT ACCORDINGLY
         if ($crossCheck != 0) {
            $content = '<div id="cross-request">You have a pending request from ' . ucfirst($this->username) . '!</div>';
         } else {
            $content = '<li><a href="javascript: void(0)" name="' . $name . '">' . $header . '</a></li>';
         }

         echo '
            <div id="new">
               <ul>
                  ' . $content . '
               </ul>
            </div>
         ';
      }
   }
?>

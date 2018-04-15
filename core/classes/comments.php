<?php
   class comments {
      private $object;
      private $count;

      public function __construct($code) {
         $this->object = db::instance()->get("SELECT * FROM comments WHERE ref = ?", array($code));
         $this->count = db::instance()->count("SELECT * FROM comments WHERE ref = ?", array($code));
      }

      public function show() {
         // SOMETHING
      }

      public function count() {
         return $this->count;
      }

      public function button() {
         echo '
            <div id="new">
               <ul>
                  <li><a href="javascript: void(0)" name="comment">Post Comment</a></li>
               </ul>
            </div>
         ';
      }

   }
?>
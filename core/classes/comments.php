<?php
   class comments {
      private $object;
      private $count;

      public function __construct($code) {
         $this->object = db::instance()->get("SELECT id, author, comment, date FROM comments WHERE ref = ?", array($code));
         $this->count = db::instance()->count("SELECT * FROM comments WHERE ref = ?", array($code));
      }

      public function show() {
         echo '
            <div id="comments">
            <div id="comments-header"><u>Comments</u> (' . $this->count . ')</div>
         ';

         foreach ($this->object as $res => $r) {
            $remove = '';

            if ($r['author'] == session::username()) {
               $remove = '<td><a href="javascript: void(0)" name="remove" label="' . $r['id'] . '">Remove</a></td>';
            }

            echo '
               <div class="comments-row">
                  <table><tr>
                     <td>[' . misc::date($r['date'], 'shorter') . '] &lt;<a href="../people/' . $r['author'] . '">' . ucfirst($r['author']) . '</a>&gt; ' . $r['comment'] . '</td>
                     ' . $remove . '
                  </tr></table>
               </div>
            ';
         }

         echo '</div>';
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
<?php
   require_once 'init.php';
   $user = '';

   // CHECK IF USER IS ONLINE TO LOCATE CORRECT MENU
   if (session::logged()) {
      $status = 'online';
      $user = session::username();
   } else {
      $status = 'offline';
   }

   // OVERWRITE SECTION VARIABLE IN PEOPLE.PHP IF YOU'RE VIEWING YOUR OWN PROFILE
   if (get::isset('username') && session::logged() && get::val('username') == session::username()) {
		$section = 'profile';
	}

   // ALL MENUS -- HEADER => CORRESPONDING HREF
   $menus = array(

      // LEFT MENU
      'left' => array(

         // ONLINE
         'online' => array(
            array('dashboard', ''),
            array('people', 'people'),
            array('dates', 'dates'),
         ),

         // OFFLINE
         'offline' => array(
            array('dashboard', ''),
            array('people', 'people'),
         ),
      ),

      // RIGHT MENU
      'right' => array(

         // ONLINE
         'online' => array(
            array('profile', 'people/' . $user),
            array('settings', 'none'),
            array('logout', 'logout'),
         ),

         // OFFLINE
         'offline' => array(
            array('register', 'none'),
            array('login', 'none'),
         ),
      ),
   );
?>
<head>
   <title>Dating App</title>
	<link rel="stylesheet" href="http://dating.proj/interface/styles.css" type="text/css">
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" lang="sv">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
   <script type="text/javascript" src="http://dating.proj/core/js/cxr.js"></script>
   
   <?php
      // INJECT MAPS RELATED JS WHEN ON CORRECT PAGE
      if (isset($_GET['code'])) {
         echo '<script src="http://dating.proj/core/js/maps.js"></script>';
      }
   ?>

</head>
<body>

<table id="tools">
	<tr>
		<td>
			<div id="toolbox"></div>
		</td>
	</tr>
</table>

<div id="menu">
	<table id="menu-tbl"><tr>
		<td>
			<ul>
				<?php

               // LOOP OUT LEFT SIDE MENU
					for ($x = 0; $x < count($menus['left'][$status]); $x++) {
						echo '<li ' . misc::menuCurrent($menus['left'][$status][$x][0], $section) . '><a href="' . misc::menuHref($menus['left'][$status][$x][1]) . '">' . ucfirst($menus['left'][$status][$x][0]) . '</a></li>';
               }

				?>
			</ul>
		</td>
		<td>
			<ul>
				<?php

               // LOOP OUT RIGHT SIDE MENU
					for ($x = 0; $x < count($menus['right'][$status]); $x++) {
						echo '<li ' . misc::menuCurrent($menus['right'][$status][$x][0], $section) . '><a href="' . misc::menuHref($menus['right'][$status][$x][1]) . '" name="' . $menus['right'][$status][$x][0] . '">' . ucfirst($menus['right'][$status][$x][0]) . '</a></li>';
               }
               
				?>
			</ul>
		</td>
	</tr></table>
</div>

<div id="main">
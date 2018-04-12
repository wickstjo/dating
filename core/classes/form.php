<?php
	class form {

		public function login() {
         echo '
            <div id="validate"></div>
				<form method="post">
					<input type="text" placeholder="Username" autocomplete="off" class="login" name="username" tabindex="1">
					<input type="password" placeholder="Password" class="login" name="password" tabindex="2">
					<input type="submit" value="Login" name="login" disabled>
				</form>
			';
		}

		public function register() {
         echo '
            <div id="validate"></div>
            <form method="post">
               <input type="text" placeholder="Username" autocomplete="off" class="register" name="username">
               <input type="text" placeholder="Email" autocomplete="off" class="register" name="email">
               <input type="password" placeholder="Password" class="register" name="password">
               <input type="password" placeholder="Repeat Password" class="register" name="repeat_password">
					<input type="submit" value="Register" name="register" disabled>
				</form>
			';
      }

      public function settings() {
         echo '
            <div id="validate"></div>
            <form method="post">
               <input type="text" placeholder="' . $_SESSION['auth']->fetch('name') . '" autocomplete="off" class="settings" name="name">
               <input type="text" placeholder="' . $_SESSION['auth']->fetch('email') . '" autocomplete="off" class="settings" name="email">
               <input type="text" placeholder="' . $_SESSION['auth']->fetch('zip') . '" autocomplete="off" class="settings" name="zip">
               <input type="number" placeholder="' . $_SESSION['auth']->fetch('income') . '" autocomplete="off" class="settings" name="income">
               <input type="text" placeholder="' . $_SESSION['auth']->fetch('seeks') . '" autocomplete="off" class="settings" name="seeks">
					<input type="submit" value="Change Settings" name="settings" disabled>
				</form>
			';
      }
      
	}
?>
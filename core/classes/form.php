<?php
	class form {

		public function login() {
         echo '
            <div id="validate"></div>
            <hr id="vspace">
				<form method="post">
					<input type="text" placeholder="Username" autocomplete="off" class="login" name="username" tabindex="1">
               <input type="password" placeholder="Password" class="login" name="password" tabindex="2">
               <hr>
					<input type="submit" value="Login" name="login" disabled>
				</form>
			';
		}

		public function register() {
         echo '
            <div id="validate"></div>
            <hr id="vspace">
            <form method="post">
               <input type="text" placeholder="Username" autocomplete="off" class="register" name="username">
               <input type="password" placeholder="Password" autocomplete="off" class="register" name="password">
               <input type="password" placeholder="Password Again" autocomplete="off" class="register" name="repeat_password">
               <hr>
               <input type="text" placeholder="Full Name" autocomplete="off" class="register" name="name">
               <input type="text" placeholder="Email" autocomplete="off" class="register" name="email">
               <input type="text" placeholder="Zip Code" class="register" name="zip">
               <input type="number" placeholder="Yearly Income" autocomplete="off" class="register" name="income">
               <input type="text" placeholder="What are you seeking?" autocomplete="off" class="register" name="seeks">
               <input type="text" placeholder="Describe yourself" autocomplete="off" class="register" name="descr">
               <hr>
					<input type="submit" value="Register" name="register" disabled>
				</form>
			';
      }

      public function settings() {
         echo '
            <div id="validate"></div>
            <hr id="vspace">
            <form method="post">
               <input type="text" placeholder="' . session::name() . '" autocomplete="off" class="settings" name="name">
               <input type="text" placeholder="' . session::email() . '" autocomplete="off" class="settings" name="email">
               <input type="text" placeholder="' . session::zip() . '" autocomplete="off" class="settings" name="zip">
               <input type="number" placeholder="' . session::income() . '" autocomplete="off" class="settings" name="income">
               <input type="text" placeholder="' . session::seeks() . '" autocomplete="off" class="settings" name="seeks">
               <input type="text" placeholder="' . session::descr() . '" autocomplete="off" class="settings" name="descr">
               <hr>
					<input type="submit" value="Change Settings" name="settings" disabled>
				</form>
			';
      }

      public function date_request() {
         echo '
            <div id="validate"></div>
            <hr id="vspace">
            <form method="post">
               <input type="text" placeholder="Your Message" autocomplete="off" class="date_request" name="msg">
               <hr>
					<input type="submit" value="Ask Out" name="date_request" disabled>
				</form>
			';
      }

      public function date_cancel() {
         echo '
            <div id="validate"></div>
            <hr id="vspace">
            <form method="post">
               <input type="text" placeholder="Confirm" autocomplete="off" class="date_cancel" name="confirm">
               <hr>
					<input type="submit" value="Cancel Request" name="date_cancel" disabled>
				</form>
			';
      }
      
	}
?>
$("#toolbox input").on('keydown keyup change', function() {

   // CHECK FOR ELEMENT CLASS TO BE ABLE TO REUSE VARIABLE NAMES
   var source = $(event.target).attr("class");

   // ARRAYS FOR VALIDATION
   var errors = [];
   var loopList = [];

   // LOGIN
   if (source == 'login') {
      var username = $("[name=username]").val();
      var password = $("[name=password]").val();

      // CHECK INPUT VALUE LENGTHS
      if (username.length == 0 || password.length == 0) {
         errors.push('Both fields required!');
      }

      // CHECK EXISTENCE -- DISABLED FOR ASYNC ISSUES
      /* $.ajax ({
         type: 'POST',
         url: '/backend/core/js/check.php',
         data: {
            username: username,
            password: password,
            src: source,
         },
         success: function(data) {
            if (data != 1 && password.length != 0) {
               errors.push('Combination does not exist!');
            }
         },
         async: false
      }); */

      // ON SUCCESS
      if (errors.length == 0) {
         $("[type=submit]").prop('disabled', false);
         $('#validate').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);

         for(x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));

         // HIDE IF ALL FIELDS ARE EMPTY, SHOW IF NOT
         if (username.length == 0 && password.length == 0) {
            $('#validate').css('display', 'none');
         } else {
            $('#validate').css('display', 'block');
         }
      }
   }
   
   // REGISTER
   if (source == 'register') {
      var username = $("[name=username]").val();
      var email = $("[name=email]").val();
      var password = $("[name=password]").val();
      var repeat_password = $("[name=repeat_password]").val();

      // CHECK INPUT VALUE LENGTHS
      if (username.length == 0 || email.length == 0 || password.length == 0 || repeat_password.length == 0) {
         errors.push('All fields are required!');
      }

      // CHECK EMAIL VALIDITY
      if (email.length != 0 && email.length < 8) {

         // IMPLEMENT PROPER EMAIL CHECK
         errors.push('Invalid email format!');
      }

      // CHECK IF PASSWORDS MATCH
      if (password != repeat_password && password.length != 0 && repeat_password.length != 0) {
         errors.push('Passwords do not match!');
      }

      // CHECK EXISTENCE -- DISABLED FOR ASYNC ISSUES
      /* $.ajax ({
         type: 'POST',
         url: '/backend/core/js/check.php',
         data: {
            username: username,
            src: source,
         },
         success: function(data) {
            if (data != 0) {
               errors.push('Username already exists!');
            }
         },
         async: false
      }); */

      // ON SUCCESS
      if (errors.length == 0) {
         $("[type=submit]").prop('disabled', false);
         $('#validate').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);

         for(x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));

         // HIDE IF ALL FIELDS ARE EMPTY, SHOW IF NOT
         if (username.length == 0 && email.length == 0 && password.length == 0 && repeat_password.length == 0) {
            $('#validate').css('display', 'none');
         } else {
            $('#validate').css('display', 'block');
         }
      }
   }

   // SETTINGS
   if (source == 'settings') {
      var name = $("[name=name]").val();
      var namePH = $("[name=name]").attr('placeholder');

      var email = $("[name=email]").val();
      var emailPH = $("[name=email]").attr('placeholder');

      var zip = $("[name=zip]").val();
      var zipPH = $("[name=zip]").attr('placeholder');

      var income = $("[name=income]").val();
      var incomePH = $("[name=income]").attr('placeholder');

      var seeks = $("[name=seeks]").val();
      var seeksPH = $("[name=seeks]").attr('placeholder');

      // CHECK NAME WITH PH
      if (name.toLowerCase() == namePH.toLowerCase()) {
         errors.push('That is already your name.');
      }

      // CHECK EMAIL WITH PH
      if (email.toLowerCase() == emailPH.toLowerCase()) {
         errors.push('That is already your email.');
      }

      // CHECK ZIP WITH PH
      if (zip == zipPH) {
         errors.push('That is already your zip code.');
      }

      // CHECK INCOME WITH PH
      if (income == incomePH) {
         errors.push('That is already your yearly income.');
      }

      // CHECK SEEKS WITH PH
      if (seeks.toLowerCase() == seeksPH.toLowerCase()) {
         errors.push('You are already seeking those.');
      }

      // ON SUCCESS
      if ((errors.length == 0) && (name.length != 0 || email.length != 0 || zip.length != 0 || income.length != 0 || seeks.length != 0)) {
         $("[type=submit]").prop('disabled', false);
         $('#validate').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);
         $('#validate').css('display', 'block');

         for (x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));
      }
   }

});
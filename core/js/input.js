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

      // CHECK THAT BOTH FIELDS ARE FILLED
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
         $('#validate, #vspace').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);

         for(x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));

         // HIDE IF ALL FIELDS ARE EMPTY, SHOW IF NOT
         if (username.length == 0 && password.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }
   
   // REGISTER
   if (source == 'register') {
      var username = $("[name=username]").val();
      var password = $("[name=password]").val();
      var repeat_password = $("[name=repeat_password]").val();

      var name = $("[name=name]").val();
      var email = $("[name=email]").val();
      var zip = $("[name=zip]").val();
      var income = $("[name=income]").val();
      var seeks = $("[name=seeks]").val();
      var descr = $("[name=descr]").val();

      // CHECK THAT ALL FIELDS ARE FILLED
      if (username.length == 0 || password.length == 0 || repeat_password.length == 0 || name.length == 0 || email.length == 0 || zip.length == 0 || income.length == 0 || seeks.length == 0 || descr.length == 0) {
         errors.push('All fields are required!');
      }

      // CHECK USERNAME LENGTH
      if ((username.length != 0) && (username.length < 3 || username.length > 50)) {
         errors.push('Username must be between 3 and 50 characters.');
      }

      // CHECK IF PASSWORDS MATCH
      if (password != repeat_password && password.length != 0 && repeat_password.length != 0) {
         errors.push('Passwords do not match!');
      }

      // CHECK PASSWORD LENGTH
      if (password == repeat_password && password.length > 1000) {
         errors.push('Password cannot exceed 1000 characters!');
      }

      // CHECK NAME LENGTH
      if ((name.length != 0) && (name.length > 100)) {
         errors.push('Name cannot exceed 100 characters.');
      }

      // CHECK EMAIL VALIDITY
      if ((email.length != 0 && email.length < 8) || (email.length > 50)) {

         // IMPLEMENT PROPER EMAIL CHECK
         errors.push('Invalid email format!');
      }

      // CHECK ZIP CODE VALIDITY
      if (zip.length != 0 && zip.length != 6) {
         errors.push('Invalid zip code format!');
      }

      // CHECK INCOME LENGTH
      if (income.length > 100) {
         errors.push('Income cannot exceed 100 characters!');
      }

      // CHECK DESCRIPTION LENGTH
      if ((descr.length != 0) && (descr.length < 10 || descr.length > 500)) {
         errors.push('Description must be between 10 and 500 characters.');
      }

      // CHECK USERNAME EXISTENCE -- DISABLED FOR ASYNC ISSUES
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
         $('#validate, #vspace').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);

         for(x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));

         // HIDE IF ALL FIELDS ARE EMPTY, SHOW IF NOT
         if (username.length == 0 && password.length == 0 && repeat_password.length == 0 && name.length == 0 && email.length == 0 && zip.length == 0 && income.length == 0 && seeks.length == 0 && descr.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
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

      var descr = $("[name=descr]").val();
      var descrPH = $("[name=descr]").attr('placeholder');

      // CHECK NAME WITH PH
      if (name.toLowerCase() == namePH.toLowerCase()) {
         errors.push('That is already your name!');
      }

      // CHECK EMAIL WITH PH
      if (email.toLowerCase() == emailPH.toLowerCase()) {
         errors.push('That is already your email!');
      }

      // CHECK ZIP WITH PH
      if (zip == zipPH) {
         errors.push('That is already your zip code!');
      }

      // CHECK INCOME WITH PH
      if (income == incomePH) {
         errors.push('That is already your yearly income!');
      }

      // CHECK SEEKS WITH PH
      if (seeks.toLowerCase() == seeksPH.toLowerCase()) {
         errors.push('You are already seeking those!');
      }

      // CHECK DESCRIPTION WITH PH
      if (descr == descrPH) {
         errors.push('That is already your description!');
      }

      // ON SUCCESS
      if ((errors.length == 0) && (name.length != 0 || email.length != 0 || zip.length != 0 || income.length != 0 || seeks.length != 0 || descr.length != 0)) {
         $("[type=submit]").prop('disabled', false);
         $('#validate, #vspace').css('display', 'none');

      // ON ERROR
      } else {
         $("[type=submit]").prop('disabled', true);
         $('#validate, #vspace').css('display', 'block');

         // BANDAID FIX TO PROPERLY TOGGLE HR
         if (errors.length == 0) {
            $('#vspace').css('display', 'none');
         } else {
            $('#vspace').css('display', 'block');
         }

         for (x = 0; x < errors.length; x++) { loopList.push('<div class="row">' + errors[x] + '</div>'); }
         $("#validate").html(loopList.join(""));
      }
   }

});
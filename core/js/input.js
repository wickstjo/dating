$("#toolbox input, #toolbox select").on('keydown keyup change', function() {

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
      var currency = $("[name=currency]").val();

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
      if ((name.length != 0) && (name.length < 4 || name.length > 100)) {
         errors.push('Name must be between 4 and 100 characters.');
      }

      // CHECK EMAIL VALIDITY
      if ((email.length != 0 && email.length < 8) || (email.length > 50)) {

         // IMPLEMENT PROPER EMAIL CHECK
         errors.push('Invalid email format!');
      }

      // CHECK ZIP CODE VALIDITY
      if (zip.length != 0 && zip.length < 5) {
         errors.push('Invalid zip code format!');
      }

      // CHECK INCOME LENGTH
      if (income.length > 100) {
         errors.push('Income cannot exceed 100 characters!');
      }

      // CHECK THAT A CURRENCY HAS BEEN SELECTED
      if (currency == 'Your Local Currency') {
         errors.push('Select a Proper Currency!');
      }

      // CALCULATE INCOME IN DOLLARS
      if (income.length != 0 && currency != 'Your Local Currency') {
         var rate = JSON.parse(localStorage.getItem('CXR-rates')).rates[currency];
         var money = income / rate;

         $("[name=converted]").val(money);

      // EMPTY HIDDEN INPUT IF EITHER FAIL
      } else {
         $("[name=converted]").val('');
      }

      // SEEKS WHITELIST
      var whitelist = ['male', 'female', 'both'];

      // TRIGGER IF NOT WITHIN WHITELIST
      if (jQuery.inArray(seeks.toLowerCase(), whitelist) == -1 && seeks.length != 0) {
         errors.push('Accepted values: Male, Female or Both!');
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

      var currency = $("[name=currency]").val();

      var seeks = $("[name=seeks]").val();
      var seeksPH = $("[name=seeks]").attr('placeholder');

      var descr = $("[name=descr]").val();
      var descrPH = $("[name=descr]").attr('placeholder');

      var password = $("[name=password]").val();
      var password_again = $("[name=password_again]").val();

      // CHECK NAME WITH PH
      if (name.toLowerCase() == namePH.toLowerCase()) {
         errors.push('That is already your name!');
      }

      // CHECK NAME LENGTH
      if ((name.length != 0) && (name.length < 4 || name.length > 100)) {
         errors.push('Name must be between 4 and 100 characters.');
      }

      // CHECK EMAIL WITH PH
      if (email.toLowerCase() == emailPH.toLowerCase()) {
         errors.push('That is already your email!');
      }
      
      // CHECK EMAIL VALIDITY
      if ((email.length != 0 && email.length < 8) || (email.length > 50)) {

         // IMPLEMENT PROPER EMAIL CHECK
         errors.push('Invalid email format!');
      }

      // CHECK ZIP WITH PH
      if (zip == zipPH) {
         errors.push('That is already your zip code!');
      }

      // CHECK ZIP CODE VALIDITY
      if (zip.length != 0 && zip.length < 5) {
         errors.push('Invalid zip code format!');
      }

      // CHECK INCOME WITH PH
      if (income == incomePH) {
         errors.push('That is already your yearly income!');
      }

      // MAKE SURE BOTH INCOME AND CURRENCY FIELDS ARE FILLED
      if ((income.length != 0 && currency != 'Your Local Currency') && ($("[name=converted]").length != 0)) {
         
         var rate = JSON.parse(localStorage.getItem('CXR-rates')).rates[currency];
         var money = income / rate;
         $("[name=converted]").val(money);

      } else {

         if ((income.length == 0 && currency != 'Your Local Currency') || (income.length != 0 && currency == 'Your Local Currency')) {
            errors.push('Both your income and currency have to be specified.');
         }
         
         $("[name=converted]").val('');
      }

      // CHECK INCOME LENGTH
      if (income.length > 100) {
         errors.push('Income cannot exceed 100 characters!');
      }

      // CHECK SEEKS WITH PH
      if (seeks.toLowerCase() == seeksPH.toLowerCase()) {
         errors.push('You are already seeking those!');
      }

      // SEEKS WHITELIST
      var whitelist = ['male', 'female', 'both'];

      // TRIGGER IF NOT WITHIN WHITELIST
      if (jQuery.inArray(seeks.toLowerCase(), whitelist) == -1 && seeks.length != 0) {
         errors.push('Acceptable values: Male, Female or Both!');
      }

      // CHECK DESCRIPTION WITH PH
      if (descr == descrPH) {
         errors.push('That is already your description!');
      }

      // CHECK DESCRIPTION LENGTH
      if ((descr.length != 0) && (descr.length < 10 || descr.length > 500)) {
         errors.push('Description must be between 10 and 500 characters.');
      }

      // CHECK IF PASSWORDS MATCH
      if (password != password_again) {
         errors.push('Passwords do not match!');
      }

      // CHECK PASSWORD LENGTH
      if (password.length > 1000) {
         errors.push('Password cannot exceed 1000 characters!');
      }

      // ON SUCCESS
      if ((errors.length == 0) && (name.length != 0 || email.length != 0 || zip.length != 0 || income.length != 0 || seeks.length != 0 || descr.length != 0) || (password.length != 0 && password_again.length != 0 && password == password_again)) {
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

   // DATE REQUEST
   if (source == 'date_request') {
      var msg = $("[name=msg]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (msg.length < 10 || msg.length > 40) {
         errors.push('Message must be between 10 and 40 characters.');
      }

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
         if (msg.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

   // DATE CANCEL
   if (source == 'date_cancel') {
      var confirm = $("[name=confirm]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (confirm != 'Confirm') {
         errors.push('Type in "Confirm" to finalize.');
      }

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
         if (confirm.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

   // ACCEPT REQUEST
   if (source == 'accept') {
      var accept_confirm = $("[name=accept_confirm]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (accept_confirm != 'Accept') {
         errors.push('Type in "Accept" to finalize.');
      }

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
         if (accept_confirm.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

   // DECLINE REQUEST
   if (source == 'decline') {
      var decline_confirm = $("[name=decline_confirm]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (decline_confirm != 'Decline') {
         errors.push('Type in "Decline" to finalize.');
      }

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
         if (decline_confirm.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

   // POST COMMENT
   if (source == 'comment') {
      var comment = $("[name=comment]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (comment.length < 3 || comment.length > 300) {
         errors.push('Comment must be between 3 and 300 characters.');
      }

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
         if (comment.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

   // REMOVE COMMENT
   if (source == 'remove_comment') {
      var remove_confirm = $("[name=remove_confirm]").val();

      // CHECK THAT BOTH FIELDS ARE FILLED
      if (remove_confirm != 'Remove') {
         errors.push('Type in "Remove" to finalize.');
      }

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
         if (remove_confirm.length == 0) {
            $('#validate, #vspace').css('display', 'none');
         } else {
            $('#validate, #vspace').css('display', 'block');
         }
      }
   }

});
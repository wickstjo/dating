$('a').on('click', function() {

   // PICK UP AND SAVE NAME ATTR TO KNOW WHICH FORM TO VALIDATE
	var id = $(event.target).attr("name");

   // CHECK IF SOURCE IS ALLOWED
	if (id == 'login' || id == 'register' || id == 'settings') {

		$.ajax({
         type: 'POST',
         url: '/core/js/tools.php',
         data: {id: id},
         success: function(data) {
            $('#toolbox').html(data);
            $("#tools").css('display', 'table');
            $.getScript("http://dating.proj/core/js/input.js");
         }
      });
   }
   
   if (id == 'sort') {

      // PICK UP ID
      var col = $(event.target).attr("id");

      $.ajax({
         type: 'POST',
         url: '/core/js/sort.php',
         data: {col: col},
         success: function(data) {
            console.log('sorting based on ' + col);
            $('#sorting').html(data);
         }
      });

   }

});

// HIDE WINDOW WHEN YOU PRESS ESC
jQuery(document).on('keyup',function(evt) {
    if (evt.keyCode == 27) {
		var value = $("#tools").css('display');

		if (value == 'table') {
			$("#tools").css('display', 'none');
			$("#toolbox").html();
		}
    }
});
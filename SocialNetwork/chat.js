$("#submit_button").click(function(){
        var message =$("#chatMsg").val();
		 if (message.length !=0) {
			send_message(message);
          event.preventDefault();
        } else {
          alert('Enter a message to send!');
        }
	 });


function send_message(message) {
	alert(""+message);
  $.ajax({
    url: "add_msg.php",
    method: "POST",
    data: {
		 msg : message
		},
    success: function(data) {
      $('#chatMsg').val('');
	  alert("Got it !!!");
      get_messages();
    }
  });
}

/**
 * Get's the chat messages.
 */
function get_messages() {
  $.ajax({
    url: 'get_messages.php',
    method: 'GET',
    success: function(data) {
      $('.msg-wgt-body').html(data);
    }
  });
}


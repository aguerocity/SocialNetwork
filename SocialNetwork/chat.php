<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="css/core.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js">
       alert("MBDSJdkjd");
 </script>
  </head>
  <body>
    <div style="margin: 0px auto; width: 980px;">
    <!--      Main content area-->
    </div>
    <?php
    @session_start();
    
    $_SESSION['user_id'] = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 1;
    
    // Load the messages initially
    require_once("FbChatMock.php");
    $chat = new FbChatMock();
    $messages = $chat->getMessages();
    ?> 
    
    <div class="container" style="border: 1px solid lightgray;">
      <div class="msg-wgt-header">
        <a href="#">Online</a>
      </div>
      <div class="msg-wgt-body">
        <table>
          <?php
          if (!empty($messages)) {
            foreach ($messages as $message) {
              $msg = htmlentities($message['message'], ENT_NOQUOTES);
              $user_name = ucfirst($message['username']);
              $sent =$message['sent_on'];
              echo <<<MSG
              <tr class="msg-row-container">
                <td>
                  <div class="msg-row">
                    <div class="avatar"></div>
                    <div class="message">
                      <span class="user-label"><a href="#" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$sent}</span></span><br/>{$msg}
                    </div>
                  </div>
                </td>
              </tr>
MSG;
            }
          } else {
            echo '<span style="margin-left: 25px;">No chat messages available!</span>';
          }
          ?>
        </table>
      </div>
      <div class="msg-wgt-footer">
        <textarea id="chatMsg" placeholder="Type your message."></textarea>
		<input type="button" id="submit_button" value="Send"/><br/>

  <form name="multiform" id="multiform" action="#" method="POST" enctype="multipart/form-data">
					Image : <input type="file" name="file" id="file" class="file" /></br>
					<input  type="button"  id="multi-post" value="Upload"></input>
  </form>
	  </div>
	  </div>
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
	
	
	$("#submit_button").click(function(){
        var message =$("#chatMsg").val();
		 if (message.length !=0) {
			send_messages(message);
          event.preventDefault();
        } else {
          alert('Enter a message to send!');
        }
	 });
	 
	 	 
	 $("#multi-post").click(function(){
		 
		if(window.FormData != undefined){
			var formData = new FormData(this);
			alert(""+formData);
			$.ajax({
				url : 'add_msg.php',
				type : 'POST',
				data : formData,
				mimeType : 'multipart/form-data',
				contentType : false,
				cache : false,
				processData : false,
				success : function(data){
					get_messages();
					document.getElementById("file").value="";
				}
				
			});
		}
			
	 });
 

	 
function send_messages(message){
  $.ajax({
    url: 'add_msg.php',
    method: 'POST',
	data:{
		msg: message
		},
    success: function(data){
 		get_messages();
     document.getElementById("chatMsg").value="";
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

</script>
    
</body>
</html>
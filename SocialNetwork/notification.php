<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="style/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="style/core.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div style="margin: 0px auto; width: 980px;">
    <!--      Main content area-->
    </div>
    <div class="container" style="border: 1px solid lightgray;">
      <div class="msg-wgt-header">
        <a href="#">Notifications</a>
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

  <form name="multiform" id="multiform" action="#" method="POST" enctype="multipart/form-data">
					Image : <input type="file" name="file" id="file" class="file" /></br>
					<input  type="button"  id="multi-post" value="Upload"></input>
  </form>
	  </div>
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("#multiform").submit(function(e) {
    var formObj = $(this);
   
    if(window.FormData !== undefined) {
      var formData = new FormData(this);
	  alert("askjhjhf");
      $.ajax({
        url: 'add_notification.php',
        method: 'POST',
        data:  formData,
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
        success: function(data) {
			 $('#file').val('')
			  e.preventDefault();
			  //e.unbind();
			 }
	});
	}
  });

  $("#multi-post").click(function() {
    //sending form from here
    $("#multiform").submit();
    console.log();
  });

});

</script>
    
</body>
</html>


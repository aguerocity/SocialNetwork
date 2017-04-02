 <?php
session_start();
if(isset($_SESSION["uname"])){
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>



</script>

<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <link href="css/core.css" rel="stylesheet" type="text/css" />

    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->



    
<style>

//To display friends birthday

.msg-wgt-body {
  height: 300px;
  overflow-y: scroll;
}

.msg-wgt-body table {
  width: 100%;
}

.msg-row-container {
  border-bottom: 1px solid lightgray;
}

.msg-row-container td {
  border-bottom: 1px solid lightgray;
  padding: 3px 0 3px 2px;
}

.msg-row {
  width: 100%;
}

.message {
  margin-left: 40px;
}

.user-label {
  font-size: 11px;
}

.msg-time {
  font-size: 10px;
  float: right;
  color: gray;
}

.avatar {
  width: 30px;
  height: 30px;
  float: left;
  border: 1px solid lightgray;
}
</style>	
<script>

function birthdayWish(name,i){
 var msg = document.getElementsByClassName("wishes");
    $.ajax({
        type: 'POST',
        url: 'wish.php',
        data: { 'uname': name, 'message': msg[i].value },
        success: function(response) {
           alert("Sent Successfully");
           location.reload();
        }
    });
}


</script>




<script>

function setinput(){
var x=document.getElementById("skills").value;window.location.href="fsearch.php?nm="+x;
}






</script>

</head>
<body>


    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="profile.php"></a>
            </div>

        </nav>
        <!-- /. NAV TOP  -->
				<?php
					require_once("connection.php");
					$q="select profile_pic from users where username='".$_SESSION["uname"]."'";
					if(!$result=$con->query($q))
					 echo $con->error;
					$row=$result->fetch_assoc();
				?>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src=<?php echo $row["profile_pic"];?> class="img-thumbnail" />

                            <div class="inner-text">
                                   <?php echo $_SESSION["uname"]; ?>                 
                                        <br />
                                 <?php
					require_once("connection.php");
					$q="select logout_time from users where username='".$_SESSION["uname"]."'";
					if(!$result=$con->query($q))
					 echo $con->error;
					$row=$result->fetch_assoc();
$second = time() - strtotime($row["logout_time"]);
$day=round($second/86400);
$second=$second%86400;
$hour=round($second/3600);
$second=$second%3600;
$minutes = round($second/60);
$second=round($second%60);
                                  ?>
                                <small>Last Login : <?php if($day>0) echo $day." days ".$hour." hrs ago."; else if($hour>0) echo $hour." hrs ".$minutes." min ago."; else if($minutes>0) echo $minutes." min ".$second." sec ago."; else echo $second." sec ago.";   ?> </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="profile.php"><i class="fa fa-dashboard "></i>Homepage</a>
                    </li>
                    <li>
                        <a href="profilepage.php"><i class="fa fa-desktop "></i>Profile<span class="fa arrow"></span></a>
                    </li>


			<?php
				require_once("connection.php");

				$date=date("Y-m-d");
				$q="SELECT `username` FROM ".$_SESSION["uname"]."_friend_list WHERE extract(day from `date_of_birth`)=extract(day from '$date') and extract(month from `date_of_birth`)=extract(month from '$date') and wishstatus=0";

				if(!$result=$con->query($q))
				  echo $con->error;

				$no=$result->num_rows;
				while($row=$result->fetch_assoc()){
				   $messages[]=$row;
				}

			?>

			     <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Today's Birthday(<?php echo $no;?>)<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
		 <?php
           $i=0;
          if (!empty($messages)) {  
            foreach ($messages as $message) {
              $user_name = ucfirst($message['username']);
              require_once("connection.php");
              $q="select profile_pic from users where username='".strtolower($user_name)."'";
                 if(!$result=$con->query($q))
                   echo $con->error;
                    $row=$result->fetch_assoc();
                    $picname=$row["profile_pic"];
              echo <<<MSG
                            <li>
                                <a href="#" class="showBox"><i class="fa fa-code  "></i><img class="avatar" src='$picname'/>     {$user_name}</a>
                                <ul class="nav nav-third-level">
                                    <li>  
                 <input type="text" class="wishes" name="wish" placeholder="Type here..." align="left" height="100" width="500"/><input type="button" align="center" value="Send" onclick="birthdayWish('$user_name',$i)"/>
                                     </li>
                                    
                                </ul>
                            </li>
MSG;
             $i++;
            }
          } else {
            echo '<li><a class="accordion" href="invoice.html"><i class="fa fa-coffee"></i>No birthday today!</a></li>';
          }
          ?>
                         </ul>
                    </li>
      


  
			<?php
				require_once("connection.php");

				$date=date("Y-m-d");
				$q="SELECT name,username FROM users where username in (select username from ".$_SESSION["uname"]."_friend_request)";

				if(!$result=$con->query($q))
				  echo $con->error;

				$num=$result->num_rows;
				while($row=$result->fetch_assoc()){
				   $friend[]=$row;
				}

			?>


  				     <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Friend Request(<?php echo $num;?>)<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">

		 <?php
           $i=0;
          if (!empty($friend)) {  
            foreach ($friend as $fr) {
              $user_name = ucfirst($fr['name']);
              $username=$fr['username'];
              require_once("connection.php");
              $q="select profile_pic from users where username='".strtolower($username)."'";
                 if(!$result=$con->query($q))
                   echo $con->error;
                    $row=$result->fetch_assoc();
                    $picname=$row["profile_pic"];
              echo <<<MSG
                            <li>
                                <img class="avatar" src='$picname'/><a href="#">{$user_name}<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#" onclick="acc('$user_name','$username');" ><i class="fa fa-plus "></i>Accept Request</a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="del('$user_name','$username');" ><i class="fa fa-comments-o "></i>Cancel Request</a>
                                    </li>

                                </ul>

                            </li>
MSG;
             $i++;
            }
          } else {
            echo '<li><a class="accordion" href="invoice.html"><i class="fa fa-coffee"></i>No Friend Request!</a></li>';
          }
          ?>

                        </ul>
                    </li>






<script>

function acc(name,uname){
    $.ajax({
        type: 'POST',
        url: 'wish.php',
        data: { 'accept': name,'acname':uname },
        success: function(response) {
           alert("Accepted "+response);
           location.reload();
        }
    });
}


function del(name,uname){
    $.ajax({
        type: 'POST',
        url: 'wish.php',
        data: { 'delete': name, 'delname' :uname },
        success: function(response) {
           alert("Deleted "+response);
           location.reload();
        }
    });
}


  function sendMsg(){
   var from="";
        var message =$("#chatMsg").val();
       var to =$("#fname").val();
		 if (message.length !=0) {
			send_messages(to,message);
          event.preventDefault();
 	} else {
          alert('Enter a message to send!');
        }
  }
	 


	 	 
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
 
	 
function send_messages(t,message){
var from="";
  $.ajax({
    url: 'add_msg.php',
    method: 'POST',
	data:{
                'to': t,
		'msg': message
		},
    success: function(data){
         get_messages(data);
     document.getElementById("chatMsg").value="";
    }
  });
}

/**
 * Get's the chat messages.
 */

function get_messages(from) {
  $.ajax({
    url: 'get_messages.php',
    method: 'GET',
    data:{
           'from': from
	 },
    success: function(data) {
      $('.msg-wgt-body').html(data);
    }
  });
}


function log(){
 $.ajax({
        type: 'POST',
        url: 'logout.php',
        success: function(response) {
         window.location = "http://chatterbox.890m.com/index.html";
        }
    });
}

$("a").click(function(){
window.location = "http://chatterbox.890m.com/profile.php";
});


function timer(from){
  get_messages(from);
  setTimeout(timer,5000,from);
}

function interaction(name) {
  $.ajax({
    url: 'logout.php',
    method: 'POST',
    data:{
           'name': name
	 },
    success: function(data) {
    }
  });
}

interaction('<?php echo $_GET["nm"]; ?>');

timer('<?php echo $_GET["nm"]; ?>');


</script>
   

 



<?php
$qu="SELECT `username`,`profile_pic` from users where status=1 and `username`!='".$_SESSION["uname"]."' and username in (select username from ".$_SESSION["uname"]."_friend_list )";
if(!$result=$con->query($qu))
  echo $con->error;

$onlineusers=$result->num_rows;
while($row=$result->fetch_assoc()){
  $users[]=$row;
}
?>
         <li>
            <a href="#" class="reset"><i class="fa fa-bicycle "></i>Online Friends(<?php echo $onlineusers;?>)<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
        <?php
          if (!empty($users)) {
            $i=0;
            foreach ($users as $u) {
              $pic_name = htmlentities($u['profile_pic'], ENT_NOQUOTES);
              $user_name=$u['username'];
              echo <<<MSG
                            <li>
                                <input type="hidden" id="from" value={$user_name} />
                                <a href="online.php?nm={$user_name}"><i class="fa fa-code  "></i><img class="avatar"  name={$pic_name} src={$pic_name} />    {$user_name}</a>                                  
  
                           </li>
               
MSG;
             $i++;
            }
          }else{
            echo '<span style="margin-left: 25px;">No User is Online!</span>';
          }
          ?>                                                                                      
                        </ul>
                    </li>





    <div style="margin: 0px auto; width: 948px;">
    <!--      Main content area-->
    </div>
<?php
    if(isset($_GET['nm'])){
?>      

    <div class="Container" onclick="hide()" style="border: 1px solid lightgray;">
      <div id="refresh" class="msg-wgt-header">
        <a href="#"><?php echo $_GET['nm']; ?></a>
      </div>
      <div class="msg-wgt-body">
        <table>
       <?php
         require_once("FbChatMock.php");
          $chat = new FbChatMock();
            $msg = $chat->getMessages($_GET["nm"]);
    
          if (!empty($msg)) {
            foreach($msg as $m){
              $from=ucfirst($m['f']);
              $sent=$m['send_on'];
              $cht=$m['message'];
              require_once("connection.php");
              $q="select profile_pic from users where username='".strtolower($from)."'";
                 if(!$result=$con->query($q))
                   echo $con->error;
                    $row=$result->fetch_assoc();
                     $picname=$row["profile_pic"];
              echo <<<MSG
              <tr class="msg-row-container">
                <td>
                  <div class="msg-row">
                     <img class="avatar" src='$picname'/>
                    <div class="message">
                      <span class="user-label"><a href="#" style="color: #6D84B4;">{$from}</a> <span class="msg-time">{$sent}</span></span><br/>{$cht}
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
        <input type="hidden" id="fname" value='<?php echo $_GET["nm"];?>' />        
        <textarea id="chatMsg" placeholder="Type your message."></textarea>
	<input type="button" onclick="sendMsg()" value="Send"/><br/>

	  </div>
    </div>
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<?php
}
?>




                      <li>
                        <a href="gallery.php"><i class="fa fa-anchor "></i>Gallery</a>
                    </li>
                
                    <li id="logout">
                        <a href="#" onclick="log()" ><i class="fa fa-sign-in "></i>Logout</a>
                    </li>
                                
                   
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
               
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    
                </div>
                <!-- /. ROW  -->


                <div class="row" style="padding-bottom: 100px; `">
                  

                </div>

                    <div class="col-md-4">
                        <div class="panel panel-info">


                        </div>
                    </div>



                    
                </div>


                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            
                        </div>
                        <!-- /. ROW  -->
                        <hr />

                        <div class="panel panel-default">

                            <div id="carousel-example" class="carousel slide" data-ride="carousel" style="border: 5px solid #000;">

                                <div class="carousel-inner">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.REVIEWS &  SLIDESHOW  -->
                    <div class="col-md-4">

                    </div>

                </div>
                <!-- /. ROW  -->



                <div class="row">
                    <div class="col-md-8">
            Add Anything Remaining.......
                    </div>
                </div>


            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        <p Developed by Abhinav ,Anand and Abhishek :)</p>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>
    


</body>
</html>
<?php
}
?>
						
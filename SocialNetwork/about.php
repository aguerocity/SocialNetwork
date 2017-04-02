 <?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>




<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>

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

            <div class="header-right">

                <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="sign.php" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>

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
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="index.html"><i class="fa fa-dashboard "></i>Homepage</a>
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
      


  				     <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Friend Request <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Anand<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#"><i class="fa fa-plus "></i>Accept Request</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-comments-o "></i>Cancel Request</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>





<script>
$(document).click(function(){
var x="reset";
$.ajax({
        type: 'POST',
        url: 'online.php',
        data: { 'reset': x},
        success: function(response) {
          $(".Container").hide();
           $("#page-inner").show();
        }
    });
  });


$(".reset").click(function(){
var x="reset";
$.ajax({
        type: 'POST',
        url: 'online.php',
        data: { 'reset': x},
        success: function(response) {
          $(".Container").hide();
           $("#page-inner").show();
        }
    });
  });


function online(name){
 $.ajax({
        type: 'POST',
        url: 'online.php',
        data: { 'nm': name},
        success: function(response) { 
          $("#refresh").load("profile.php #refresh");
        }
    });
}

function on(){
  $(".Container").fadeToggle();
  $("#page-inner").fadeToggle();
}

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
                                <a href="#" onclick="on()" onmouseover="online('$user_name')"><i class="fa fa-code  "></i><img class="avatar"  name={$pic_name} src={$pic_name} />    {$user_name}</a>                                  
  
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
           
    <div class="Container" style="border: 1px solid lightgray;">
      <div id="refresh" class="msg-wgt-header">
        <a href="#">Online</a>
      </div>
      <div class="msg-wgt-body">
        <table>
       <?php
         require_once("FbChatMock.php");
          $chat = new FbChatMock();
            $msg = $chat->getMessages();
    
          if (!empty($msg)) {
            foreach($msg as $m){
              $from=ucfirst($m['from']);
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
        <textarea id="chatMsg" placeholder="Type your message."></textarea>
		<input type="button" id="submit_button" value="Send"/><br/>

	  </div>
	  </div>


	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
  $(".Container").hide();
  
      

   


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
 
/
	 
function send_messages(fr,t,message){
  $.ajax({
    url: 'add_msg.php',
    method: 'POST',
	data:{
                from: fr,
                to: t,
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





























                    <li>
                        <a href="faq.html"><i class="fa fa-flash "></i>FAQ </a>
                        
                    </li>

                      <li>
                        <a href="gallery.php"><i class="fa fa-anchor "></i>Gallery</a>
                    </li>
                     <li>
                        <a href="error.html"><i class="fa fa-bug "></i>PRIVACY</a>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-sign-in "></i>Login Page</a>
                    </li>
                                
                   
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">TIMELINE</h1>



                        <h1 class="page-subhead-line">ChatterboX..stay connected socially :) </h1>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            
                                
                                <h5>CHAT</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            
                               
                                <h5>SHARE</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-pink">
                            
                                
                                <h5>INVITE</h5>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /. ROW  -->


                <div class="row" style="padding-bottom: 100px; `">
                    <div class="col-md-6">
                        <div id="comments-sec">
                            <h4><strong>WHAT'S ON YOUR MIND</strong></h4>
                            <hr />


                            
                            <div class="form-group ">
                               
                                <textarea class="form-control" rows="8" placeholder="What's on your mind..."></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">UPDATE STATUS</button>
                            </div>
                        </div>
                        <div class="col-md-12">

                                <div id="reviews" class="carousel slide" data-ride="carousel">

                                    <div class="carousel-inner">
                                        <div class="item active">

                                            <div class="col-md-10 col-md-offset-1">

                                                <h4><i class="fa fa-quote-left"></i>Add Suggestions here.......<i class="fa fa-quote-right"></i></h4>
                                                <div class="user-img pull-right">
                                                    <img src="assets/img/user.gif" alt="" class="img-u image-responsive" />
                                                </div>
                                                <h5 class="pull-right"><strong class="c-black">Lorem Dolor</strong></h5>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="col-md-10 col-md-offset-1">

                                                <h4><i class="fa fa-quote-left"></i>Add Suggestions here....... <i class="fa fa-quote-right"></i></h4>
                                                <div class="user-img pull-right">
                                                    <img src="assets/img/user.png" alt="" class="img-u image-responsive" />
                                                </div>
                                                <h5 class="pull-right"><strong class="c-black">Lorem Dolor</strong></h5>
                                            </div>

                                        </div>
                                        <div class="item">
                                            <div class="col-md-10 col-md-offset-1">

                                                <h4><i class="fa fa-quote-left"></i>Add Suggestions here....... <i class="fa fa-quote-right"></i></h4>
                                                <div class="user-img pull-right">
                                                    <img src="assets/img/user.gif" alt="" class="img-u image-responsive" />
                                                </div>
                                                <h5 class="pull-right"><strong class="c-black">Lorem Dolor</strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--INDICATORS-->
                                    <ol class="carousel-indicators">
                                        <li data-target="#reviews" data-slide-to="0" class="active"></li>
                                        <li data-target="#reviews" data-slide-to="1"></li>
                                        <li data-target="#reviews" data-slide-to="2"></li>
                                    </ol>
                                    <!--PREVIUS-NEXT BUTTONS-->

                                </div>

                            </div>


                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i>News Feeds
                            </div>

                            <div class="panel-body">
                                <div class="list-group">

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-envelope fa-fw"></i>Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-tasks fa-fw"></i>New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-upload fa-fw"></i>Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-bolt fa-fw"></i>Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-warning fa-fw"></i>Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-bolt fa-fw"></i>Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-warning fa-fw"></i>Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="fa fa-shopping-cart fa-fw"></i>New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                    </a>
                                </div>
                                <!-- /.list-group -->
                                <a href="#" class="btn btn-info btn-block">View All Alerts</a>
                            </div>

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
                                    <div class="item active">

                                        <img src="assets/img/slideshow/1.jpg" alt="" />

                                    </div>
                                    <div class="item">
                                        <img src="assets/img/slideshow/2.jpg" alt="" />

                                    </div>
                                    <div class="item">
                                        <img src="assets/img/slideshow/3.jpg" alt="" />

                                    </div>
                                </div>
                                <!--INDICATORS-->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example" data-slide-to="1"></li>
                                    <li data-target="#carousel-example" data-slide-to="2"></li>
                                </ol>
                                <!--PREVIUS-NEXT BUTTONS-->
                                <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
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
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <h4 class="list-group-item-heading">LIST GROUP HEADING</h4>
                                <p class="list-group-item-text" style="line-height: 30px;">
                                    Do Anything Remaining here..........
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <!--/.Row-->
                <hr />

                <div class="row">
                    <div class="col-md-8">
            Add Anything Remaining.......
                    </div>
                </div>

                <!--/.Row-->
                <hr />
                <!--/.ROW-->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
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
					
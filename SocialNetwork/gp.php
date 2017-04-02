<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" >
$(document).ready(function()
{
$("#notificationLink").click(function()
{ 
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");
return false;
});


$(document).click(function()
{
$("#notificationContainer").hide();
});


$("#notificationContainer").click(function()
{
return false
});

});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
    });
  });
  </script>



<style>

div.friend_request {
    width:100px;
    margin: auto;
    border: 3px solid #73AD21;
}

body{background-color:#dedede;font-family:arial}


#nav{
list-style:none;margin: 0px;
padding: 0px;}
#nav li {
float: right;
margin-right: 20px;
font-size: 14px;
font-weight:bold;
}

#nav li a{color:#333333;text-decoration:none}


#nav li a:hover{color:#006699;text-decoration:none}


#notification_li{position:relative}


#notificationContainer {
background-color: #fff;
border: 1px solid rgba(100, 100, 100, .4);
-webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
overflow: visible;
position: absolute;
top: 30px;
margin-left: -170px;
width: 400px;
z-index: -1;
display: none;
}


#notificationContainer:before {
content: '';
display: block;
position: absolute;
width: 0;
height: 0;
color: transparent;
border: 10px solid black;
border-color: transparent transparent white;
margin-top: -20px;
margin-left: 188px;
}


#notificationTitle {
z-index: 1000;
font-weight: bold;
padding: 8px;
font-size: 13px;
background-color: #ffffff;
width: 384px;
border-bottom: 1px solid #dddddd;
}


#notificationsBody {
padding: 33px 0px 0px 0px !important;
min-height:300px;
}


#notificationFooter {
background-color: #e9eaed;
text-align: center;
font-weight: bold;
padding: 8px;
font-size: 12px;
border-top: 1px solid #dddddd;
}


#notification_count {
padding: 3px 7px 3px 7px;
background: #cc0000;
color: #ffffff;
font-weight: bold;
margin-left: 77px;
border-radius: 9px;
position: absolute;
margin-top: -11px;
font-size: 11px;
}



//To Display notifications

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
  background: url('/chat_avatar.png');
  border: 1px solid lightgray;
}
#rss { 
  position: absolute; 
  left: 0%; 
}

//To display friends birthday

button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 500px;
    height: 100px;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}

#birthdayarea{
   position: absolute; 
  right: 5%; 
  margin-top:15%;
  height: 60%;
  width: 20%;
}

#postarea{
  position: absolute; 
  align:center;
  margin-left:28%;
  margin-top:15%;
  height: 100%;
  width: 40%;
}
</style>

</head>

<body background="bag.jpg" >
<fieldset width="500" height="500" id="postarea">
<legend align="center">POST AREA</legend>
</fieldset>
<fieldset width="500" height="500" align="right" id="birthdayarea">
<legend align="center">HAPPY BIRTHDAY</legend>
<button class="accordion">Today is Mahi's birthday...</button>
<div class="panel">
  <p><textarea id="wishes" align="right" height="100" width="300"></textarea><br/><input type="button" value="Send" onclick="birthdayWish()"</p>
</div>

<button class="accordion">Today is Abhinav's birthday...</button>
<div class="panel">
  <p><textarea id="wishes" align="right" height="100" width="300"></textarea><br/><input type="button" value="Send" onclick="birthdayWish()"</p>
</div>

<button  class="accordion">Today is Abhishek's birthday...</button>
<div id="foo" class="panel">
  <p><textarea id="wishes" align="right" height="100" width="300"></textarea><br/><input type="button" value="Send" onclick="birthdayWish()"</p>
</div>
</fieldset>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}


function setinput(){
var x=document.getElementById("skills").value;window.location.href="fsearch.php?nm="+x;
}
</script>



<?php

require_once("connection.php");
$query="SELECT * FROM `notification` AS n,".$_SESSION["uname"]."_notification AS p WHERE n.notification_id=p.notification_id and p.seen_status=0";

if(!$result=$con->query($query))
  echo $con->error;

$n=$result->num_rows;
while($row=$result->fetch_assoc()){
  $messages[]=$row;
}

?>
<div style="margin:0 auto;width:900px">
<center><h2 margin-left="200" ><b>WELCOME <?php echo $_SESSION["uname"]; ?></b></h2> </center><div class="ui-widget">
  <label for="skills">Search friends: </label>
  <input id="skills">
</div>
<input type="submit" value="GO" onclick="setinput()"/>


<ul id="nav">
<li><a href="#">Logout</a></li>
<li><a href="#">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li id="notification_li">
<span id="notification_count"><?php echo $n; ?></span>
<a href="#" id="notificationLink">Notifications</a>
<div id="notificationContainer">
<div id="notificationTitle">Notifications</div>
<div id="notificationsBody" class="notifications">
      
<div class="msg-wgt-body">
        <table>
          <?php
          if (!empty($messages)) {
            foreach ($messages as $message) {
              $msg = htmlentities($message['notification_link'], ENT_NOQUOTES);
              $user_name = ucfirst($message['posted_by']);
              $date=$message['date_of_post'];
              echo <<<MSG
              <tr class="msg-row-container">
                <td>
                  <div class="msg-row">
                    <div class="avatar"></div>
                    <div class="message">
                      <span class="user-label"><a href="#" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$date}</span></span><br/>{$msg}
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
</div>
<div id="notificationFooter"><a href="#">See All</a></div>
</div>

</li>
<li><a href="home.php">Gallery</a></li>
<li><a href="#">Chat</a></li>
</ul>

</br>
</br>
</br>
</br></br></br></br>
<div id ="friend_request" style="background-color:black;color:white;padding:20px; width:100px;">
  <h3> FRIEND REQUESTS</h3>
  <?php
$sql="select * from ".$_SESSION["uname"]."_friend_request";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
?>
<div id=<?php echo $row["username"] ?> >
<?php


echo $row["username"];

?>

<input type="submit" value ="ACCEPT" id=<?php echo $row["username"] ?> onclick="add_friend(<?php echo $row["username"] ?>)"> <input type="submit" value ="DECLINE" id=<?php echo $row["username"] ?> onclick="del_friend(<?php echo $row["username"] ?>)">
</div>
<?php
}
?>
</div>

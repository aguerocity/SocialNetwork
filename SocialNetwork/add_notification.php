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
    margin-left: 60%;
      margin-top: 20%
    border: 3px solid #73AD21;
}

body{background-color:#dedede;font-family:arial}


#nav{
list-style:none;margin: 0px;
padding: 0px;
}

#nav li {
float: left;
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
  left: 1%; 
  margin-top: 20%;
}

//To display friends birthday

button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 500px;
    height: 300px;
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
  margin-top:2%;
  height: 40%;
  width: 20%;
}
#status{
  position: absolute; 
  align:center;
  margin-left:27%;
  margin-top:17%;
  height: 20%;
  width: 45%;
}

#po{
  position: absolute; 
  margin-left:27%;
  margin-top:28%;  
}

#profile{
  position: absolute; 
  align:right;
  margin-left:1%;
  margin-top:2%;
  height: 200px;
  width: 200px;
 border: 4px solid black;
 border-radius: 4px;
 opacity: .7;

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
        }
    });
}
</script>
</head>

<body background="bag.jpg" >
<?php
require_once("connection.php");
$q="select profile_pic from users where username='".$_SESSION["uname"]."'";
if(!$result=$con->query($q))
 echo $con->error;
$row=$result->fetch_assoc();
?>
<img src=<?php echo $row["profile_pic"];?> id="profile"/>

<div id="rss">

<?php 
require_once("connection.php");
$name=$_SESSION["uname"];
$qry="select link from feeds where category in (select interest from ".$name."_interests)";
$result=$con->query($qry);
$arr=array();
$j=0;

while($row=$result->fetch_assoc())
{
        array_push($arr,$row["link"]);
	$j++;
}
	
?>
<script type="text/javascript">document.write('\x3Cscript type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js">\x3C/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://www.rssmix.com/u/8202570/rss.xml",rssmikle_frame_width: "300",rssmikle_frame_height: "400",frame_height_by_article: "0",rssmikle_target: "_blank",rssmikle_font: "Arial, Helvetica, sans-serif",rssmikle_font_size: "12",rssmikle_border: "off",responsive: "off",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "on",scrolldirection: "up",scrollstep: "5",mcspeed: "20",sort: "Off",rssmikle_title: "on",rssmikle_title_sentence: "News Feeds",rssmikle_title_link: "",rssmikle_title_bgcolor: "#0066FF",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "55",rssmikle_item_title_color: "#0066FF",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "on",rssmikle_item_description_length: "150",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M %p",item_description_style: "text+tn",item_thumbnail: "full",item_thumbnail_selection: "auto",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script> 
</div>
<textarea rows="5" cols="70" name="comment" id="status" placeholder="what's on your mind"></textarea>
                                       <input type ="submit" value="post" onclick="set_status()" id="po">
<script>
function set_status(){

var s=document.getElementById("status").value;


if (s.length == 0) { 
        document.getElementById("status").value = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("status").value = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "status.php?q=" + s, true);
        xmlhttp.send();
    }
}





</script>



<?php
require_once("connection.php");

$date=date("Y-m-d");
$q="SELECT `username` FROM ".$_SESSION["uname"]."_friend_list WHERE `date_of_birth`='$date'";

if(!$result=$con->query($q))
  echo $con->error;

$no=$result->num_rows;
while($row=$result->fetch_assoc()){
  $messages[]=$row;
}

?>

<fieldset width="500" height="500" align="right" id="birthdayarea">
<legend align="center">HAPPY BIRTHDAY</legend>

<div class="msg-wgt-body">
        <table>
          <?php
           $i=0;
          if (!empty($messages)) {
            foreach ($messages as $message) {
              $user_name = ucfirst($message['username']);
              echo <<<MSG
              <tr class="msg-row-container">
                <td>
                  <div class="msg-row">
                    <div class="avatar"></div>
                    <div class="message">
                    <button class="accordion">It's {$user_name}'s birthday today,click to wish him/her.</button>
                  <div class="panel">
                  <p><textarea class="wishes" name="wish" placeholder="Type here..." align="right" height="100" width="300"></textarea><br/><input type="button" value="Send" onclick="birthdayWish('$user_name',$i)"</p>
                 </div>
                    </div>
                  </div>
                </td>
              </tr>
MSG;
             $i++;
            }
          } else {
            echo '<span style="align: center">No birthday today!</span>';
          }
          ?>
        </table>
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
<li><a href="logout.php">Logout</a></li>
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
          if(!empty($messages)) {
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
require_once("connection.php");
$sql="select * from ".$_SESSION["uname"]."_friend_request";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
echo $name=$row["username"];
 echo <<<MSG
<div id={$name}>
<input type="submit" value ="ACCEPT" id={$name} onclick="add_friend('$name')"> <input type="submit" value ="DECLINE" id={$name} onclick="del_friend('$name')">
</div>
MSG;
}
?>
</div>


<script>
function add_friend(x){
x=10;
document.write(x);
alert("asjkh"+x);
<?php
$sql ="select count(*) from ".$_SESSION["uname"]."_friend_list where username in(select uname from "+x+"_friend_list)";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
$mutual=$row["count(*)"];
}
$sql2="insert into ".$_SESSION["uname"]."_friend_list values('"+x+"',0,'".$date."',".$mutual.")";
$con->query($sql2);
?>
document.getElementById(x).innerHTML="button";
}

function del_friend(x){
<?php
$sql="delete from".$_SESSION["uname"]."_friend_request where username='"+x+"'";

$con->query($sql);
?>
alert(""+x);
document.getElementById(x).innerHTML="button";

}
</script>
</br>

hello
<div id ="online" style="background-color:black;color:white;padding:20px; width:100px;">
  <h3> ONLINE FRIENDS </h3>
<?php

$q="select username from ".$_SESSION["uname"]."_friend_list where username in(select username from users where status=1)";

$r=$con->query($q);while($r=$r->fetch_assoc()){

echo $row["username"];?><img src="ol.png style=width=1cm; height:1cm;><?php


}

?>


</div>
</body>
</html>		
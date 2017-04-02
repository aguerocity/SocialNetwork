<?php
session_start();
require_once('connection.php');

if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["cat"]) && isset($_POST["type"])){
if($_POST["type"]=="Like"){
$query="update ".$_SESSION["uname"]."_notification set seen_status=1 where notification_id='".$_POST["id"]."'";
$con->query($query);
$query="update notification set likes=likes+1 where notification_id='".$_POST["id"]."'";
$con->query($query);
$l=$_SESSION["uname"]." likes your post.";

$query="INSERT INTO `notification` (`notification_link`,`category`,`posted_by`,`date_of_post`) VALUES ('$l','".$_POST["cat"]."','".$_SESSION['uname']."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;
$q="select notification_id from notification where posted_by='".$_SESSION['uname']."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
$id=$row["notification_id"];
$q="insert into ".strtolower($_POST["name"])."_notification values('$id',0)";
if(!$result=$con->query($q))
  echo $con->error;
$query="select likes from notification where notification_id='".$_POST["id"]."'";
$result=$con->query($query);
$row=$result->fetch_assoc();
echo $row["likes"];
}
else{
$query="update ".$_SESSION["uname"]."_notification set seen_status=1 where notification_id='".$_POST["id"]."'";
$con->query($query);
$query="update notification set likes=likes-1 where notification_id='".$_POST["id"]."'";
$con->query($query);
$query="select likes from notification where notification_id='".$_POST["id"]."'";
$result=$con->query($query);
$row=$result->fetch_assoc();
echo $row["likes"];
}
}
else if($_POST["name"])
{
echo $_POST["name"];
$query="update ".$_POST["name"]."_friend_list set interaction_count=interaction_count+1 where username='".$_SESSION["uname"]."'";
$con->query($query);
$query="update ".$_SESSION["uname"]."_friend_list set interaction_count=interaction_count+1 where username='".$_POST["name"]."'";
$con->query($query);
}
else{
$query="update users set status=0,logout_time=TIMESTAMPADD(MINUTE,330,now()) where username='".$_SESSION["uname"]."'";
$con->query($query);
session_destroy();
}
?>
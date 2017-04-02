<?php
session_start();
require_once("connection.php");
if(isset($_POST["uname"]) && isset($_POST["message"])){

$query="INSERT INTO `notification` (`notification_link`,`category`,`posted_by`,`date_of_post`) VALUES ('".$_POST['message']."','birthday','".$_SESSION['uname']."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;
$q="select notification_id from notification where posted_by='".$_SESSION['uname']."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
echo $id=$row["notification_id"];
$q="insert into ".strtolower($_POST["uname"])."_notification values('$id',0)";
if(!$result=$con->query($q))
  echo $con->error;

$q="update ".$_SESSION["uname"]."_friend_list set wishstatus=1 where username='".strtolower($_POST["uname"])."'";
if(!$result=$con->query($q))
  echo $con->error;
}
else if(isset($_POST["accept"]) && isset($_POST['acname'])){
$query="delete from ".$_SESSION["uname"]."_friend_request where username='".$_POST["acname"]."'";
if(!$result=$con->query($query))
  echo $con->error;
$query="select birthday from users where username='".$_POST["acname"]."'";
if(!$result=$con->query($query))
  echo $con->error;
$row=$result->fetch_assoc();
$dob=$row["birthday"];

$query="INSERT INTO ".$_SESSION["uname"]."_friend_list VALUES ('".$_POST['acname']."','$dob',0,0,curdate(),0)";
if(!$result=$con->query($query))
  echo $con->error;

$query="select birthday from users where username='".$_SESSION["uname"]."'";
if(!$result=$con->query($query))
  echo $con->error;
$row=$result->fetch_assoc();
$dob=$row["birthday"];


$query="INSERT INTO ".$_POST["acname"]."_friend_list VALUES ('".$_SESSION['uname']."','$dob',0,0,curdate(),0)";
if(!$result=$con->query($query))
  echo $con->error;


$query="INSERT INTO `notification` (`notification_link`,`posted_by`,`date_of_post`) VALUES ('".$_SESSION["uname"]." accept your friend request','".$_SESSION['uname']."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;

$q="select notification_id from notification where posted_by='".$_SESSION["uname"]."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
echo $id=$row["notification_id"];
$q="insert into ".strtolower($_POST["acname"])."_notification values('$id',0)";
if(!$result=$con->query($q))
  echo $con->error;
}
else if(isset($_POST["delete"]) && isset($_POST["delname"])){
$query="delete from ".$_SESSION["uname"]."_friend_request where username='".$_POST["delname"]."'";
if(!$result=$con->query($query))
  echo $con->error;
}
?>	
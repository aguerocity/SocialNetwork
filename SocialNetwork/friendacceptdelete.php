<?php
session_start();
if(isset($_POST["uname"])){
echo $_POST["uname"];
require_once("connection.php");
$sql ="select username from ".$_SESSION["uname"]."_friend_list where username in(select username from ".$_POST["uname"]."_friend_list)";
if(!$result=$con->query($sql))
   echo $con->error; 
$mutual=$result->num_rows;
$date=date("Y-m-d");
$q="select birthday from users where username='".$_POST["uname"]."'";
if(!$result=$con->query($q))
   echo $con->error;
$row=$result->fetch_assoc(); 
$dateofbirth1=$row["birthday"];

$q="select birthday from users where username='".$_SESSION["uname"]."'";
if(!$result=$con->query($q))
   echo $con->error;
$row=$result->fetch_assoc(); 
$dateofbirth2=$row["birthday"];

$sql2="insert into ".$_SESSION["uname"]."_friend_list values('".$_POST["uname"]."','".$dateofbirth1."',0,'".$date."','".$mutual."')";
if(!$result=$con->query($sql2))
   echo $con->error;

$sql2="insert into ".$_POST["uname"]."_friend_list values('".$_SESSION["uname"]."','".$dateofbirth2."',0,'".$date."','".$mutual."')";
if(!$result=$con->query($sql2))
   echo $con->error;

$sql2="delete from ".$_SESSION["uname"]."_friend_request where username='".$_POST["uname"]."'";
if(!$result=$con->query($sql2))
   echo $con->error;

$msg=$_SESSION["uname"]." accepted your friend request";

$query="INSERT INTO `notification` (`notification_link`,`posted_by`,`date_of_post`) VALUES ('".$msg."','".$_SESSION['uname']."',NOW())";
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


}

if(isset($_POST["delete"])){
require_once("connection.php");
$sql2="delete from ".$_SESSION["uname"]."_friend_request where username='".$_POST["delete"]."'";
if(!$result=$con->query($sql2))
   echo $con->error;
}
?>
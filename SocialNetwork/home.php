<?php
session_start();
$uname=$_SESSION["uname"];
if(isset($_POST["picname"])){
require("connection.php");
 $q="UPDATE `users` SET `profile_pic`='".$_POST["picname"]."' WHERE `username`='$uname'";
 if(!$result=$con->query($q))
     echo $con->error;
echo $_POST["picname"];
$query="INSERT INTO `notification` (`notification_link`,`category`,`posted_by`,`date_of_post`) VALUES ('".$_SESSION['uname']." updates a profile picture','".$_POST["picname"]."','".$_SESSION["uname"]."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;
$q="select notification_id from notification where posted_by='".$_SESSION["uname"]."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
echo $id=$row["notification_id"];

$q="select username from ".$_SESSION["uname"]."_friend_list";
if(!$result=$con->query($q))
  echo $con->error;
echo $n=$result->num_rows;
while($row=$result->fetch_assoc()){
$name[]=$row;
}

for($i=0;$i<$n;$i++){
$qu="insert into ".strtolower($name[$i]['username'])."_notification values('$id',0)";
if(!$result=$con->query($qu))
  echo $con->error;
}

}



if(isset($_POST["deletepic"])){
echo $_POST["deletepic"];
require("connection.php");
$q="delete from ".$_SESSION["uname"]."_pics where pic_name='".$_POST["deletepic"]."'";
if(!$result=$con->query($q))
     echo $con->error;
$q="select gender,profile_pic from users where username='".$_SESSION["uname"]."'";
 if(!$result=$con->query($q))
     echo $con->error;
$row=$result->fetch_assoc();
echo $row["profile_pic"];
 if($_POST["deletepic"]==$row["profile_pic"] && ($row["gender"]=="male" || $row["gender"]=="Male")){ 
    $qu="UPDATE `users` SET `profile_pic`='male.jpg' WHERE `username`='$uname'";
   if(!$result=$con->query($qu))
     echo $con->error;  
   }else{
    $qu="UPDATE `users` SET `profile_pic`='female.jpg' WHERE `username`='$uname'";
   if(!$result=$con->query($qu))
     echo $con->error;  
  }
}

?>

<?php
session_start();
$m=$_REQUEST["q"];
$uname=$_SESSION["uname"];
$fname=$_SESSION["fname"];

require_once('connection.php');


$query="select birthday from users where username='".$fname."'";
$result=$con->query($query);
while($row=$result->fetch_assoc()){


$dob=$row["birthday"];


}


$query="select count(distint username) from ".$fname."_friend_list where username  in(select username from ".$uname."_friend_list)";
$result=$con->query($query);
$mf=$result->num_rows;





if($m=="UNFRIEND"){

$q1="delete from ".$uname."_friend_list where username='".$fname."'";

$con->query($q1);


$q2="delete from ".$fname."_friend_list where username='".$uname."'";

$con->query($q2);

echo "ADD";


}


else if($m=="ADD"){


$q1="insert into ".$fname."_friend_request values('".$uname."',curdate())";
$con->query($q1);

echo "FRIEND REQUEST SENT";

}

else if($m=="ACCEPT"){
$q1="delete from ".$uname."_friend_request where username='".$fname."'";

$con->query($q1);
$q2="insert into ".$uname."_friend_list(username,date_of_birth,date_of_friendship,mutual_friends) values('".$uname."','".$dob."',curdate(),$mf)";

$con->query($q2);



$query="INSERT INTO `notification` (`notification_link`,`posted_by`,`date_of_post`) VALUES ('".$_SESSION["uname"]." accept your friend request','".$_SESSION['uname']."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;

$q="select notification_id from notification where posted_by='".$_SESSION["uname"]."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
echo $id=$row["notification_id"];
$q="insert into ".strtolower($fname)."_notification values('$id',0)";
if(!$result=$con->query($q))
  echo $con->error;

echo "UNFRIEND";

}
else{


echo "FRIEND REQUEST SENT";
}

?>
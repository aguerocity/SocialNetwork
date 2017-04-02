<?php
session_start();
$servername="localhost";
$username="u679748943_chatt";
$password="chatterbox";
$dbname="u679748943_chatt";
$con=new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
	die("connection failed".$con->connect_error);
}




$registration=date("Y/m/d");
$uname=$_POST['uname'];

$pass=$_POST['pass'];
$gender=$_POST['gender'];
$country=$_POST['nation'];
$state=$_POST['state'];
$email=$_POST['email'];
$org=$_POST['org'];
$dob=$_POST['dob'];
$mname=$_POST['mname'];
$city=$_POST['city'];

$q="select username from users where username='".$uname."'";
$r=$con->query($q);

if($row=$r->fetch_assoc()){
?>

<script>

alert("username not available plz try again");
</script>

<?php
header('Location:index.html');



}

else{

if($gender=="male"){
$pic="male.jpg";

}


else{
$pic="female.jpg";

}


$sql="INSERT INTO `users` (`username`,`name`,`pass`,`registration`,`email`,`birthday`,`gender`,`nation`,`state`,`city`,`organization`,`profile_pic`) VALUES ('".$uname."','".$mname."','".$pass."','".$registration."','".$email."','".$dob."','".$gender."','".$country."','".$state."','".$city."','".$org."','".$pic."')";



if($con->query($sql)){

mkdir($uname);
$sql2="create table ".$uname."_friend_list(username varchar(30),date_of_birth date,wishstatus int,interaction_count int,date_of_friendship date,mutual_friends int ,foreign key(username) references users(username) on delete cascade on update cascade)";
$con->query($sql2);
$sql3="create table ".$uname."_chat_table(f varchar(30),t varchar(30) ,message varchar(100),send_on timestamp,foreign key(t) references users(username) on delete cascade on update cascade)";

$con->query($sql3);
$sql4="create table ".$uname."_notification(notification_id bigint primary key,seen_status int default 0,foreign key(notification_id) references notification(notification_id) on delete cascade on update cascade)";
$con->query($sql4);
$sql5="create table ".$uname."_pics(pic_id bigint auto_increment primary key,pic_name varchar(40),date_post timestamp)";
$con->query($sql5);
$sql6="create table ".$uname."_friend_request(username varchar(30),date_of_request date ,foreign key(username) references users(username) on delete cascade on update cascade)";
$con->query($sql6);

$_SESSION['gender']=$gender;

$_SESSION["uname"]=$uname;
include('index.html');
?>
<script>
alert("succcesfully registered ,we welcome u to chatterbox!!");
</script>

<?php

}else{
echo "<script>alert('Account Not Create.Check all details');</script>";
session_destroy();
}}
?>
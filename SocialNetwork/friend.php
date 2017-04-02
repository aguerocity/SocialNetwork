<?php

$servername='localhost';
$dbname='friends';
$con=new mysqli($servername,'root','',$dbname);

if($con->connect_error){
	die("connection failed");
}
$qry2="select * from friend_list1";
$result1=$con->query($qry2);
while($row1=$result1->fetch_assoc()){

$qry="select count(*) from friend_list1  where uname in (select uname from ".$row1['uname'].")";

$result=$con->query($qry);

while($row=$result->fetch_assoc())
{
	$a=$row['count(*)'];
	echo $a;
	
}

$qry1="update friend_list1 set `mutual`='$a' where uname='".$row1['uname']."'";
if($con->query($qry1))
	echo "hello";
}
?>



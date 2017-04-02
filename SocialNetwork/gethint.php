<?php
$hint=$_REQUEST["q"];

$username=$_POST["uname"];

 $password=$_POST["pass"];

$servername="localhost";
$username="u679748943_chatt";
$password="chatterbox";
$dbname="u679748943_chatt";
$con=new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
	die("connection failed".$con->connect_error);
	
	
	
}
$sql="select name from users where username='".$hint."'";

$result=$con->query($sql);

if($row=$result->fetch_assoc()){
echo $hint." is not available,try again";
}

elseif($hint==""){
echo "username cannot be left blank";}

else{

 echo $hint." is available";
}
?>
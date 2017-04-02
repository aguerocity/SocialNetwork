<?php
session_start();
if(isset($_POST["uname"]) && isset($_POST["pass"])){
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

$sql="select * from `users` where `username` = '".$_POST['uname']."' and pass='".$_POST['pass']."' ";
$result=$con->query($sql);


if($row=$result->fetch_assoc())
 {
  $_SESSION["uname"]=$row["username"];
$qry="update users set status=1 where username='".$_SESSION["uname"]."'";
$con->query($qry);

  require('profile.php');
 }
else{
require ('index.html');
?>
<script>
alert("invalid username or password plz try again")</script>;
<?php
}
die();
}
require ('index.html');

?>
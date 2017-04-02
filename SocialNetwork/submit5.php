<?php 

session_start();

$uname=$_SESSION["uname"];

$gender=$_POST["gender"];

$state=$_POST["state"];

$city=$_POST["city"];

$work=$_POST["work"];

$org=$_POST["org"];

$f=$_POST["feeds"];


$pass=$_POST["pass"];


require_once('connection.php');












$query="update  users set gender='".$gender."' , state='".$state."' ,city='".$city."' ,work='".$work."' ,organization='".$org."',preference='".$f."',pass='".$pass."'";     

if($con->query($query)){
echo "<script>alert('profile updated successfully')</script>";
header('Location:profile.php');

}
?>
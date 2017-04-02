<?php
session_start();
require_once("connection.php");

$status=$_POST["status"];

$sql="update users set post='".$status."' where username='".$_SESSION["uname"]."'";

if($con->query($sql))
echo"updated successfully";


else
{
echo "unsuccessful";
}


?>

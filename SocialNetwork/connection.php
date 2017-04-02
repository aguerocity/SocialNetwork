<?php

$servername="localhost";
$username="u679748943_chatt";
$password="chatterbox";
$dbname="u679748943_chatt";
$con=new mysqli($servername,$username,$password,$dbname);

if($con->connect_error){
	die("connection failed".$con->connect_error);
		
}

?>
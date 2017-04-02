<?php
$name="abhinav";
$email="jain.abhinav2406@gmail.com";
$phone="8819038881";

$from = "mehta.anuj2309@gmail.com";
		$headers ="From: Ecell";
		
		$subject ="New registration";
		$msg = $name." ".$email." ".$phone;
		if(mail($from,$subject,$msg,$headers)) {
		
		
		echo "mail sent";
		
		}
			
?>

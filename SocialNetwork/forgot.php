<?php
$email=$_POST["e"];


$servername="localhost";
$username="u679748943_chatt";
$password="chatterbox";
$dbname="u679748943_chatt";
$con=new mysqli($servername,$username,$password,$dbname);
if($con->connect_error){
	die("connection failed".$con->connect_error);
	
	
	
}
$sql ="select * from users where email='$email'";
$result=$con->query($sql);


if($row=$result->fetch_assoc()){


$emailcut = substr($email, 0, 4);
		$randNum = rand(10000,99999);
		$tempPass = $emailcut.$randNum;
		$hashTempPass =md5($tempPass);

		$sql1 = "UPDATE users SET pass='".$hashTempPass."' WHERE username='".$row['username']."' ";
$con->query($sql1);
$to = $email;
		$from = "jain.abhinav2406@gmail.com";
		$headers ="From: chatterbox";
		
		$subject ="yoursite Temporary Password";
		$msg = "hello".$row['name']."The new temporary password for your chatterbox login is".$hashTempPass." click here to login: www.chatterbox.890m.com";
		if(mail($to,$subject,$msg,$headers)) {
			include('index.html');
?>
<script>
alert("we have sent the new login password to ur repected email-id plz visit and sign-in");
</script>
<?php
			exit();
		} else {
			echo "email_send_failed";
			exit();
		}
    
}
else{

include('forgot.html');
?>
<script>
alert("your credential doesnot match,plz try again");
</script>
<?php
}

?>
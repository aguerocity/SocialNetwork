<?php
session_start();
$nm=$_GET['nm'];
$date=date("y-m-d");
require_once("connection.php");



$sql="select * from users where name='".$nm."'";

$result=$con->query($sql);

while($row=$result->fetch_assoc()){

?>


<center><img src=<?php echo $row['profile_pic']?> ></center>
<?php
$unm=$row["username"];

?>

<table border="1" style="width:100%" style="height:200%">
<tr> <td> <font> <b> NAME</b> </font> </td> <td> <font> <b> USERNAME</b> </font> </td>  <td> <font> <b> EMAIL-ID</b> </font> </td> <td> <font> <b> DOB</b> </font> </td> <td> <font> <b> GENDER</b> </font> </td>
</tr>

<tr><td height="100"> <font><b> <?php echo $row["name"]?></b></font></td><td> <font> <b><?php echo $row["username"]?></b></font></td><td> <font> <b><?php echo $row["email"]?></b></font></td><td> <font> <b><?php echo $row["birthday"]?></b></font></td><td> <font><b> <?php echo $row["gender"]?></b></font></td></tr>

</table>

<?php



}





$sql2="select * from ".$_SESSION["uname"]."_friend_list where username='".$unm."'";
$result1=$con->query($sql2);

$sql5="select * from ".$unm."_friend_request where username='".$_SESSION["uname"]."'";
$result2=$con->query($sql5);

if($row=$result->fetch_assoc()){
?>

<center> <input type="submit" value="unfriend" onclick="unfriend()"/></center>
<?php
}

elseif($row1=$result2->fetch_assoc()){




?>
<center> <input type="submit"  id="add"  value ="FRIEND REQUEST SENT" onclick=""/></center>

<?php

}

else{
?>
<center> <input type="submit"  id="add"  value ="ADD FRIEND" onclick="add_friend()"/></center>

<?php

}
?>

<html>
<head>
<script>

function unfriend(){

<?php

$sql7="delete from ".$_SESSION["uname"]."_friend_list where username='".$unm."'";

$con->query($sql7);

?>

document.getElementById("add").value="ADD FRIEND";

}


function add_friend(){


<?php
$sql6="insert into ".$unm."_friend_request values('".$_SESSION["uname"]."','".$date."')";
$con->query($sql6);
?>


document.getElementById("add").value="FRIEND REQUEST SENT";



}

</script>
</head><body background="bag.jpg">	
<?php
session_start();
$uname=$_SESSION["uname"];
require_once("connection.php");
$target_dir =$uname."/" ;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
//   if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
$qry="insert into ".$uname."_pics(`pic_name`, `date_post`)values('".$target_file."',TIMESTAMPADD(MINUTE,330,now()))";

$con->query($qry);


$query="INSERT INTO `notification` (`notification_link`,`category`,`posted_by`,`date_of_post`) VALUES ('Your friend ".$_SESSION['uname']." uploads a photo','".$target_file."','".$_SESSION['uname']."',TIMESTAMPADD(MINUTE,330,now()))";
if(!$result=$con->query($query))
  echo $con->error;
$q="select notification_id from notification where posted_by='".$_SESSION['uname']."' order by date_of_post desc";
if(!$result=$con->query($q))
  echo $con->error;
$row=$result->fetch_assoc();
echo $id=$row["notification_id"];

$q="select username from ".$_SESSION["uname"]."_friend_list";
if(!$result=$con->query($q))
  echo $con->error;
echo $n=$result->num_rows;
while($row=$result->fetch_assoc()){
$name[]=$row;
}

for($i=0;$i<$n;$i++){
$qu="insert into ".strtolower($name[$i]['username'])."_notification values('$id',0)";
if(!$result=$con->query($qu))
  echo $con->error;
}
}
?>
<script>
alert("Pic uploaded successfully");
location.reload();
</script>
<?php
       
    } 
include("gallery.php");
?>
<script>
	alert("Message");
</script>
<?php
echo "<script>
	alert("Message");
</script>";
session_start();
require_once("connection.php");
$con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
if($con->connect_error)
	die('Connection error :'.$con->connect_error);

$data="";
if(isset($_POST['topic']) && isset($_POST['description']))
{	

		 $user_name=mysqli_real_escape_string($con,$_SESSION['user_nic_name']);
		  $topic_name=mysqli_real_escape_string($con,$_POST["topic"]);
		  $description=mysqli_escape_string($con,$_POST["description"]);
		
		$query="INSERT INTO `posted_data` (`user_nic_name`,`topic_name`,`description_about_topic`,`posting_date_time`) VALUES (?,?,?,NOW())";
		$result=$con->prepare($query);
		$result->bind_param("sss",$user_name,$topic_name,$description);

		if(!$result->execute())
			echo $result->error."  Not Connected2";

		$data="";
	
		$query='SELECT * FROM `posted_data` ORDER BY `posting_date_time` DESC LIMIT 1';
		
		if(!$result=$con->query($query)){
			echo "ANnd";
		}
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$data.="<br/><br/><h2>".$row['user_nic_name']."</h2><br/><h2>".$row['posting_date_time']."</h2><br/><h3>".$row['topic_name']."</h3><br/><h3>".$row['description_about_topic']."</h3><br/>";
			}
		}else{
			echo "Not Connect3";	
		}		
}
else{
$id=0;
$path = "uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp","pdf");
		$data="";

		$name=$_FILES['file']['name'];
		$size=$_FILES['file']['size'];
		$tmp=$_FILES['file']['tmp_name'];
		$user_name=mysqli_real_escape_string($con,1);

 if(strlen($name))
 {
	 list($txt, $ext) = explode(".", $name);
	 if(in_array($ext,$valid_formats))
		{
		if($size<(2*1024*1024))
			{
				$actual_file_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
	 
					//upload file
			  if(move_uploaded_file($tmp,$path.$actual_file_name)){
					 $query="INSERT INTO `chat` (`user_id`,`file`,`sent_on`) VALUES (?,?,CURRENT_TIMESTAMP)";
				  $result=$con->prepare($query);
				  $result->bind_param("ss",$user_id,$actual_file_name);
				  if(!$result->execute())
					echo $result->error."  Not Connected2";
				}
			}
			else
				echo "Image Size max 2MB";
		}
		else
			echo "Invalid File Format";
  //check whether file is exists or not in a folder
  if(file_exists("uploads/".$actual_file_name)) {
   echo'Uploaded successfully';
  }
  else {
   echo'File is not uploaded';
  }
 }else{
	 echo "Please select an image...";
 }
		$query='SELECT * FROM `posted_data` ORDER BY `posting_date_time` DESC LIMIT 1';
		if(!$result=$con->query($query)){
			echo "ANnd";
		}
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$data.="<br/><br/><h2>".$row['user_nic_name']."</h2><br/><h2>".$row['posting_date_time']."</h2><br/><h3>".$row['topic_name']."</h3><br/><h3><img src='uploads/".$row['image_about_topic']."'/></h3>";
			}
		}else{
			echo "Not Connect3";	
		}		
}
?>
<script type="text/javascript">
	$(".showbox").appendTo('#upper-well');
</script>
<div class="showbox"> <?php echo $data;?> </div>	

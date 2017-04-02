<?php
session_start();

if(isset($_POST['msg']) && isset($_POST['to'])) {
  require_once('FbChatMock.php');
  
  $from = $_SESSION['uname'];
  echo $to =$_POST['to'];
  $msg = htmlentities($_POST['msg'],  ENT_NOQUOTES);
  
  $chat = new FbChatMock();
  $result = $chat->addMessage($from,$to,$msg);

}
else{
$path = "uploads/";
$valid_formats = array("jpg", "png", "gif", "bmp","pdf");
		 echo $userId = (int) $_SESSION['user_id'];

		$name=$_FILES['file']['name'];
		$size=$_FILES['file']['size'];
		$tmp=$_FILES['file']['tmp_name'];
 echo $name = htmlentities($name,  ENT_NOQUOTES);

 if(strlen($name))
 {
	 list($txt, $ext) = explode(".", $name);
	 if(in_array($ext,$valid_formats))
		{
		if($size<(2*1024*1024))
			{
				$actual_file_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				move_uploaded_file($tmp,$path.$actual_file_name);
					//upload file
			  if(move_uploaded_file($tmp,$path.$actual_file_name)){
					  $chat = new FbChatMock();
					  $result = $chat->addMessage($userId, $actual_file_name);				  
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
}
?>
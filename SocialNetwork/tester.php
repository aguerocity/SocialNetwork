<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES -->
    <link href="css/prettyPhoto.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<style>
body{
color:white;
margin : 0;		
padding : 0;
}

#imageList{
font-size: 0;
width: 550px;
margin: 0 auto;
}

#imageList a {
margin: 5px;
border: 4px solid transparent;
display: inline-block;
-webkit-border-radius: 10px;
border-radius: 10px;
opacity: .7;
}

#imageList a:hover{
border-color: white;
opacity: 1;
}

#imageList img{
border-radius: 10px;
}

.accordion {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
}

.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 160px;
    height: 160px;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

a.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    height: 70px;
    width: 150px;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}


</style>



</head>
<body>
<center>
  <fieldset>
  
   <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" id="submit" value="Upload Image" name="submit">
   </form>
</fieldset>
</center>

<script>

function setProfile(i){
 var pic = document.getElementsByClassName("image");
 var pic_name= pic[i].name;
 $.ajax({
        type: 'POST',
        url: 'home.php',
        data: { 'picname':  pic_name},
        success: function(response) {
             alert("Profile pic Update Successfully");
        }
    });

}
</script>
<?php
require_once("connection.php");
if(isset($_POST["picname"])){
 $q="UPDATE `users` SET `profile_pic`='".$_POST["picname"]."' WHERE `username`='$uname'";
 if(!$result=$con->query($q))
     echo $con->error;
}

if(isset($_POST["deletepic"])){
echo $uname.$_POST["deletepic"];
 $q="delete from ".$uname."_pics WHERE `pic_name`='".$_POST["deletepic"]."'";
 if(!$result=$con->query($q))
     echo $con->error;
}


$query="SELECT * FROM anand007_pics";
if(!$result=$con->query($query))
  echo $con->error;

$n=$result->num_rows;
while($row=$result->fetch_assoc()){
  $messages[]=$row;
}


?>

               <div class="col-md-4 ">

                    <div class="portfolio-item awesome mix_all" data-cat="awesome" >


                        <img src="img/portfolio/g.jpg" class="img-responsive " alt="" />
                        <div class="overlay">
                            <p>
                                <span>
                                Image Orinagal Size: 750x500
                                </span>
                               
                                PROJECT TITLE HERE
                            </p>
                            <a class="preview btn btn-info " title="Image Title Here" href="assets/img/portfolio/g.jpg"><i class="fa fa-plus fa-2x"></i></a>

                        </div>
                    </div>
                </div>












<script>
function deletepic(i){
var pic = document.getElementsByClassName("image");
var pic_name= pic[i].name;
 $.ajax({
        type: 'POST',
        url: 'home.php',
        data: { 'deletepic':  pic_name},
        success: function(response) {
             alert("Deleted Successfully");
            location.reload();
        }
    });
}
</script>





<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  } 
}
</script>


          <?php
          if (!empty($messages)) {
            $i=0;
            foreach ($messages as $message) {
              $pic_name = htmlentities($message['pic_name'], ENT_NOQUOTES);
              $date=$message['date_post'];
              echo <<<MSG
                 <a class="accordion"><img id="image" class="image" height="150" width="150" name={$pic_name} src={$pic_name} alt="" /></a>
                  <div class="panel">
                         <p><input type="button" value="Set as Profile Pic" class="profile" onclick="setProfile($i)"/>  <input type="button" value="Delete" class="del" onclick="deletepic($i)"/></p>
                  </div>
                 </div>
MSG;
             $i++;
            }
          }else{
            echo '<span style="margin-left: 25px;">No Pics available!</span>';
          }
          ?>
        
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
     <!-- PAGE LEVEL SCRIPTS -->
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>
     <!-- CUSTOM Gallery Call SCRIPTS -->
    <script src="js/galleryCustom.js"></script>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Refreshen 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130217

-->

<?php

session_start();
require_once('connection.php');


$q="select * from users where username='".$_SESSION["uname"]."'";

$r=$con->query($q);


while($row=$r->fetch_assoc()){

$name= $row["name"];
$pic=$row["profile_pic"];
$about=$row["about"];
$gender=$row["gender"];
$birthday=$row["birthday"];
$city=$row["city"];
$nation=$row["nation"];
$work=$row["work"];
$org=$row["organization"];

}
?>
<?php

$q1="select pic_name from ".$_SESSION["uname"]."_pics where pic_name not in(select profile_pic from users where username='".$_SESSION["uname"]."') LIMIT 1";
$r2=$con->query($q1);
while($rw=$r2->fetch_assoc()){
$p1=$rw["pic_name"];


}


?>
<?php

$q1="select pic_name from ".$_SESSION["uname"]."_pics where pic_name not in(select profile_pic from users where username='".$_SESSION["uname"]."') LIMIT 2";
$r2=$con->query($q1);
while($rw=$r2->fetch_assoc()){
$p2=$rw["pic_name"];


}

$q3="select count(*) from ".$_SESSION["uname"]."_friend_list";
$r=$con->query($q3);

while($row=$r->fetch_assoc()){

$friend=$row["count(*)"];

}

?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="jquery.slidertron-1.1.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script>


function log(){
 $.ajax({
        type: 'POST',
        url: 'logout.php',
        success: function(response) {
         alert(response);
         window.location = "http://chatterbox.890m.com/index.html";
        }
    });
}

</script>



<style>

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

</style>

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#"><?php echo $name?></a></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="first active"><a href="profile.php" accesskey="1" title="">Homepage</a></li>
				<li><a href="gallery.php" accesskey="2" title="">gallery</a></li>
				<li><a href=# onclick="log()" accesskey="3" title="">Logout</a></li>
                                <li><a href="updateprofile.html"  accesskey="3" title="">EDIT PROFILE</a></li>
				
			</ul>
		</div>
	</div>
</div>
<div id="banner">
	<div id="slider">
		<div class="viewer">
			<div class="reel">
				<div class="slide">

					<a class="link" href="http://nodethirtythree.com/#slidertron-slide-1">Full story ...</a> <img src=<?php echo $p1?> alt="cover1"  width="800" height="600"/> </div>
				<div class="slide">
					<a class="link" href="http://nodethirtythree.com/#slidertron-slide-2">Full story ...</a> <img src=<?php echo $p2?> alt="cover2" /> </div>
			</div>
		</div>
		<div class="indicator">
			<ul>
				<li class="active">1</li>
				<li>2</li>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		$('#slider').slidertron({
			viewerSelector: '.viewer',
			reelSelector: '.viewer .reel',
			slidesSelector: '.viewer .reel .slide',
			advanceDelay: 3000,
			speed: 'slow',
			navPreviousSelector: '.previous-button',
			navNextSelector: '.next-button',
			indicatorSelector: '.indicator ul li',
			slideLinkSelector: '.link'
		});
	</script> 
</div>
<div id="wrapper">
	<div id="page" class="container">
		<div id="content"> <img src=<?php echo $pic ?> width="235" height="235" alt="" />
			<h2>ABOUT ME </h2>
			<p><?php echo $about ?></p>
		</div>
		<div id="sidebar">
			<div>
				<h2>INTRO</h2>
				<ul class="style1">
					<li class="first">
						<p><strong> NAME:</strong> <?php echo $name?></p>
						</br>
                                                <p><strong> BIRTHDAY:</strong> <?php echo $birthday?></p>
                                                </br>
                                                <p><strong> GENDER:</strong> <?php echo $gender ?></p>
                                               </br>
                                                 <p><strong> LIVES IN:</strong> <?php echo $city ?></p>
                                               </br>
                                                 <p><strong> NATION:</strong> <?php echo $nation?></p>

					
				</ul>
			</div>
		</div>
	</div>
	<div id="featured" class="container">
		<h2 class="title">MY STUFF</h2>
		<div id="fbox1"> <img src="loc.jpg" width="235" height="235" alt="" />
			<h2>LOCATION</h2>
			<p><?php echo $city?></p>
		</div>
		<div id="fbox2"> <img src="edu.png" width="235" height="235" alt="" />
			<h2>STUDIED AT</h2>
			<p><?php echo $org?> </p>
		</div>
		<div id="fbox3"> <img src="work.JPG" width="235" height="235" alt="" />
			<h2>WORKS AT </h2>
			<p><?php $work ?></p>
		</div>
		<div id="fbox4"> <img src="friend.jpg" width="235" height="235" alt="" />
			<h2>TOTAL FRIENDS</h2>
			<p><?php echo $friend ?> <a href=#friends> VIEW FRIENDS</a></p>
		</div>
	</div>


<?php




$q="select u.name ,u.profile_pic from users  u natural join ".$_SESSION["uname"]."_friend_list order by date_of_friendship ";
if($result=$con->query($q))

$stack=array();
$stack1=array();
while($row=$result->fetch_assoc()){


array_push($stack,$row["name"]);
array_push($stack1,$row["profile_pic"]);

}

?>


<div id="featured" class="container">
		<h2 class="title">RECENT FRIENDS</h2>
<?php 



if($stack[0]==="")

{

?>

<center> <div id="fbox1"> 
			<h2>NO RECENT FRIENDS</h2>
			
		</div>
</center>

<?php
}

else{

?>
<div id="fbox1"> <img src=<?php echo $stack1[0]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[0]?></h2>
			
		</div>
<?php


}

if($stack[1]==="")

{

?>
 <div id="fbox2"> 
			
			
		</div>


<?php
}

else{

?>
<div id="fbox2"> <img src=<?php echo $stack1[1]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[1]?></h2>
			
		</div>
<?php


}


if($stack[1]==="")

{

?>
 <div id="fbox3"> 
			
			
		</div>


<?php
}

else{

?>
<div id="fbox3"> <img src=<?php echo $stack1[2]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[2]?></h2>
			
		</div>
<?php


}

if($stack[1]==="")

{

?>
 <div id="fbox4"> 
			
			
		</div>


<?php
}

else{

?>
<div id="fbox4"> <img src=<?php echo $stack1[3]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[3]?></h2>
			
		</div>
<?php


}



?>




		
	</div>


<?php


$q="select preference from users where username ='".$_SESSION["uname"]."'";
$result=$con->query($q);

while($row=$result->fetch_assoc()){
$pref=$row["preference"];

}

$st=array();
$sd=array();

if($pref==="edens"){
array_push($st,"education.jpg","enter.jpg","sports.png");
array_push($sd,"EDUCATION","ENTERTAINMENT","SPORTS");
}
else if($pref==="rens"){
array_push($st,"news.jpg","enter.jpg","sports.png");

array_push($sd,"NEWS","ENTERTAINMENT","SPORTS");
}
else if($pref==="edrs"){
array_push($st,"education.jpg","news.jpg","sports.png");

array_push($sd,"EDUCATION","NEWS","SPORTS");
}
else if($pref==="rens"){
array_push($st,"news.jpg","enter.jpg","sports.png");

array_push($sd,"NEWS","ENTERTAINMENT","SPORTS");
}

else if($pref==="edren"){
array_push($st,"education.jpg","news.jpg","enter.jpg");

array_push($sd,"EDUCATION","NEWS","ENTERTAINMENT");
}

else if($pref==="tens"){
array_push($st,"tech.jpg","enter.jpg","sports.png");
array_push($sd,"TECHNOLOGY","ENTERTAINMENT","SPORTS");
}


else if($pref==="trs"){
array_push($st,"tech.jpg","news.jpg","sports.png");
array_push($sd,"TECHNOLOGY","NEWS","SPORTS");
}

else if($pref==="tren"){
array_push($st,"tech.jpg","news.jpg","enter.jpg");
array_push($sd,"TECHNOLOGY","NEWS","ENTERTAINMENT");
}
else if($pref==="teds"){
array_push($st,"tech.jpg","education.jpg","sports.png");
array_push($sd,"TECHNOLOGY","EDUCATION","SPORTS");
}

else if($pref==="teden"){
array_push($st,"tech.jpg","education.jpg","enter.jpg");
array_push($sd,"TECHNOLOGY","EDUCATION","ENTERTAINMENT");
}
else if($pref==="tedr"){
array_push($st,"tech.jpg","education.jpg","news.jpg");
array_push($sd,"TECHNOLOGY","EDUCATION","NEWS");
}



?>








<div id="featured" class="container">
		<h2 class="title">MY INTERESTS</h2>
		<div id="fbox1"> <img src=<?php echo $st[0]?> width="235" height="235" alt="" />
			<h2><?php echo $sd[0]?></h2>
			
		</div>

		<div id="fbox2"> <img src=<?php echo $st[1];?> width="235" height="235" alt="" />
			<h2><?php echo $sd[1]?></h2>
			
		</div>
		<div id="fbox3"> <img src=<?php echo $st[2]?> width="235" height="235" alt="" />
			<h2><?php echo $sd[2]?></h2>
			



		</div>


			



		</div>
		



	





<div id="footer">
	<p Developed by Abhinav ,Anand and Abhishek :)</p>
</div>
</body>
</html>

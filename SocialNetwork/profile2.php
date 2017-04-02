<head>
<style>
.view {
    margin-left: 75%;
    width: 105px;
    margin-top: -4%;
    height: auto;
    color: #9E9E9E;
    background: beige;
}

</style>
</head>
<?php
$name=$_GET["x"];
session_start();


require_once('connection.php');


$q="select username from users where name ='".$name."'";

$result=$con->query($q);

while($row=$result->fetch_assoc()){


$uname=$row["username"];
$_SESSION["fname"]=$uname;

}

$q="select * from users where username='".$uname."'";

$r=$con->query($q);


while($row=$r->fetch_assoc()){





$pic=$row["profile_pic"];
$about=$row["about"];
$gender=$row["gender"];
$birthday=$row["birthday"];
$city=$row["city"];
$nation=$row["nation"];
$work=$row["work"];
$org=$row["organization"];

}

$q1="select pic_name from ".$uname."_pics where pic_name not in(select profile_pic from users where username='".$uname."') LIMIT 1";
$r2=$con->query($q1);
while($rw=$r2->fetch_assoc()){
$p1=$rw["pic_name"];

}


$q1="select pic_name from ".$uname."_pics where pic_name not in(select profile_pic from users where username='".$uname."') LIMIT 2";
$r2=$con->query($q1);
while($rw=$r2->fetch_assoc()){
$p2=$rw["pic_name"];


}

$q3="select count(*) from ".$uname."_friend_list";
$r=$con->query($q3);

while($row=$r->fetch_assoc()){

$friend=$row["count(*)"];

}


$q4="select name from users where username in(select username from ".$uname."_friend_list)";
$r=$con->query($q4);
$num=$r->num_rows;
while($row=$r->fetch_assoc()){

$friendname[]=$row;

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

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<![endif]-->

<style>






.w3-btn {width:150px;}

</style>

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




function act(){
    

var str=document.getElementById("comp").value;



        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("comp").value = xmlhttp.responseText;


            }
        };
        xmlhttp.open("GET", "do.php?q=" + str, true);
        xmlhttp.send();
    }

</script>






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
				
			</ul>


			
		</div>
	</div>
</div>
<div id="banner">
	<div id="slider">
		<div class="viewer">
			<div class="reel">
				<div class="slide">

					<a class="link" href="http://nodethirtythree.com/#slidertron-slide-1">Full story ...</a> <img src=<?php echo $p1?> alt="cover1" /> </div>
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
$(".view").fadeToggle();
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




<?php

$af=0;

$fs=0;

$df=0;

$q1="select username from ".$_SESSION["uname"]."_friend_request where username='".$uname."'";

$result=$con->query($q1);

if( $result->num_rows>0)
$cf=1;


$q2="select username from ".$_SESSION["uname"]."_friend_list where username='".$uname."'";

$result=$con->query($q2);

if( $result->num_rows>0)
$df=1;



$q3="select username from ".$uname."_friend_request where username='".$_SESSION["uname"]."'";



$result=$con->query($q3);

if($result->num_rows>0)

$fs=1;

if( $result->num_rows>0)
$df=1;




if($cf==1)
$ftype="ACCEPT";


else if($df==1)
$ftype="UNFRIEND";


else if($fs==1)
$ftype="FRIEND REQUEST SENT";

else{

$ftype="ADD";

}


?>

















<center>

<div class="w3-container">
<input type="submit" id="comp" onclick="act()" value= <?php echo $ftype; ?> >
</div></center>


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
			<p><?php echo $friend ?> <a href="#" onmouseover="view()"> VIEW FRIENDS</a></p>
		</div>
	</div>

<script>
function view(){
$(".view").fadeToggle();
}
</script>

<div class="view">
<?php
for($i=0;$i<$num;$i++){
echo "<strong>".$friendname[$i]["name"]."</strong><br/>";
}
?>
</div>


<?php




$q="select u.name ,u.profile_pic from users  u natural join ".$uname."_friend_list order by date_of_friendship ";
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
		<div id="fbox1"> <img src=<?php echo $stack1[0]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[0]?></h2>
			
		</div>
		<div id="fbox2"> <img src=<?php echo $stack1[1]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[1]?></h2>
			
		</div>
		<div id="fbox3"> <img src=<?php echo $stack1[2]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[2]?></h2>
			
		</div>
		<div id="fbox4"> <img src=<?php echo $stack1[3]?> width="235" height="235" alt="" />
			<h2><?php echo $stack[3]?></h2>
			
		</div>
	</div>


<?php


$q="select preference from users where username ='".$uname."'";
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
		<div id="fbox2"> <img src=<?php echo $st[1]?> width="235" height="235" alt="" />
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



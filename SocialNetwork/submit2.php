<?php
session_start();

$uname=$_SESSION["uname"];

require_once('connection.php');

$q="select profile_pic from users where username='".$uname."'";
$r=$con->query($q);

while($row=$r->fetch_assoc()){

$pic=$row["profile_pic"];

}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CHATTERBOX  </title>
<link rel="icon" href="/ch.jpg" type="image/png">



<style>


div {
    border: 2px solid #a1a1a1;
    padding: 10px 40px;
    background: #dddddd;
    width: 300px;
    border-radius: 25px;
}



h2{

color:black;



text-decoration: underline;



    font-family: "Monotype Corsiva", Times, serif;

}


h3{

color:blue;



text-decoration: underline;



    font-family: "Monotype Corsiva", Times, serif;

}

.round-button {
	width:25%;
}
.round-button-circle {
	width: 100%;
	height:0;
	padding-bottom: 100%;
    border-radius: 50%;
	border:10px solid #cfdcec;
    overflow:hidden;
    
    background: #4679BD; 
    box-shadow: 0 0 3px gray;
}
.round-button-circle:hover {
	background:#30588e;
}
.round-button a {
    display:block;
	float:left;
	width:100%;
	padding-top:50%;
    padding-bottom:50%;
	line-height:1em;
	margin-top:-0.5em;
    
	text-align:center;
	color:#e2eaf3;
    font-family:Verdana;
    font-size:1.2em;
    font-weight:bold;
    text-decoration:none;
}



</style>

</head>

<body background="background.png">


<fieldset style=width:2cm height:2cm>

<img src=<?php echo $pic; ?> width="100" height="100"/>

<a href="upload.php"> change profile pic</a>


</fieldset>



<center><h2> PERSONAL STUFF <h2></CENTER>
       

    </body>

</html>
<center>
<fieldset style=width:10cm height:10cm>
<center> <h3> subscribe to feeds </h3> </center>

<pre>
<form action="submit3.php">

<input type="label" value="choose your first interest" >
<br>


<select name="i1"  PLACEHOLDER="INTEREST 1">


<option value="tech">TECHNOLOGY</OPTION>

<option value="edu">EDUCATION</OPTION>

<option value="ent">ENTERTAINMENT</OPTION>

<option value="news">RECENT-STORIES</OPTION>

<option value="sp">SPORTS</OPTION>



</select>

</br>
<input type="label" value="choose your second interest" >
<br>

<select name="i2"  PLACEHOLDER="INTEREST 2">


<option value="tech">TECHNOLOGY</OPTION>

<option value="edu">EDUCATION</OPTION>

<option value="ent">ENTERTAINMENT</OPTION>

<option value="news">RECENT-STORIES</OPTION>

<option value="sp">SPORTS</OPTION>



</select>

</br>
<input type="label" value="choose your third interest" >
<br>


<select name="i3"  PLACEHOLDER="INTEREST 3">


<option value="tech">TECHNOLOGY</OPTION>

<option value="edu">EDUCATION</OPTION>

<option value="ent">ENTERTAINMENT</OPTION>

<option value="news">RECENT-STORIES</OPTION>

<option value="sp">SPORTS</OPTION>



</select>

</br>

 <h3> Your work place </h3>

<input type="text" placeholder="WORKS AT" name="work">


<center> <div><input type="submit" value ="Save Changes"></div> </center>










</fieldset>

</center>
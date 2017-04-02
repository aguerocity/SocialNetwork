<?php

$uname="abh2406";
$stack=array();

require_once('connection.php');

$query="select * from ".$uname."_friend_list order by interaction_count desc" ;

$result=$con->query($query);


while($row=$result->fetch_assoc()){

array_push($stack, $row["username"]);

}

echo $stack[0];

$friends=array();
$fpic=array();
$i=0;$j=0;

while($i<count($stack)){
$q="select *   from ".$stack[$i]."_friend_list  f  ,".$uname."_friend_list u ,users m where f.username!= u.username and f.username=m.username";

$res=$con->query($q);






while($r=$res->fetch_assoc())
{
$j=$j+1;

array_push($friends,$r["f.name"]);

array_push($fpic,$r["profile_pic"]);







}

$i=$i+1;

}

?>


<?php 
$s1=$fpic[0];
$s2=$fpic[1];
$s3=$fpic[2];
echo $friends[0];
echo $s1;
?>












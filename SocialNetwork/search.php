<?php
session_start();
require_once("connection.php");
$link="profile2.php?x=";
$searchTerm = $_POST['msg'];
$query = $con->query("SELECT * FROM users WHERE name LIKE '".$searchTerm."%'  and username!='".$_SESSION["uname"]."' ORDER BY name ASC");
while ($row = $query->fetch_assoc()) {
    echo "<a href=".$link.$row["name"].">".$row["name"]."</a></br>";
}
?>
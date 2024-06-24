<?php
include "./config.php";
if(isset($_SESSION["role"]) && $_SESSION["role"] == 0){
    header("Location: post.php");
}


$id = $_GET["id"];

$query = "DELETE FROM user WHERE user_id = '$id' ";
$result = mysqli_query($conn, $query) or die("Delete query failed");

if($result){
    header("Location: users.php");
}


?>
<?php

include ("./config.php");
$id = $_GET["id"];
$cid = $_GET["catId"];


$sql = "SELECT * FROM  post WHERE  `post_id` = '$id'; ";
$result = mysqli_query($conn, $sql) or die("Query Failed");

$row = mysqli_fetch_assoc($result);

unlink("upload/".$row["post_img"]);


$sql = "DELETE FROM post WHERE  `post_id` = '$id'; ";
$sql .= "UPDATE category SET `post` = (post - 1) WHERE category_id = '$cid' ";

$result = mysqli_multi_query($conn, $sql) or die("Query failed");

if ($result) {
    header("Location: post.php");
} else {
    echo "Post Deletion failed";
}

?>
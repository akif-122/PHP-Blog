<?php
// 2,097,152

include "./config.php";
session_start();

if (isset($_FILES["fileToUpload"])) {
    $errors = [];
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    $file_type = $_FILES["fileToUpload"]["type"];
    // $file_ext = strtolower(end(explode(".", $name)));
    $file_ext = explode(".", $file_name);
    $file_ext = strtolower(end($file_ext));

    $extension = ["jpg", "png", "jpeg"];

    if (!in_array($file_ext, $extension)) {
        $errors[] = "This file extension is not allowed";
    }

    if ($file_size > 297152) {
        $errors[] = "File size must be less than 2MB.";
    }

    if (empty($errors)) {
        move_uploaded_file($tmp_name, "upload/" . $file_name);
    } else {
        print_r($errors);
    }

}

$title = $_POST["post_title"];
$desc = mysqli_real_escape_string($conn, $_POST["postdesc"]);
$category = $_POST["category"];
$date = date("d M, Y");
$author = $_SESSION["user_id"];

$sql = "INSERT INTO post(`title`,`description`,`category`,`post_date`,`author`,`post_img`)
                VALUES('$title', '$desc','$category','$date','$author','$file_name');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = '$category'";

$result = mysqli_multi_query($conn, $sql);

if($result){
    echo "Saved";
    header("Location: post.php");
}else{
    echo "Failed";
}

?>
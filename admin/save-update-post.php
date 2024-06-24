<?php
include ("./config.php");

$id = $_POST["post_id"];
$title = $_POST["title"];
$description = $_POST["description"];
$category = $_POST["category"];

if (empty($_FILES["new-image"]['name'])) {
    // $oldImg = $_POST["old-img"];

    $sql = "UPDATE post SET `title` = '$title', `description`='$description', `category`='$category' WHERE post_id = '$id' ";
} else {
    $errors = [];
    // print_r($_FILES["new-image"]);
    $filename = $_FILES["new-image"]["name"];
    $tmp_name = $_FILES["new-image"]["tmp_name"];
    $fileSize = $_FILES["new-image"]["size"];
    $fileExt = explode(".", $filename);
    $fileExt = strtolower(end($fileExt));

    $extensions = ["jpg", "png", "jpeg"];

    if (!in_array($fileExt, $extensions)) {
        $errors[] = "File Extension in invalid";
    }

    if ($fileSize > 2097152) {
        $errors[] = "File size must be less than 2 MB.";

    }

    if (empty($errors)) {

        $sql = "SELECT * FROM post WHERE post_id = '$id' ";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        unlink("upload/" . $row["post_img"]);


        $sql = "UPDATE post SET `title` = '$title', `description`='$description', `category`='$category' , `post_img` = '$filename' WHERE post_id = '$id' ";

        move_uploaded_file($tmp_name, "upload/" . $filename);

    } else {
        print_r($errors);
    }



}




$result = mysqli_query($conn, $sql) or die("Query failed");

if ($result) {




    header("Location: post.php");
} else {
    echo "Updation failed";
}


?>
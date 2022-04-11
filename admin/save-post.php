<?php
session_start();
include "config.php";

if (isset($_FILES["fileToUpload"])) {
    $error = array();

    $img_data = $_FILES["fileToUpload"];

    $img_name = $img_data["name"];
    $img_size = $img_data["size"];
    $img_tmp_name = $img_data["tmp_name"];
    $img_type = $img_data["type"];
    $file_extantion = end(explode(".", $img_name));

    $extantion = array("jpg", "png", "jpeg");
    if (in_array($file_extantion, $extantion) === false) {
        $error[] = "Your file should be jpeg,jpg,png";
    }

    if ($img_siz > 2097152) {
        $error[] = "file size must be 2mb or lower";
    }

    $target = "upload/" . $img_name;

    if (empty($error) == true) {
        move_uploaded_file($img_tmp_name, $target);
    } else {
        print_r($error);
        die();
    }
}


$pst_name = mysqli_real_escape_string($connection, $_REQUEST["post_title"]);
$postdesc = mysqli_real_escape_string($connection, $_REQUEST["postdesc"]);
$category = mysqli_real_escape_string($connection, $_REQUEST["category"]);
$date = date("d-m-Y");
$author = $_SESSION['id'];

$insert_query = "INSERT INTO post(title, description, category, pst_date, author, pst_img) VALUES ('{$pst_name}','{$postdesc}','{$category}','{$date}','{$author}','{$img_name}');";

$insert_query .= "UPDATE categroy SET post = post + 1 WHERE category_id={$category}";

$query = mysqli_multi_query($connection, $insert_query) or die("query failed");
if ($query) {
    header("location:post.php");
} else {
    echo "data not insert";
};

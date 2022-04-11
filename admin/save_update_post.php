<?php
include "config.php";

if ($_REQUEST["submit"]) {

    $rec_id = $_REQUEST["post_id"];
    $title = $_REQUEST["post_title"];
    $description = $_REQUEST["postdesc"];
    $category = $_REQUEST["category"];
    $img_name = $_FILES["new-image"]["name"];
    $type = $_FILES["new-image"]["type"];
    $tmp_name = $_FILES["new-image"]["tmp_name"];
    $size = $_FILES["new-image"]["size"];


    if (!empty($rec_id) && !empty($title) && !empty($description) && !empty($category) && !empty($img_name)) {

        $target = "upload/";
        $file_up = move_uploaded_file($tmp_name, $target . $img_name);
        if (!($file_up)) {
            print_r($error);
            die();
        };

        $up_query = "UPDATE post SET title = '$title', description = '$description', category = '$category', pst_img = '$img_name' WHERE pst_id = '$rec_id'";
        $query = mysqli_query($connection, $up_query) or die("query failed");
        if ($query) {
            header("location:post.php");
        } else {
            echo "Query upadate failed!";
        }
    } else if (!empty($rec_id) && !empty($title) && !empty($description) && !empty($category) && empty($img_name)) {
        
        $up_query = "UPDATE post SET title = '$title', description = '$description', category = '$category' WHERE pst_id = '$rec_id'";
        $query = mysqli_query($connection, $up_query) or die("query failed");
        if ($query) {
            header("location:post.php");
        } else {
            echo "Update query failed";
        }
    }
}

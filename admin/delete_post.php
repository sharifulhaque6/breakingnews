<?php
include "config.php";
echo $post_id = $_REQUEST["send_id"];
echo "<br>";
echo $ctg_id = $_REQUEST["ctg"];


$select_query = "SELECT * FROM post WHERE pst_id = '$post_id'";
$query_conect = mysqli_query($connection, $select_query);
$row = mysqli_fetch_assoc($query_conect);
unlink("upload/" . $row["pst_img"]);

$delete_query = "DELETE FROM post WHERE pst_id = '$post_id';";
$delete_query .= "UPDATE categroy SET post = post - 1 WHERE category_id='$ctg_id'";

if ($delete_query) {
    echo "Delete query";
} else {
    echo "query not delete";
};

$query = mysqli_multi_query($connection, $delete_query) or die("query filed");
if ($query) {
    header("location:post.php");
}

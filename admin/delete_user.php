<?php

include "config.php";

$rec_id = $_REQUEST['id'];

$delete_query = "DELETE FROM add_user WHERE id ='$rec_id'";
$query = mysqli_query($connection, $delete_query) or die("Delete Query failed");
if ($query) {
    header("location:users.php");
} else {
    echo "can't delete user";
}

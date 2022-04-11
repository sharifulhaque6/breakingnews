<?php
include "config.php";
$rcv_id = $_REQUEST["id"];

$delete_query = "DELETE FROM categroy WHERE category_id ='$rcv_id'";
$query = mysqli_query($connection,$delete_query) or die("query failed");

header("location:category.php");

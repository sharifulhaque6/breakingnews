<?php

$connection = mysqli_connect("localhost", "root", "", "news");
if (!$connection) {
    echo "Database Not connected";
}

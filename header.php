<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News Site</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="images/news.jpg" width="500"></a>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php

                    include "admin/config.php";

                    if (isset($_REQUEST["ctg_id"])) {
                        $id = $_REQUEST["ctg_id"];
                    };


                    $select_query = "SELECT * FROM categroy";
                    $query = mysqli_query($connection, $select_query) or die("query not connect");
                    $count = mysqli_num_rows($query);
                    if ($count > 0) {
                    ?>
                        <ul class='menu'>
                        <?php
                        $active = "";
                        while ($row = mysqli_fetch_assoc($query)) {
                            $ctg_id = $row["category_id"];
                            $ctg_name = $row["category_name"];
                            if (isset($_REQUEST["ctg_id"])) {
                                if ($ctg_id == $id) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                            }
                            echo "<li><a class='$active' href='category.php?ctg_id=$ctg_id'>$ctg_name</li>";
                        }
                    }


                        ?>

                        </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
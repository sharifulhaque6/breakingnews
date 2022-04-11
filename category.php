<?php include 'header.php';
include "admin/config.php";
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php

                    if (isset($_REQUEST["ctg_id"])) {
                        $id = $_REQUEST["ctg_id"];
                    };

                    $select_query = "SELECT * FROM categroy WHERE category_id='$id'";
                    $query = mysqli_query($connection, $select_query) or die("query failed");
                    $row = mysqli_fetch_assoc($query);

                    ?>
                    <h2 class="page-heading"><?php echo $row["category_name"] ?></h2>
                    <?php

                    // $limit = 5;
                    // if (isset($_REQUEST['page'])) {
                    //     $page_number = $_REQUEST['page'];
                    // } else {
                    //     $page_number = 1;
                    // }
                    // LIMIT $offset,$limit
                    // $offset = ($page_number - 1) * $limit;
                    $select_query = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id WHERE post.category={$id}
        ORDER BY pst_id DESC";
                    $query = mysqli_query($connection, $select_query) or die("Query feild");
                    $cunt = mysqli_num_rows($query);
                    if ($cunt > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row["pst_id"] ?>"><img src="admin/upload/<?php echo $row["pst_img"] ?>" alt="img not found" class="img-fluid" height="100%" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row["pst_id"] ?>'><?php echo $row["title"] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?ctg_id=<?php echo $row["category_id"] ?>'><?php echo $row["category_name"] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php'><?php echo $row["username"] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row["pst_date"] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row["description"], 0, 150) . "..."  ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row["pst_id"] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        echo "Data not found!";
                    }

                    // $select_query = "SELECT * FROM post ";
                    // $query_set = mysqli_query($connection, $select_query) or die("failed");
                    // if (mysqli_num_rows($query_set)) {
                    //     $page_count = mysqli_num_rows($query_set);
                    //     $total_page = ceil($page_count / $limit);
                    //     echo "<ul class='pagination admin-pagination'>";
                    //     if ($page_number > 1) {
                    //         echo '<li><a href="category.php?page=' . ($page_number - 1) . '">Prev</a></li>';
                    //     }
                    //     for ($i = 1; $i <= $total_page; $i++) {
                    //         if ($i == $page_number) {
                    //             $active = "active";
                    //         } else {
                    //             $active = "";
                    //         }
                    //         echo '<li class=' . $active . '><a href="category.php?page=' . $i . '">' . $i . '</a></li>';
                    //     }
                    // }
                    // if ($total_page > $page_number) {
                    //     echo '<li><a href="category.php?ctg_id=' . $id . '&page=' . ($page_number + 1) . '">Next</a></li>';
                    // };
                    // echo "</ul>";

                    ?>


                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
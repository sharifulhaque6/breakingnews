<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->

                <?php
                if (isset($_REQUEST["search"])) {
                    $rcv_search_value = $_REQUEST["search"];
                }

                ?>

                <div class="post-container">
                    <h2 class="page-heading">Search : <?php echo $rcv_search_value ?></h2>

                    <?php
                    include "admin/config.php";

                    $limit = 5;
                    if (isset($_REQUEST['page'])) {
                        $page_number = $_REQUEST['page'];
                    } else {
                        $page_number = 1;
                    }

                    $offset = ($page_number - 1) * $limit;

                    $pst_data_select = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id WHERE title LIKE '%{$rcv_search_value}%' ORDER BY pst_id DESC LIMIT $offset ,$limit";

                    $query_set = mysqli_query($connection, $pst_data_select) or die("query failed");
                    $count = mysqli_num_rows($query_set);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($query_set)) { ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row["pst_id"] ?>"><img src="admin/upload/<?php echo $row["pst_img"] ?>" alt="img not found" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row["pst_id"] ?>'><?php echo $row["title"] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php'><?php echo $row["category_name"] ?></a>
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
                                                <?php echo $row["description"] ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row["pst_id"] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        echo "data not found";
                    }


                    $select_query = "SELECT * FROM post WHERE title LIKE '%{$rcv_search_value}%'";
                    $query_set = mysqli_query($connection, $select_query) or die("failed");
                    if (mysqli_num_rows($query_set)) {
                        $page_count = mysqli_num_rows($query_set);
                        $total_page = ceil($page_count / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page_number > 1) {
                            echo '<li><a href="search.php?page=' . ($page_number - 1) . '">Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page_number) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo '<li class=' . $active . '><a href="search.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($total_page > $page_number) {
                        echo '<li><a href="search.php?page=' . ($page_number + 1) . '">Next</a></li>';
                    };
                    echo "</ul>";



                    ?>

                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
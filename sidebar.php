<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php
        include "admin/config.php";
        $pst_data_select = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id";

        $query_set = mysqli_query($connection, $pst_data_select) or die("query failed");
        $count = mysqli_num_rows($query_set);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($query_set)) { ?>

                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?php echo $row["pst_id"] ?>">
                        <img src="admin/upload/<?php echo $row["pst_img"] ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $row['pst_id'] ?>"><?php echo $row["title"] ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php'><?php echo $row["category_name"] ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row["pst_date"] ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $row["pst_id"] ?>">read more</a>
                    </div>
                </div>


        <?php

            }
        } else {
            echo "data not found";
        }



        ?>


    </div>
    <!-- /recent posts box -->
</div>
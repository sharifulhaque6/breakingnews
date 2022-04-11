<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">


                <?php
                include "admin/config.php";

                $rec_id = $_REQUEST["id"];

                $select_query = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id WHERE pst_id='$rec_id'";
                $query = mysqli_query($connection, $select_query) or die("Query feild");
                $cunt = mysqli_num_rows($query);
                if ($cunt > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <!-- post-container -->
                        <div class="post-container">
                            <div class="post-content single-post">
                                <h3><?php echo $row["title"] ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $row["category_name"] ?>
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
                                <img class="single-feature-image" src="admin/upload/<?php echo $row["pst_img"] ?>" alt="image not found" />
                                <p class="description">
                                    <?php echo $row["description"] ?>
                                </p>
                            </div>
                        </div>
                        <!-- /post-container -->

                <?php
                    }
                } else {
                    echo "Data not found!";
                }
                ?>



            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
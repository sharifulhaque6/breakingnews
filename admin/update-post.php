<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->

        <?php
        include "config.php";
        $rcv_id = $_REQUEST["send_id"];

        $select_query = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id WHERE pst_id='$rcv_id'";
        $query = mysqli_query($connection, $select_query) or die("Query feild");
        $cunt = mysqli_num_rows($query);
        if ($cunt > 0) {

          while ($row = mysqli_fetch_assoc($query)) {

        ?>

            <form action="save_update_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
              <div class="form-group">
                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['pst_id'] ?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description'] ?> </textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option disabled selected> Select Category</option>
                  <?php
                  $selct_query2 = "SELECT * FROM categroy";
                  $query2 = mysqli_query($connection, $selct_query2) or die("query failed");
                  $count2 = mysqli_num_rows($query2);
                  if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($query2)) {

                      if ($row["category"] == $row2["category_id"]) {
                        $select = "selected";
                      } else {
                        $select = "";
                      }

                      echo "<option {$select} value='{$row2['category_id']}'>{$row2['category_name']}</option>";
                    }
                  }

                  ?>
                  <input type="hidden" name="old_category" value="<?php echo $row["category"] ?>">
                </select>
              </div>
              <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img src="upload/<?php echo $row['pst_img'] ?>" height="150px" alt="Not found">
                <input type="hidden" name="old_image" value="<?php echo $row['pst_img'] ?>">
              </div>
              <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            </form>

        <?php
          }
        } else {
          echo "Data not found";
        } ?>

      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
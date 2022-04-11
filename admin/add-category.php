<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Add New Category</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <?php
        if (isset($_SESSION['ctg_msg'])) {
          echo "<p style='color:red; text-align:center;'>{$_SESSION['ctg_msg']}</p>";
        }
        ?>
        <!-- Form Start -->
        <form action="" method="POST">
          <?php
          include "config.php";
          if (isset($_REQUEST["save"])) {

            $ctg_name = mysqli_real_escape_string($connection, $_REQUEST["category_name"]);
            $select_query = "SELECT * FROM categroy WHERE category_name='$ctg_name'";
            $query = mysqli_query($connection, $select_query) or die("query faild");
            $count = mysqli_num_rows($query);
            if ($count > 0) {
              $_SESSION["ctg_msg"] = "Your category name already registered";
            } else {

              $insert_query = "INSERT INTO categroy(category_name) VALUES ('$ctg_name')";
              $query_setup = mysqli_query($connection, $insert_query) or die("query failed");
              header("location:category.php");
            }
          }

          ?>
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
          </div>
          <input type="submit" name="save" class="btn btn-primary" value="Save" required />
        </form>
        <!-- /Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
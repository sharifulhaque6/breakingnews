<?php include "header.php";
include "config.php";
?>

<?php
if (isset($_REQUEST["submit"])) {

  $update_id = $_REQUEST["category_id"];
  $ctg_name = mysqli_real_escape_string($connection, $_REQUEST["category_name"]);

  $update_query = "UPDATE categroy SET category_name ='$ctg_name' WHERE category_id='$update_id'";
  $query = mysqli_query($connection, $update_query) or die("query failed");

  header("location:category.php");
}


?>



<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="adin-heading"> Update Category</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <?php
        $rcv_id = $_REQUEST["id"];
        $select_row = "SELECT * FROM categroy WHERE category_id='$rcv_id'";
        $query = mysqli_query($connection, $select_row) or die("query failed");
        $count = mysqli_num_rows($query);
        if ($count > 0) {

          while ($row = mysqli_fetch_assoc($query)) {
            $ctg_id = $row["category_id"];
            $ctg_name = $row["category_name"];
          }
        }

        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <input type="hidden" name="category_id" class="form-control" value="<?php echo $ctg_id ?>" placeholder="">
          </div>
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" value="<?php echo $ctg_name ?>" placeholder="Add Category" required>
          </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
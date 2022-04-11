<?php include "header.php";
if (!isset($_SESSION['username'])) {
  header("location:index.php");
} ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">Categories</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-category.php">add category</a>
      </div>
      <div class="col-md-12">

        <?php
        include "config.php";

        $select_query = "SELECT * FROM categroy ORDER BY category_id DESC";
        $query = mysqli_query($connection, $select_query) or die("query failed");
        $count = mysqli_num_rows($query);
        if ($count > 0) {
        ?>

          <table class="content-table">
            <thead>
              <th>S.No.</th>
              <th>Category Name</th>
              <th>No. of Posts</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>

              <?php
              $serial_num = 1;
              while ($row = mysqli_fetch_assoc($query)) {
              ?>

                <tr>
                  <td><?php echo $serial_num++ ?></td>
                  <td><?php echo $row["category_name"] ?></td>
                  <td><?php echo $row["category_id"] ?></td>
                  <td><a href='update-category.php?id=<?php echo $row["category_id"] ?>'><i class='fa fa-edit'></i></a></td>
                  <td><a onclick="return confirm('Are you sure?')" href="delete_category.php?id=<?php echo $row["category_id"] ?>"><i class='fa fa-trash-o'></i></a></td>
                </tr>

              <?php } ?>

            </tbody>
          </table>
        <?php } ?>


        <ul class='pagination admin-pagination'>
          <li><a href="">prev</a></li>
          <li><a href="">1</a></li>
          <li><a href="">next</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
<?php include "header.php";
include "config.php";
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}

?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">Users Data</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-user.php">add user</a>
      </div>
      <div class="col-md-12">

        <?php
        $limit = 3;
        if (isset($_REQUEST['page'])) {
          $page_number = $_REQUEST['page'];
        } else {
          $page_number = 1;
        }

        $offset = ($page_number - 1) * $limit;
        $select_query = "SELECT * FROM add_user ORDER BY id DESC LIMIT $offset,$limit";
        $query = mysqli_query($connection, $select_query) or die("Query feild");
        $cunt = mysqli_num_rows($query);
        if ($cunt > 0) {

        ?>

          <table class="content-table">
            <thead>
              <th>DB ID</th>
              <th>Full Name</th>
              <th>User Name</th>
              <th>Role</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              <?php

              while ($row = mysqli_fetch_assoc($query)) {

                $id = $row["id"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $username = $row["username"];
                $role = $row["role"];
              ?>
                <tr>
                  <td class='id'><?php echo $id; ?></td>
                  <td><?php echo $fname . " " . $lname; ?></td>
                  <td><?php echo $username; ?></td>
                  <td><?php

                      if ($role == 1) {
                        echo "Admin";
                      } else {
                        echo "Moderator";
                      }

                      ?></td>
                  <td class='edit'><a href='update-user.php?id=<?php echo $id; ?>'><i class='fa fa-edit'></i></a></td>
                  <td class='delete'><a onclick="return confirm('Are Your Sure?')" href='delete_user.php?id=<?php echo $id; ?>'><i class='fa fa-trash-o'></i></a></td>
                </tr>

              <?php } ?>
            </tbody>
          <?php }; ?>
          </table>

          <?php

          $select_query = "SELECT * FROM add_user";
          $query_set = mysqli_query($connection, $select_query) or die("failed");
          if (mysqli_num_rows($query_set)) {
            $page_count = mysqli_num_rows($query_set);
            $total_page = ceil($page_count / $limit);
            echo "<ul class='pagination admin-pagination'>";
            if ($page_number > 1) {
              echo '<li><a href="users.php?page=' . ($page_number - 1) . '">Prev</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
              if ($i == $page_number) {
                $active = "active";
              } else {
                $active = "";
              }
              echo '<li class=' . $active . '><a href="users.php?page=' . $i . '">' . $i . '</a></li>';
            }
          }
          if ($total_page > $page_number) {
            echo '<li><a href="users.php?page=' . ($page_number + 1) . '">Next</a></li>';
          }
          echo "</ul>";
          ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
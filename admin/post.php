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
        <h1 class="admin-heading">Users Posts</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-post.php">add post</a>
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
        $select_query = "SELECT * FROM post
        LEFT JOIN categroy ON post.category = categroy.category_id 
        LEFT JOIN add_user ON post.author = add_user.id
        ORDER BY pst_id DESC LIMIT $offset,$limit";
        $query = mysqli_query($connection, $select_query) or die("Query feild");
        $cunt = mysqli_num_rows($query);
        if ($cunt > 0) {
        ?>
          <table class="content-table">
            <thead>
              <th>S.No.</th>
              <th>Image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date</th>
              <th>Author</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              <?php
              $serial_num = 1;
              while ($row = mysqli_fetch_assoc($query)) {

                $id = $row["pst_id"];
                $title = $row["title"];
                $description = $row["description"];
                $ctg = $row["category_name"];
                $pst_date = $row["pst_date"];
                $author = $row["username"];
                $pst_img = $row["pst_img"];

              ?>
                <tr>
                  <td class='id'><?php echo $serial_num++ ?></td>
                  <td><img height="50px" src="upload/<?php echo $pst_img ?>" alt="Not found"></td>
                  <td><?php echo $title ?></td>
                  <td><?php echo $ctg ?></td>
                  <td><?php echo $pst_date ?></td>
                  <td><?php echo $author ?></td>

                  <td class='edit'><a href='update-post.php?send_id=<?php echo $id ?>'><i class='fa fa-edit'></i></a></td>
                  <td class='delete' onclick="return confirm('Are you sure?')"><a href='delete_post.php?send_id=<?php echo $id ?> & ctg=<?php echo $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          <?php }; ?>
          </table>
          <?php

          $select_query = "SELECT * FROM post";
          $query_set = mysqli_query($connection, $select_query) or die("failed");
          if (mysqli_num_rows($query_set)) {
            $page_count = mysqli_num_rows($query_set);
            $total_page = ceil($page_count / $limit);
            echo "<ul class='pagination admin-pagination'>";
            if ($page_number > 1) {
              echo '<li><a href="post.php?page=' . ($page_number - 1) . '">Prev</a></li>';
            }
            for ($i = 1; $i <= $total_page; $i++) {
              if ($i == $page_number) {
                $active = "active";
              } else {
                $active = "";
              }
              echo '<li class=' . $active . '><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
            }
          }
          if ($total_page > $page_number) {
            echo '<li><a href="post.php?page=' . ($page_number + 1) . '">Next</a></li>';
          };
          echo "</ul>";
          ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
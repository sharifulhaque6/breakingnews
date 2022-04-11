<?php include "header.php";
include "config.php";
?>

<?php

if (isset($_REQUEST['submit'])) {

    $id = mysqli_real_escape_string($connection, $_REQUEST["user_id"]);
    $fname = mysqli_real_escape_string($connection, $_REQUEST["f_name"]);
    $lname = mysqli_real_escape_string($connection, $_REQUEST["l_name"]);
    $users = mysqli_real_escape_string($connection, $_REQUEST["username"]);
    $role = mysqli_real_escape_string($connection, $_REQUEST["role"]);

    $update_query = "UPDATE add_user SET fname ='$fname', lname ='$lname', username ='$users',role ='$role' WHERE id = '$id'";
    $query = mysqli_query($connection, $update_query) or die("Query failed");
    if ($query) {
        header("location:users.php");
    }
}


?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">

                <?php

                if (isset($_REQUEST["id"])) {

                    $id = $_REQUEST["id"];

                    $select_query = "SELECT * FROM add_user WHERE id ='$id'";
                    $query = mysqli_query($connection, $select_query) or die("Query failed");
                    $count = mysqli_num_rows($query);
                    if ($count > 0) {

                        while ($row = mysqli_fetch_assoc($query)) {

                            $id = $row["id"];
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $username = $row["username"];
                            $role = $row["role"];
                ?>
                            <!-- Form Start -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $id; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="f_name" class="form-control" value="<?php echo $fname; ?>" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="l_name" class="form-control" value="<?php echo $lname; ?>" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="form-control" name="role" value="<?php echo $role; ?>">
                                        <?php

                                        if ($role == 1) {

                                            echo "<option value='0'>Moderator</option>";
                                            echo "<option value='1' selected>Admin</option>";
                                        } else {

                                            echo "<option value='0' selected>Moderator</option>";
                                            echo "<option value='1'>Admin</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                            </form>

                <?php

                        }
                    }
                }

                ?>

                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
<?php include "header.php";
include "config.php";
?>


<?php

if (isset($_REQUEST["submit"])) {

    $fname = mysqli_real_escape_string($connection, $_REQUEST["fname"]);
    $lname = mysqli_real_escape_string($connection, $_REQUEST["lname"]);
    $users = mysqli_real_escape_string($connection, $_REQUEST["user"]);
    $password = mysqli_real_escape_string($connection, $_REQUEST["password"]);
    $role = $_REQUEST["role"];

    $psw = password_hash("$password", PASSWORD_BCRYPT);

    $select_query = "SELECT username FROM add_user WHERE username ='$users'";
    $query = mysqli_query($connection, $select_query);
    if (!$query) {
        echo "Query not connect";
    }
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $_SESSION["msg"] = "Your user name already exsits";
    } else {

        $query_insert = "INSERT INTO add_user(fname, lname, username, password, role) VALUES ('$fname','$lname','$users','$psw','$role')";
        $query = mysqli_query($connection, $query_insert) or die("query faild");

        header("location: users.php");
    }
}

?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <?php

                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                }

                ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Moderator</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Add" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
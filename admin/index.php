<?php
session_start();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<?php
include "config.php";
if (isset($_REQUEST['login'])) {

    $username = mysqli_real_escape_string($connection, $_REQUEST['username']);
    $password = mysqli_real_escape_string($connection, $_REQUEST['password']);

    $select_query = "SELECT * FROM add_user";
    $query = mysqli_query($connection, $select_query) or die("query failed");
    $count = mysqli_num_rows($query);
    if ($count > 0) {

        while ($row = mysqli_fetch_assoc($query)) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['user_role'] = $row['role'];
            $psw = $row['password'];

            $psw_verify = password_verify($password, $psw);
            if ($psw_verify) {
                header("location:post.php");
            } else {
                $_SESSION['login_msg'] = "Your password not match";
            }
        }
    } else {
        $_SESSION['login_msg'] = "Not found your data";
    }
}


?>



<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>

                    <?php
                    if (isset($_SESSION['login_msg'])) {
                        echo "<p style='text-align:center;color:red;'>{$_SESSION['login_msg']}</p>";
                    }
                    ?>

                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
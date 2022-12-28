<?php include('../config/constants.php'); ?>


<html>

<head>
    <title>Login - Food Delevary</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body class="main-content">

    <!-- Login From Starts -->

    <form action="" method="POST" class="login">
        <h1>Login</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['not-logged-in'])) {
            echo $_SESSION['not-logged-in'];
            unset($_SESSION['not-logged-in']);
        }
        ?>

        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
    </form>

    <!-- Login Form Ends -->
</body>

</html>





<?php
//Prosses form values in database

//check wether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked
    // Get data from form
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));



    // Check Weather the form data exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        // Check wether data ius available or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // Check if user and pass matcher or not
            $_SESSION['login'] = "<div class='success align-center'>Login Successful</div>";

            // Check if user logged in or not
            $_SESSION['user'] = $username;

            // Redirect
            header("location:" . SITEURL . 'admin/');
        } else {
            // User Not found. Redirect to manage admin
            $_SESSION['login'] = "<div class='failure align-center'>Login Failed</div>";
            header("location:" . SITEURL . 'admin/login.php');
        }
    }
}
?>
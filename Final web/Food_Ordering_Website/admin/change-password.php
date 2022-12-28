<?php include('partials/menu.php'); ?>

<!-- Main sention start -->

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
    
            // Getting id from URL
            $id = $_GET['id'];

            // Quarry for deletion
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // Executing the quary
            $res = mysqli_query($conn, $sql);

            // Checking if query executed or not
            if($res==TRUE)
            {
                // Check the data is available or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $id = $row["id"];
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
            }
            else
            {
                // Redirect
                header('localhost:'.SITEURL.'admin/manage-admin.php');
            }
        ?>







        <form action="" method="POST" class="form-style">
            <table>
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Retype Password" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" , value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="  Change Password  " class="btn-secondary text-area">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<!-- Main section ends -->


<?php
    //Prosses form values and update them in database

    //check wether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        // Get data from form
        $id = $_POST["id"];
        $current_password = md5($_POST["current_password"]);
        $new_password = md5($_POST["new_password"]);
        $confirm_password = md5($_POST["confirm_password"]);



        // Check Weather the form data exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);
        if($res==TRUE)
        {
            // Check wether data ius available or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                // Check if new pass and confirm pass matches or not
                if($new_password==$confirm_password)
                {
                    // SQL quary to Change
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password' WHERE id=$id
                    ";

                    // Saving data into database by executing query
                    $res2 = mysqli_query($conn, $sql2);


                    // Check and redirect if password changed successfully
                    if($res2==TRUE)
                    {
                        $_SESSION['pass-changed'] = "<div class='success'>Password Changed Successfully</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['pass-changed'] = "<div class='failure'>Could Not Change Password</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    // Password doesnt match. Redirect to manage admin
                    $_SESSION['pass-not-match'] = "<div class='failure'>New Password and Current Passwor Does Not Match</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                // User Not found. Redirect to manage admin
                $_SESSION['user-not-found'] = "<div class='failure'>User Not Found</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }
    }
?>

<?php include('partials/footer.php'); ?>
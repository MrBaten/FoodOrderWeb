<?php include('partials/menu.php'); ?>

<!-- Main sention start -->

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
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
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id", value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="  Update Admin  " class="btn-secondary text_area">
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
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];

        // SQL quary to update data
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username' WHERE id=$id
        ";

        // Saving data into database by executing query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='failure'>Admin Update Unsuccessful</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>

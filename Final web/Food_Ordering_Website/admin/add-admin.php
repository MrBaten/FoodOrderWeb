<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br><br>

        <form action="" method="POST" class="form-style">
            <table>
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter a Username" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter a Password" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="  Add Admin  " class="btn-secondary"
                            class="text-area">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>


<?php
    //Prosses form values and save them in database

    //check wether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        // Get data from form
        $full_name = $_POST["full_name"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        // SQL quary to save data
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        // Saving data into database
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='failure'>Admin Add Unsuccessful</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>
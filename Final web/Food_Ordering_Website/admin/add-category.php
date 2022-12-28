<?php include('partials/menu.php'); ?>

<!-- Main Content Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Catagory</h1><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data" class="form-style">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <label><input type="text" name="title" placeholder="Category Title"></label>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <label><input type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input type="radio" name="featured" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <label><input type="radio" name="active" value="Yes"> Yes</label>
                        <label><input type="radio" name="active" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <label><input type="file" name="image"></label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="  Add Category  " class="btn-secondary text-area">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main Content Ends -->

<?php include('partials/footer.php'); ?>


<?php
//Prosses form values and save them in database

//check wether the submit button is clicked or not

if (isset($_POST['submit'])) {
    // Button Clicked
    // Get data from form
    $title = $_POST['title'];

    // Check if radio checked or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }

    // Check if image selected or not

    if (isset($_FILES['image']['name'])) {
        // Getting Image Name
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            // Rename File
            $ext = end(explode('.', $image_name));
            $image_name = "Food_Catagory_" . rand(000, 999) . '.' . $ext;

            // Setting Sourse Path and Destination Path
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            // Uploading image
            $upload = move_uploaded_file($source_path, $destination_path);

            // Check if image uploaded or not
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='failure'>Failed To Upload Image</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
                die();
            }
        }
    } else {
        //Dont upload image and set value as blank
        $image_name = "";
    }

    // SQL quary to save data
    $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
        ";

    // Saving data into database
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['add'] = "<div class='failure'>Category Add Unsuccessful</div>";
        header("location:" . SITEURL . 'admin/add-category.php');
    }
}

?>
<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1> Add Food </h1>

        <?php
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
                        <label><input type="text" name="title" placeholder="Title of The Food"></label>
                    </td>
                </tr>

                <tr>
                    <td> Description: </td>
                    <td>
                        <label><textarea name="description" cols="30" rows="5"
                                placeholder="Description of the food"></textarea></label>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <label><input type="number" name="price"></label>
                    </td>

                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <label><input type="file" name="image"></label>
                    </td>

                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <label>
                            <select name="category">
                                <?php
                                //create php code to display categories from database
                                // 1.create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing query
                                $res = mysqli_query($conn, $sql);

                                //Count to rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //2.display on drop down
                                //If count is greater than zero , we have categories else we do not have categories
                                if ($count > 0) {
                                    // we have categories
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        //get the details of category
                                        $id = $row['id'];
                                        $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"> <?php echo $title; ?> </option>
                                <?php
                                    }
                                } else {
                                    //We do not have categories
                                    ?>
                                <option value="0">No Categories found</option>
                                <?php
                                }
                                ob_start();
                                ?>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <label><input type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input type="radio" name="featured" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <label><input type="radio" name="active" value="Yes"> Yes</label>
                        <label><input type="radio" name="active" value="No"> No</label>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="  Add Food  ">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
//check wether the button is clicked or not 
if (isset($_POST['submit'])) {
    // add the food on database

    //1. get the data from form 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    //check wether the radio button for featured and active are checked or not
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No"; // setting the default value
    }
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No"; // setting the default value
    }

    //2.Upload the image if selected
    //check wether select image is clicked or not and upload he image only if the image is selected
    if (isset($_FILES['image']['name'])) {
        // get the details of the selected image
        $image_name = $_FILES['image']['name'];
        //check wether image is selected or not and upload image only if selected
        if ($image_name != "") {
            //image is selected
            //1. we need to rename the image
            // get the extension of selected image(jpg, png,gif etc)
            $devide = explode('.', $image_name);
            $ext = end($devide);

            //create new name for image
            $image_name = "Food_Name_" . rand(0000, 9999) . "." . $ext; //new image name may  be "food-name-"

            // upload the image
            //get the src path and destination path 
            $src = $_FILES['image']['tmp_name'];

            //destination path for the image
            $dst = '../images/food/' . $image_name;

            //upload the food image 
            $upload = move_uploaded_file($src, $dst);

            //check wether image uploaded or not
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='failure'>Failed To Upload The Image</div>";
                header("location:" . SITEURL . 'admin/add-food.php');
                die();
            }
            //source path is the correct location of the image
        }
    } else {
        $image_name = ""; //setting default value
    }

    //3. and then insert in database
    //create a sql query to save and add food
    $sql2 = "INSERT INTO tbl_food SET 
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

    //execute the query 
    //4. redirect with message with food page
    $res2 = mysqli_query($conn, $sql2);
    // check wether data inserted or not
    if ($res2 == true) {
        $_SESSION['add'] = "<div class = 'success'> Food Added Successfully. </div>";
        header("location:" . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['add'] = "<div class='success'> Failed to add food </div>";
        header("location:" . SITEURL . 'admin/manage-food.php');
    }
}
?>
<?php include('partials/menu.php'); ?>

<?php
//CHeck whether id is set or not
if (isset($_GET['id'])) {
    //Get all the details
    $id = $_GET['id'];

    //SQL Query to Get the Selected Food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //execute the Query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //Get the Individual Values of Selected Food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //Rediect to Manage Food
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data" class="form-style">
            <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <label><input type="text" name="title" value="<?php echo $title; ?>"></label>
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <label><textarea name="description"><?php echo $description; ?></textarea></label>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <label><input type="number" name="price" value="<?php echo $price; ?>"></label>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <label><img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px"></label>
                        <?php
                        } else {
                            echo "<div class= 'failure'>Image not Available.</div>";
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <label><input type="file" name="image"></label>
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <label><select name="category">
                                <?php
                                // Query to Get Active Categories
                                $sql = "SELECT * FROM tbl_category WHERE active= 'Yes'";
                                //Execute the Query
                                $res = mysqli_query($conn, $sql);
                                //Count rows
                                $count = mysqli_num_rows($res);

                                //Check whether category available or not
                                if ($count > 0) {
                                    //CAtegory Available
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        //echo "<option value='$category_id>$category_title</option>";
                                ?>
                                        <option <?php if ($current_category == $category_id) {
                                                    echo "Selected";
                                                } ?> value="<? echo $category_id; ?>"><?php echo $category_title ?>
                                        </option>
                                <?php
                                    }
                                } else {
                                    //CAtegory Not Available
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                                ?>

                            </select></label>
                        <?php ob_start(); ?>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <label><input <?php if ($featured == "Yes") {
                                            echo "checked";
                                        } ?> type="radio" name="featured" value="Yes">Yes</label>
                        <label><input <?php if ($featured == "No") {
                                            echo "checked";
                                        } ?> type="radio" name="featured" value="No">No</label>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <label><input <?php if ($active == "Yes") {
                                            echo "checked";
                                        } ?> type="radio" name="active" value="Yes">Yes</label>
                        <label><input <?php if ($active == "No") {
                                            echo "checked";
                                        } ?> type="radio" name="active" value="No">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="  Update Food  ">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            //echo "Button Clicked";

            //1. Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Upload the image if Selected

            //Check whether upload button is clicked or not
            if (isset($_FILES['image']['name'])) {
                //Upload BUtton Clicked
                $image_name = $_FILES['image']['name']; //New Image name

                //CHeck whether the file is available or not
                if ($image_name != "") {
                    //IMage is Available
                    //A. Uploading New Image

                    //REname the Image
                    $ext = end(explode('.', $image_name)); //Gets the extension of the image

                    $image_name = "Food_Name_" . rand(0000, 9999) . '.' . $ext;

                    //Get the source Path and DEstination PAth
                    $src_path = $_FILES['image']['tmp_name']; //Source Path
                    $dest_path = "../images/food/" . $image_name; //DEstination Path

                    //Upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    ///CHeck whether the image is uploaded or not
                    if ($upload == false) {
                        //FAiled to Upload
                        $_SESSION['upload'] = "<div class='failure'>Failed to Upload Image.</div>";
                        //REdirect to Manage Food
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        //Stop the Process
                        die();
                    }
                    //3. Remove the image if new image is uploaded and current image exists
                    //B. Remove current Image if Available
                    if ($current_image != "") {
                        //Current Image is Available
                        //REmove the image
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        if ($remove == false) {
                            //failed to remove current image
                            $_SESSION['remove-failed'] = "<div class='failure'>Failed to remove Current Image.</div>";
                            //redirect to manage food
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            //Stop the Process
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //4. Update the food in Database
            $sql3 = "UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";
            //Execute the SQL Query
            $res3 = mysqli_query($conn, $sql3);

            //CHeck whether the query is executed or not
            if ($res3 == true) {
                //Query Executed andFood Updated
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div><br>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Failed to Update Food
                $_SESSION['update'] = "<div class='failure'>Failed to Update Food.</div><br>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
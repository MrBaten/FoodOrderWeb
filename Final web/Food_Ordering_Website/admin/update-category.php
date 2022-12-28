<?php include('partials/menu.php'); ?>

<!-- Main sention start -->

<div class="main-content">
    <div class="wrapper">
        <h1>Update Catagory</h1>
        <br><br>
        <?php
    
            // Getting id from URL
            
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                    
                // Quarry for deletion
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // Executing the quary
                $res = mysqli_query($conn, $sql);

                // Check the data is available or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $current_image = $row['image_name'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='failure'>No Category Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // Redirect
                header('localhost:'.SITEURL.'admin/manage-category.php');
            }
        ?>







        <form action="" method="POST" enctype="multipart/form-data" class="form-style">
            <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="text-area">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <label><input <?php if($featured=="Yes") echo "checked" ?> type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input <?php if($featured=="No") echo "checked" ?> type="radio" name="featured" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <label><input <?php if($featured=="Yes") echo "checked" ?> type="radio" name="active" value="Yes"> Yes</label>
                        <label><input <?php if($featured=="No") echo "checked" ?> type="radio" name="active" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                        ?>
                                <label><img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="100px"></label>
                        <?php
                            }
                            else
                            {
                                echo "<div class='failure'> Image Not Added </div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <label><input type="file" name="image"></label>  
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id", value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image", value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="  Update Category  ">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //Prosses form values and update them in database

            //check wether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                // Button Clicked
                // Get data from form
                $id = $_POST["id"];
                $title = $_POST["title"];
                $current_image = $_POST["current_image"];
                $featured = $_POST["featured"];
                $active = $_POST["active"];



                // Updating Image
                
                if(isset($_FILES['image']['name']))
                {
                    // Getting Image Name
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        // Rename File
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Catagory_".rand(000,999).'.'.$ext;

                        // Setting Sourse Path and Destination Path
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        // Uploading image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check if image uploaded or not
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='failure'>Failed To Upload Image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }

                        // Remove Current Image
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                $_SESSION['remove'] = "<div class='failure'>Failed To remove Catagory Image</div><br>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        //Dont upload image and set value as blank
                        $image_name = $current_image;
                    }
                }
                else
                {
                    //Dont upload image and set value as blank
                    $image_name = $current_image;
                }


                // SQL quary to update data
                $sql2 = "UPDATE tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";

                // Saving data into database by executing query
                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='failure'>Category Update Unsuccessful</div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }

        ?>

    </div>
</div>
<!-- Main section ends -->



<?php include('partials/footer.php'); ?>

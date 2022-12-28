<?php
    
    // Including the database connection
    include('../config/constants.php');


    // Check Wether id and inamge name set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get data from url
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Delete phisical image from directory
        if($image_name!="")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='failure'>Failed To Remove Catagory Image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        // Delete Data from Database
        // Quarry for deletion
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Executing the quary
        $res = mysqli_query($conn, $sql);

        // Checking if its deleted or not
        if($res==TRUE)
        {
            // Deleted successed
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Deleted failed
            $_SESSION['delete'] = "<div class='failure'>Category Deletetion Unsuccessful</div>";
            header('localhost:'.SITEURL.'admin/manage-category.php');
        }

        // Redirect to Manage Catagory
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        // Redirect To Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
<?php include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
{
    //Process to Delete
    //echo "Process to Delete";

    //1. Get ID and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove the image if available
    //Check whether the image is available or not and delete only if available
    if ($image_name != "") {
        // IT has Image from folder
        //Get the Image Image Path
        $path = "../images/food/" . $image_name;

        //REmove Image File from folder
        $remove = unlink($path);

        //Check whether the Image is removed or not
        if ($remove == false) {

            //Failed to Remove Image
            $_SESSION['remove'] = "<div class='failure'>Failed to Remove Image File</div";
            //REdirect to Manage Food
            header('location:' . SITEURL . 'admin/manager-food.php');
            //Stop the Process of Deleting Food
            die();
        }
    }
    //3. Delete food from Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed or not and set the session message respectively
    //4. Redirect to Manage Food with Session Message
    if ($res == true) {
        //Food Deleted
        $_SESSION['delete'] = "<div class ='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        //Failed to Delete Food
        $_SESSION['delete'] = "<div class='failure'>Failed to Delete Food</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    //Redirect to Manage Food Page
    //echo "REdirect";
    $_SESSION['unauthorize'] = "<div class= 'failure' >Unauthorized Access</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
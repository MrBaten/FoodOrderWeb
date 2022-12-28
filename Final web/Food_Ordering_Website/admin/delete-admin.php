<?php
    
    // Including the database connection
    include('../config/constants.php');

    // Getting id from URL
    $id = $_GET['id'];

    // Quarry for deletion
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Executing the quary
    $res = mysqli_query($conn, $sql);

    // Checking if its deleted or not
    if($res==TRUE)
    {
        // Deleted successed
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Deleted failed
        $_SESSION['delete'] = "<div class='failure'>Admin Deletetion Unsuccessful</div>";
        header('localhost:'.SITEURL.'admin/manage-admin.php');
    }
?>
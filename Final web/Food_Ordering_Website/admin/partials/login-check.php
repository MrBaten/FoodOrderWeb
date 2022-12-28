<?php
    // Authorization - Access Control
    // Check if the user logged in or not
    if(!isset($_SESSION['user']))
    {
        $_SESSION['not-logged-in'] = "<br><div class='failure text-center align-center'>Please Login to Access Admin Panel</div>";

            
        // Redirect to login Page
        header("location:".SITEURL.'admin/login.php');
    }
?>
<?php
    include('../config/constants.php');
    // Distroy The session
    session_destroy(); // Distroyes [user] session
    
    // Redirect to login Page
    header("location:".SITEURL.'admin/login.php');
?>
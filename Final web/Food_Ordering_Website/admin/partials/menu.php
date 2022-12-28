<?php
    include('../config/constants.php'); 
    include('login-check.php');
?>



<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script>
            $(document).ready(function(){
                $('#icon').click(function(){
                    $('ul').toggleClass('show');
                });
            });
        </script>
    </head>
    <body>
        <!-- Menu Starts -->
        <div class="menu">
            <nav>
                <label class="logo"><img src="../images/admin_logo.png" width="79px"></label>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Catagory</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                <label id="icon">
                    <i class="fas fa-bars"></i>
                </label>
            </nav>
        </div>
        <!-- Menu Ends -->

<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function() {
            $('#icon').click(function() {
                $('ul').toggleClass('show');
            });
        });
    </script>
</head>

<body>



        <!-- Menu Starts -->
        <div class="menu">
            <nav>
                <label class="logo"><img src="images/logo.png" width="79px"></label>
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Category</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <label id="icon">
                    <i class="fas fa-bars"></i>
                </label>
            </nav>
        </div>
        <!-- Menu Ends -->

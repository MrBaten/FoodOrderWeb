<?php include('partials/menu.php'); ?>


<!-- Main Content Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>&nbsp;&nbsp;DASHBOARD</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <?php
        $count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_category"));
        $count2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_food"));
        $count3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_order"));
        $count4 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'"));
        $rev = $count4['Total'];
        ?>



        <div class="col-4 text-center">
            <h1><?php echo $count; ?></h1>
            <br>
            <h3>Catagories</h3>
        </div>

        <div class="col-4 text-center">
            <h1><?php echo $count2; ?></h1>
            <br>
            <h3>Foods</h3>
        </div>

        <div class="col-4 text-center">
            <h1><?php echo $count3; ?></h1>
            <br>
            <h3>Total Orders</h3>
        </div>

        <div class="col-4 text-center">
            <h1><?php echo $rev; ?> Taka</h1>
            <br>
            <h3>Revenue Orders</h3>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Ends -->


<?php include('partials/footer.php'); ?>
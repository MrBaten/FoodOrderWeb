<?php include('partials-front/menu.php'); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}
?>





<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search-order">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name != "") {
                    ?>
                        <img src="images/food/<?php echo $image_name; ?>" alt="Chicken Pizza" class="img-responsive img-curve">
                    <?php
                    } else {
                        echo "<div class='error'>Image Not Found</div>";
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price"><?php echo $price; ?> Taka</p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="example.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                <!--need change-->
            </fieldset>
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php

if (isset($_POST['submit'])) {
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];


    $sql2 = "INSERT INTO tbl_order SET
        food='$food',
        price=$price,
        qty=$qty,
        total=$total,
        order_date='$order_date',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'
        ";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['order'] = "<div class='success'>Your Order Is Placed</div>";
        header("location:" . SITEURL);
    } else {
        $_SESSION['order'] = "<div class='success'>Your Order Is Not Placed</div>";
        header("location:" . SITEURL);
    }
}

?>


<?php include('partials-front/footer.php'); ?>

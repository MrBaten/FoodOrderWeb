<?php include('partials-front/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];

            $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
        ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?> Taka</p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>
                            <a href="order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
        <?php

                }
            } else {
                echo "<div class='error'>There are no Foods in this Category</div>";
            }
        } else {
            header('location:' . SITEURL);
        }
        ?>


        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
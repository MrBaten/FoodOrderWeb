<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>


        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $sn = 1;

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            $image_name = $rows['image_name'];
                ?>


                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <?php

                                    if ($image_name != "") {
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="Image Not Found or Failed To Load" height="60px">
                                    <?php
                                    } else {
                                        echo "<p style='color:red;'>Image Not Found</p>";
                                    }

                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update&nbspCategory</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete&nbspCategory</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        echo " <tr> <td colspan = '6' class = 'failure'>Category not added yet.</td> </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
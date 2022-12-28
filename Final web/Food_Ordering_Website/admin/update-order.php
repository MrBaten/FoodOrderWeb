<?php include('partials/menu.php'); ?>

<?php
//CHeck whether id is set or not
if (isset($_GET['id'])) {
    //Get all the details
    $id = $_GET['id'];

    //SQL Query to Get the Selected Food
    $sql2 = "SELECT * FROM tbl_order WHERE id=$id";
    //execute the Query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value based on query executed
    $rows = mysqli_fetch_assoc($res2);

    //Get the Individual Values of Selected Food
    $id = $rows['id'];
    $food = $rows['food'];
    $price = $rows['price'];
    $qty = $rows['qty'];
    $total = $rows['total'];
    $status = $rows['status'];
} else {
    //Rediect to Manage Food
    header('location:' . SITEURL . 'admin/manage-order.php');
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data" class="form-style">
            <table>
                <tr>
                    <td>Food Name: </td>
                    <td>
                        <label><?php echo $food; ?></label>
                    </td>
                </tr>
                <tr>
                    <td>Quantity: </td>
                    <td>
                        <label><input type="number" name="qty" value="<?php echo $qty; ?>"></label>
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <label>
                            <select name="status">
                                <option value="Ordered">Ordered</option>
                                <option value="On Delivery">On Delivery</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancled">Cancled</option>
                            </select>
                        </label>
                        <?php ob_start(); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="  Update Order  ">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            //echo "Button Clicked";

            //1. Get all the details from the form
            $id = $_POST['id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $total = $qty * $price;

            //4. Update the order in Database
            $sql3 = "UPDATE tbl_order SET
                qty = $qty,
                total=$total,
                status='$status'
                WHERE id=$id
            ";
            //Execute the SQL Query
            $res3 = mysqli_query($conn, $sql3);

            //CHeck whether the query is executed or not
            if ($res3 == true) {
                //Query Executed andFood Updated
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                //Failed to Update Food
                $_SESSION['update'] = "<div class='failure'>Failed to Update Order.</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
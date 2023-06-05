<?php include('partials/menu.php'); ?>

<?php
ob_start();
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM food WHERE id = $food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location: ' . URL . 'frontend');
    }
} else {
    header('location: ' . URL . 'frontend');
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name == "") {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                    ?>
                        <img src="<?php echo IMAGE_URL ?>food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title ?>">

                    <!-- <p class="food-price" style="font-size: 90%;">Rp.</p> -->
                    Rp. <?php echo $price ?>
                    <input type="hidden" name="price" value="<?php echo $price ?>" class="food-price" readonly style="font-size: 80%;">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="Enter your phone number" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="Enter your Email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $order_date = date("Y-m-d h:i:sa");
            $order_date = date("Y-m-d h:i:s");

            $status = "Ordered"; // Ordered, On Delivery, Delivered, Cancelled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // try {
            $sql2 = "INSERT INTO `order`SET
                            `food` = '$food',
                            `price` = $price,
                            `qty` = $qty,
                            `total` = $total,
                            `order_date` = '$order_date',
                            `status` = '$status',
                            `customer_name` = '$customer_name',
                            `customer_contact` = '$customer_contact',
                            `customer_email` = '$customer_email',
                            `customer_address` = '$customer_address'
                        ";

            $res2 = mysqli_query($conn, $sql2);
            // } catch (mysqli_sql_exception $e) {
            //     var_dump($e);
            //     exit;
            // }


            // $sql2 = "INSERT INTO order(food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES ('$food', `$price`, `$qty`, `$total`,'$order_date','$status','$customer_name','$customer_contact','$customer_email', '$customer_address')";


            if ($res2 == true) {
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                header('location: ' . URL . 'frontend');
            } else {
                $_SESSION['order'] = "<div class='success text-center'>Failed to order food</div>";
                header('location: ' . URL . 'frontend');
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials/footer.php'); ?>
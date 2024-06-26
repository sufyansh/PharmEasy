<?php
include "includes/head.php"
?>

<body>
    <?php
    include "includes/header.php";

    ?>

<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the link value from the form
    $deliveryLocation = $_POST['deliveryLocation'];
    
    // Save the link in a session variable
    $_SESSION['delivery_location'] = $deliveryLocation;
}
?>
    </div>
    <!-- PRODUCT header-->
    <div class="shopping" style="margin: 10px; border-bottom: 4px; font-weight: bold;">
        <h3> Shopping Cart</h3>
        <h1 class="border border-1.5" style="width: 100%;"> </h1>
    </div>
    <!-- end of PRODUCT header-->

    <!-- PRODUCTS-->
    <div class="container-fluid">
        <?php
        if (!empty($_SESSION['cart'])) {
            $data = get_cart();
            delete_from_cart();
            $num = sizeof($data);
            for ($i = 0; $i < $num; $i++) {
                if (isset($data[$i])) {
        ?>
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="images/<?php echo $data[$i][0]['item_image'] ?>" class="img-fluid rounded-start" style="margin: 10px; width: 20.45rem; height: 15.45rem; " alt="...">
                            </div>

                            <!--CATALOG FOR THE PRODUCT-->
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data[$i][0]['item_title'] ?></h5>

                                    <?php if ($data[$i][0]['item_quantity'] > 0) {

                                    ?>
                                        <small style="color: rgb(58, 211, 58);">In Stock</small>
                                    <?php
                                    } else {
                                    ?>
                                        <small style="color: red;">Out Of Stock</small>

                                    <?php
                                    }
                                    ?>
                                    </p>
                                    <small style="font-weight: bold;">₹<?php echo $data[$i][0]['item_price'] ?></small><br>
                                    <small class="text-muted" style="font-weight: bold;">Brand Name </small>
                                    <small style="color: rgb(80, 223, 80);font-weight: bold;padding:10px ;"><?php echo $data[$i][0]['item_brand'] ?></small><br>
                                    <small class="text-muted" style="font-weight: bold;">Quantity </small>
                                    <small style="color: rgb(80, 223, 80);font-weight: bold;padding:10px ;"><?php echo $_SESSION['cart'][$i]['quantity'] ?></small><br><br>
                                    <a href="cart.php?delete=<?php echo $data[$i][0]['item_id'] ?>" class="btn btn-outline-danger">Delete</a>



                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

<!-- <form action="products.php" method="POST"> -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="validationTooltip01">Enter Link of Location where you want to Deliver</label>
        <input id="validationTooltip01" type="text" class="form-control" placeholder="link...." value="<?php echo isset($_SESSION['delivery_location']) ? $_SESSION['delivery_location'] : ''; ?>" name="deliveryLocation">
        <div class="form-text">Please enter the delivery location link (1-25 characters), special characters are not allowed.</div>
    </div>
    
    <button type="submit" class="btn btn-primary">Save Link</button>
</form>


<!-- </form> -->
            <!-- end of PRODUCTS -->
            <!-- TOTAL -->
            <div class="shopping" style="margin: 10px; border-bottom: 4px; font-weight: bold;">
                <h3> Total </h3>
                <h1 class="border border-1.5" style="width: 100%;"> </h1>
            </div>
            <div style="margin-left: 460px;">
            <br>
                <h5>total (<?php
                            $total = total_price($data);
                            echo $num . " ";
                            if ($num == 1 or $num == 0) {
                                echo "item";
                            } else {
                                echo "items";
                            } ?>) : ₹<?php echo $total ?></h5>

                <br>

            </div>
            <div style="margin-left: 350px; padding-right: 100px;">
                <a href="cart.php?delete_all=1" class="btn btn-outline-danger btn-lg"> Delete all Products !</a>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <?php
    // Check if delivery location is empty
    if (empty($_SESSION['delivery_location'])) {
        echo '<button class="btn btn-outline-success btn-lg" disabled>Proceed to Buy (Save Location First)</button>';
    } else {
        echo '<a href="final.php?order=done" class="btn btn-outline-success btn-lg">Proceed to Buy</a>';
    }
    ?>
                <br><br>
            </div>
        <?php
        } else {
        ?>
            <h1 style="text-align: center; font-family: 'Fredoka One', cursive;">No products in the Cart</h1>
            <p style="text-align: center; font-family: 'Fredoka One', cursive;">Please add at least product to Buy</p>
            <img style="width:46rem; margin-left: 330px;" src="images/nocart.png" alt="">
        <?php
        }
        ?>

    </div>
    <!-- end of TOTAL -->
    <!-- FOOTER -->
    <?php
    include "includes/footer.php"
    ?>

</body>

</html>
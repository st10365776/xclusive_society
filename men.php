<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Men's Collection</title>
</head>
<body>
    <!-- Include navigation header -->
    <?php include 'includes/header.php'; ?>

    <!-- Page title section -->
    <section class="page-title">
        <h1>Men Collection</h1>
    </section>

    <!-- Products grid section -->
    <section class="products">

        <!-- PRODUCT 1: Casual T-Shirt -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/men/greyt.jpg">
                <h3>X.S Casual T-Shirt</h3>
                <p>R899</p>

                <!-- Hidden form fields to pass product data -->
                <input type="hidden" name="id" value="men1">
                <input type="hidden" name="name" value="X.S Casual T-Shirt">
                <input type="hidden" name="price" value="899">
                <input type="hidden" name="image" value="images/men/greyt.jpg">

                <button type="submit">Add to Cart</button>
            </form>
        </div>
        </form>
    </div>

    <!-- PRODUCT 3 -->
    <div class="product">
        <form action="add_to_cart.php" method="POST">

            <img src="images/men/hoodiep.jpg">

            <h3>X.S Performance Hoodie</h3>
            <p>R699</p>

            <input type="hidden" name="id" value="men3">
            <input type="hidden" name="name" value="X.S Performance Hoodie">
            <input type="hidden" name="price" value="699">
            <input type="hidden" name="image" value="images/men/hoodiep.jpg">

            <button type="submit">Add to Cart</button>

        </form>
    </div>

    <!-- PRODUCT 4 -->
    <div class="product">
        <form action="add_to_cart.php" method="POST">

            <img src="images/men/hoodiew.jpg">

            <h3>X.S Casual Hoodie</h3>
            <p>R699</p>

            <input type="hidden" name="id" value="men4">
            <input type="hidden" name="name" value="X.S Casual Hoodie">
            <input type="hidden" name="price" value="699">
            <input type="hidden" name="image" value="images/men/hoodiew.jpg">

            <button type="submit">Add to Cart</button>

        </form>
    </div>

    <!-- PRODUCT 5 -->
    <div class="product">
        <form action="add_to_cart.php" method="POST">

            <img src="images/men/sweaterf.jpg">

            <h3>X.S Sweater</h3>
            <p>R499</p>

            <input type="hidden" name="id" value="men5">
            <input type="hidden" name="name" value="X.S Sweater">
            <input type="hidden" name="price" value="499">
            <input type="hidden" name="image" value="images/men/sweaterf.jpg">

            <button type="submit">Add to Cart</button>

        </form>
    </div>

    <!-- PRODUCT 6 -->
    <div class="product">
        <form action="add_to_cart.php" method="POST">

            <img src="images/men/tsm.jpg">

            <h3>X.S Casual T-Shirt</h3>
            <p>R599</p>

            <input type="hidden" name="id" value="men6">
            <input type="hidden" name="name" value="X.S Casual T-Shirt">
            <input type="hidden" name="price" value="599">
            <input type="hidden" name="image" value="images/men/tsm.jpg">

            <button type="submit">Add to Cart</button>

        </form>
    </div>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
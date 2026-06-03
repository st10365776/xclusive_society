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
    <?php
    include 'includes/DBConn.php';
    include 'includes/product_helpers.php';
    $products = getProductsByCategory($conn, 'men');
    ?>

    <!-- Page title section -->
    <section class="page-title">
        <h1>Men Collection</h1>
    </section>

    <!-- Products grid section -->
    <section class="products">
        <?php renderProductGrid($products); ?>
    </section>

<?php include 'includes/footer.php'; ?>
<script>

function confirmAddToCart(price){

    return confirm("Add this item to cart for R" + price + "?");

}

</script>
</body>
</html>

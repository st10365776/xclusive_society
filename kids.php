<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kids Collection</title>
</head>
<body>
    <!-- Include navigation header -->
    <?php include 'includes/header.php'; ?>
    <?php
    include 'includes/DBConn.php';
    include 'includes/product_helpers.php';
    $products = getProductsByCategory($conn, 'kids');
    ?>

    <!-- Page title section -->
    <section class="page-title">
        <h1>Kids Collection</h1>
    </section>

    <!-- Products grid section -->
    <section class="products">
        <?php renderProductGrid($products); ?>
    </section>
    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>

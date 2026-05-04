<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kids Collection</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>

<section class="page-title">
    <h1>Kids Collection</h1>
</section>

<section class="products">

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/blackpants.jpg">
            <h3>X.S Black Pants</h3>
            <p>R399</p>

            <input type="hidden" name="id" value="kids1">
            <input type="hidden" name="name" value="X.S Black Pants">
            <input type="hidden" name="price" value="399">
            <input type="hidden" name="image" value="images/kids/blackpants.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/greyt.jpg">
            <h3>X.S Essential Tee</h3>
            <p>R300</p>

            <input type="hidden" name="id" value="kids2">
            <input type="hidden" name="name" value="X.S Essential Tee">
            <input type="hidden" name="price" value="300">
            <input type="hidden" name="image" value="images/kids/greyt.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/gstar.jpg">
            <h3>X.S G-Star Tee</h3>
            <p>R1299</p>

            <input type="hidden" name="id" value="kids3">
            <input type="hidden" name="name" value="X.S G-Star Tee">
            <input type="hidden" name="price" value="1299">
            <input type="hidden" name="image" value="images/kids/gstar.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/oranget.jpg">
            <h3>X.S Orange Shirt</h3>
            <p>R300</p>

            <input type="hidden" name="id" value="kids4">
            <input type="hidden" name="name" value="X.S Orange Shirt">
            <input type="hidden" name="price" value="300">
            <input type="hidden" name="image" value="images/kids/oranget.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/polo.jpg">
            <h3>X.S Polo</h3>
            <p>R699</p>

            <input type="hidden" name="id" value="kids5">
            <input type="hidden" name="name" value="X.S Polo">
            <input type="hidden" name="price" value="699">
            <input type="hidden" name="image" value="images/kids/polo.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/kids/pullover.jpg">
            <h3>X.S Pullover</h3>
            <p>R1200</p>

            <input type="hidden" name="id" value="kids6">
            <input type="hidden" name="name" value="X.S Pullover">
            <input type="hidden" name="price" value="1200">
            <input type="hidden" name="image" value="images/kids/pullover.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
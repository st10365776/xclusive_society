<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>

<section class="page-title">
    <h1>Women Collection</h1>
</section>

<section class="products">

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/1.jpg">
            <h3>X.S Button Dress</h3>
            <p>R380</p>

            <input type="hidden" name="id" value="women1">
            <input type="hidden" name="name" value="X.S Button Dress">
            <input type="hidden" name="price" value="380">
            <input type="hidden" name="image" value="images/women/1.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/2.jpg">
            <h3>X.S Red Long Dress</h3>
            <p>R1899</p>

            <input type="hidden" name="id" value="women2">
            <input type="hidden" name="name" value="X.S Red Long Dress">
            <input type="hidden" name="price" value="1899">
            <input type="hidden" name="image" value="images/women/2.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/3.jpg">
            <h3>X.S Black Long Dress</h3>
            <p>R1899</p>

            <input type="hidden" name="id" value="women3">
            <input type="hidden" name="name" value="X.S Black Long Dress">
            <input type="hidden" name="price" value="1899">
            <input type="hidden" name="image" value="images/women/3.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/4.jpg">
            <h3>X.S Long Sleeve Dress</h3>
            <p>R2499</p>

            <input type="hidden" name="id" value="women4">
            <input type="hidden" name="name" value="X.S Long Sleeve Dress">
            <input type="hidden" name="price" value="2499">
            <input type="hidden" name="image" value="images/women/4.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/5.jpg">
            <h3>X.S Wrap Dress</h3>
            <p>R1399</p>

            <input type="hidden" name="id" value="women5">
            <input type="hidden" name="name" value="X.S Wrap Dress">
            <input type="hidden" name="price" value="1399">
            <input type="hidden" name="image" value="images/women/5.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <div class="product">
        <form action="add_to_cart.php" method="POST">
            <img src="images/women/6.jpg">
            <h3>X.S Midi Dress</h3>
            <p>R699</p>

            <input type="hidden" name="id" value="women6">
            <input type="hidden" name="name" value="X.S Midi Dress">
            <input type="hidden" name="price" value="699">
            <input type="hidden" name="image" value="images/women/6.jpg">

            <button type="submit">Add to Cart</button>
        </form>
    </div>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
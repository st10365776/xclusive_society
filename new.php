<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New Products</title>
</head>
<body>
    <!-- Include navigation header -->
    <?php include 'includes/header.php'; ?>

    <!-- Page title section -->
    <section class="page-title">
        <h1>New Products</h1>
    </section>

    <!-- Products grid section -->
    <section class="products">
        
        <!-- PRODUCT 1: Kids Dress -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_products/n1.jpg">
                <h3>X.S Kids Dress</h3>
                <p>R340</p>

                <input type="hidden" name="id" value="new1">
                <input type="hidden" name="name" value="X.S Kids Dress">
                <input type="hidden" name="price" value="340">
                <input type="hidden" name="image" value="images/New_products/n1.jpg">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 2: Adidas Germany World Cup Jersey -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/adidas_Youth_Germany_Home_World_Cup_26_White_Stadium_Jersey_R1.299.95.png">
                <h3>X.S adidas Youth Germany Home World Cup 26 White Stadium Jersey</h3>
                <p>R1299.95</p>

                <input type="hidden" name="id" value="new2">
                <input type="hidden" name="name" value="X.S adidas Youth Germany Home World Cup 26 White Stadium Jersey">
                <input type="hidden" name="price" value="1299.95">
                <input type="hidden" name="image" value="images/New_Products/adidas_Youth_Germany_Home_World_Cup_26_White_Stadium_Jersey_R1.299.95.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 3: Anatomy Dragonfly T-Shirt -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/Anatomy Men's Whirl Dragonfly Graphic Brown T-shirt.png">
                <h3>X.S Anatomy Men's Whirl Dragonfly Graphic Brown T-shirt</h3>
                <p>R450</p>

                <input type="hidden" name="id" value="new3">
                <input type="hidden" name="name" value="X.S Anatomy Men's Whirl Dragonfly Graphic Brown T-shirt">
                <input type="hidden" name="price" value="450">
                <input type="hidden" name="image" value="images/New_Products/Anatomy Men's Whirl Dragonfly Graphic Brown T-shirt.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 4: Women's Barrel Leg Jeans -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/Exact Women's Mid Wash Barrel Leg Jeans.png">
                <h3>X.S Women's Mid Wash Barrel Leg Jeans</h3>
                <p>R650</p>

                <input type="hidden" name="id" value="new4">
                <input type="hidden" name="name" value="X.S Women's Mid Wash Barrel Leg Jeans">
                <input type="hidden" name="price" value="650">
                <input type="hidden" name="image" value="images/New_Products/Exact Women's Mid Wash Barrel Leg Jeans.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 5: Women's Checked Mesh Dress -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/Exact Women's White Checked Mesh Dress.png">
                <h3>X.S Women's White Checked Mesh Dress</h3>
                <p>R450</p>

                <input type="hidden" name="id" value="new5">
                <input type="hidden" name="name" value="X.S Women's White Checked Mesh Dress">
                <input type="hidden" name="price" value="450">
                <input type="hidden" name="image" value="images/New_Products/Exact Women's White Checked Mesh Dress.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 6: Men's Flannel Pyjama Set -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/Jet Men's Blue King Nap Knitted Flannel Pyjama Set.png">
                <h3>X.S Men's Blue King Nap Knitted Flannel Pyjama Set</h3>
                <p>R290</p>

                <input type="hidden" name="id" value="new6">
                <input type="hidden" name="name" value="X.S Men's Blue King Nap Knitted Flannel Pyjama Set">
                <input type="hidden" name="price" value="290">
                <input type="hidden" name="image" value="images/New_Products/Jet Men's Blue King Nap Knitted Flannel Pyjama Set.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 7: Women's Stripe Quarter Zip Pullover -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/pullover.png">
                <h3>X.S Women's White And Black Stripe Quarter Zip Pullover</h3>
                <p>R790</p>

                <input type="hidden" name="id" value="new7">
                <input type="hidden" name="name" value="X.S Women's White And Black Stripe Quarter Zip Pullover">
                <input type="hidden" name="price" value="790">
                <input type="hidden" name="image" value="images/New_Products/pullover.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <!-- PRODUCT 8: Boys Dino Pyjama Set -->
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="images/New_Products/Jet Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99.png">
                <h3>X.S Younger Boys Grey Dino Micro Fleece Pyjama Set</h3>
                <p>R129.99</p>

                <input type="hidden" name="id" value="new8">
                <input type="hidden" name="name" value="X.S Younger Boys Grey Dino Micro Fleece Pyjama Set">
                <input type="hidden" name="price" value="129.99">
                <input type="hidden" name="image" value="images/New_Products/Jet Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99.png">

                <button type="submit">Add to Cart</button>
            </form>
        </div>

    </section>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
    </section>
</body>
<script>
document.querySelectorAll('button[type="submit"]').forEach(btn => {
    btn.addEventListener('click', () => {
        btn.style.transform = "scale(0.9)";
        setTimeout(() => {
            btn.style.transform = "";
        }, 150);
    });
});
</script>
</html>
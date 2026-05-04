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
                <img src="images/New_Products/Jet Women's White And Black Stripe Quarter Zip Pullover.png">
                <h3>X.S Women's White And Black Stripe Quarter Zip Pullover</h3>
                <p>R790</p>

                <input type="hidden" name="id" value="new7">
                <input type="hidden" name="name" value="X.S Women's White And Black Stripe Quarter Zip Pullover">
                <input type="hidden" name="price" value="790">
                <input type="hidden" name="image" value="images/New_Products/Jet Women's White And Black Stripe Quarter Zip Pullover.png">

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

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Jet Women’s White And Black Stripe Quarter Zip Pullover.png">

                <h3>X.S Women’s White And Black Stripe Quarter Zip Pullover</h3>
                <p>R790</p>

                <input type="hidden" name="id" value="new7">
                <input type="hidden" name="name" value="X.S Women’s White And Black Stripe Quarter Zip Pullover">
                <input type="hidden" name="price" value="790">
                <input type="hidden" name="image" value="images/New_Products/Jet Women’s White And Black Stripe Quarter Zip Pullover.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Jet Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99.png">

                <h3>X.S Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99</h3>
                <p>R129.99</p>

                <input type="hidden" name="id" value="new8">
                <input type="hidden" name="name" value="X.S Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99">
                <input type="hidden" name="price" value="129.99">
                <input type="hidden" name="image" value="images/New_Products/Jet Younger Boys Grey Dino Micro Fleece Pyjama Set - R129.99.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Kids Calvin Klein Black Varsity Graphic T-Shirt.png">

                <h3>Kids Calvin Klein Black Varsity Graphic T-Shirt</h3>
                <p>R450.99</p>

                <input type="hidden" name="id" value="new9">
                <input type="hidden" name="name" value="X.S Kids Calvin Klein Black Varsity Graphic T-Shirt">
                <input type="hidden" name="price" value="450.99">
                <input type="hidden" name="image" value="images/New_Products/Kids Calvin Klein Black Varsity Graphic T-Shirt.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Kids G-star Green Regular T-shirt - R699.png">

                <h3>Kids G-star Green Regular T-shirt</h3>
                <p>R699</p>

                <input type="hidden" name="id" value="new10">
                <input type="hidden" name="name" value="X.S Kids G-star Green Regular T-shirt">
                <input type="hidden" name="price" value="699">
                <input type="hidden" name="image" value="images/New_Products/Kids G-star Green Regular T-shirt - R699.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Kids Jeep Black Essential Softshell Jacket - R899.png">

                <h3>Kids Jeep Black Essential Softshell Jacket</h3>
                <p>R899</p>

                <input type="hidden" name="id" value="new11">
                <input type="hidden" name="name" value="X.S Kids Jeep Black Essential Softshell Jacket">
                <input type="hidden" name="price" value="899">
                <input type="hidden" name="image" value="images/New_Products/Kids Jeep Black Essential Softshell Jacket - R899.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Men's Calvin Klein Black Sueded Stripe Pocket T-Shirt - R2,699.png">

                <h3>Men's Calvin Klein Black Sueded Stripe Pocket T-Shirt</h3>
                <p>R2699</p>

                <input type="hidden" name="id" value="new12">
                <input type="hidden" name="name" value="X.S Men's Calvin Klein Black Sueded Stripe Pocket T-Shirt">
                <input type="hidden" name="price" value="2699">
                <input type="hidden" name="image" value="images/New_Products/Men's Calvin Klein Black Sueded Stripe Pocket T-Shirt - R2,699.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Men's Calvin Klein Orange 20s Graphic T-Shirt - R1,499 - Copy.png">

                <h3>Men's Calvin Klein Orange 20s Graphic T-Shirt</h3>
                <p>R1499</p>

                <input type="hidden" name="id" value="new13">
                <input type="hidden" name="name" value="X.S Men's Calvin Klein Orange 20s Graphic T-Shirt">
                <input type="hidden" name="price" value="1499">
                <input type="hidden" name="image" value="images/New_Products/Men's Calvin Klein Orange 20s Graphic T-Shirt - R1,499 - Copy.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Men's Polo Black Logo T-Shirt - R549.png">

                <h3>Men's Polo Black Logo T-Shirt</h3>
                <p>R549</p>

                <input type="hidden" name="id" value="new14">
                <input type="hidden" name="name" value="X.S Men's Polo Black Logo T-Shirt">
                <input type="hidden" name="price" value="549">
                <input type="hidden" name="image" value="images/New_Products/Men's Polo Black Logo T-Shirt - R549.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Nikw Boys Just Do It Naby Tee.png">

                <h3>Nike Boys Just Do It Naby Tee</h3>
                <p>R349</p>

                <input type="hidden" name="id" value="new15">
                <input type="hidden" name="name" value="X.S Nike Boys Just Do It Naby Tee">
                <input type="hidden" name="price" value="349">
                <input type="hidden" name="image" value="images/New_Products/Nike Boys Just Do It Naby Tee.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Pleather Slim Fit Cropped Harrington Jacket.png">

                <h3>Pleather Slim Fit Cropped Harrington Jacket</h3>
                <p>R799</p>

                <input type="hidden" name="id" value="new16">
                <input type="hidden" name="name" value="X.S Pleather Slim Fit Cropped Harrington Jacket">
                <input type="hidden" name="price" value="799">
                <input type="hidden" name="image" value="images/New_Products/Pleather Slim Fit Cropped Harrington Jacket.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Redbat Men's Graphic Black T-Shirt.png">

                <h3>Redbat Men's Graphic Black T-Shirt</h3>
                <p>R359</p>

                <input type="hidden" name="id" value="new17">
                <input type="hidden" name="name" value="X.S Redbat Men's Graphic Black T-Shirt">
                <input type="hidden" name="price" value="359">
                <input type="hidden" name="image" value="images/New_Products/Redbat Men's Graphic Black T-Shirt.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>

        <div class="product">
             <form action="add_to_cart.php" method="POST">

                <img src="images/New_Products/Womens Stone Dty Poloneck.png">

                <h3>Womens Stone Dty Poloneck</h3>
                <p>R150</p>

                <input type="hidden" name="id" value="new18">
                <input type="hidden" name="name" value="X.S Womens Stone Dty Poloneck">
                <input type="hidden" name="price" value="150">
                <input type="hidden" name="image" value="images/New_Products/Womens Stone Dty Poloneck.png">

                <button type="submit">Add to Cart</button>

            </form>
        </div>
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
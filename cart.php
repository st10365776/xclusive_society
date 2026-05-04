<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>

<section class="cart-page">

<h1 class="cart-title">Your Bag</h1>

<div class="cart-wrapper">

<!-- LEFT SIDE -->
<div class="cart-items">

<div class="cart-card">

<img src="images/men/hoodiew.jpg">

<div class="cart-info">
<h3>X.S Casual Hoodie</h3>
<p class="price">R699</p>

<div class="qty">
<button>-</button>
<span>1</span>
<button>+</button>
</div>

<button class="remove">Remove</button>
</div>

</div>


<div class="cart-card">

<img src="images/men/tsm.jpg">

<div class="cart-info">
<h3>X.S Casual T-Shirt</h3>
<p class="price">R599</p>

<div class="qty">
<button>-</button>
<span>1</span>
<button>+</button>
</div>

<button class="remove">Remove</button>
</div>

</div>

</div>


<!-- RIGHT SIDE -->
<div class="cart-summary">

<h2>Order Summary</h2>

<div class="summary-line">
<span>Subtotal</span>
<span>R1298</span>
</div>

<div class="summary-line">
<span>Shipping</span>
<span>Free</span>
</div>

<hr>

<div class="summary-total">
<span>Total</span>
<span>R1298</span>
</div>

<a href="checkout.php" class="checkout-btn">Checkout</a>

</div>

</div>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
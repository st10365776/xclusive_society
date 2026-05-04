<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
session_start();
include 'includes/header.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<section class="cart-page">

<h1>Your Bag</h1>

<div class="cart-wrapper">

<div class="cart-items">

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>

<?php foreach ($cart as $id => $item): ?>

<?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>

<div class="cart-card">

<img src="<?php echo $item['image']; ?>">

<div class="cart-info">

<h3><?php echo $item['name']; ?></h3>
<p>R<?php echo $item['price']; ?></p>

<p>Qty: <?php echo $item['qty']; ?></p>

<p>Subtotal: R<?php echo $subtotal; ?></p>

<!-- ✅ REMOVE BUTTON ADDED HERE -->
<a href="remove-from-cart.php?id=<?php echo $id; ?>" 
   class="remove-btn"
   onclick="return confirm('Remove this item from cart?')">
   Remove
</a>

</div>

</div>

<?php endforeach; ?>

<?php endif; ?>

</div>

<!-- SUMMARY -->
<div class="cart-summary">

<h2>Order Summary</h2>

<p>Total: R<?php echo $total; ?></p>

<form action="place_order.php" method="POST">
    <button class="checkout-btn">Place Order</button>
</form>

</div>

</div>

</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
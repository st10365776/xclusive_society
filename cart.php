<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cart</title>
</head>
<body>
    <?php
   
    session_start();
    include 'includes/header.php';
    
    // Get cart from session, default to empty array if not set
    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
    ?>

    <section class="cart-page">
        <h1>Your Bag</h1>

        <?php if (!empty($_SESSION['cart_message'])): ?>
            <p class="cart-alert"><?= htmlspecialchars($_SESSION['cart_message']); ?></p>
            <?php unset($_SESSION['cart_message']); ?>
        <?php endif; ?>

        <div class="cart-wrapper">
            <div class="cart-items">
                
                <!-- Display message if cart is empty -->
                <?php if (empty($cart)): ?>
                    <p>Your cart is empty.</p>
                
                <!-- Display cart items -->
                <?php else: ?>
                    <?php foreach ($cart as $id => $item): ?>
                        <!-- Calculate subtotal for this item -->
                        <?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>

                        <div class="cart-card">
                            <!-- Product image -->
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">

                            <div class="cart-info">
                                <!-- Product name -->
                                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                <!-- Product price -->
                                <p>R<?php echo htmlspecialchars($item['price']); ?></p>

                                <!-- Item quantity -->
                                <p>Qty: <?php echo htmlspecialchars($item['qty']); ?></p>

                                <!-- Subtotal for this item -->
                                <p>Subtotal: R<?php echo $subtotal; ?></p>

                                <!-- Button to remove item from cart -->
                                <a href="remove-from-cart.php?id=<?php echo urlencode($id); ?>"
                                   class="remove-btn"
                                   onclick="return confirm('Remove this item from cart?')">
                                   Remove
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <!-- Order summary sidebar -->
            <div class="cart-summary">
                <h2>Order Summary</h2>

                <!-- Display total cart value -->
                <p>Total: R<?php echo number_format($total, 2); ?></p>

                <?php if (!empty($cart)): ?>
                    <!-- Form to proceed to checkout -->
                    <form action="checkout.php" method="GET">
                        <button class="checkout-btn">Checkout</button>
                    </form>

                    <form action="empty-cart.php" method="POST" onsubmit="return confirm('Empty your cart?')">
                        <button class="empty-cart-btn" type="submit">Empty Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>

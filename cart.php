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
    /**
     * SHOPPING CART PAGE
     * ==================
     * Displays all items currently in the user's shopping cart.
     * Shows item details including price, quantity, and subtotal.
     * Allows users to remove items or proceed to checkout.
     */
    
    session_start();
    include 'includes/header.php';
    
    // Get cart from session, default to empty array if not set
    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
    ?>

    <section class="cart-page">
        <h1>Your Bag</h1>

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
                            <img src="<?php echo $item['image']; ?>">

                            <div class="cart-info">
                                <!-- Product name -->
                                <h3><?php echo $item['name']; ?></h3>
                                <!-- Product price -->
                                <p>R<?php echo $item['price']; ?></p>

                                <!-- Item quantity -->
                                <p>Qty: <?php echo $item['qty']; ?></p>

                                <!-- Subtotal for this item -->
                                <p>Subtotal: R<?php echo $subtotal; ?></p>

                                <!-- Button to remove item from cart -->
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

            <!-- Order summary sidebar -->
            <div class="cart-summary">
                <h2>Order Summary</h2>

                <!-- Display total cart value -->
                <p>Total: R<?php echo $total; ?></p>

                <!-- Form to proceed to checkout -->
                <form action="place_order.php" method="POST">
                    <button class="checkout-btn">Place Order</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
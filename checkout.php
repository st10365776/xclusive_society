<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Checkout</title>
</head>
<body>
    <?php
    session_start();
    include 'includes/header.php';

    if (!isset($_SESSION['userID']) || empty($_SESSION['cart'])) {
        header("Location: cart.php");
        exit();
    }

    $cart = $_SESSION['cart'];
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }
    ?>

    <section class="checkout-page">
        <div class="checkout-container">
            <h1 class="checkout-title">Checkout</h1>

            <div class="checkout-wrapper">
                <!-- Checkout Form -->
                <form class="checkout-form" action="place_order.php" method="POST">
                    <!-- Delivery Details Section -->
                    <div class="form-section">
                        <h2 class="form-section-title">Delivery Details</h2>
                        
                        <div class="form-group">
                            <label for="customerName">Full Name</label>
                            <input id="customerName" type="text" name="customerName" value="Demo Customer" placeholder="Enter your full name" required>
                        </div>

                        <div class="form-group">
                            <label for="shippingAddress">Delivery Address</label>
                            <textarea id="shippingAddress" name="shippingAddress" placeholder="Enter your delivery address" rows="4" required>123 Xclusive Street, Sandton, Johannesburg, 2196</textarea>
                        </div>

                        <div class="form-group">
                            <label for="shippingMethod">Shipping Method</label>
                            <select id="shippingMethod" name="shippingMethod" required>
                                <option value="Standard Delivery">Standard Delivery - 3 to 5 business days</option>
                                <option value="Express Delivery">Express Delivery - 1 to 2 business days</option>
                                <option value="Collection">Store Collection</option>
                            </select>
                        </div>
                    </div>

                    <!-- Payment Details Section -->
                    <div class="form-section">
                        <h2 class="form-section-title">Payment Details</h2>

                        <div class="form-group">
                            <label for="paymentMethod">Payment Method</label>
                            <select id="paymentMethod" name="paymentMethod" required>
                                <option value="Demo Visa Card">Demo Visa Card</option>
                                <option value="Demo EFT">Demo EFT</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input id="cardNumber" type="text" name="cardNumber" value="4111 1111 1111 4242" placeholder="Enter card number" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiry">Expiry Date</label>
                                <input id="expiry" type="text" name="expiry" value="12/29" placeholder="MM/YY" required>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input id="cvv" type="text" name="cvv" value="123" placeholder="123" required>
                            </div>
                        </div>
                    </div>

                    <button class="checkout-btn" type="submit">Place Order</button>
                </form>

                <!-- Order Summary Sidebar -->
                <aside class="checkout-summary">
                    <h2 class="summary-title">Order Summary</h2>

                    <div class="summary-items">
                        <?php foreach ($cart as $item): ?>
                            <?php $subtotal = $item['price'] * $item['qty']; ?>
                            <div class="summary-item">
                                <span class="item-name"><?= htmlspecialchars($item['name']); ?> x <?= htmlspecialchars($item['qty']); ?></span>
                                <span class="item-price">R<?= number_format($subtotal, 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="summary-total">
                        <span>Total:</span>
                        <span class="total-price">R<?= number_format($total, 2); ?></span>
                    </div>

                    <a href="cart.php" class="back-to-cart-btn">Back to Cart</a>
                </aside>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <?php
    /**
     * CHECKOUT PAGE
     * ==============
     * Finalizes the order by:
     * 1. Validating user is logged in and has items in cart
     * 2. Calculating total cart value
     * 3. Inserting order record into tblAorder database table
     * 4. Clearing the cart session
     * 5. Redirecting to user profile
     */
    
    session_start();
    include 'includes/DBConn.php';

    // Only allow logged-in users with items in cart
    if (!isset($_SESSION['userID']) || empty($_SESSION['cart'])) {
        header("Location: cart.php");
        exit();
    }

    $userID = $_SESSION['userID'];
    $cart = $_SESSION['cart'];

    $total = 0;

    // Step 1: Calculate total cart value
    foreach ($cart as $productID => $item) {
        $total += $item['price'] * $item['qty'];
    }

    // Step 2: Insert new order into database
    $stmt = $conn->prepare("INSERT INTO tblAorder (userID, total) VALUES (?, ?)");
    $stmt->bind_param("id", $userID, $total);
    $stmt->execute();

    // Get the auto-generated order ID
    $orderID = $stmt->insert_id;

    // Step 3: Optional - store individual order items (if tblOrderItems table exists)
    foreach ($cart as $productID => $item) {
        $qty = $item['qty'];
        $price = $item['price'];

        // Uncomment below if you create tblOrderItems table:
        /*
        $stmt2 = $conn->prepare("
            INSERT INTO tblOrderItems (orderID, productID, quantity, price)
            VALUES (?, ?, ?, ?)
        ");
        $stmt2->bind_param("iiid", $orderID, $productID, $qty, $price);
        $stmt2->execute();
        */
    }

    // Step 4: Clear cart from session
    unset($_SESSION['cart']);

    // Step 5: Redirect to profile page to see order
    header("Location: profile.php");
    exit();
    ?>

    <h1>Checkout</h1>
    <p>Total: R<?= $total ?></p>

    <!-- Display message only if something goes wrong before redirect -->
    <form action="place_order.php" method="POST">
        <button class="btn">Place Order</button>
    </form>
</body>
</html>
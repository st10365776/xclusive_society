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
include 'includes/DBConn.php';

if (!isset($_SESSION['userID']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$userID = $_SESSION['userID'];
$cart = $_SESSION['cart'];

$total = 0;

/* 1. CALCULATE TOTAL */
foreach ($cart as $id => $item) {
    $total += $item['price'] * $item['qty'];
}

/* 2. INSERT INTO tblAorder */
$stmt = $conn->prepare("INSERT INTO tblAorder (userID, total) VALUES (?, ?)");
$stmt->bind_param("id", $userID, $total);
$stmt->execute();

$orderID = $stmt->insert_id;

/* 3. OPTIONAL: If you want order items table later */
foreach ($cart as $id => $item) {

    $productID = $id;
    $qty = $item['qty'];
    $price = $item['price'];

    //
    /*
    $stmt2 = $conn->prepare("
        INSERT INTO tblOrderItems (orderID, productID, quantity, price)
        VALUES (?, ?, ?, ?)
    ");
    $stmt2->bind_param("iiid", $orderID, $productID, $qty, $price);
    $stmt2->execute();
    */
}

/* 4. CLEAR CART */
unset($_SESSION['cart']);

/* 5. REDIRECT */
header("Location: profile.php");
exit();
?>

<h1>Checkout</h1>

<p>Total: R<?= $total ?></p>

<form action="place_order.php" method="POST">
<button class="btn">Place Order</button>
</form>
</body>
</html>
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
include 'includes/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];

$total = 0;

foreach($cart as $product_id => $qty){

    $result = $conn->query("SELECT * FROM products WHERE id=$product_id");
    $product = $result->fetch_assoc();

    $total += $product['price'] * $qty;
}
?>

<h1>Checkout</h1>

<p>Total: R<?= $total ?></p>

<form action="place_order.php" method="POST">
<button class="btn">Place Order</button>
</form>
</body>
</html>
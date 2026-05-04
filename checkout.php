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

$user_id = $_SESSION['userID'];

$total = 0;

foreach($_SESSION['cart'] as $id=>$qty){
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $product = $result->fetch_assoc();

    $total += $product['price'] * $qty;
}

$conn->query("
INSERT INTO orders(userID,total)
VALUES('$user_id','$total')
");

$order_id = $conn->insert_id;

foreach($_SESSION['cart'] as $id=>$qty){

    $product = $conn->query("SELECT * FROM tblClothes WHERE id=$id")->fetch_assoc();

    $conn->query("
    INSERT INTO order_items(order_id,product_id,quantity,price)
    VALUES('$order_id','$id','$qty','".$product['price']."')
    ");
}

unset($_SESSION['cart']);

header("Location: profile.php");
exit();
?>

<h2>Your Orders</h2>

<?php
$user_id = $_SESSION['user_id'];

$orders = $conn->query("
SELECT * FROM orders
WHERE user_id=$user_id
ORDER BY order_date DESC
");

while($order = $orders->fetch_assoc()){
    echo "<p>Order #".$order['id']." - R".$order['total']."</p>";
}
?>

<h1>Checkout</h1>

<p>Total: R<?= $total ?></p>

<form action="place_order.php" method="POST">
<button class="btn">Place Order</button>
</form>
</body>
</html>
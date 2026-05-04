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

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];

$total = 0;

/* calculate total */

foreach($cart as $product_id => $qty){
    $product = $conn->query(
        "SELECT * FROM products WHERE id=$product_id"
    )->fetch_assoc();

    $total += $product['price'] * $qty;
}

/* create order */

$conn->query("
INSERT INTO orders(user_id,total)
VALUES('$user_id','$total')
");

$order_id = $conn->insert_id;

/* insert order items */

foreach($cart as $product_id => $qty){

    $product = $conn->query(
        "SELECT * FROM products WHERE id=$product_id"
    )->fetch_assoc();

    $price = $product['price'];

    $conn->query("
    INSERT INTO order_items(order_id,product_id,quantity,price)
    VALUES('$order_id','$product_id','$qty','$price')
    ");
}

/* clear cart */

unset($_SESSION['cart']);

header("Location: profile.php");
exit();
?>
</body>
</html>
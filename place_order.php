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
foreach ($cart as $productID => $item) {

    $total += $item['price'] * $item['qty'];
}

/* 2. INSERT ORDER INTO tblAorder */
$stmt = $conn->prepare("INSERT INTO tblAorder (userID, total) VALUES (?, ?)");
$stmt->bind_param("id", $userID, $total);
$stmt->execute();

$orderID = $stmt->insert_id;

/* 3. OPTIONAL: store order details (only if you later create tblOrderItems)
   For now we skip this because your DB doesn't have it
*/

/* 4. CLEAR CART */
unset($_SESSION['cart']);

/* 5. REDIRECT */
header("Location: profile.php");
exit();
?>
</body>
</html>
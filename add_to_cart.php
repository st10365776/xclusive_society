<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add to Cart</title>
</head>
<body>

<?php

/**
 * ==========================================
 * ADD TO CART
 * ==========================================
 * - Adds products into session cart
 * - Increments quantity if product exists
 * - Redirects user back to product page
 * ==========================================
 */

session_start();
include 'includes/DBConn.php';

/* Check if product ID was submitted */
if (!isset($_POST['id'])) {

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

}

/* Get product ID */
$id = $_POST['id'];

/* Fetch product from database */
$sql = "SELECT productCode, productName, price, imagePath
        FROM tblClothes
        WHERE productCode = ? AND isActive = 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();

$product = $stmt->get_result()->fetch_assoc();

/* If product does not exist */
if (!$product) {

    header("Location: products.php");
    exit();

}

/* Create cart session if not already created */
if (!isset($_SESSION['cart'])) {

    $_SESSION['cart'] = [];

}

/* Product already exists in cart */
if (isset($_SESSION['cart'][$id])) {

    $_SESSION['cart'][$id]['qty'] += 1;

} else {

    /* Add new product to cart */
    $_SESSION['cart'][$id] = [

        "id"    => $product['productCode'],
        "name"  => $product['productName'],
        "price" => $product['price'],
        "image" => $product['imagePath'],
        "qty"   => 1

    ];

}

/* Redirect user back to previous page */
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

?>

</body>
</html>

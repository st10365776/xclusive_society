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
   
   
   session_start();
   include 'includes/DBConn.php';

   if (!isset($_POST['id'])) {
       header("Location: cart.php");
       exit();
   }

   $id = $_POST['id'];

   $stmt = $conn->prepare(
       "SELECT productCode, productName, price, imagePath
        FROM tblClothes
        WHERE productCode = ? AND isActive = 1"
   );
   $stmt->bind_param("s", $id);
   $stmt->execute();
   $product = $stmt->get_result()->fetch_assoc();

   if (!$product) {
       header("Location: cart.php");
       exit();
   }

   // Initialize cart session array if it doesn't exist
   if (!isset($_SESSION['cart'])) {
       $_SESSION['cart'] = [];
   }

   // If product already in cart, increment quantity
   if (isset($_SESSION['cart'][$id])) {
       $_SESSION['cart'][$id]['qty'] += 1;
   } else {
       // Otherwise add product as new item with quantity 1
       $_SESSION['cart'][$id] = [
           "name" => $product['productName'],
           "price" => $product['price'],
           "image" => $product['imagePath'],
           "qty" => 1
       ];
   }

   // Redirect to cart page to view updated cart
   header("Location: cart.php");
   exit();
   ?>
</body>
</html>

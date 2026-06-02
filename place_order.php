<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Confirm Order</title>
</head>
<body>
   <?php
   
   
   session_start();
   include 'includes/DBConn.php';

   // Ensure user is logged in and has items to checkout
   if (!isset($_SESSION['userID']) || empty($_SESSION['cart'])) {
       header("Location: cart.php");
       exit();
   }

   $userID = $_SESSION['userID'];
   $cart = $_SESSION['cart'];

   $total = 0;

   // Calculate total order amount
   foreach ($cart as $productID => $item) {
       $total += $item['price'] * $item['qty'];
   }

   // Insert order into database with calculated total
   $stmt = $conn->prepare("INSERT INTO tblAorder (userID, total) VALUES (?, ?)");
   $stmt->bind_param("id", $userID, $total);
   $stmt->execute();

   // Get the newly created order ID
   $orderID = $stmt->insert_id;

   $itemStmt = $conn->prepare(
       "INSERT INTO tblOrderItems (orderID, productCode, productName, quantity, price)
        VALUES (?, ?, ?, ?, ?)"
   );

   foreach ($cart as $productCode => $item) {
       $qty = $item['qty'];
       $price = $item['price'];
       $name = $item['name'];
       $itemStmt->bind_param("issid", $orderID, $productCode, $name, $qty, $price);
       $itemStmt->execute();
   }

   // Clear cart from session after successful order placement
   unset($_SESSION['cart']);

   // Redirect to profile to view order confirmation
   header("Location: profile.php");
   exit();
   ?>
</body>
</html>

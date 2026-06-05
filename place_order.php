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
   require_once 'includes/schema_helpers.php';
   ensureStoreSchema($conn);

   // Ensure user is logged in and has items to checkout
   if (!isset($_SESSION['userID']) || empty($_SESSION['cart'])) {
       header("Location: cart.php");
       exit();
   }

   $userID = $_SESSION['userID'];
   $cart = $_SESSION['cart'];
   $shippingAddress = trim($_POST['shippingAddress'] ?? '123 Xclusive Street, Sandton, Johannesburg, 2196');
   $shippingMethod = trim($_POST['shippingMethod'] ?? 'Standard Delivery');
   $paymentMethod = trim($_POST['paymentMethod'] ?? 'Demo Visa Card');
   $cardNumber = preg_replace('/\D/', '', $_POST['cardNumber'] ?? '4242');
   $paymentLast4 = substr($cardNumber, -4);

   $total = 0;

   // Calculate total order amount
   foreach ($cart as $productID => $item) {
       $total += $item['price'] * $item['qty'];
   }

   $conn->begin_transaction();

   try {
       $stockStmt = $conn->prepare(
           "SELECT quantity FROM tblClothes WHERE productCode = ? AND isActive = 1 FOR UPDATE"
       );

       foreach ($cart as $productCode => $item) {
           $qty = (int)$item['qty'];
           $stockStmt->bind_param("s", $productCode);
           $stockStmt->execute();
           $product = $stockStmt->get_result()->fetch_assoc();

           if (!$product || (int)$product['quantity'] < $qty) {
               throw new Exception($item['name'] . " does not have enough stock.");
           }
       }

       // Insert order into database with calculated total and checkout details
       $stmt = $conn->prepare(
           "INSERT INTO tblAorder
            (userID, total, shippingAddress, shippingMethod, paymentMethod, paymentLast4)
            VALUES (?, ?, ?, ?, ?, ?)"
       );
       $stmt->bind_param("idssss", $userID, $total, $shippingAddress, $shippingMethod, $paymentMethod, $paymentLast4);
       $stmt->execute();

       // Get the newly created order ID
       $orderID = $stmt->insert_id;

       $itemStmt = $conn->prepare(
           "INSERT INTO tblOrderItems (orderID, productCode, productName, quantity, price)
            VALUES (?, ?, ?, ?, ?)"
       );
       $quantityStmt = $conn->prepare(
           "UPDATE tblClothes SET quantity = quantity - ? WHERE productCode = ?"
       );

       foreach ($cart as $productCode => $item) {
           $qty = (int)$item['qty'];
           $price = (float)$item['price'];
           $name = $item['name'];
           $itemStmt->bind_param("issid", $orderID, $productCode, $name, $qty, $price);
           $itemStmt->execute();

           $quantityStmt->bind_param("is", $qty, $productCode);
           $quantityStmt->execute();
       }

       $conn->commit();

       // Clear cart from session after successful order placement
       unset($_SESSION['cart']);
       $_SESSION['order_message'] = "Order placed successfully.";

       // Redirect to profile to view order confirmation
       header("Location: profile.php");
       exit();
   } catch (Exception $e) {
       $conn->rollback();
       $_SESSION['cart_message'] = $e->getMessage();
       header("Location: cart.php");
       exit();
   }
   ?>
</body>
</html>

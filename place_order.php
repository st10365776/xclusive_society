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
   /**
    * PLACE ORDER - ORDER CONFIRMATION PAGE
    * =====================================
    * Processes the final order placement.
    * Validates user is logged in and has cart items.
    * Calculates total and creates order record in database.
    * Clears cart and redirects to profile.
    */
   
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

   // Clear cart from session after successful order placement
   unset($_SESSION['cart']);

   // Redirect to profile to view order confirmation
   header("Location: profile.php");
   exit();
   ?>
</body>
</html>
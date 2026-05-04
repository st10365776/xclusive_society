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
    * ADD TO CART HANDLER
    * ===================
    * Processes product additions to the shopping cart.
    * Stores cart data in the session ($_SESSION['cart']).
    * If a product already exists in cart, increments quantity.
    * Otherwise, adds the product as a new cart item.
    */
   
   session_start();

   // Collect product data from form submission
   $product = [
       "id" => $_POST['id'],
       "name" => $_POST['name'],
       "price" => $_POST['price'],
       "image" => $_POST['image']
   ];

   $id = $product['id'];

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
           "name" => $product['name'],
           "price" => $product['price'],
           "image" => $product['image'],
           "qty" => 1
       ];
   }

   // Redirect to cart page to view updated cart
   header("Location: cart.php");
   exit();
   ?>
</body>
</html>
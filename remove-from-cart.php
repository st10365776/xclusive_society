<?php
/**
 * REMOVE FROM CART
 * ================
 * Handles removal of a single product item from the shopping cart.
 * Gets product ID from GET parameter and removes it from session.
 * Redirects back to cart page to show updated cart.
 */

session_start();

// Check if product ID was provided in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Remove the product from cart if it exists
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// Redirect back to cart page to show updated cart
header("Location: cart.php");
exit();
?>
<?php
/**
 * CANCEL ORDER
 * ============
 * Handles order cancellation from the user profile page.
 * Only allows users to cancel their own orders (security check).
 * Deletes order from database if it belongs to the current user.
 * Redirects back to profile page.
 */

session_start();
include 'includes/DBConn.php';

// Only allow logged-in users to cancel orders
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

// Process order cancellation if orderID provided
if (isset($_GET['orderID'])) {

    $orderID = $_GET['orderID'];
    $userID = $_SESSION['userID'];

    // SECURITY: Ensure user can only delete THEIR OWN orders
    // This prevents users from canceling others' orders
    $sql = "DELETE FROM tblAorder WHERE orderID = ? AND userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $orderID, $userID);
    $stmt->execute();
}

// Redirect back to profile to see updated orders
header("Location: profile.php");
exit();
?>
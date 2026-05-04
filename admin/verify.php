<?php
/**
 * VERIFY USER
 * ===========
 * Marks a user as verified in the database.
 * Admin uses this to approve pending user registrations.
 * Gets user ID from URL parameter and updates verified field to 1.
 * Redirects back to verify_users.php.
 */

// Check if user is authenticated admin
include 'admin_auth.php';
include '../includes/DBConn.php';

// Get user ID from URL parameter
$id = $_GET['id'];

// Update user verified status to 1 (approved)
// WARNING: Should use prepared statements for security
$conn->query(
    "UPDATE tblUser SET verified=1 WHERE userID=$id"
);

// Redirect back to pending verification list
header("Location: verify_users.php");
exit();
?>
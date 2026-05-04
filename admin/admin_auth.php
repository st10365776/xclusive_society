<?php
/**
 * ADMIN AUTHENTICATION CHECK
 * ==========================
 * This file is included in protected admin pages to verify admin session.
 * If user is not authenticated, redirects to admin login page.
 * 
 * Usage: Add "include 'admin_auth.php';" at the top of protected pages.
 */

session_start();

// Check if adminID session variable is set (meaning user is logged in)
if(!isset($_SESSION['adminID'])){
    // Redirect unauthenticated users to login
    header("Location: login.php");
    exit();
}
?>
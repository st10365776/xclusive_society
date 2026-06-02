<?php

session_start();

// Check if admin session variable is set (meaning user is logged in)
if(!isset($_SESSION['admin'])){
    // Redirect unauthenticated users to login
    header("Location: login.php");
    exit();
}
?>

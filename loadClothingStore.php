<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Reset Database</title>
</head>
<body>

<?php
/**
 * RESET/INITIALIZE DATABASE
 * =========================
 * This is a database maintenance script that drops and recreates all tables.
 * Useful for:
 * - Testing and development
 * - Resetting the database to a clean state
 * - Removing all user, order, clothing, and admin data
 * 
 * NOTE: USE WITH CAUTION - This will delete all data in the database!
 */

include "DBConn.php";

// Drop all existing tables in order (to avoid foreign key constraint issues)
$conn->query("DROP TABLE IF EXISTS tblAorder");      // Orders table
$conn->query("DROP TABLE IF EXISTS tblClothes");     // Clothes/Products table
$conn->query("DROP TABLE IF EXISTS tblUser");        // Users table
$conn->query("DROP TABLE IF EXISTS tblAdmin");       // Admin users table

// Display success message
echo "Tables deleted successfully";

// TODO: Add code here to recreate tables with proper schema if needed
// You would add CREATE TABLE statements here to re-initialize the database

?>

</body>
</html>
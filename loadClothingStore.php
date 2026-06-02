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

include "includes/DBConn.php";

// Drop all existing tables in order (to avoid foreign key constraint issues)
$conn->query("SET FOREIGN_KEY_CHECKS = 0");
$conn->query("DROP TABLE IF EXISTS tblOrderItems");  // Order item details
$conn->query("DROP TABLE IF EXISTS tblAorder");      // Orders table
$conn->query("DROP TABLE IF EXISTS tblClothes");     // Clothes/Products table
$conn->query("DROP TABLE IF EXISTS tblUser");        // Users table
$conn->query("DROP TABLE IF EXISTS tblAdmin");       // Admin users table
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

// Display success message
echo "Tables deleted successfully";

echo "<br><a href='createTable.php'>Recreate tables and reload products</a>";

?>

</body>
</html>

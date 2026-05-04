<?php
/**
 * DATABASE CONNECTION
 * ===================
 * Establishes connection to MySQL database using MySQLi.
 * Connection parameters:
 * - Host: localhost (local XAMPP server)
 * - User: root (default XAMPP user)
 * - Password: (empty - default XAMPP configuration)
 * - Database: ClothingStore
 * 
 * This file is included in all pages that require database access.
 * Exits with error message if connection fails.
 */

// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ClothingStore";

// Create MySQLi connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check if connection was successful
if ($conn->connect_error) {
    // Display error and stop execution if connection fails
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Setup - Create Database Tables</title>
</head>
<body>
    <?php
    /**
     * CREATE DATABASE TABLES
     * ======================
     * Database initialization script that:
     * 1. Drops existing tblUser table (if it exists)
     * 2. Creates new tblUser table with proper schema
     * 3. Loads user data from userData.txt CSV file
     * 
     * NOTE: This is a setup/maintenance script. Should only be run once
     * or when intentionally resetting the user data.
     */
    
    include "DBConn.php";

    // Drop the table if it already exists to avoid conflicts
    $conn->query("DROP TABLE IF EXISTS tblUser");

    // Create tblUser table with all necessary columns
    $sql = "CREATE TABLE tblUser (
        userID INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(150),
        password VARCHAR(255),
        verified BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Execute table creation
    $conn->query($sql);

    // Load user data from CSV file (userData.txt)
    $file = fopen("userData.txt","r");

    // Loop through each line in the CSV file
    while(($line = fgetcsv($file)) !== FALSE){

        // Extract user data from CSV columns
        $name = $line[0];
        $email = $line[1];
        $password = $line[2];

        // Insert user into database using prepared statement
        $stmt = $conn->prepare(
            "INSERT INTO tblUser(name,email,password)
             VALUES (?,?,?)"
        );

        // Bind parameters for security
        $stmt->bind_param("sss",$name,$email,$password);
        // Execute the insert
        $stmt->execute();
    }

    // Close the file
    fclose($file);

    // Display success message
    echo "tblUser recreated and data loaded!";
    ?>
</body>
</html>
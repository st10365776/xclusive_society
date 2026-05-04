<!-- 
    ==========================================
    SITE NAVIGATION HEADER
    ==========================================
    
    This is the main navigation bar displayed on all pages.
    Includes:
    - Logo and site branding
    - Main navigation links
    - Shopping cart icon
    - User profile and login links
    - Admin panel access
    
    This file is included at the top of all pages.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xclusive Society</title>

    <!-- Link to main stylesheet -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Import Poppins font family from Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Main navigation bar -->
    <nav class="navbar">

        <!-- Logo section - links back to home page -->
        <div class="logo">
            <a href="index.php">
                <img src="images/logo.png" alt="Xclusive Society Logo">
            </a>
        </div>

        <!-- Main navigation links -->
        <ul class="nav-links">
            <!-- New/Featured products -->
            <li><a href="new.php">New</a></li>
            <!-- Men's clothing category -->
            <li><a href="men.php">Men</a></li>
            <!-- Women's clothing category -->
            <li><a href="women.php">Women</a></li>
            <!-- Kids' clothing category -->
            <li><a href="kids.php">Kids</a></li>
            <!-- Contact page -->
            <li><a href="contact.php">Contact Us</a></li>
        </ul>

        <!-- User action icons and links -->
        <div class="icons">
            <!-- Shopping cart icon - links to cart page -->
            <a href="cart.php">🛒</a>
            <!-- User profile icon - links to profile page -->
            <a href="profile.php">👤</a>
            <!-- Login link for regular users -->
            <a href="login.php">Login</a>
            <!-- Admin panel access -->
            <a href="admin/login.php" class="admin-btn">Admin</a>
        </div>

    </nav>
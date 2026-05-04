<!-- 
    ==========================================
    XCLUSIVE SOCIETY - HOME PAGE
    ==========================================
    
    This is the main landing page of the Xclusive Society 
    e-commerce platform. It displays:
    - Hero section with brand messaging
    - Category cards for Men, Women, Kids, and New products
    - Navigation header and footer
    
    Author: Xclusive Society Team
    Last Updated: 2026
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Xclusive Society</title>
</head>
<body>
    <!-- Include navigation header -->
    <?php include 'includes/header.php'; ?>

<!-- Hero banner section with brand messaging -->
<section class="hero">
    <div class="hero-content">
        <h1>XCLUSIVE SOCIETY</h1>
        <p>Built Different.</p>
        <!-- Call-to-action button directing users to new products -->
        <a href="new.php" class="btn">Shop Now</a>
    </div>
</section>

<!-- Product category cards section -->
<section class="categories">
    <!-- Men's clothing category -->
    <div class="card">
        <a href="men.php">MEN</a>
    </div>

    <!-- Women's clothing category -->
    <div class="card2">
        <a href="women.php">WOMEN</a>
    </div>

    <!-- Kids' clothing category -->
    <div class="card3">
        <a href="kids.php">KIDS</a>
    </div>

    <!-- New products category -->
    <div class="card4">
        <a href="new.php">NEW</a>
    </div>
</section>

<!-- Include footer -->
<?php include 'includes/footer.php'; ?>
</body>
</html>
<!-- 
    ==========================================
    XCLUSIVE SOCIETY - HOME PAGE
    ==========================================
    
    This is the main landing page of the Xclusive Society 
    e-commerce platform. It displays:
    - Modern hero section with brand messaging
    - Featured products section
    - Category cards for Men, Women, Kids, and New products
    - Trust badges and features
    - Newsletter signup
    - Navigation header and footer
    
    Author: Xclusive Society Team
    Last Updated: 2026
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Xclusive Society - Premium Fashion Store</title>
</head>
<body>
    <!-- Include navigation header -->
    <?php include 'includes/header.php'; ?>

    <!-- Hero banner section with brand messaging -->
    <section class="hero">
        <div class="hero-content">
            <h1>XCLUSIVE SOCIETY</h1>
            <p>Discover premium, curated fashion built different. Elevate your style with our exclusive collections.</p>
            <!-- Call-to-action button directing users to new products -->
            <a href="new.php" class="btn btn-primary">Shop New Arrivals</a>
        </div>
    </section>

    <!-- Trust & Features Section -->
    <section class="features-section">
        <div class="features-container">
            <div class="feature-item">
                <i class="fas fa-truck"></i>
                <h3>Free Shipping</h3>
                <p>On orders over R500</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-undo"></i>
                <h3>Easy Returns</h3>
                <p>30-day return policy</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-lock"></i>
                <h3>Secure Payment</h3>
                <p>100% safe transactions</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Dedicated customer service</p>
            </div>
        </div>
    </section>

    <!-- Category Cards Section -->
    <section class="categories-showcase">
        <h2>Shop By Category</h2>
        <div class="categories">
            <!-- Men's clothing category -->
            <div class="category-card card-men">
                <div class="card-overlay"></div>
                <div class="card-content">
                    <h3>Men's Collection</h3>
                    <p>Explore premium styles</p>
                    <a href="men.php" class="card-btn">Browse Men →</a>
                </div>
            </div>

            <!-- Women's clothing category -->
            <div class="category-card card-women">
                <div class="card-overlay"></div>
                <div class="card-content">
                    <h3>Women's Collection</h3>
                    <p>Elegant & trendy pieces</p>
                    <a href="women.php" class="card-btn">Browse Women →</a>
                </div>
            </div>

            <!-- Kids' clothing category -->
            <div class="category-card card-kids">
                <div class="card-overlay"></div>
                <div class="card-content">
                    <h3>Kids' Collection</h3>
                    <p>Fun & fashionable styles</p>
                    <a href="kids.php" class="card-btn">Browse Kids →</a>
                </div>
            </div>

            <!-- New products category -->
            <div class="category-card card-new">
                <div class="card-overlay"></div>
                <div class="card-content">
                    <h3>New Arrivals</h3>
                    <p>Latest trends & exclusive drops</p>
                    <a href="new.php" class="card-btn">Shop New →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-section">
        <div class="section-header">
            <h2>Featured Products</h2>
            <p>Handpicked pieces to elevate your wardrobe</p>
        </div>
        
        <div class="featured-grid">
            <?php
            require_once 'includes/DBConn.php';
            require_once 'includes/product_helpers.php';
            require_once 'includes/schema_helpers.php';
            
            ensureStoreSchema($conn);
            
            // Fetch the most popular/latest products from database
            $sql = "SELECT productCode, productName, price, imagePath, quantity
                    FROM tblClothes
                    WHERE isActive = 1 AND price > 0 AND quantity > 0
                    ORDER BY displayOrder DESC, productID DESC
                    LIMIT 6";
            
            $result = $conn->query($sql);
            $product_count = 0;
            
            if ($result && $result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    $code = htmlspecialchars($product['productCode']);
                    $name = htmlspecialchars($product['productName']);
                    $price = htmlspecialchars(formatRand($product['price']));
                    $image = htmlspecialchars($product['imagePath']);
                    $quantity = (int)($product['quantity'] ?? 0);
                    ?>
                    <div class="featured-product">
                        <div class="product-image-wrapper">
                            <img src="<?= $image; ?>" alt="<?= $name; ?>" class="product-img">
                            <div class="product-badge">Featured</div>
                            <div class="product-overlay">
                                <form action="add_to_cart.php" method="POST" style="width: 100%;">
                                    <input type="hidden" name="id" value="<?= $code; ?>">
                                    <button type="submit" class="btn btn-secondary" <?= $quantity <= 0 ? 'disabled' : ''; ?>>
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="product-info">
                            <h4><?= $name; ?></h4>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="product-price">R<?= $price; ?></p>
                            <p class="product-stock"><?= $quantity > 0 ? $quantity . ' in stock' : 'Out of stock'; ?></p>
                        </div>
                    </div>
                    <?php
                    $product_count++;
                }
            } else {
                // If no products with price > 0, fetch any available products
                $sql_fallback = "SELECT productCode, productName, price, imagePath, quantity
                                FROM tblClothes
                                WHERE isActive = 1
                                ORDER BY displayOrder DESC, productID DESC
                                LIMIT 6";
                
                $result = $conn->query($sql_fallback);
                
                if ($result && $result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $code = htmlspecialchars($product['productCode']);
                        $name = htmlspecialchars($product['productName']);
                        $price = htmlspecialchars(formatRand($product['price']));
                        $image = htmlspecialchars($product['imagePath']);
                        $quantity = (int)($product['quantity'] ?? 0);
                        ?>
                        <div class="featured-product">
                            <div class="product-image-wrapper">
                                <img src="<?= $image; ?>" alt="<?= $name; ?>" class="product-img">
                                <div class="product-badge">Featured</div>
                                <div class="product-overlay">
                                    <form action="add_to_cart.php" method="POST" style="width: 100%;">
                                        <input type="hidden" name="id" value="<?= $code; ?>">
                                        <button type="submit" class="btn btn-secondary" <?= $quantity <= 0 ? 'disabled' : ''; ?>>
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="product-info">
                                <h4><?= $name; ?></h4>
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="product-price">R<?= $price; ?></p>
                                <p class="product-stock"><?= $quantity > 0 ? $quantity . ' in stock' : 'Out of stock'; ?></p>
                            </div>
                        </div>
                        <?php
                        $product_count++;
                    }
                }
            }
            
            // If still no products, show a placeholder
            if ($product_count == 0) {
                ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <p style="font-size: 18px; color: #666;">Featured products will be displayed here once they're available.</p>
                    <a href="new.php" class="btn btn-primary" style="margin-top: 20px;">Browse All Products</a>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div class="section-cta">
            <a href="new.php" class="btn btn-primary">View All Products</a>
        </div>
    </section>

    <!-- Promo Banner Section -->
    <section class="promo-banner">
        <div class="promo-content">
            <h2>Exclusive Member Benefits</h2>
            <p>Get early access to new collections, exclusive discounts, and personalized style recommendations</p>
            <a href="register.php" class="btn btn-light">Join Xclusive Society</a>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Subscribe to get special offers and the latest fashion updates delivered to your inbox</p>
            <form class="newsletter-form" id="newsletter-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
            <p class="newsletter-note">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </section>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>

    <script>
        // Newsletter form handling
        document.getElementById('newsletter-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            alert('Thank you for subscribing! Check your email for exclusive offers.');
            this.reset();
        });

        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
<?php

function getProductsByCategory(mysqli $conn, string $category): mysqli_result
{
    $sql = "SELECT productCode, productName, price, imagePath
            FROM tblClothes
            WHERE LOWER(category) = ? AND isActive = 1
            ORDER BY displayOrder, productID";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();

    return $stmt->get_result();
}

function formatRand($price): string
{
    $amount = number_format((float)$price, 2, '.', '');
    return rtrim(rtrim($amount, '0'), '.');
}

function renderProductGrid(mysqli_result $products): void
{
    if ($products->num_rows === 0) {

        echo '<p>No products available.</p>';
        return;

    }

    while ($product = $products->fetch_assoc()) {

        $code  = htmlspecialchars($product['productCode']);
        $name  = htmlspecialchars($product['productName']);
        $price = htmlspecialchars(formatRand($product['price']));
        $image = htmlspecialchars($product['imagePath']);
        ?>

        <div class="product">

            <form action="add_to_cart.php"
                  method="POST"
                  onsubmit="return confirmAddToCart('<?= $price; ?>')">

                <!-- Product Image -->
                <img src="<?= $image; ?>" alt="<?= $name; ?>">

                <!-- Product Name -->
                <h3><?= $name; ?></h3>

                <!-- Product Price -->
                <p>R<?= $price; ?></p>

                <!-- Hidden Product ID -->
                <input type="hidden"
                       name="id"
                       value="<?= $code; ?>">

                <!-- Image/Icon Add To Cart Button -->
                <button type="submit" class="cart-btn">
                     <!-- <img src="images/add-to-cart-iconn.png" alt="Add to Cart"> -->
                      <!-- <img src = "images/add-to-cart-icon_.gif" alt = "Add to Cart"> -->
                    <img src = "images\Add-Cart.gif" alt = "Add to Cart"> 
                    
                </button>

            </form>

        </div>

        <?php
    }
}

?>

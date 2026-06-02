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
        $code = htmlspecialchars($product['productCode']);
        $name = htmlspecialchars($product['productName']);
        $price = htmlspecialchars(formatRand($product['price']));
        $image = htmlspecialchars($product['imagePath']);
        ?>
        <div class="product">
            <form action="add_to_cart.php" method="POST">
                <img src="<?= $image; ?>" alt="<?= $name; ?>">
                <h3><?= $name; ?></h3>
                <p>R<?= $price; ?></p>
                <input type="hidden" name="id" value="<?= $code; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php
    }
}
?>

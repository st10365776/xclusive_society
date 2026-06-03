<?php
include 'admin_auth.php';
require_once '../includes/DBConn.php';

$message = "";
$error = "";
$categories = ['new', 'men', 'women', 'kids'];

function ensureProductColumn(mysqli $conn, string $column, string $definition): void
{
    $columnCheck = $conn->query("SHOW COLUMNS FROM tblClothes LIKE '$column'");
    if ($columnCheck && $columnCheck->num_rows === 0) {
        $conn->query("ALTER TABLE tblClothes ADD $column $definition");
    }
}

ensureProductColumn($conn, 'description', 'TEXT DEFAULT NULL AFTER category');
ensureProductColumn($conn, 'isActive', 'BOOLEAN DEFAULT TRUE');
ensureProductColumn($conn, 'displayOrder', 'INT DEFAULT 0');
$conn->query("ALTER TABLE tblClothes MODIFY category VARCHAR(30) NOT NULL");
$conn->query("UPDATE tblClothes SET category = LOWER(category)");

$editProduct = null;

if (isset($_GET['edit'])) {
    $editID = intval($_GET['edit']);
    $stmt = $conn->prepare("SELECT productID, productName, category, description, price, imagePath, isActive FROM tblClothes WHERE productID = ?");
    $stmt->bind_param("i", $editID);
    $stmt->execute();
    $editProduct = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_product') {
    $productID = intval($_POST['productID'] ?? 0);

    $stmt = $conn->prepare("DELETE FROM tblClothes WHERE productID = ?");
    $stmt->bind_param("i", $productID);

    if ($stmt->execute()) {
        $message = "Product deleted successfully.";
        $editProduct = null;
    } else {
        $error = "Could not delete product: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_product') {
    $productID = intval($_POST['productID'] ?? 0);
    $isEditing = $productID > 0;
    $productName = trim($_POST['productName'] ?? '');
    $category = strtolower(trim($_POST['category'] ?? ''));
    $price = trim($_POST['price'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $dbImagePath = $_POST['existingImage'] ?? '';

    if ($productName === '' || $category === '' || $price === '') {
        $error = "Product name, category, and price are required.";
    } elseif (!in_array($category, $categories, true)) {
        $error = "Please choose a valid category.";
    } elseif (!is_numeric($price) || (float)$price < 0) {
        $error = "Please enter a valid price.";
    } elseif (!$isEditing && (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)) {
        $uploadErrors = [
            UPLOAD_ERR_INI_SIZE => "The image is bigger than the server upload limit.",
            UPLOAD_ERR_FORM_SIZE => "The image is bigger than the form upload limit.",
            UPLOAD_ERR_PARTIAL => "The image only uploaded partly. Please try again.",
            UPLOAD_ERR_NO_FILE => "Please upload a product image.",
            UPLOAD_ERR_NO_TMP_DIR => "The server upload folder is missing.",
            UPLOAD_ERR_CANT_WRITE => "The server could not write the uploaded image.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the upload."
        ];
        $uploadCode = $_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE;
        $error = $uploadErrors[$uploadCode] ?? "Please upload a product image.";
    } else {
        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
        $hasNewImage = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK;

        if ($hasNewImage) {
            $fileType = mime_content_type($_FILES['image']['tmp_name']);

            if (!isset($allowedTypes[$fileType])) {
                $error = "Only JPG, PNG, WEBP, and GIF images are allowed.";
            }
        }

        if ($error === "" && $hasNewImage) {
            $uploadDir = '../images/products';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!is_writable($uploadDir)) {
                chmod($uploadDir, 0777);
            }

            if (!is_writable($uploadDir)) {
                $error = "The images/products folder is not writable.";
            } else {
                $baseName = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
                $safeName = preg_replace('/[^A-Za-z0-9_-]/', '-', $baseName);
                $fileName = $category . '-' . time() . '-' . $safeName . '.' . $allowedTypes[$fileType];
                $targetPath = $uploadDir . '/' . $fileName;
                $dbImagePath = 'images/products/' . $fileName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $error = "Could not upload image.";
                }
            }
        }

        if ($error === "") {
            $priceValue = (float)$price;

            if ($isEditing) {
                $stmt = $conn->prepare(
                    "UPDATE tblClothes
                     SET productName = ?, category = ?, description = ?, price = ?, imagePath = ?
                     WHERE productID = ?"
                );
                $stmt->bind_param("sssdsi", $productName, $category, $description, $priceValue, $dbImagePath, $productID);

                if ($stmt->execute()) {
                    $message = "Product updated successfully.";
                    $editProduct = null;
                } else {
                    $error = "Could not update product: " . $stmt->error;
                }
            } else {
                $productCode = $category . uniqid('', true);
                $displayOrderResult = $conn->prepare("SELECT COALESCE(MAX(displayOrder), 0) + 1 AS nextOrder FROM tblClothes WHERE LOWER(category) = ?");
                $displayOrderResult->bind_param("s", $category);
                $displayOrderResult->execute();
                $displayOrder = $displayOrderResult->get_result()->fetch_assoc()['nextOrder'];

                $stmt = $conn->prepare(
                    "INSERT INTO tblClothes(productCode, productName, category, description, price, imagePath, displayOrder)
                     VALUES (?, ?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("ssssdsi", $productCode, $productName, $category, $description, $priceValue, $dbImagePath, $displayOrder);

                if ($stmt->execute()) {
                    $message = "Product added successfully.";
                } else {
                    $error = "Could not save product: " . $stmt->error;
                }
            }
        }
    }
}

$products = $conn->query("SELECT productID, productName, category, description, price, imagePath, isActive FROM tblClothes ORDER BY category, displayOrder, productID DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Products</title>

<style>
body{margin:0;font-family:Arial;background:#121212;color:white;}
.admin-layout{display:flex;min-height:100vh;}
.sidebar{width:220px;background:#1e1e1e;padding:20px;}
.sidebar a{display:block;color:white;padding:12px;text-decoration:none;margin-bottom:10px;border-radius:6px;background:#2a2a2a;}
.sidebar a:hover{background:#ff3c3c;}
.logout{background:#ff3c3c;}
.content{flex:1;padding:40px;}
.card{background:#1e1e1e;padding:20px;border-radius:10px;margin-bottom:24px;}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;}
label{display:block;font-size:14px;margin-bottom:6px;color:#ddd;}
input,select,textarea{width:100%;box-sizing:border-box;padding:10px;border:none;border-radius:5px;background:#2a2a2a;color:white;}
textarea{min-height:100px;resize:vertical;}
.full{grid-column:1 / -1;}
button{padding:10px 14px;border:none;border-radius:5px;cursor:pointer;background:#ff3c3c;color:white;}
.button-link{display:inline-block;padding:9px 12px;border-radius:5px;background:#2a2a2a;color:white;text-decoration:none;margin-right:6px;}
.button-link:hover{background:#ff3c3c;}
.delete-btn{background:#b91c1c;margin-top:6px;}
.inline-form{display:inline;}
table{width:100%;border-collapse:collapse;}
th,td{padding:12px;border-bottom:1px solid #333;text-align:left;vertical-align:top;}
.product-img{width:70px;height:70px;object-fit:cover;border-radius:6px;background:#2a2a2a;}
.message{color:#6ee76e;}
.error{color:#ff7373;}
.muted{color:#aaa;font-size:13px;}
</style>
</head>

<body>
<div class="admin-layout">
<div class="sidebar">
<h2>Admin Panel</h2>
<a href="dashboard.php">Dashboard</a>
<a href="customers.php">Customers</a>
<a href="products.php">Products</a>
<a href="seller_submissions.php">Seller Submissions</a>
<a href="message_user.php?id=<?= $row['userID'] ?>">Message Seller</a>
<a href="logout.php" class="logout">Logout</a>
</div>

<div class="content">
<div class="card">
<h2><?= $editProduct ? 'Edit Product' : 'Add Product'; ?></h2>

<?php if($message): ?><p class="message"><?= htmlspecialchars($message); ?></p><?php endif; ?>
<?php if($error): ?><p class="error"><?= htmlspecialchars($error); ?></p><?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="form-grid">
<input type="hidden" name="action" value="save_product">
<input type="hidden" name="productID" value="<?= htmlspecialchars($editProduct['productID'] ?? ''); ?>">
<input type="hidden" name="existingImage" value="<?= htmlspecialchars($editProduct['imagePath'] ?? ''); ?>">

<div>
<label>Product Name</label>
<input name="productName" value="<?= htmlspecialchars($editProduct['productName'] ?? ''); ?>" required>
</div>

<div>
<label>Price</label>
<input name="price" type="number" min="0" step="0.01" value="<?= htmlspecialchars($editProduct['price'] ?? ''); ?>" required>
</div>

<div>
<label>Category</label>
<select name="category" required>
<?php foreach($categories as $categoryOption): ?>
<option value="<?= $categoryOption; ?>" <?= (($editProduct['category'] ?? '') === $categoryOption) ? 'selected' : ''; ?>>
<?= htmlspecialchars(ucfirst($categoryOption)); ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div>
<label>Product Image</label>
<input name="image" type="file" accept="image/jpeg,image/png,image/webp,image/gif" <?= $editProduct ? '' : 'required'; ?>>
<?php if($editProduct): ?>
<p class="muted">Leave blank to keep the current image.</p>
<?php endif; ?>
</div>

<div class="full">
<label>Description</label>
<textarea name="description"><?= htmlspecialchars($editProduct['description'] ?? ''); ?></textarea>
</div>

<div class="full">
<button type="submit"><?= $editProduct ? 'Save Changes' : 'Add Product'; ?></button>
<?php if($editProduct): ?>
<a href="products.php" class="button-link">Cancel Edit</a>
<?php endif; ?>
</div>
</form>
</div>

<div class="card">
<h2>Current Products</h2>

<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Description</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php while($product = $products->fetch_assoc()): ?>
<tr>
<td><img class="product-img" src="../<?= htmlspecialchars($product['imagePath']); ?>" alt="<?= htmlspecialchars($product['productName']); ?>"></td>
<td><?= htmlspecialchars($product['productName']); ?></td>
<td><?= htmlspecialchars(ucfirst($product['category'])); ?></td>
<td>R<?= number_format((float)$product['price'], 2); ?></td>
<td class="muted"><?= nl2br(htmlspecialchars($product['description'] ?? '')); ?></td>
<td><?= $product['isActive'] ? 'Active' : 'Hidden'; ?></td>
<td>
<a href="products.php?edit=<?= $product['productID']; ?>" class="button-link">Edit</a>
<form method="POST" class="inline-form" onsubmit="return confirm('Delete this product?')">
<input type="hidden" name="action" value="delete_product">
<input type="hidden" name="productID" value="<?= $product['productID']; ?>">
<button type="submit" class="delete-btn">Delete</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>
</div>
</div>
</body>
</html>

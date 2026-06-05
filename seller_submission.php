<?php
session_start();
include 'includes/DBConn.php';

/*
|--------------------------------------------------------------------------
| CHECK IF USER IS LOGGED IN
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$message = "";

/*
|--------------------------------------------------------------------------
| HANDLE FORM SUBMISSION
|--------------------------------------------------------------------------
*/

if (isset($_POST['submit_item'])) {

    // Logged in user ID
    $userID = $_SESSION['userID'];

    // Form values
    $itemName   = trim($_POST['itemName']);
    $brand      = trim($_POST['brand']);
    $size       = trim($_POST['size']);
    $category   = trim($_POST['category']);
    $condition  = trim($_POST['condition']);
    $description= trim($_POST['description']);
    $price      = trim($_POST['price']);

    /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD
    |--------------------------------------------------------------------------
    */

    $imagePath = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        // Create uploads folder if it does not exist
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // File info
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $target   = "uploads/" . $fileName;

        // Move uploaded image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $imagePath = $target;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | INSERT INTO DATABASE
    |--------------------------------------------------------------------------
    */

    $status = "Pending";

    $stmt = $conn->prepare("
        INSERT INTO tblSellerSubmissions
        (
            userID,
            itemName,
            brand,
            size,
            category,
            itemCondition,
            description,
            askingPrice,
            imagePath,
            status
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "issssssdss",
        $userID,
        $itemName,
        $brand,
        $size,
        $category,
        $condition,
        $description,
        $price,
        $imagePath,
        $status
    );

    if ($stmt->execute()) {
        $message = "✅ Product submitted successfully. Waiting for admin approval.";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sell Product</title>

<style>

body{
    margin:0;
    padding:0;
    font-family:Arial, sans-serif;
    background:#f5f5f5;
}

.form-container{
    width:500px;
    max-width:90%;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.form-container h2{
    margin-bottom:20px;
    text-align:center;
}

.message{
    margin-bottom:20px;
    padding:12px;
    border-radius:6px;
    background:#f0f0f0;
    text-align:center;
}

input,
textarea,
select{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:6px;
    font-size:15px;
    box-sizing:border-box;
}

textarea{
    resize:vertical;
    min-height:120px;
}

button{
    width:100%;
    background:black;
    color:white;
    border:none;
    padding:14px;
    border-radius:6px;
    cursor:pointer;
    font-size:16px;
    transition:0.3s;
}

button:hover{
    background:#333;
}

.back-button{
    display:inline-block;
    margin-top:15px;
    width:100%;
    background:#f5f5f5;
    color:#111;
    border:2px solid #ddd;
    padding:12px;
    border-radius:6px;
    text-align:center;
    text-decoration:none;
    font-size:15px;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
    box-sizing:border-box;
}

.back-button:hover{
    background:#e8e8e8;
    border-color:#111;
}

</style>

</head>

<body>

<div class="form-container">

    <h2>Sell Your Clothing Item</h2>

    <?php if($message != ""): ?>
        <div class="message">
            <?= $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <input type="text"
               name="itemName"
               placeholder="Item Name"
               required>

        <input type="text"
               name="brand"
               placeholder="Brand"
               required>

        <input type="text"
               name="size"
               placeholder="Size"
               required>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="men">Men</option>
            <option value="women">Women</option>
            <option value="kids">Kids</option>
        </select>
        
        <select name="condition" required>
            <option value="">Select Condition</option>
            <option value="New">New</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Used">Used</option>
        </select>

        <textarea name="description"
                  placeholder="Item Description"
                  required></textarea>

        <input type="number"
               step="0.01"
               name="price"
               placeholder="Asking Price"
               required>

        <input type="file"
               name="image"
               accept="image/*"
               required>

        <button type="submit" name="submit_item">
            Submit Product
        </button>

    </form>

    <a href="javascript:history.back()" class="back-button">← Go Back</a>

</div>

</body>
</html>
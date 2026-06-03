<?php
session_start();
include '../includes/DBConn.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: seller_submissions.php");
    exit();
}

$id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| GET SUBMISSION
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare("
    SELECT *
    FROM tblSellerSubmissions
    WHERE submissionID = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

if(!$product){
    header("Location: seller_submissions.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| INSERT INTO tblClothes
|--------------------------------------------------------------------------
*/

$category = "men"; // default category

$isActive = 1;

$stmt2 = $conn->prepare("
    INSERT INTO tblClothes
    (
        productName,
        price,
        category,
        imagePath,
        description,
        isActive
    )
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt2->bind_param(
    "sdsssi",
    $product['itemName'],
    $product['askingPrice'],
    $category,
    $product['imagePath'],
    $product['description'],
    $isActive
);

$stmt2->execute();

/*
|--------------------------------------------------------------------------
| DELETE SUBMISSION AFTER APPROVAL
|--------------------------------------------------------------------------
*/

$delete = $conn->prepare("
    DELETE FROM tblSellerSubmissions
    WHERE submissionID = ?
");

$delete->bind_param("i", $id);
$delete->execute();

header("Location: seller_submissions.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
session_start();
include 'includes/DBConn.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['userID'];
?>

<?php include 'includes/header.php'; ?>

<?php
// GET USER INFO
$sql = "SELECT * FROM tblUser WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<h1>Welcome, <?php echo htmlspecialchars($user['name']); ?> 👋</h1>
<p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

<hr>

<h2>Your Orders</h2>

<?php
// GET ORDERS FROM tblAorder
$orderSQL = "SELECT * FROM tblAorder WHERE userID = ? ORDER BY orderID DESC";
$stmt = $conn->prepare($orderSQL);
$stmt->bind_param("i", $userID);
$stmt->execute();
$orders = $stmt->get_result();

if ($orders->num_rows == 0) {
    echo "<p>No orders yet.</p>";
} else {
    while ($order = $orders->fetch_assoc()) {
        echo "
        <div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>
            <p>Order ID: {$order['orderID']}</p>
            <p>Total: R{$order['totalAmount']}</p>
            <p>Status: {$order['status']}</p>
        </div>";
    }
}
?>

<?php include 'includes/footer.php'; ?>

<h1>Welcome <?= $_SESSION['name']; ?></h1>

<a href="logout.php">Logout</a>

</body>
</html>
</body>
</html>
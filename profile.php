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

<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
}

.profile-container {
    max-width: 900px;
    margin: auto;
    padding: 20px;
}

.profile-card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.order-card {
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    background: #fafafa;
}

.order-header {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
}

.status {
    padding: 5px 10px;
    background: #333;
    color: #fff;
    border-radius: 5px;
    font-size: 12px;
}

.cancel-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background: red;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
}

.cancel-btn:hover {
    background: darkred;
}
</style>

<div class="profile-container">

<!-- USER INFO -->
<div class="profile-card">

<?php
$sql = "SELECT * FROM tblUser WHERE userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<h2>Welcome, <?= htmlspecialchars($user['name']); ?> 👋</h2>
<p>Email: <?= htmlspecialchars($user['email']); ?></p>

<a href="logout.php" class="logout-btn">Logout</a>

</div>

<!-- ORDERS -->
<div class="profile-card">

<h2>Your Orders</h2>

<?php
$orderSQL = "SELECT * FROM tblAorder WHERE userID = ? ORDER BY orderID DESC";
$stmt = $conn->prepare($orderSQL);
$stmt->bind_param("i", $userID);
$stmt->execute();
$orders = $stmt->get_result();

if ($orders->num_rows == 0) {
    echo "<p>No orders yet.</p>";
} else {

    while ($order = $orders->fetch_assoc()) {
        ?>

        <div class="order-card">

            <div class="order-header">
                <span>Order #<?= $order['orderID']; ?></span>
                <span class="status">Pending</span>
            </div>

            <p>Total: R<?= $order['total']; ?></p>
            <p>Date: <?= $order['orderDate']; ?></p>

            <!-- CANCEL ORDER -->
            <a class="cancel-btn"
               href="cancel-order.php?orderID=<?= $order['orderID']; ?>"
               onclick="return confirm('Cancel this order?')">
               Cancel Order
            </a>

        </div>

        <?php
    }
}
?>

</div>

</div>
<a href="logout.php" class="logout-btn">Logout</a>

<?php include 'includes/footer.php'; ?>

</body>
</html>
</body>
</html>
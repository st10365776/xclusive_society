<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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

<a href="logout.php" class="logout">Logout</a>

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

<?php include 'includes/footer.php'; ?>

</body>
</html>
</body>
</html>
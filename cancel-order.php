<?php
session_start();
include 'includes/DBConn.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['orderID'])) {

    $orderID = $_GET['orderID'];
    $userID = $_SESSION['userID'];

    // ⚠️ IMPORTANT: ensure user can only delete THEIR own orders
    $sql = "DELETE FROM tblAorder WHERE orderID = ? AND userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $orderID, $userID);
    $stmt->execute();
}

header("Location: profile.php");
exit();
?>
<?php
session_start();
include '../includes/DBConn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM tblUser WHERE userID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: customers.php");

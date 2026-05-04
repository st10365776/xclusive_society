<?php
session_start();
require_once '../includes/DBConn.php';

/* =========================
   ADMIN AUTH CHECK
========================= */
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

/* =========================
   GET USER ID SAFELY
========================= */
if (!isset($_GET['id'])) {
    header("Location: customers.php");
    exit();
}

$id = intval($_GET['id']); // prevents injection

/* =========================
   UPDATE USER TO VERIFIED
========================= */
$stmt = $conn->prepare("UPDATE tblUser SET verified = 1 WHERE userID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

/* =========================
   REDIRECT BACK
========================= */
header("Location: customers.php");
exit();
?>